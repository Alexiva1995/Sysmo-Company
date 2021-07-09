<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProductWarehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Hexters\CoinPayment\CoinPayment;
use Hexters\CoinPayment\Helpers\CoinPaymentHelper;
use App\Models\User;
use App\Traits\BonoTrait;

class ProductWarehouseController extends Controller
{
    use BonoTrait;

     // permite ver la vista de la tienda

     public function index(){
        $store = ProductWarehouse::all();
        return view('content.store.user.index')->with('store', $store);
    
    }

     // permite ver la vista de la tienda
    public function orders(){

        $store = Order::all();
        return view('content.store.admin.orders')->with('store', $store);
    
    }

    // permite ver la vista de creacion delproducto

    public function create(){

        return view('content.store.admin.create');
    
    }

    // permite la creacion del producto

    public function store(Request $request){

        $store = ProductWarehouse::all();

        $fields = [        ];

        $msj = [        ];

        $this->validate($request, $fields, $msj);

        $store = ProductWarehouse::create($request->all());

        if ($request->hasFile('photoDB')) {
            
            $file = $request->file('photoDB');
            
            $name = $request->name.'_'.$file->getClientOriginalName();
            
            $file->move(public_path('storage').'/products',$name);
            
            $store->photoDB = $name;
        }

		$store->save();
        
        return redirect()->route('store.list-admin')->with('message', 'El Producto se creo Exitosamente');
    }

    // permite editar el producto

    public function editAdmin($id){

        $store = ProductWarehouse::find($id);

        return view('content.store.admin.edit')
        ->with('store', $store);
    }

     // permite editar el producto

     public function orderAttend($id){

        $store = Order::find($id);

        return view('content.store.admin.order-attend')
        ->with('store', $store);
    }

    public function updateOrder(Request $request, $id){

        $store = Order::find($id);

        $fields = [
     
        ];

        $msj = [
      
        ];
        
        $this->validate($request, $fields, $msj);

        $store->update($request->all());

        $store->save();
        
      return redirect()->route('store.list-orders')->with('message', 'Producto '.$id.' Actualizado ');
    }

    // permite actualizar el producto

    public function updateAdmin(Request $request, $id){

        $store = ProductWarehouse::find($id);

        $fields = [
            "name" => ['required'],
            "description" => ['required'],
            "price" => ['required'],
        ];

        $msj = [
            'name.required' => 'El nombre es Requerido',
            'description.required' => 'La descripcion es Requerido',
            'price.required' => 'El monto es Requerido',
        ];
        
        $this->validate($request, $fields, $msj);

        $store->update($request->all());
        
        if ($request->hasFile('photoDB')) {
            
            $file = $request->file('photoDB');
            
            $name = $request->name.'_'.$file->getClientOriginalName();
            
            $file->move(public_path('storage').'/products',$name);
            
            $store->photoDB = $name;
        }

        $store->save();
        
      return redirect()->route('store.list-admin')->with('message', 'Producto '.$id.' Actualizado ');
    }

    // permite ver la lista de productos

    public function listAdmin(){
        
        $store = ProductWarehouse::all();
        
        return view('content.store.admin.list-admin')
        ->with('store', $store);
    }

    // permite eliminar un producto
    
    public function destroy($id)
    {
      $store = ProductWarehouse::find($id);
    
      $store->delete();
    
      return redirect()->route('store.list-admin')->with('message', 'Producto '.$id.' Eliminado');
    }

    // permite guardar la orden comprada
    public function saveOrden(Request $request)
    {
            $user = Auth::user();

            if($user->balance >= $request->price){

            $orden = Order::create([
                'user_id' => Auth::id(),
                'product_id' => $request->id,
                'amount' => '1',
            ]);

            $wallet = $user->balance - $request->price;
            $orden->getUser->update(['balance' => $wallet]);
            $this->bonoDirecto($request->id);//Consulta si cumple con bonoDirecto;
            $this->bonoMoney($request->id);//Consulta si cumple con bonoMoney;
            return redirect()->back()->with('message', 'Producto Comprado');
        }else{
            return redirect()->back()->with('error', 'Saldo Insuficiente');
        }
    }

    // permite ver la lista de producto
  
    public function listUser(){
  
      $store = Order::where('user_id', '=', Auth::id())->get();
  
      return view('content.store.user.list-user')
      ->with('store', $store);
    }
  
    // permite ver el producto
  
    public function showUser($id){
  
      $store = Order::find($id);
  
      return view('content.store.user.show')
      ->with('store', $store);
    }

    public function guardarOrden($infoOrden)
    {
        $orden = Order::create($infoOrden);

        return $orden->id;

    }

    public function buyProduct($id)
    {
        $product = ProductWarehouse::find($id);
        $user = Auth::user()->id;
        $data = Order::latest('id')->first();
        $hayData = $data? $data->id+1 : 1;

        $infoOrden = [
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'amount' => $product->price,
            'status' => '0'
        ];

        $transacion = [
            'amountTotal' => $product->price,
            'note' => 'Compra de paquete: '.$product->name.' por un precio de '.$product->price,
            'order_id' => $this->guardarOrden($infoOrden),
            'tipo' => 'Compra de un paquete',
            'tipo_transacion' => 3,
            'buyer_name' => Auth::user()->firstname,
            'buyer_email' => Auth::user()->email,
            'redirect_url' => url('/'),
            'cancel_url' => url('/')
        ];
        $transacion['items'][] = [
            'itemDescription' => 'Compra de paquete '.$product->name,
            'itemPrice' => $product->price, // USD
            'itemQty' => (INT) 1,
            'itemSubtotalAmount' => $product->price // USD
        ];
        $ruta = \CoinPayment::generatelink($transacion);
        return redirect($ruta);

        // try{
        //     $product = ProductWarehouse::find($id);
        //     $user = Auth::user()->id;
        //     $data = Order::latest('id')->first();
        //     $hayData = $data? $data->id+1 : 1;

        //     $transaction['order_id'] =  $hayData; // invoice number
        //     $transaction['amountTotal'] = (FLOAT) 210;
        //     $transaction['note'] = "Compra de Producto";
        //     $transaction['buyer_name'] = Auth::user()->firstname;
        //     $transaction['buyer_email'] = Auth::user()->email;
        //     $transaction['redirect_url'] = url('/'); // When Transaction was comleted
        //     $transaction['cancel_url'] = url('/'); // When user click cancel link

        //     $transaction['items'][] = [
        //         'itemDescription' => $product->name,
        //         'itemPrice' => (FLOAT) $product->price, // USD
        //         'itemQty' => (INT) 1,
        //         'itemSubtotalAmount' => (FLOAT) $product->price*1 // USD
        //       ];

        //     $transaction['payload'] = [
        //         'foo' => [
        //        'bar' => 'baz'
        //     ]
        //  ];


        //     return redirect(CoinPayment::generatelink($transaction));
        // } catch (\Throwable $th) {
        //     Log::error('LinkCoinpayment -> '.$th);
        // }  

    }

    public function linkCoinPayMent(object $producto, int $idcompra, int $abono)
    {
        try {
            $iduser = Auth::user()->id;

            // $checkRentabilidad1 = DB::table('log_rentabilidad')->where([
            //     ['iduser', '=', $iduser],
            //     ['progreso', '<', 100],
            //     ['nivel_minimo_cobro', '=', 0]
            // ])->first();

            // $resta = 0;
            // if ($checkRentabilidad1 != null) {
            //     $resta = $checkRentabilidad1->precio;
            // }
            
            $controllerWallet = new WalletController();
            $subtotal = (FLOAT) ($producto->meta_value);
            $total = 0;
            $wallet = 0;
            $fee = $result = 0;
            if ($abono == 1) {
                $wallet = Auth::user()->wallet_amount;
                $fee = ($subtotal * 0.045);
                $result = ($subtotal + $fee);
                $total = ($result - $wallet);
            }else{
                $total = $subtotal;
            }
            if ($total > 0) {
                if ($wallet > 0) {
                    $descripcion = 'Descuento del paquete con el saldo de la wallet';
                    $controllerWallet->saveRetiro(Auth::user()->ID, $wallet, $descripcion, 0, $wallet);
                }
                $transaction['order_id'] = $idcompra; // invoice number
                $transaction['amountTotal'] = $total;
                $transaction['note'] = $producto->post_content;
                $transaction['buyer_name'] = Auth::user()->display_name;
                $transaction['buyer_email'] = Auth::user()->user_email;
                $transaction['redirect_url'] = route('tienda.estado', ['pendiente']); // When Transaction was comleted
                $transaction['cancel_url'] = route('tienda.estado', ['cancelada']); // When user click cancel link
                $transaction['items'][] = [
                    'itemDescription' => 'Producto '.$producto->post_title,
                    'itemPrice' => (FLOAT) $total, // USD
                    'itemQty' => (INT) 1,
                    'itemSubtotalAmount' => (FLOAT) $total // USD
                ];
                return CoinPayment::generatelink($transaction);
            }else{
                $descripcion = 'Renovacion de nuevo paquete';
                $controllerWallet->saveRetiro(Auth::user()->ID, $result, $descripcion, $result, $result);
                return 'pagado';
            }
        } catch (\Throwable $th) {
            Log::error('LinkCoinpayment -> '.$th);
        }        
    }
    
    /**
     * Permite Guardar la informacion de la entrada en wp
     *
     * @access public
     * @param request $datos - informacion de la compra
     * @return view
     */
    public function saveOrdenPosts(Request $datos)
    {
        $validate = $datos->validate([
            'precio' => 'required',
            'name' => 'required',
        ]); 
        try {
            $settings = Settings::first();
            if ($validate) {
                $iduser = Auth::user()->ID;
                $checkRentabilidad1 = DB::table('log_rentabilidad')->where([
                    ['iduser', '=', $iduser],
                    ['progreso', '<', 100]
                ])->first();
                $suma = 0;
                if ($checkRentabilidad1 != null) {
                    $suma = $checkRentabilidad1->precio;
                }
                $fecha = new Carbon();
                $id = $this->savePosts('wc-on-hold');
                $data = [
                    '_order_key' => 'wc_order_'.base64_encode($fecha->now()),
                    'ip' => $datos->ip(),
                    'total' => ($datos->precio + $suma).'.00',
                    'idproducto' => $datos->idproducto
                ];
                $ruta = '';
                if ($id) {
                    $linkProducto = str_replace('office', '?post_type=shop_order&#038;p=', $datos->root());
                    DB::table($settings->prefijo_wp.'posts')->where('ID', $id)->update([
                        'guid' => $linkProducto.$id
                    ]);
                    $this->saveOrdenPostmeta($id, $data, $datos->tipo, $iduser);
                    $this->saveOrderItems($id, $datos->name, $data);
                    $contrProducto = new ProductController;
                    $producto = $contrProducto->getOneProduct($datos->idproducto);
                    if (!empty($producto)) {
                        $ruta = $this->linkCoinPayMent($producto, $id, $datos->abono);
                        if ($ruta == 'pagado') {
                            $this->actualizarBD($id, 'wc-completed', 'Saldo');
                            $this->accionSolicitud($id, 'wc-completed', 'Saldo');
                        }
                    }
                }
                if (!empty($ruta)) {
                    if ($ruta != 'pagado') {
                        return redirect($ruta);
                    }else{
                        return redirect()->back()->with('msj', 'Su paquete fue pagado con su saldo exitosamente');
                    }
                }else{
                    return redirect()->back()->with('msj', 'Hubo Un Problema con el proceso de compra');
                }
            }
        } catch (\Throwable $th) {
            Log::error('Proceso de compra -> '.$th);
            return redirect()->back()->with('msj', 'Hubo Un Problema con el proceso de compra');
            // dd($th);
        }    
    }
}
