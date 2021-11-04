<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Support\Facades\Crypt;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentController extends Controller
{
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
            // dd($transaction);
            // Check if User has Enrollment
            // $enrollment = Enrollment::where('user_id', auth()->id())->firstOrCreate(['user_id' => auth()->id()]);
           
            // dd($this->credentials);
            // Init PayPal
            $provider = PayPal::setProvider();
            $provider->setApiCredentials($this->credentials); // Pull values from Config
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
    
            // Prepare Order
            $order = $provider->createOrder([
                'intent'=> 'CAPTURE',
                'purchase_units'=> [[
                    'reference_id' => $transaction['order_id'],
                    'amount'=> [
                      'currency_code'=> 'USD',
                      'value'=> $transaction['amountTotal']
                    ]
                ]],
                'application_context' => [
                    'cancel_url' => Route('paypal.cancel.payment'),
                    'return_url' => Route('paypal.success.payment')
                ]
            ]);
    
            // dd($order);
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
            $orden = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->firstOrFail();
            // dd($orden);
            // Init PayPal 
            
            $provider = PayPal::setProvider();
            $provider->setApiCredentials($this->credentials);
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
            
            // Get PaymentOrder using our transaction ID
            $PaymentOrder = $provider->capturePaymentOrder($request->token);
            // dd($PaymentOrder);
            $orden->transaction_id = $PaymentOrder['id'];
            $orden->save();

            return redirect()->route('store.index')->with('message', 'Su paquete fue pagado exitosamente');

        } catch (\Throwable $th) {
            Log::error('paymentSuccess -> '.$th);
            return redirect()->back()->with('error', 'Hubo un problema al procesar el pago');
        }    
    }

}