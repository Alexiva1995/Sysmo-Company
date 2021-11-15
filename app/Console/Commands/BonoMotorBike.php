<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoMotorBike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:motorbike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para el BonoMotorBike';

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
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         ******************************************************************/
        $alluser = User::get();
        try {
            foreach($alluser as $user){      
                if($user->status == "1"){
                    $referidos = $user->childrenActive;
                    if(count($referidos) >= 100){
                        if(Wallet::where([['user_id', $user->id],['bonus_id', 5]])->count() == 0){
                            Wallet::create([
                                'user_id' => $user->id,
                                'bonus_id' => 5,
                                'description' => 'Bono MotorBike para ' . $user->username . ' (' .$user->email . ')',
                                'status' => 0
                            ]);
                            Storage::append("BonoMotorBike.txt", 'Bono MotorBike para ' . $user->username . ' (' .$user->email . ')');
                        }
                    }
                    // else{
                    //     Storage::append("BonoMotorBike.txt", $i . " No cumple");
                    // }
                }
            }
        } catch (\Throwable $th) {
            Storage::append("BonoMotorBike.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }
}
