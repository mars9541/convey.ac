<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'ASjVB3pxSzs8qUGGuJEO-tWbgKimhM-rtDPy17aAihSPW2ZEew-N90-KOu1InahNzNCO6Z20F7A0FU2O'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'EJtiiWLPB9MxswWH3zxSRK8C2qd4ORd0cc5R2PU4KCwIzXFoXdk3ZT1IPgyADZTHVWfkA1RjV0Pcrjml'),
        'app_id'            => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'GBP'),
    'building_type'  => env('MerchantInitiatedBilling'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
