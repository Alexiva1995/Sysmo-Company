<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoCarLifeStyle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:carlifestyle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para el BonoCarLifeStyle';

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
         •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 
         ******************************************************************/
        $alluser = count(User::all());
        try {
            
            for($i = 1; $i <= $alluser; $i++){
                if(User::find($i)->status == 1){
                    $referidos = User::find($i)->children;
                    if(count($referidos) >= 500){
                        if(Wallet::where([['user_id', User::find($i)->id],['bonus_id', 7]])->count() == 0){
                            Wallet::create([
                                'user_id' => User::find($i)->id,
                                'bonus_id' => 7,
                                'description' => 'Ganó un Automóvil 0 Kilómetros',
                                'status' => 2
                            ]);
                            Storage::append("BonoCarLifeStyle.txt", $i . " ganó un auto");
                        }
                        // else{
                        //     Storage::append("BonoCarLifeStyle.txt", $i . " ya había ganado un auto");
                        // }
                        
                        
                    }
                    // else{
                    //     Storage::append("BonoCarLifeStyle.txt", $i . " No cumple");
                    // }
                }
            }
        } catch (\Throwable $th) {
            Storage::append("BonoCarLifeStyle.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }
}
