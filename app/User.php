<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\{Localize, GlobalAccessor};
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\{Role, FormSubmission as Form};
class User extends Authenticatable
{
    use Notifiable, Localize, EntrustUserTrait, GlobalAccessor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'mobile', 'designation_id', 'locationable_id', 'locationable_type', 'nameEn', 'status', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function location()
    {
        return $this->morphTo('locationable');
    }


    /**
     *
     * Retrive user accesssable submissions
     * @return COllectin of FormSubmission Model
     *
     */
    public function accessableSubmissions()
    {

        $user = request()->user();
        
        if($user->hasRole('dc'))
        {
             return Form::DC();
        }
        if($user->hasRole('nsc'))
        {
            return Form::NSC();
        }
        if($user->hasRole('ministry'))
        {
            return Form::Ministry();
        }
        if($user->hasRole('bsc'))
        {
            return Form::BSC();
        }
        if($user->hasRole('dev'))
        {
            return Form::all();
        }
        if($user->hasRole('special'))
        {
            return Form::Special();
        }
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function getAvatarAttribute($avatar)
    {
        return $avatar?\Storage::url($avatar): \Storage::url("photo/default-avatar.png");
    }

    public function accessableUsers()
    {
        $user = request()->user();
        
        if($user->hasRole('dc'))
        {
            return $this->location->users()->with('roles', 'designation');
        }
        
        // if($user->hasRole('nsc'))
        // {
        //     return Form::NSC();
        // }
        // if($user->hasRole('ministry'))
        // {
        //     return Form::Ministry();
        // }
        // if($user->hasRole('bsc'))
        // {
        //     return Form::BSC();
        // }
        // if($user->hasRole('dev'))
        // {
        //     return Form::all();
        // }
    }


}
