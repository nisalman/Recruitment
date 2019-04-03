<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
	use GlobalAccessor;
	protected $fillable = ['year_name', 'status'];

    public $timestamps = false;
    
	
}
