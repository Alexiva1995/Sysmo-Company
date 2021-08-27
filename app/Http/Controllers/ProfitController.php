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
use PhpParser\Node\Expr\Cast\Object_;

class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Order::where('status', 1)->sum('amount');
        $comision = Wallet::where('type_transaction', '0')->sum('amount');
        $profit = Wallet::all();
        $ids = Wallet::pluck('user_id')->toArray();
        $correos2 = [];
        // dd(User::where('id', $ids[0])->pluck('email'));
        for($i=0; $i<count($ids); $i++){
            array_push($correos2, User::where('id', $ids[$i])->pluck('email')->toArray());
        }
        $correos = array_map('current', $correos2);
        // dd($correos);

        return view('content.profit.index')
                    ->with('profit', $profit)
                    ->with('ordenes', $ordenes)
                    ->with('comision', $comision)
                    ->with('correos', $correos);

    }

    public function rangoFecha($from, $to)
    {
        // $from = '2020-08-10';
        // $to = '2021-08-26';
        $ordenes = Order::where('status', 1)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('amount');
        $comision = Wallet::where('type_transaction', '0')->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum('amount');
        $data = [$ordenes, $comision];
        return $data;
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
