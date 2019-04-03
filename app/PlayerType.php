<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class PlayerType extends Model
{
	use GlobalAccessor;
	protected $fillable = ['name', 'status'];

    public $timestamps = false;
    
	public function sport()
	{
		return $this->belongsTo(Sport::class);
	}
}
