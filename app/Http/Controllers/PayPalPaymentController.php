<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Traits\BonoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Crypt;
use Database\Seeders\ProductWarehouseSeeder;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentController extends Controller
{

    use BonoTrait;

    public $credentials;
    public function __construct()
    {
        $this->credentials = config('paypal');
        $this->credentials['sandbox']['client_id'] =  Crypt::decryptString('eyJpdiI6IlZ2bXlmZGNsSENSM0tLWW1rcGtmb3c9PSIsInZhbHVlIjoidjZyYVNxbEYvUnFBSEVYYXFVdkJSeDRGZys0YWV3V1RNYTlMdHZZb3IyVUp2V2ovQis3N0wyc1JPWXJxSXYxc2orTExYWHd1Nmt0MTR2aWpUaGFGQ25WNzE0MlZ6Wi9yWmJ3a2QzT1BlYXRpZ0ljMUFVN2VnYTR6eFZsNzlXR1IiLCJtYWMiOiI3YjhkZWMxYmFlYzcxNDIxMjVhYTA1ODlmMTg2YzAxNmYwMGFkODQwNDU3OTM0YmQ4ZDBhNGE1MjA4NWM0OTNlIiwidGFnIjoiIn0=');
        $this->credentials['sandbox']['client_secret'] = Crypt::decryptString('eyJpdiI6Ik05UitwNFBKbENPRU1xdHJPaTJraHc9PSIsInZhbHVlIjoiWXZvL0pEZS9XQnorZlQvd3lQaW56NHAvcDI0ZXQ0cFlGM1VYV0U0VERjbFVGTEtYZnMzS2dZZkl5dXFsODZlLzRZZGwrTXAzK3pYYUU0VTB0dEcwMkVGM05iMTFKUDVtNGs4cURUSHdVQUt4a0hsUmVnODNNa0h5Qjd4dXRYK20iLCJtYWMiOiI4NmQwY2I5NDhlNjc1NDMzM2M1MWEyMjA5ZmM0YWMxYmI4NmRjZjY3MTk2OTgwMDZhY2I1ODRmYzBkZDE5YmY2IiwidGFnIjoiIn0=');
        $this->credentials['live']['client_id'] = Crypt::decryptString('eyJpdiI6IlZ2bXlmZGNsSENSM0tLWW1rcGtmb3c9PSIsInZhbHVlIjoidjZyYVNxbEYvUnFBSEVYYXFVdkJSeDRGZys0YWV3V1RNYTlMdHZZb3IyVUp2V2ovQis3N0wyc1JPWXJxSXYxc2orTExYWHd1Nmt0MTR2aWpUaGFGQ25WNzE0MlZ6Wi9yWmJ3a2QzT1BlYXRpZ0ljMUFVN2VnYTR6eFZsNzlXR1IiLCJtYWMiOiI3YjhkZWMxYmFlYzcxNDIxMjVhYTA1ODlmMTg2YzAxNmYwMGFkODQwNDU3OTM0YmQ4ZDBhNGE1MjA4NWM0OTNlIiwidGFnIjoiIn0=');
        $this->credentials['live']['client_secret'] = Crypt::decryptString('eyJpdiI6Ik05UitwNFBKbENPRU1xdHJPaTJraHc9PSIsInZhbHVlIjoiWXZvL0pEZS9XQnorZlQvd3lQaW56NHAvcDI0ZXQ0cFlGM1VYV0U0VERjbFVGTEtYZnMzS2dZZkl5dXFsODZlLzRZZGwrTXAzK3pYYUU0VTB0dEcwMkVGM05iMTFKUDVtNGs4cURUSHdVQUt4a0hsUmVnODNNa0h5Qjd4dXRYK20iLCJtYWMiOiI4NmQwY2I5NDhlNjc1NDMzM2M1MWEyMjA5ZmM0YWMxYmI4NmRjZjY3MTk2OTgwMDZhY2I1ODRmYzBkZDE5YmY2IiwidGFnIjoiIn0=');
    }



    public function paymentProcess($transaction)
    {
        // $this->prueba('4RS03813A0401941S');
        // die;
            // dd($transaction);
            // Init PayPal
            $provider = $this->configPayPal();
            $order = $provider->createOrder([
                'intent'=> 'CAPTURE',
                'purchase_units'=> [[
                    'reference_id' => $transaction['order_id'],
                    'amount'=> [
                      'currency_code'=> 'USD',
                      'value'=> $transaction['amountTotal'],
                      'description' => $transaction['note']
                    ]
                ]],
                'application_context' => [
                    'cancel_url' => Route('paypal.cancel.payment'),
                    'return_url' => Route('paypal.success.payment')
                ]
            ]);
    
            // Store Token so we can retrieve after PayPal sends them back to us
            // $enrollment->payment_transaction = $order['id'];
            // $enrollment->save();
            // Send user to PayPal to confirm payment
            return redirect($order['links'][1]['href'])->send();
    }
   
    public function paymentCancel()
    {
        $orden = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->firstOrFail();
        $orden->status = 2;
        $orden->save();
        return redirect()->route('store.index')->with('error', 'Transacción Cancelada');
    }
  
    public function paymentSuccess(Request $request) {
        try{
            // dd($request);
            $orden = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->firstOrFail();
            // dd($orden);
            // Init PayPal 
            
            $provider = $this->configPayPal();
    
            // Get PaymentOrder using our transaction ID
            $PaymentOrder = $provider->capturePaymentOrder($request->token);
            
            $orden->transaction_id = $PaymentOrder['id'];
            if(isset($PaymentOrder['purchase_units'])){
                if($PaymentOrder['purchase_units'][0]['payments']['captures'][0]['status'] == 'COMPLETED'){
                    $orden->status = 1;
                }
            }
            $orden->save();

            return redirect()->route('store.index')->with('message', 'Su paquete fue pagado exitosamente');

        } catch (\Throwable $th) {
            Log::error('paymentSuccess -> '.$th);
            return redirect()->back()->with('error', 'Hubo un problema al procesar el pago');
        }    
    }


    public function paymentStatus($order)
    {
        // $allOrderPaypal = $allOrderPaypal = Order::where('method', 'paypal')->where('transaction_id', '!=', null)->where('status', '!=', 1)->get();
        // dd($allOrderPaypal);
        $provider = $this->configPayPal();
    
            // Get PaymentOrder using our transaction ID
            $PaymentOrder = $provider->showOrderDetails($order->transaction_id);
                
                if(isset($PaymentOrder['purchase_units'])){
                    $estado = $PaymentOrder['purchase_units'][0]['payments']['captures'][0]['status'];
                }
                if(isset($estado)){
                    if($estado == 'COMPLETED'){
                        $status = 1;
                        $this->editOrder($order, $status);
                    }elseif($estado == 'DECLINED' || $estado == 'FAILED'){
                        $status = 2;
                        $this->editOrder($order, $status);
                    }
                }
                // else{
                //     dd("Error");
                // }
            // dd($PaymentOrder['purchase_units'][0]['payments']['captures'][0]['status']);
            // die;
    }

    public function prueba($transaction)
    {
        // $allOrderPaypal = Order::where('method', 'paypal')->where('transaction_id', '!=', null)->where('status', 0)->get();
        // dd($allOrderPaypal);
        $provider = $this->configPayPal();
        $PaymentOrder = $provider->showOrderDetails($transaction);
        dd($PaymentOrder['purchase_units'][0]['payments']['captures'][0]);
    }


    public function configPayPal()
    {   
        PayPal::setProvider();
        $provider = PayPal::getProvider();
        $provider->setApiCredentials($this->credentials); // Pull values from Config
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        return $provider;
    }

    public function editOrder($order, $status){
        // dd($request);
        $order->status = $status;
        if($order->save()){
            // $this->bonoDirecto($order);//Consulta si cumple con bonoDirecto
            $this->bonoMoney($order);//Consulta si cumple con bonoMoney
        }
    }


}