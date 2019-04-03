<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Federation extends Model
{
	use GlobalAccessor;
	protected $fillable = ['name', 'address', 'sport_id'];

    public $timestamps = false;
    
	public function sport()
	{
		return $this->belongsTo(Sport::class);
	}
}
