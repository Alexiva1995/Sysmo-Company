<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoSpeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:speed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para el BonoSpeed';

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
         •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
         se le dará como bono el retorno del 100% de los próximos 2 referidos.
         Nota:(para aplicar a este bono debe tener esos 2 referidos en los Siguientes 15 días)
         ******************************************************************/
        $alluser = count(User::all());
        try{
            for($i = 1; $i <= $alluser; $i++){
                $user = User::find($i);
                $padre = $user->referred_id;

                if($user->status == 1){
                    $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(30)] );
                    if(count($referidosRangoFecha) >= 20  ) {
                            $fechaReferido20 = [];
                            foreach($user->children as $fecha){
                                array_push($fechaReferido20, $fecha->created_at); //Crea un array con las fechas de los referidos
                            }
                            sort($fechaReferido20, SORT_STRING); //Ordena la colección por fecha

                            $fechaReferido20 = $fechaReferido20[19]->format('d-m-Y');//El Índice del array tiene que ser 19
                            $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido20), Carbon::parse($fechaReferido20)->addDays(15)]));//Guarda cuantos referidos se registraron despues de que el referido N°20 se registró hasta 15 días después

                            if(count($referidosExtra) > 2){
                                if(Wallet::where([['user_id', User::find($i)->id],['bonus_id', 2]])->count() == 0){
                                    Wallet::create([
                                        'user_id' => User::find($i)->id,
                                        'bonus_id' => 2,
                                        'description' => 'Bono Speed para ' . User::find($i)->username . ' (' .User::find($i)->email . ')',
                                        'status' => 1
                                    ]);
                                    Storage::append("BonoSpeed.txt", 'Bono Speed para ' . User::find($i)->username . ' (' .User::find($i)->email . ')');
                                }
                                // Storage::append("BonoSpeed.txt", 'El usuario '. $i .' Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 20 se registró el ' . $fechaReferido20 . ', ' .$user->created_at->diffInDays($fechaReferido20) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
                            }
                            // else{
                            //     Storage::append("BonoSpeed.txt", 'El usuario '. $i .' Necesita al menos 2 referido más antes de la fecha '. Carbon::parse($fechaReferido20)->addDays(30)->format('d-m-Y') .' para ganar el bono');
                            // }
                    }
                    // else{
                    //     Storage::append("BonoSpeed.txt", 'El usuario '. $i .', No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenía ' . count($referidosRangoFecha) . ' de 20');
                    // }
                }
            }

        } catch (\Throwable $th) {
            Storage::append("BonoSpeed.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }
}
