<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
    	'type', 'title', 'description', 'path'
    ];

    public function getSrcAttribute()
    {
    	return url(str_replace('public', 'storage', $this->path));
    }
}
