<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Register
    public function showRegistrationForm()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/auth/register', [
        'pageConfigs' => $pageConfigs
        ]);
    }

    /**
     * Permite registrar a los usuarios que vienen de la academia
     *
     * @param Request $request
     * @return void
     */
    public function getRegisteApiCrypto(Request $request)
    {
            $messages = [
                'firstname.required' => 'El Campo nombre es requerido',
                'lastname.required' => 'El Campo apellido es requerido',
                'username.required' => 'El Campo Nombre de Usuario es requerido.',
                'username.unique' => 'Ya existe este nombre de usuario en nuestra base de datos',
                'email.require' => 'El campo Correo es requerido',
                'email.unique' => 'Ya existe este correo en nuestra base de datos',
                'token.required' => 'El campo token es requerido',
            ];
            $input = $request->toArray();
            $validate = Validator::make($input, [
                'token' => ['required'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', new Password],
                'user_id_crypto' => ['required']
            ], $messages);
            if ($validate->fails()) {
                return response()->json(['error'=>$validate->errors()], 401);
            }

            $token = ($input['token'] == '$2a$15$VRAzVMvVQkqgKMlfIzRPv.4HR3lG.MdpoD60f9Thgw1KaA4WH7Ssy') ? true : false;
    
            if ($token) {
                $user = User::create([
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'username' => $input['username'].$input['lastname'].'_'.$input['firstname'].'_'.$input['user_id_crypto'],
                    'email' => trim($input['email']),
                    'password' => $input['password'],
                    'referred_id' => 1,
                    'user_id_crypto'=> $input['user_id_crypto']
                ]);
    
                if ($user) {
                    return response()->json(['success' => 'ok']);
                }
            }else{
                return response()->json(['error' => ['token' => 'El token es incorrecto']]);
            }
    }
}
