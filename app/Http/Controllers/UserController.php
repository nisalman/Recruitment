<?php
namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use DB;
class UserController extends Controller
{
    public function index(Request $request)
    {
    	if(request()->has('draw'))
    	{
    		return $this->draw();
    	}
//previous query users, designation, Role

//        $users = DB::table('users')
//            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
//            ->select('users.*', 'designations.name as designation_name')
//            ->where('type', 1)->orderBy('id', 'asc')->get();

//previous query for users, designation, Role

        $users = DB::table('users')

            ->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.*', 'role_user.role_id', 'designations.name as designation_name')
            ->where('users.type', 1)
            ->orderBy('id', 'asc')->get();
//        echo'<pre>';
//        print_r($users);
//        exit();


        if ($request->ajax()) {
            return response()->json(view(['users' => $users], 'users.list')->render());
        }

        //return view('users.index',['users' => $users]);
    	return view('users',compact('users'));

    }

    /**
     *
     * Send data to table
     *
     */

    public function draw()
    {
    	$json = datatables()
    			->of(request()->user()->accessableUsers())
          
                ->addColumn('designation', function ($user)
	                {
	                    // return $user->designation->name;
	                })
                ->addColumn('roles', function ($user)
	                {
	                    return $user->rolesAsHtml();
	                })
                ->addColumn('status', function ($sport)
                    {
                        return $sport->editableStatus;
                    })
                ->rawColumns([ 'roles', 'status'])
    			->toJson(true);

        return $json;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:2',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->type = 1;
        $user->designation_id = $request->designation_id;
        $user->save();

        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $request->roles]);
        return $user;
//
//        $user = new User();
//        $user->name = $request->name;
//        $user->username = $request->username;
//        $user->password = bcrypt($request->password);
//        $user->designation_id = $request->designation_id;
//        $user->status = $request->status;
//        $user->type = 1;
//        $user->save();
//
//        if ($request->has('dc_select')) {
//            $user->locationable_type = 'App\District';
//            $user->locationable_id = 63;
//        }
//
//        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $request->roles]);
//
//        return redirect('/admin/users');
//    	$data = $this->getData();
//    	$user = $request->user()->location->users()->create($data);
//    	$user->roles()->attach($request->roles);
    }

    public function updateUser(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:2',
        ]);

        $user=array();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->type = 1;
        $user->designation_id = $request->designation_id;
   print_r($user);
   exit();
        DB::table('users')
            ->where('id',$category_id)
            ->update($user);
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function getData()
    {
    	$data = request()->only('name', 'username', 'password', 'status', 'designation_id');
    	$data['password'] = bcrypt($data['password']);
    	$data['type'] = '1';
    	return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        $user_data= DB::table('users')

            ->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->select('users.*', 'role_user.role_id', 'designations.name as designation_name')
            ->where ('users.id', $id)
            ->first();
//        echo '<pre>';
//        print_r($user_data);
//        exit();
//        $role_user = DB::table('role_user')
//            ->where ('user_id', $id)
//            ->first();
//        $role_data = DB::table('roles')
//            ->where('id', $role_user)
//            ->first();
//        echo '<pre>';
//        print_r($users);
//        echo '<pre>';
//        exit();
//        $users = User::find($id);

        return view('edit_user',compact('user_data'));
//        if ($request->ajax()) {
//            return response()->json(view('edit_user', ['users' => $users])->render());
//        return dd($user);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::where('id', $id)->update($request->only(['name', 'status']));
        return dd($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return $user;
    }

    public function show(){
        $users = DB::table('users')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->select('users.*', 'designations.name as designation_name')
            ->where('type', 1)->orderBy('id', 'asc')->get();

        $records = $users ? $users[0] : [];
        return response()->json($records);
    }

}
