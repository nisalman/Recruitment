<?php

namespace App;

use App\Traits\GlobalAccessor;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use GlobalAccessor;
    protected $fillable = ['name', 'address', 'sport_id'];

    public $timestamps = false;

    public function sports()
    {
        return $this->belongsTo(Sport::class);
    }
}
