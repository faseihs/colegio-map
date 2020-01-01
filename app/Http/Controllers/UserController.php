<?php

namespace App\Http\Controllers;

use App\Model\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //

    public function index(Request $request){
        $type="all";
        if($request->has("type"))
            $type=$request->type;
        $roles=["all","Super Admin","Admin","Employee"];
        if(!in_array($type,$roles))
            abort(404);
        if($type=="all")
            $users=User::all();
        else $users=User::role($type)->get();
        return view('user.index',compact(['users','type']));
    }

    public function show($id){
        $user=User::findOrFail($id);
        $roles = $user->getRoleNames();
        $role=$roles->first();
        
        $roles= Role::pluck('name','name')->all();
        
       // dd($role,$roles);
        if(!$user)
            abort(404);
        return view('user.show',compact('user','roles','role'));
    }

    public function update(Request $request,$id){
        //dd($request->all());
        $user=User::where('id',$id)->first();
        if(!$user)
            abort(404);
        $input = [];
        $input["name"] = $request->name;
        $this->validate($request,[
            'email' => 'unique:users,email,'.$user->id,
            'role'=>'required'
        ]);

        $user->removeRole($request->role);
        $user->assignRole($request->role);
        $input["email"] = $request->email;
        if($request->input('password')!=null){
            $this->validate($request,[
                'password' => 'required|string|min:6|confirmed',
            ]);
            if(Hash::check($request['password'],Auth::user()->getAuthPassword()))
                return Redirect::back()->withInput(Input::all())->withErrors(['','New Password same to old password']);

            $input["password"]=bcrypt($request->input('password'));
        }
        $user->update($input);
        return redirect('/users')->with('success','Updated Successfully');
    }

    public function addAdminShow(){
        $roles= Role::pluck('name','name')->all();
        return view('user.add-admin',compact('roles'));
    }


    public function addAdminPost(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>'required'
        ]);

        try{
            DB::beginTransaction();
            $input=$request->all();
            $input["password"]=bcrypt($request->input('password'));
            $user=User::create($input);
            $user->assignRole($request->role);
            DB::commit();
            return redirect('/users')->with('success','Added Admin Successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            if(env('APP_ENV')=='local')
                dd($e);
            else abort(500);
        }
    }

    public function deleteAdmin(Request $request,$id){
        $user=User::findOrFail($id);
        if($user->hasRole('Admin'))
            $user->delete();
        else abort(404);
        return redirect('/admin/users/Admin')->with('success','Deleted Admin Successfully');
    }
}
