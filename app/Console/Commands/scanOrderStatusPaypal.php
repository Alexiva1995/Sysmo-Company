<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PayPalPaymentController;
use Hexters\CoinPayment\Entities\CoinpaymentTransaction;

class scanOrderStatusPaypal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scanOrder:StatusPaypal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea el estatus de PayPal para igualar el valor en la tabla orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
        $PayPalPaymentController = new PayPalPaymentController;
        $allOrderPaypal = Order::where('method', 'paypal')->where('transaction_id', '!=', null)->where('status', 0)->get();
        foreach($allOrderPaypal as $paypalOrder){
            $PayPalPaymentController->paymentStatus($paypalOrder);
            Storage::append("ScanOrderPayPal.txt", 'Order: '.$paypalOrder->id . ' Status: ' . $paypalOrder->status);
        }
        }catch (\Throwable $th) {
            Storage::append("ScanOrderPayPal.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }
}
