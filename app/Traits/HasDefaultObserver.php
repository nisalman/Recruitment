<?php 
namespace App\Traits;

trait HasDefaultObserver
{

	public static function boot()
	{
		parent::boot();
        static::observe(\App\Observers\DefaultObserver::class);
	}
}