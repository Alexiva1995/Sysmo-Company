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
        $this->credentials['sandbox']['client_id'] =  Crypt::decryptString('eyJpdiI6ImhsMmxGR3Y0YkhmWEhSc3FuQjVraUE9PSIsInZhbHVlIjoiZTQ4TjdFTURJNjh3a3pXaGZwZVBKeFZXV2lQYmE3WE5XWWRnTWRualJ1bXpEZ3N4V0M3YjJwUWttYXl6a2c2MGgyM3VvUDQyT2NIdW5ZSWFwL3dMa2s1S1l4cFZYU2V5SmtFN1VGTFJVV3NtMWJhWVNYYUpEOFUrWFNhTSsyRWoiLCJtYWMiOiI4M2M5YzljYmRhM2EwOTY2ZDE5OTM0MTZlZDJhZGYyMGY1OGJkNDE2ZjBkMmE1Mjk5Mzk4ZTFlM2EyNWExMmUyIiwidGFnIjoiIn0=');
        $this->credentials['sandbox']['client_secret'] = Crypt::decryptString('eyJpdiI6IklNY0V2UHlxaXovWWFQclJxRnJDYUE9PSIsInZhbHVlIjoiTTNiRURtekJ1Sm9YNGN6bWFaUHBJam1mNmN4Tmw5b1U1T0hRRVNTS2NkK3gxYzZXeUdhcFp3d1l4MUpkb0NQd2NwQ045b1o5UGtTdWhVTGNQdEsyY0tCbkhET2pzSnJlZVloUFdMSSthUkpQeEhGck1BNVl6VkpZVC8yUzRUcXUiLCJtYWMiOiI1ZWQzNDcyMTFkZDMwZTQxOTNiMmY3MWI4NDVmZjA2MGUzZmQzYjJmZDkyNDBkNWQwMzBkODNiM2Q2YTMxZDIwIiwidGFnIjoiIn0=');
        $this->credentials['live']['client_id'] = Crypt::decryptString('eyJpdiI6IkY0SXFycHRaNGJtZzZVVUNpWnpYNXc9PSIsInZhbHVlIjoiRkZrY1p1bWZEVHJNYWlUdExSSGQ2WlI1VmhjSk90ZlJKQlJBZ2lJZm95K3R0VEJ3NU5DcjFmRE5IS29UTUhqUk1Da29obWJLQ2F1U1VpaUJCOXc3bmFacTdRbVFtVHBTRW1XVXdhM2tqZ1FTN24ycUJycVFYOHN2R2Faa3NVdHkiLCJtYWMiOiI4NDQ3ZWRhYmYxNTAwZWIzYzUzMGZmZWEzMzg2NDgzNDBlYWZiMmZkMjZjZDE1MzMyMmY2NTllOWJlZjRkNWFlIiwidGFnIjoiIn0=');
        $this->credentials['live']['client_secret'] = Crypt::decryptString('eyJpdiI6IkpiR2JOOWJGYWxEZ1IwMytsRFBSelE9PSIsInZhbHVlIjoiTW1qRmlSbjBjRVhpbnQrNGt1dlRMMGxlSnJEeXpQTEFOTVB4OCtob1gwZy8yblo3a0s1L1JHb29lOWVQSFhuMVIyM1B1UjhKMW50aGViV1EwOTIrK1FiYlhJaU50NWJYakRVdGU2TzNwcUdVWlh4QTN6bEp5dHNEYW8xRms4dU0iLCJtYWMiOiI4MmM0ZjliNzg0MThmYWRlYTc3YTk4MGViMWI3NjNjZGUxMGJlODU4M2YyYTg1YTY2NDM2NmE3NDA1NzM1N2ZmIiwidGFnIjoiIn0=');
    }
    #Sanbox
    #client_id = ATv5xiHhOBEjPBGtSKsZ8DSCUab2py5aRFpJ1WsdeQ2JbWjF59jIllpCE0QV4ZbSPFLH8386opaIRE2x
    #secret_id = EFD0S4DNiigRfG29K8Pzq4VyoR1jgtTV85Zh1tzluocZdekqMnzh7SKcJnPCMiRXe1_RR9WgK4AnNqaG
    #Live
    #Client_id= ASYRvw42jHA5VgrHsDpdpBkm0EJWO1QLFrb7E_h8EXk5daGA4hOSPEGViwNSx6sibn6ZwXQvzElGc55s
    #secret_id= EHF7OnMtWb-p8rxnL_ul2RD1KAScBK3TbxcEoA4BFR6nlwfy9idppJnFOxDnLbz8HC1GGs5G-hmYFtDm



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