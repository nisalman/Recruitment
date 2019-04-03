<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

use Illuminate\Database\Eloquent\Builder;
class Role extends EntrustRole
{


    public static function boot()
   {
   		parent::boot();
   		static::addGlobalScope('filter', function (Builder  $builder)
   		{
   			// $builder->where('name', '!=', 'dev');
   		});
   }
}
