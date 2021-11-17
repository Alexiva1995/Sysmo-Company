<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Shakurov\Coinbase\Facades\Coinbase;

class CoinbasePaymentController extends Controller
{
    
    public function paymentProcess($transacion)
    {
        // $this->paymentStatus();
        // die;
        try{   
            $charge = Coinbase::createCharge([
                'name' => $transacion['name'],
                'description' => $transacion['note'],
                'local_price' => [
                    'amount' => $transacion['amountTotal'],
                    'currency' => 'USD',
                ],
                'pricing_type' => 'fixed_price',
            ]);
            // dd($charge);
            $orden = Order::find($transacion['order_id']);
            $orden->transaction_id = $charge['data']['id'];

            $orden->save();
            $url = $charge['data']['hosted_url'];
            //    dd($url);
            if (!empty($url)) {
                return redirect($url)->send();
            }else{
                $orden->delete();
                return redirect()->back()->with('error', 'Problemas al generar la orden, intente mas tarde');
            }
        } catch (\Throwable $th) {
            Log::error('CoinbasePaymentController/paymentProcess -> '.$th);
            return redirect()->back()->with('error', 'Hubo un problema al procesar el pago');
        } 
    }

    public function paymentStatus(){
        $checkouts = Coinbase::getCheckout('5a8204b6-5cb6-4672-970e-8e206c0a42b6');
        dd($checkouts);
    }

}
