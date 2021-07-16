<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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


        return User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'referred_id' => $input['referred_id'],
        ]);
    }
}
