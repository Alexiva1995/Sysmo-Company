<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Liquidaction;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $order = Order::all();
        $liquidaction = Liquidaction::all();
        $product_warehouse = ProductWarehouse::all();

        $user_id = Auth::user()->id;

        // dd($product_warehouse);

        // $profit = DB::table('wallets')->where('user_id', $user_id);
        $comision = Wallet::all()->where('type_transaction', '0')->sum('debit');
        $retiro = Wallet::all()->where('type_transaction', '1')->sum('credit');

        $profit = Wallet::all();


        return view('content.profit.index')
                    ->with('profit', $profit)
                    ->with('comision', $comision)
                    ->with('retiro', $retiro);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
