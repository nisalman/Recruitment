<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class MaritialStatus extends Model
{
    use GlobalAccessor;
    protected $fillable = ['name', 'status'];
}
