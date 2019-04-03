<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

	public function upazilas()
	{
		return $this->hasMany(Upazila::class);
	}

//    public function getNameAttribute($value)
//    {
//    	return $this->bn_name;
//    }

    public function users()
    {
    	return $this->morphMany('App\User', 'locationable');
    }

    public function submissions()
    {
    	return $this->hasManyThrough('App\FormSubmission', 'App\Upazila', null, 'permenentThana');
    }
}
