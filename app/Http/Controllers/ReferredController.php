<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ReferredController extends Controller
{

    // obtiene los referidos directos del usuario logueado
    public function listDirect(){

        $referred_direct = User::where('referred_id', '=', Auth::user()->id)
                                ->select('id', 'email', 'created_at', 'status')
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('content.referred.referred-direct')->with('referred_direct', $referred_direct);

    }

    // obtiene los referidos en red del usuario logueado
    public function listNet(){
        
        $referred_net = $this->getReferrals(Auth::user()->id, [], 1);

        return view('content.referred.referred-net')->with('referred_net', $referred_net);
    }

    public function getReferrals($user, $referrals, $level){

    	if (empty($referrals)){
    		$referrals = collect();
    	}

    	if ($level < 10){
    		$referidos = User::select('id', 'email', 'created_at', 'status')
    					->where('referred_id', '=', $user)
    					->get();

	    	foreach ($referidos as $referido){
	    		$referido->level = $level;
	    		$referrals->push($referido);
	    		$this->getReferrals($referido->id, $referrals, $level+1);
	    	}
    	}
    	
    	return $referrals;
    }




    /**
     * Lleva a la vista de arbol o matriz
     *
     * @param string $type
     * @return void
     */
    public function index($type)
    {
            // $trees = $this->getDataEstructura(Auth::user()->id, $type);
            // $type = ucfirst($type);
            // $base = Auth::user();
            // $base->children = User::where('referred_id', '=', Auth::id())->get();
            // $base->logoarbol = asset('images/logo/logoarbol.png');
            // return view('content.referred.tree.tree', compact('trees','type', 'base'));
            try {
                //Titulo
                // View::share('titleg', 'Arbol');
                $trees = $this->getDataEstructura(Auth::id(), $type);
                $users = User::all("firstname");
                $type = ucfirst($type);
                $base = Auth::user();
                $base->logoarbol = asset('images/logo/logoarbol.png');
                return view('content.referred.tree.tree', compact('trees', 'type', 'base', 'users'));
            } catch (\Throwable $th) {
                // Log::error('Tree - index -> Error: '.$th);
                dd($th);
                abort(403, "Ocurrio un error, contacte con el administrador");
            }
    }


        /**
     * Lleva a la vista de arbol o matriz de un usuario hijo
     *
     * @param string $type
     * @param string $id
     * @return void
     */
    public function moretree($type, $id)
    {
        try {
            // titulo
            // View::share('titleg', 'Arbol');
            $id = base64_decode($id);
            $trees = $this->getDataEstructura($id, $type);
            $type = ucfirst($type);
            $base = User::find($id);
            if (empty($base)) {
                return redirect()->back()->with('msj2', 'El ID '. $id.', no se encuentra registrado');
            }
            $base->children = User::where('referred_id', '=', $base->id)->get();
            $base->logoarbol = asset('assets/img/sistema/favicon.png');
            return view('content.referred.tree.tree', compact('trees', 'type', 'base'));
        } catch (\Throwable $th) {
            // Log::error('Tree - moretree -> Error: '.$th);
            dd($th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }

            // $trees = $this->getDataEstructura($id, strtolower($type));
            // $type = ucfirst($type);
            // $base = User::find($id);

            // if (empty($base)) {
            //     return redirect()->back()->with('msj2', 'El ID '. $id.', no se encuentra registrado');
            // }
            // $base->children = User::where('referred_id', '=', $base->id)->get();
            // $base->logoarbol = asset('images/logo/logoarbol.png');
            // return view('content.referred.tree.tree')->with(compact('base', 'trees', 'type'));

    }


    /**
     * Permite obtener la informacion para el arbol o matris
     *
     * @param integer $id - id del usuario a obtener sus hijos
     * @param string $type - tipo de estructura a general
     * @return void
     */
    // private function getDataEstructura($id, $type)
    // {
    //         $genealogyType = [
    //             'tree' => 'referred_id',
    //             'matriz' => 'referred_id',
    //         ];


    //         $childres = $this->getData($id, 1, $genealogyType[$type]);
    //         $trees = $this->getChildren($childres, 2, $genealogyType[$type]);
    //         return $trees;
    // } 
    private function getDataEstructura($id, $type)
    {
        try {
            $genealogyType = [
                'tree' => 'referred_id',
                'matriz' => 'binary_id',
                'alterno' => 'alternativo_id'
            ];
            
            $childres = $this->getData($id, 1, $genealogyType[$type]);
            $trees = $this->getChildren($childres, 2, $genealogyType[$type]);
            return $trees;
        } catch (\Throwable $th) {
            // Log::error('Tree - getDataEstructura -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite obtener a todos mis hijos y los hijos de mis hijos
     *
     * @param array $users - arreglo de usuarios
     * @param integer $nivel - el nivel en el que esta parado
     * @param string $typeTree - el tipo de arbol a usar
     * @return void
     */
    // public function getChildren($users, $nivel, $typeTree)
    // {
    //         if (!empty($users)) {
    //             foreach ($users as $user) {
    //                 $user->children = $this->getData($user->id, $nivel, $typeTree);
    //                 // $this->getChildren($user->children, ($nivel+1), $typeTree);
    //             }
    //             return $users;
    //         }else{
    //             return $users;
    //         }
    // }

    public function getChildren($users, $nivel, $typeTree)
    {
        try {
            if (!empty($users)) {
                foreach ($users as $user) {
                    $user->children = $this->getData($user->id, $nivel, $typeTree);
                    $this->getChildren($user->children, ($nivel+1), $typeTree);
                }
                return $users;
            }else{
                return $users;
            }
        } catch (\Throwable $th) {
            // Log::error('Tree - getChildren -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Se trare la informacion de los hijos 
     *
     * @param integer $id - id a buscar hijos
     * @param integer $nivel - nivel en que los hijos se encuentra
     * @param string $typeTree - tipo de arbol a usar
     * @return object
     */
    // private function getData($id, $nivel, $typeTree) : object
    // {
    //         $resul = User::where($typeTree, '=', $id)->get();
            
    //         foreach ($resul as $user) {
                
    //             $user->nivel = $nivel;
    //             $user->logoarbol = asset('images/logo/logoarbol.png');

    //         }
    //         return $resul;
    // }
    private function getData($id, $nivel, $typeTree)
    {
        try {
            $resul = User::where($typeTree, '=', $id)->get();

            foreach ($resul as $user) {
                $user->nivel = $nivel;
                $user->logoarbol = asset('images/logo/logoarbol.png');
            }
            return $resul;
        } catch (\Throwable $th) {
            // Log::error('Tree - getData -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


}
