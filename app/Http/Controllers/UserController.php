<?php

namespace App\Http\Controllers;

use App\Model\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        if(!$user)
            abort(404);
        return view('user.show',compact(['user']));
    }

    public function update(Request $request,$slug){
        $user=User::where('slug',$slug)->first();
        if(!$user)
            abort(404);
        $input = [];
        $input["name"] = $request->name;
        $this->validate($request,[
            'email' => 'unique:users,email,'.$user->id,
        ]);
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
        return redirect('/admin/user/'.$user->slug)->with('success','Updated Successfully');
    }

    public function addAdminShow(){
        return view('user.add-admin');
    }


    public function addAdminPost(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try{
            DB::beginTransaction();
            $input=$request->all();
            $input["password"]=bcrypt($request->input('password'));
            $user=User::create($input);
            $user->assignRole('Admin');
            $profile=new Profile();
            $profile->user_id=$user->id;
            $profile->save();
            DB::commit();
            return redirect('/admin/users/Admin')->with('success','Added Admin Successfully');
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
