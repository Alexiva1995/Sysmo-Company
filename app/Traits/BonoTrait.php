<?php
namespace App\Traits;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait BonoTrait{

    public function bonoMoney($order)
    {
        /******************************************************************
         Cada 10 referidos directos que compren paquete se pagara 100usd
         ******************************************************************/
        
        try {
            // $user = User::find(Auth::user()->id);
            /******************************** */
            if(isset($order["user_id"])){
                $user = $order["user_id"];
                $user = User::find($user)->referred_id;
                //Dependiendo de la manera en que se llame el método, se activan o no estas variables
                $user = User::find($user);
                // dd("If", $user);
            }else{
                $user = User::find($order->id);
                // dd("Else", $user);
            }
            $userName = $user->username;
            $userMail = $user->email;
            
            // dd($user);
            // Storage::append("BonoMoney.txt", $user);
            
            /******************************* */
            // dd($user);
            $totalOrdenes = [];
            
            foreach($user->childrenActive as $referido){
                // Storage::append("BonoMoney.txt", 'Total Ordenes: ' . $totalOrdenes );
                if($referido->getOrder->where('status', '1')->isNotEmpty()){
                    array_push($totalOrdenes, $referido->getOrder->where('status', '1'));
                    // Storage::append("BonoMoney.txt", 'Total Ordenes: ' . count($totalOrdenes) );
                }
            }
            $it = Wallet::where('bonus_id', 1)->where('user_id', $user->id)->get();
            $it = count($it);
            
            Storage::append("BonoMoney.txt", 'Iterador Base de datos: ' . $it );
            $iterador = 10*($it+1);
            // $iterador = intval(ceil(count($totalOrdenes)/(2))*(2));
            // Storage::append("BonoMoney.txt", 'Iterador: ' . $iterador );
            // Storage::append("BonoMoney.txt", 'totalOrdenes: ' . count($totalOrdenes ));
            $totalOrdenes = count($totalOrdenes);
        if($totalOrdenes != 0){
            if($totalOrdenes == $iterador){
                Wallet::create([
                    'user_id' => $user->id,
                    'bonus_id' => 1,
                    'referred_id' => $user->referred_id,
                    'amount' => 100,
                    'description' => 'Bono Money por el usuario '.$userName. ' (' .$userMail. ')',
                    'status' => 0
                ]);
                Storage::append("BonoMoney.txt", 'Bono Money por el usuario '.$userName. ' (' .$userMail. ')');
                if($totalOrdenes < 10){
                    return $totalOrdenes*10;
                }else{
                    return ($totalOrdenes*10-(100*($iterador/10)-100));
                }
                // return $totalOrdenes;
                // return $iterador;
                
            }
            else{
                Storage::append("BonoMoney.txt", 'Tus referidos no han comprado los paquetes suficientes, tienes ' . $totalOrdenes . ' de ' . $iterador);
                
                if($totalOrdenes < 10){
                    return ($totalOrdenes*10);
                }else{
                    return ($totalOrdenes*10-(100*($iterador/10)-100));
                }
                // return $totalOrdenes;
                // return $iterador;
                // return (($iterador-$totalOrdenes)*100)/10;
            }
        }
        else{
            Storage::append("BonoMoney.txt", 'Ninguno de tus referidos ha comprado paquetes');
             return 0;
        }
            
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function bonoSpeed()
    {
        /******************************************************************
         •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
        se le dará como bono el retorno del 100% de los próximos 2 referidos.
        Nota:(para aplicar a este bono debe tener esos 2 referidos en los Siguientes 15 días)
        ******************************************************************/
        try{
            $user = User::find(Auth::user()->id);
            /******************************** */
            // $padre = $user->referred_id;
                                                //Dependiendo de la manera en que se llame el método, se activan o no estas variables
            // $user = User::find($padre);
            /******************************* */
            // dd($user);

            $fechaTope = Carbon::parse($user->created_at)->addDays(30);

            $referidosRangoFecha = $user->childrenActive->whereBetween('created_at', [Carbon::parse($user->created_at), Carbon::parse($user->created_at)->addDays(30)] );
            
            $porcentaje = round(count($referidosRangoFecha)/22*100, 2);
            if($porcentaje > 100){
                $porcentaje = 100;
            }

            if(count($referidosRangoFecha) >= 22  ) {

                    // $fechaReferido20 = [];
                    // foreach($user->childrenActive as $fecha){
                    //     array_push($fechaReferido20, $fecha->created_at); //Crea un array con las fechas de los referidos
                    // }
                    // sort($fechaReferido20, SORT_STRING); //Ordena la colección por fecha

                    // $fechaReferido20 = $fechaReferido20[19]->format('d-m-Y');//El Índice del array tiene que ser 19
                    // $referidosExtra = ($user->childrenActive->whereBetween('created_at', [Carbon::parse($fechaReferido20), Carbon::parse($fechaReferido20)->addDays(15)]));//Guarda cuantos referidos se registraron despues de que el referido N°20 se registró hasta 15 días después
                    
                    
                    // if(count($referidosExtra) > 2){
                        // return $porcentaje;
                        $retorno = '
                        <div class="progress w-100 rounded-0" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100%</div>
                        </div>';

                        return $retorno;
                    // }else{
                    //     $retorno = '
                    //     <div class="progress w-100 rounded-0" style="height: 20px;">
                    //         <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                    //     </div>';

                    //     return $retorno;
                    // }
            }else if (($fechaTope < Carbon::now()) && count($referidosRangoFecha) < 3){
                return 0;
            }else{
                $retorno = '
                <div class="progress w-100 rounded-0" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                </div>';

                return $retorno;
            }

        } catch (\Throwable $th) {
            dd($th);
        }


    
    }

     public function bonoStart()
     {
         /******************************************************************
          • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
          recibirá por su 4 referido un bono extra de 50usd
          Nota: (para aplicar a esta comisión extra el referido #4 debe
          traerlo durante los primeros 30 dias)
          ******************************************************************/

         try{
            $user = User::find(Auth::user()->id);
            
            $fechaTope = Carbon::parse($user->created_at)->addDays(30);
            $referidosRangoFecha = $user->childrenActive->whereBetween('created_at', [Carbon::parse($user->created_at), $fechaTope] );

            $porcentaje = round(count($referidosRangoFecha)/4*100, 2);
            if($porcentaje > 100){
                $porcentaje = 100;
            }

             if(count($referidosRangoFecha) >= 4  ) {

                //  $fechaReferido3 = [];
                //     foreach($user->childrenActive as $fecha){
                //          array_push($fechaReferido3, $fecha->created_at); //Crea un array con las fechas de los referidos
                //     }
                //     sort($fechaReferido3, SORT_STRING); //Ordena la colección por fecha
                //     $fechaReferido3 = $fechaReferido3[2]->format('d-m-Y'); //El Índice del array tiene que ser 2

                    
                //     $referidosExtra = ($user->childrenActive->whereBetween('created_at', [Carbon::parse($fechaReferido3), Carbon::parse($fechaReferido3)->addDays(30)])); //Guarda cuantos referidos se registraron despues de que el referido N°3 se registró hasta 30 días después
                    
                //     // return $referidosExtra;

                //      if(count($referidosExtra) > 3){

                        $retorno = '
                        <div class="progress w-100 rounded-0" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100%</div>
                        </div>';

                        return $retorno;
                    //  }else{
                    //     $retorno = '
                    //     <div class="progress w-100 rounded-0" style="height: 20px;">
                    //         <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                    //     </div>';
                    //      return $retorno;
                    //  }
             }else if (($fechaTope < Carbon::now()) && count($referidosRangoFecha) < 3){
                return 0;
             }else{
                $retorno = '
                <div class="progress w-100 rounded-0" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                </div>';

                return $retorno;
             }
         }catch (\Throwable $th) {
             dd($th);
         }
     }

    // public function bonoDirecto($producto)
    // {
    //     /******************************************************************
    //      •El bono directo sera  cada paquere rs pagara 50 usd y cada pro pagara 70. 
    //      ******************************************************************/
    //     try {
    //         $idProducto = $producto['product_id'];
    //         $userId = $producto['user_id'];
    //         $nombreUser = User::find($userId)->username;
    //         $correoUser = User::find($userId)->email;
    //         $padre = User::find($userId)->referred_id;
    //         // Storage::append("BonoDirecto.txt", 'ID Padre del padre; '. User::find($padre)->referred_id . " ID User: " . $userId);
    //         if((User::find($padre)->created_at)->diffInDays(Carbon::now()) <= 365)//Validez por 1 año
    //         {
    //             if($idProducto == 1){
    //                 Wallet::create([
    //                     'user_id' => User::find($padre)->id,
    //                     'bonus_id' => 4,
    //                     'referred_id' => User::find($padre)->referred_id,
    //                     'amount' => 50,
    //                     'description' => 'Bono Directo por el usuario ' . $nombreUser . ' (' . $correoUser . ')',
    //                     'status' => 0
    //                 ]);
    //                 Storage::append("BonoDirecto.txt", 'Bono Directo por el usuario ' . $nombreUser . ' (' . $correoUser . ')');
    //             }elseif($idProducto == 2){
    //                 Wallet::create([
    //                     'user_id' => User::find($padre)->id,
    //                     'bonus_id' => 4,
    //                     'referred_id' => User::find($padre)->referred_id,
    //                     'amount' => 70,
    //                     'description' => 'Bono Directo por el usuario ' . $nombreUser . ' (' . $correoUser . ')',
    //                     'status' => 0
    //                 ]);
    //                 Storage::append("BonoDirecto.txt", 'Bono Directo por el usuario ' . $nombreUser . ' (' . $correoUser . ')');
    //             }
    //         }
    //         else{
    //             Storage::append("BonoDirecto.txt", 'Se venció el bono directo al usuario: ' . $padre);
    //         }
           
    //     } catch (\Throwable $th) {
    //         Storage::append("BonoDirecto.txt", 'LOG | Error: '. $th .' Fecha: '. Carbon::now());
    //     }
    // }

    public function bonoTravel()
    {
        /******************************************************************
         •Cuando complete los 50 referidos recibirá adicional un viaje a
          San andres para 1 persona todo incluido, si esos 50 referidos
          los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
          aplicara para 2 personas todo incluido.
         ******************************************************************/
        try {
            $user = User::find(Auth::user()->id);
            $porcentaje = round(count($user->childrenActive)/50*100, 2);
            if($porcentaje > 100){
                $porcentaje = 100;
            }
            if(count($user->childrenActive) >= 50){
                if($user->created_at->diffInDays(Carbon::now()) <= 90){
                   return 2;
                }
                return 1;
            }else{
                $retorno = '
                        <div class="progress w-100 rounded-0" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                        </div>';
                        return $retorno;
                // return ("No tiene suficientes referidos para ganarse el viaje, tiene " . count($user->childrenActive) . " de 50 referidos");
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function bonoMotorBike()
    {
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         ******************************************************************/
        try {
            // dd(Auth::user());
            $referidos = User::find(Auth::user()->id)->childrenActive;
            $porcentaje = round(count($referidos)/100*100, 2);
            if($porcentaje > 100){
                $porcentaje = 100;
            }
        if(count($referidos) >= 100){
            return 1;
        }else{
            $retorno = '
                <div class="progress w-100 rounded-0" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                </div>';
                return $retorno;
        }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function bonoCarLifeStyle()
    {
        /******************************************************************
         •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 
         ******************************************************************/
        try {
            $referidos = User::find(Auth::user()->id)->childrenActive;
            $porcentaje = round(count($referidos)/500*100, 2);
            if($porcentaje > 100){
                $porcentaje = 100;
            }
        if(count($referidos) >= 500){
            return 1;
        }else{
            $retorno = '
                <div class="progress w-100 rounded-0" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated rounded-0 bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%">'.$porcentaje.'%</div>
                </div>';
                return $retorno;
        }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }


    /////////////////////////////////////////////////////////////////////////////////////////


    
    public function showBonoMoney()
    {
        $bonoDirecto = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 1);
        
        if($bonoDirecto){
            return count($bonoDirecto);
        }else{
            return 0;
        }
    }

    public function showBonoRapido()
    {
        $bonoRapido = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 3);

        if($bonoRapido){
            return count($bonoRapido);
        }else{
            return 0;
        }
    }

    public function showBonoInicio()
    {
        $bonoInicio = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 2);

        if($bonoInicio){
            return count($bonoInicio);
        }else{
            return 0;
        }
    }
    
    // public function showBonoDirecto()
    // {
    //     $bonoDirecto = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 4);

    //     if($bonoDirecto){
    //         return count($bonoDirecto);
    //     }else{
    //         return 0;
    //     }
    // }

    public function showBonoViaje()
    {
        $bonoViaje = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 4);

        if($bonoViaje){
            return count($bonoViaje);
        }else{
            return 0;
        }
    }

    public function showBonoMoto()
    {
        $bonoMoto = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 5);

        if($bonoMoto){
            return count($bonoMoto);
        }else{
            return 0;
        }
    }

    public function showBonoCarro()
    {
        $bonoCarro = Wallet::all()->where('user_id', '=', Auth::user()->id)->where('bonus_id', '=', 6);

        if($bonoCarro){
            return count($bonoCarro);
        }else{
            return 0;
        }
    }



}