<?php

namespace App;

use App\center;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalAccessor;

class room extends Model
{
    use GlobalAccessor;
    protected $fillable = ['center_id', 'name', 'capacity', 'location','floor', 'status'];

    public $timestamps = false;

    Public function center()
    {
        return $this->belongsTo('App\center');
    }
}
