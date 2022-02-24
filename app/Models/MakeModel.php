<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function makes()
    {
        return $this->belongsTo('App\Models\Make');
    }
    public function vehicles()
    {
        return $this->hasMany('App\Models\Vehicle');
    }
}
