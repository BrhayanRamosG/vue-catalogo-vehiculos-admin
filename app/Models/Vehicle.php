<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function videos()
    {
        return $this->hasMany('App\Models\Video');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
    public function conditions()
    {
        return $this->belongsTo('App\Models\Condition');
    }
    public function payment_methods()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }
    public function proprietaries()
    {
        return $this->belongsTo('App\Models\Proprietary');
    }
    public function categories()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function make_models()
    {
        return $this->belongsTo('App\Models\MakeModel');
    }
    public function transmissions()
    {
        return $this->belongsTo('App\Models\Transmission');
    }
    public function status_vehicles()
    {
        return $this->belongsTo('App\Models\StatusVehicle');
    }
    public function slugs()
    {
        return $this->hasOne('App\Models\Slug');
    }
}
