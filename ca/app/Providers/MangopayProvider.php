<?php
namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use InvalidArgumentException;
use MangoPay\MangoPayApi;

class MangopayProvider extends IlluminateServiceProvider
{

    /**
    * The Mangopay URLs used by the API
    */
    public const BASE_URL_SANDBOX = 'https://api.sandbox.mangopay.com';
    public const BASE_URL_PRODUCTION = 'https://api.mangopay.com';

    /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = true;

    /**
    * Determine if this is a Lumen application.
    */
    protected function isLumen(): bool
    {
        return Str::contains($this->app->version(), 'Lumen');
    }

    /**
    * Bootstrap the application services.
    */
    public function boot(): void
    {
        $source = dirname(__DIR__) . '/../resources/config/mangopay.php';
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('mangopay.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('mangopay');
        }
        $this->mergeConfigFrom($source, 'mangopay');
    }

    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->singleton(MangoPayApi::class, function ($app) {

            // Load the configuration and instantiate the API
            $config = $app['config'][$this->isLumen()?'mangopay':'services.mangopay'];
            $api = new MangoPayApi();
            // Set the client id and password

            if (!$clientId = Arr::get($config, 'key')) {
                throw new InvalidArgumentException('Mangopay key not configured');
            }

            if (!$clientPassword = Arr::get($config, 'secret')) {
                throw new InvalidArgumentException('Mangopay secret not configured');
            }

            if (!$env = Arr::get($config, 'env')) {
                throw new InvalidArgumentException('Mangopay environment not configured');
            }

            $api->Config->ClientId = $clientId;
            $api->Config->ClientPassword = $clientPassword;

            // Set the base URL based on the environment defined in config

            $api->Config->BaseUrl = $this->getURL($env);

            // Use the Laravel logger

            $api->setLogger($app['log']);

            // Set a custom storage strategy if set in config

            if ($storageClass = Arr::get($app['config'], 'mangopay.StorageClass', null)) {
                $storageClass = $app->make($storageClass);
                $api->OAuthTokenManager->RegisterCustomStorageStrategy($storageClass);
            }

            // Set a default temp folder (can be overridden in the config,
            // but should be different for each environment according to
            // the Mangopay SDK specifications)

            $path = storage_path('mangopay' . DIRECTORY_SEPARATOR . $env . DIRECTORY_SEPARATOR);
            $api->Config->TemporaryFolder = $path;

            // Set any extra options specified in the configuration

            $extras = Arr::get($app['config'], 'mangopay', []);
            foreach ($extras as $property => $value) {
                if ($property === 'StorageClass') {
                    $storageClass = $app->make($value);
                    $api->OAuthTokenManager->RegisterCustomStorageStrategy($storageClass);
                } else {
                    $api->Config->{$property} = $value;
                }
            }

            // Return the configured API client

            return $api;
        });

        $this->app->bind('command.mangopay:mkdir', CreateDirectories::class);

        $this->commands([
        'command.mangopay:mkdir',
        ]);
    }

    /**
    * Get the services provided by the provider.
    *
    * @return array
    */
    public function provides()
    {
        return [MangoPayApi::class];
    }

    /**
    * Return the appropriate API URL based on the environment.
    *
    * @param $environment
    * @return string
    */
    public function getURL($environment)
    {
        try {
            return constant('self::BASE_URL_' . strtoupper($environment));
        } catch (\Exception $e) {
            throw new InvalidArgumentException('Mangopay environment should be one of "sandbox" or "production"');
        }
    }

}
