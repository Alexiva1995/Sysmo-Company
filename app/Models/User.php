<?php

namespace App\Models;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'billetera',
        'skrill',
        'role',
        'range_id',
        'status',
        'balance',
        'referred_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getDescriptionAttribute()
    {
        return $this->display_name;
    }

    public function children()
    {
        return $this->hasMany(User::class, 'referred_id', 'id');
    }
    public function childrenActive()
    {
        return $this->children()->where('status', '1');
    }

        /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getSaldos()
    {
        return $this->hasMany('App\Models\AddSaldo', 'user_id');
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany('App\Models\Wallet', 'user_id');
    }

    /**
     * Permite obtener todas la liquidaciones que tengo
     *
     * @return void
     */
    public function getLiquidate()
    {
        return $this->hasMany('App\Models\Liquidaction', 'user_id');
    }


    /**
     * Permite obtener todas las ordenes que tengo
     *
     * @return void
     */
    public function getOrder()
    {
        return $this->hasMany('App\Models\Order', 'user_id');
    }

    public function getBonus()
    {
        return $this->hasMany('App\Models\BonusPivot', 'user_id');
    }

}
