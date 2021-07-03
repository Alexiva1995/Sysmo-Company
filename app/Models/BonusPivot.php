<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusPivot extends Model
{
    use HasFactory;

    public function getBonus()
    {
        return $this->belongsTo('App\Models\Bonus', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
