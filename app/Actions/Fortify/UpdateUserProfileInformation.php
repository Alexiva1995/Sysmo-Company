<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Symfony\Component\Console\Input\Input;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'whatsapp' => ['nullable','string', 'max:255'],
            'billetera' => ['nullable','string', 'max:255'],
            'skrill' => ['nullable','string', 'max:255'],
            // 'role' => ['nullable','string', 'max:255'],
            // 'balance' => ['nullable','number', 'max:255'],
            // 'status' => ['nullable','string', 'max:255'],
            // 'range_id' => ['nullable','string', 'max:255'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if($input['email'] == ""){
           $input['email'] = $user->email;
        }
        if($input['username'] == ""){
            $input['username'] = "$user->username";
         }
        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'username' => $input['username'],
                'email' => $input['email'],
                'whatsapp' => $input['whatsapp'],
                'billetera' => $input['billetera'],
                'skrill' => $input['skrill'],
                'role' => $input['role'],
                'balance' => $input['balance'],
                'status' => $input['status'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
