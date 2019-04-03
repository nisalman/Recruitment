<?php

namespace App;
use App\room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Traits\GlobalAccessor;
use App\Traits\HasDefaultObserver;
class center extends Model
{
    use GlobalAccessor;
    protected $fillable = ['name', 'num_room','location','status'];

    public $timestamps = false;

    public function room()
    {
        return $this->hasMany('App\room', 'center_id');
    }
}
