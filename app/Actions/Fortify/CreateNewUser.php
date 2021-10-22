<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $messages = [
            'firstname.required' => 'El Campo nombre es requerido',
            'lastname.required' => 'El Campo apellido es requerido',
            'username.required' => 'El Campo Nombre de Usuario es requerido.',
            'username.unique' => 'Ya existe este nombre de usuario en nuestra base de datos',
            'email.require' => 'El campo Correo es requerido',
            'email.unique' => 'Ya existe este correo en nuestra base de datos',
        ];
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
        ], $messages)->validate();

        $user = User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'referred_id' => $input['referred_id'],
        ]);

        if ($user) {
            $data = [
                'first_name='.$user->firstname,
                'last_name='.$user->lastname,
                'email='.$user->email,
                'password='.$input['password'],
                'auth_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMCIsInJvbGUiOiJhcGkiLCJmaXJzdF9uYW1lIjoiYmFja29mZmljZSJ9.X6qtlfZyjhGsWyQiqj_Kr4esk3gFAcY3ilxWeJZn-uE'
            ];
            $variable = implode('&', $data);
            $idUserCrypto = $this->insertCryptoAcademy($variable);
            $user->user_id_crypto = $idUserCrypto;
            $user->save();
            
        }

        return $user;
    }

    /**
     * Permite ingresar a un usuario en la bd de crypto academia
     *
     * @param string $data
     * @return void
     */
    public function insertCryptoAcademy($variables):int 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://sysmocompany.com/api/register_user?".$variables,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result = 0;
        if ($err) {
            Log::error('Action - CreateNewUser - InsertCryptoAcademy -> Error curl: ' . $err);
        } else {
            $arreglo = explode(',', $response);
            $arreglo2 = explode(':', $arreglo[1]);
            $iduser = trim($arreglo2[1], "}'");
            // Log::info('Id Ultimo user -> '.$iduser);
            // dd($response);
            $result = $iduser;
        }
        return $result;
    }
}
