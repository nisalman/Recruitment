<?php

namespace App;
use App\District;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function districts()
    {
    	return $this->hasMany(District::class);
    }

    public function upazilas()
    {
    	return $this->hasManyThrough(Upazila::class, District::class);
    }

    public function getNameAttribute($value)
    {
    	return $this->bn_name;
    }
}
