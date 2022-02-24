<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function vehicles()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }
}
