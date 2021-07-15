<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoTravel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:travel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para el BonoTravel';

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
         •Cuando complete los 50 referidos recibirá adicional un viaje a
          San andres para 1 persona todo incluido, si esos 50 referidos
          los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
          aplicara para 2 personas todo incluido.
         ******************************************************************/
        $alluser = count(User::all());
         try {
            for($i = 1; $i <= $alluser; $i++){
                $user = User::find($i);
                if($user->status == 1){
                    if(count($user->children) >= 10 && $user->created_at->diffInDays(Carbon::now()) <= 90){
                        if(Wallet::where([['user_id', User::find($i)->id],['bonus_id', 5]])->count() == 0){
                            Wallet::create([
                                'user_id' => User::find($i)->id,
                                'bonus_id' => 5,
                                'description' => 'Bono Travel (2 personas), para ' . User::find($i)->username . ' (' .User::find($i)->email . ')',
                                'status' => 1
                            ]);
                            Storage::append("BonoTravel.txt", 'Bono Travel (2 personas) para ' . User::find($i)->username . ' (' . User::find($i)->email . ')');
                        }
                        // Storage::append("BonoTravel.txt", $i . " si cumple para 2 personas");
                    }elseif(count($user->children) >= 10){
                        if(Wallet::where([['user_id', User::find($i)->id],['bonus_id', 5]])->count() == 0){
                            Wallet::create([
                                'user_id' => User::find($i)->id,
                                'bonus_id' => 5,
                                'description' => 'Bono Travel (1 persona) para ' . User::find($i)->username . ' (' .User::find($i)->email . ')',
                                'status' => 1
                            ]);
                            Storage::append("BonoTravel.txt", 'Bono Travel (1 persona) para ' . User::find($i)->username . ' (' .User::find($i)->email . ')');
                        }
                        // Storage::append("BonoTravel.txt", $i . " si cumple para 1 persona");
                    }
                    // else{
                    //     Storage::append("BonoTravel.txt", $i . " No cumple");
                    // }
                }
            }
        } catch (\Throwable $th) {
            Storage::append("BonoTravel.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
        
    }
}
