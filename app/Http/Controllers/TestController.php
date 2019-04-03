<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Role, Permission};

class TestController extends Controller
{
    public function index()
    {
    	\Auth::logout();
  //   	$owner = new Role();
		// $owner->name         = 'dev';
		// $owner->display_name = 'Developer'; // optional
		// $owner->save();

		// $admin = new Role();
		// $admin->name         = 'dc';
		// $admin->display_name = 'DC Office'; // optional
		// $admin->save();

		// $admin = new Role();
		// $admin->name         = 'nsc';
		// $admin->display_name = 'NSC'; // optional
		// $admin->save();

		// $admin = new Role();
		// $admin->name         = 'ministry';
		// $admin->display_name = 'Ministry'; // optional
		// $admin->save();

		// $admin = new Role();
		// $admin->name         = 'bsc';
		// $admin->display_name = 'BSC'; // optional
		// $admin->save();

		// $createPost = new Permission();
		// $createPost->name         = 'forward';
		// $createPost->display_name = 'Forward'; // optional
		// $createPost->save();
		
		// $createPost = new Permission();
		// $createPost->name         = 'update';
		// $createPost->display_name = 'Update'; // optional
		// $createPost->save();

		// $createPost = new Permission();
		// $createPost->name         = 'alter';
		// $createPost->display_name = 'Modify Form'; // optional
		// $createPost->save();

		// $createPost = new Permission();
		// $createPost->name         = 'priority';
		// $createPost->display_name = 'Form Priority'; // optional
		// $createPost->save();

		// $createPost = new Permission();
		// $createPost->name         = 'manage-users';
		// $createPost->display_name = 'Manage Users'; // optional
		// $createPost->save();

    }
}
