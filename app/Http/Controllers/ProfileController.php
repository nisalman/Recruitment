<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	$user = \Auth::user();
    	return view('profile')->with(compact('user'));
    }

    public function save(Request $request)
    {
    	$request->validate([
    			'name' => "required",
    			'mobile' => "required"
    	]);
    	$data = $request->only(['email', 'name', 'mobile', 'password']);
    	if($data['password'])
    	{
    		$data['password'] = bcrypt($data['password']);
    	}else{
    		unset($data['password']);
    	}

    	if($request->hasFile('avatar'))
    	{
    		$data['avatar'] =$request->avatar->store('public/avatar');
    		\Storage::delete($request->user()->getOriginal('avatar'));
    	}

    	\App\User::where('id', $request->user()->id)->update($data);
    	return __('Profile Updated');
    }
}
