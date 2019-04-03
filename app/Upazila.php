<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
	use GlobalAccessor;
	protected $fillable = ['name','bn_name','district_id'];

    public $timestamps = false;
    
	public function sport()
	{
		return $this->belongsTo(Sport::class);
	}

//   public function getNameAttribute($value)
//    {
//    	return $this->bn_name;
//    }

    public function district()
    {
    	return $this->belongsTo(District::class);
    }



}

