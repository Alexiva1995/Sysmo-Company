<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BonoStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Escanea todos los usuarios en busca de quien cumplió las condiciones para el BonoStart';

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
         • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
         recibirá por su 4 referido un bono extra de 50usd
         Nota: (para aplicar a esta comisión extra el referido #4 debe
         traerlo durante los primeros 30 dias)
         ******************************************************************/
        $alluser = count(User::all());
        try{
            for($i = 1; $i <= $alluser; $i++){
                $user = User::find($i);
                if($user->status == 1){
                    $referidosRangoFecha = $user->children->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(15)] );

                    if(count($referidosRangoFecha) >= 3  ) {

                        $fechaReferido3 = [];
                            foreach($user->children as $fecha){
                                array_push($fechaReferido3, $fecha->created_at); //Crea un array con las fechas de los referidos
                            }
                            sort($fechaReferido3, SORT_STRING); //Ordena la colección por fecha
                            $fechaReferido3 = $fechaReferido3[2]->format('d-m-Y');//El Índice del array tiene que ser 2
                            
                            $referidosExtra = ($user->children->whereBetween('created_at', [Carbon::parse($fechaReferido3), Carbon::parse($fechaReferido3)->addDays(30)]));//Guarda cuantos referidos se registraron despues de que el referido N°3 se registró hasta 30 días después
                            
                            if(count($referidosExtra) > 1){
                                Storage::append("BonoStart.txt", 'El usuario ' .$i. ' Cumple con todos los requisitos, tienes: '. count($user->children) .' referidos, el referido n° 3 se registró el ' . $fechaReferido3 . ', ' .$user->created_at->diffInDays($fechaReferido3) . ' días despues de que usted se registró, y desde esa fecha hasta 30 días después, has hecho ' . (count($referidosExtra)-1) . ' Referidos');
                            }else{
                                Storage::append("BonoStart.txt", 'El usuario ' .$i. ' Necesitas al menos 1 referido más antes de la fecha '. Carbon::parse($fechaReferido3)->addDays(30)->format('d-m-Y') .' para ganar el bono');
                            }
                    }else{
                        Storage::append("BonoStart.txt", 'El usuario ' .$i. ' No registró suficientes referidos en el rango de fecha establecido, al momento de caducar tenías ' . count($referidosRangoFecha) . ' de 3');
                    }
                }
            }        
        }catch (\Throwable $th) {
            Storage::append("BonoStart.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
        }
    }
}
