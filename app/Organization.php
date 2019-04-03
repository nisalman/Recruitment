<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	use GlobalAccessor;
	protected $fillable = ['name', 'representative', 'status'];

    public $timestamps = false;
    
	public function sport()
	{
		return $this->belongsTo(Sport::class);
	}
}
