<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bonus;
use App\Models\BonusPivot;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = Bonus::get();
        // dd($bonuses);
        // $this->moneyBonus();
        // $this->speedBonus();
        // $this->startBonus();
        // $this->travelBonus();
        // $this->motorbikeBonus();
        // $this->carLifeStyleBonus();
        return view('content.bonus.index')->with('bonuses', $bonuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        //
    }


    public function moneyBonus()
    {
        /******************************************************************
         Cada 10 referidos directos que compren paquete se pagara 100usd
         ******************************************************************/
        $id = 1;
        $bonus = Bonus::where('id', $id)->firstOrFail();
        $users = User::find(Auth::user()->id)->children;
        if(count($users) > 0){
            foreach($users as $user){
                if(count($user->getOrder) >= $bonus->referrals ){
                     dd("Se cumple la condición, se genera el pago y se aumenta el iterador en +10");
                }else{
                    dd("NO Se cumple la condición");
                }
            }
        }
        
    }

    public function speedBonus()
    {
        /******************************************************************
         •Si en los primeros 30 días después de su ingreso tiene 20 referidos 
         se le dará como bono el retorno del 100% de los próximos 2 referidos.

         Nota:(para aplicar a este bono debe tener esos 2 referidos en los
          Siguientes 15 días)
         ******************************************************************/
        $id = 2;
        $bonus = Bonus::where('id', $id)->firstOrFail();

        $user = User::find(Auth::user()->id);
        $create = $user->created_at;
        if($create->diffInDays(Carbon::now()) <= $bonus->days){
            if(count($user->children) >= $bonus->referrals){
                //Registrar la fecha en que se cumple la condición para comenzar el conteo de los próximos 2 referidos
                dd("Cumple los requisitos para el bono");
            }else{
                dd("No tiene suficientes referidos");
            }
        }else{
            dd("Ya pasaron más de 30 días");
        }
    
    }

    public function startBonus()
    {
        /******************************************************************
         • 3 referidos en los primeros 15 días de su ingreso a SYSMO.
         recibirá por su 4 referido un bono extra de 50usd
         Nota: (para aplicar a esta comisión extra el referido #4 debe
         traerlo durante los primeros 30 dias)
         ******************************************************************/
        $id = 3;
        $bonus = Bonus::where('id', $id)->firstOrFail();

        $user = User::find(Auth::user()->id);
        $create = $user->created_at;
         
        if($create->diffInDays(Carbon::now()) <= $bonus->days){
            if(count($user->children) >= $bonus->referrals){
                //Registrar la fecha en que se cumple la condición para comenzar el conteo del #4 referido
                dd("Cumple los requisitos para el bono");
            }else{
                dd("No tiene suficientes referidos");
            }
        }else{
            dd("Ya pasaron más de 30 días");
        }
    }

    public function directBonus()
    {
        /******************************************************************
         El bono directo sera  cada paquere rs pagara 50 usd y cada pro pagara 70
         Los planes tendran vigenci durante 12 meses
         ******************************************************************/
        $id = 4;
        $bonus = Bonus::where('id', $id)->firstOrFail();
    }

    public function travelBonus()
    {
        /******************************************************************
         •Cuando complete los 50 referidos recibirá adicional un viaje a
          San andres para 1 persona todo incluido, si esos 50 referidos
          los cumple en los primeros 90 días de su ingreso a sysmo el viaje 
          aplicara para 2 personas todo incluido.

          Nota: si el usuario se encuentra fuera de Colombia se le podrá 
          hacer efectivo el valor del viaje.

          el viaje tendrá 60 días para ser redimido. Aplica términos y condiciones.
         ******************************************************************/

        $id = 5;
        $bonus = Bonus::where('id', $id)->firstOrFail();

        $user = User::find(Auth::user()->id);
        $create = $user->created_at;
         
        if($create->diffInDays(Carbon::now()) <= $bonus->days){
            if(count($user->children) >= $bonus->referrals){
                //Registrar la fecha en que se cumple la condición para comenzar el conteo de la segunda persona en el viaje
                dd("Cumple los requisitos para el bono");
            }else{
                dd("No tiene suficientes referidos");
            }
        }else{
            dd("Ya pasaron más de 30 días");
        }

    }

    public function motorbikeBonus()
    {
        /******************************************************************
         •Al sumar 100 referidos el usuario recibirá una moto 0 kilómetros.
         
         Nota: la moto será entregada en los siguientes 60 días después de
          cumplir con el requisito. Aplica términos y condiciones.
         ******************************************************************/

        $id = 6;
        $bonus = Bonus::where('id', $id)->firstOrFail();
        $users = User::find(Auth::user()->id)->children;
        if(count($users) > 0){
            foreach($users as $user){
                if(count($user->getOrder) >= $bonus->referrals ){
                     dd("Se cumple la condición, se gana la moto");
                }else{
                    dd("NO Se cumple la condición");
                }
            }
        }
    }

    public function carLifeStyleBonus()
    {
        /******************************************************************
         •Al sumar 500 referidos el usuario recibirá  un carro 0 kilómetros. 

         Nota: el carro será entregado en los siguientes 60 días después de 
         cumplir con el requisito. Aplica términos y condiciones.
         ******************************************************************/

        $id = 7;
        $bonus = Bonus::where('id', $id)->firstOrFail();
        $users = User::find(Auth::user()->id)->children;
        if(count($users) > 0){
            foreach($users as $user){
                if(count($user->getOrder) >= $bonus->referrals ){
                     dd("Se cumple la condición, se gana el carro");
                }else{
                    dd("NO Se cumple la condición");
                }
            }
        }
    }

    public function logBonus(){
        $bonuses = Wallet::all()->where('bonus_id', '>', 0);
        return view('content.bonus.logBonus')->with('bonuses', $bonuses);
    }

}
