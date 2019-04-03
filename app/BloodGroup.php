<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use GlobalAccessor;
    protected $fillable = ['name', 'status'];
}
