<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Hexters\CoinPayment\Entities\CoinpaymentTransaction;

class scanOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:orderstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea el estatus de los coinpayment para igualar el valor en la tabla orders';

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
        $allcoinpayment = CoinpaymentTransaction::get(['order_id', 'status']);
        foreach($allcoinpayment as $coinpayment){
            if($coinpayment->status == 1){
                $status = Order::find($coinpayment->order_id)->update(['status' => '1']);
                $status->save();
            }
        }
    }
}
