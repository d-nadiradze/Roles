<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function show(){
        $users = User::with(['roles'])->get();
        return view('admin.admin',['users' => $users]);
    }

    public function user(){
        return view('admin.userAdd',['users' => User::all(),'roles' => Role::all()]);
    }

    public function addUser(UserRequest $request){
            if($request->validated()){
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'email_verified_at' => now(),
                ])->assignRole($request->role);

                return redirect()->route('admin.admin')->with('success','Account successfully created');
            }
        }
}
