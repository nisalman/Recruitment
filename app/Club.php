<?php

namespace App;
use App\Traits\GlobalAccessor;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
	use GlobalAccessor;
    protected $fillable = ['name', 'established', 'status', 'address'];

	public $timestamps = false;
    
}
