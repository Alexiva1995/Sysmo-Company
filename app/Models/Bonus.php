<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    public function getBonusPivot()
    {
        return $this->hasMany('App\Models\BonusPivot', 'bonuses_id');
    }
}
