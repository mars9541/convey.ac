<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use PayPal;
class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'ItSolutionStuff.com',
                'price' => 100,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

        $provider = new PayPalClient;

        // Through facade. No need to import namespaces


        $response = $provider->setExpressCheckout($data);
        dd($response);
        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment was successfull. The payment success page goes here!');
        }

        dd('Error occured!');
    }

    public function test_paypal(Request $request) {
        $provider = new PayPalClient;
        $config = array(
            'mode' => getenv('PAYPAL_MODE'),
            'client_id' => getenv('PAYPAL_SANDBOX_CLIENT_ID'),
            'client_secret' => getenv('PAYPAL_SANDBOX_CLIENT_ID'),
            'app_id' => 'APP-80W284485P519543T',
        );

        // Through facade. No need to import namespaces
        $provider = PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());
        $provider->setCurrency('EUR');
        /*$reponse = $provider->createOrder([
                                "intent"=> "CAPTURE",
                                "purchase_units"=> [
                                    [
                                        "amount"=> [
                                            "value"=> "100.00"
                                        ],
                                        'payee'=>[
                                            'email_address' => 'xiaogao323@gmail.com'
                                        ]
                                    ]

                                ]
                                ]);*/
        $reponse = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ],
                    'payee'=>[
                        'email_address' => 'xiaogao323@gmail.com'
                    ]
                ]

            ]
        ]);
        dd($reponse);
        $reponse = $provider->authorizePaymentOrder($reponse['id']);
        dd($reponse);
        /*$reponse = $provider->capturePaymentOrder($reponse['id']);
dd($reponse);*/

    }
}
