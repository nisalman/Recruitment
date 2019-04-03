<?php

namespace App;
use App\Traits\GlobalAccessor;
use App\Traits\HasDefaultObserver;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
	use GlobalAccessor, HasDefaultObserver;

    public $timestamps = false;

    protected $fillable = ['name', 'status', 'federation_id'];

    public function federations()
    {
    	return $this->hasMany(Federation::class);
    }

    public function associations()
    {
        return $this->hasMany(Association::class);
    }
}
