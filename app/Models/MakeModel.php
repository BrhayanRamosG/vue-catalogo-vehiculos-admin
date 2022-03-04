<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Scopes
    public function scopeSearchMakeModel($query, $idMakeModel)
    {
        return $query->join('makes', 'makes.id', '=', 'make_models.makes_id')->where('make_models.id', '=', $idMakeModel);
    }
    
    //Relationships
    public function makes()
    {
        return $this->belongsTo(Make::class);
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
