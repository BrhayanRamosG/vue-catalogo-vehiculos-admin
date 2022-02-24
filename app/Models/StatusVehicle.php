<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusVehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vehicles()
    {
        return $this->hasMany('App\Models\Vehicle');
    }
}