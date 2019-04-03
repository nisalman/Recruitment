<?php

namespace App;
use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Pre_exam extends Model
{
   // use GlobalAccessor;
    protected  $table = 'pre_exam';
    protected $fillable =['point'];

    public $timestamps = false;

}
