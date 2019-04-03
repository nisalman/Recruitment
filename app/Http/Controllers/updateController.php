<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class updateController extends Controller
{
    public function index()
    {
        return view('test');
    }
    public function store(Request $request)
    {
//        $name=$request->name;
//        echo $name;
//        exit();
        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:2',
        ]);

        $user=array();
        $user['id'] = $request->id;
        $user['name'] = $request->name;
        $user['username']  = $request->username;
        $user['password']  = bcrypt($request->password);
        $user['status']  = $request->status;
        $user['type'] = 1;
        $user['designation_id'] = $request->deg;
        DB::table('users')
            ->where('id',$user['id'])
            ->update($user);

        $role=array();

        $role['role_id']=$request->roles;

        DB::table('role_user')
            ->where('user_id',$user['id'])
            ->update($role);

        return redirect('/admin/users');
    }
    Public function deleteUser($id)
    {
        echo $id;
        exit;
        DB::table('users')

            ->where('id', $user_id)
            ->delete();
        Return Redirect::to('/admin/users');
    }
}
