<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentController extends Controller
{
        public function paymentProcess($transaction)
        {
            // dd($transaction);
            // Check if User has Enrollment
            // $enrollment = Enrollment::where('user_id', auth()->id())->firstOrCreate(['user_id' => auth()->id()]);
    
            // Init PayPal
            $provider = PayPal::setProvider();
            $provider->setApiCredentials(config('paypal')); // Pull values from Config
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
            $provider->setApiCredentials(config('paypal'));
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