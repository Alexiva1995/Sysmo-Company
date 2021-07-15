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
use App\Traits\BonoTrait;

class BonusController extends Controller
{
    use BonoTrait;

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
        $ref = User::find(Auth::user()->id)->children;
        

        $bonoMoney = $this->showBonoMoney();
        $bonoRapido = $this->showBonoRapido();
        $bonoSpeed = $this->bonoSpeed();
        $bonoInicio = $this->bonoStart();
        $bonoInicio2 = $this->showBonoInicio();
        $bonoDirecto = $this->showBonoDirecto();
        $bonoViaje = $this->showBonoViaje();
        $bonoMoto = $this->showBonoMoto();
        $bonoCarro = $this->showBonoCarro();

        return view('content.bonus.index')->with('bonuses', $bonuses)
                                        ->with('ref',count($ref))
                                        ->with('bonoMoney', $bonoMoney)
                                        ->with('bonoDirecto', $bonoDirecto)
                                        ->with('bonoViaje', $bonoViaje)
                                        ->with('bonoMoto', $bonoMoto)
                                        ->with('bonoCarro', $bonoCarro)
                                        ->with('bonoInicio', $bonoInicio)
                                        ->with('bonoInicio2', $bonoInicio2)
                                        ->with('bonoSpeed', $bonoSpeed)
                                        ->with('bonoRapido', $bonoRapido);
    }


    public function logBonus(){
        $bonuses = Wallet::all()->where('bonus_id', '>', 0);
        return view('content.bonus.logBonus')->with('bonuses', $bonuses);
    }

}
