<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;
use Spatie\Permission\Models\Permission;
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

    public function editById($id){
            $data = User::all()->find($id);

            return view('admin.userEdit',['data' => $data]);
    }

    public function edit(UserRequest $request){

        $data = User::findOrFail($request->input('user_id'));

        if($request->validated($data)) {
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => encrypt($request->password),
                'email_verified_at' => now(),
            ]);
            return redirect()->route('admin.admin')->with('success','User account successfully edited');;
        }
        else redirect()->back()->withErrors(['errors','Validation error']);
    }

    public function destroy($id){
        User::find($id)->delete();
        return redirect()->back()->with('success','Account successfully deleted');
    }

    public function role(){
        return view('admin.role.role',['permissions' => Permission::all()]);
    }

    public function addRole(RoleRequest $request){
        if(Count(Role::findByName($request->name)->get()) < 0) {

            if ($request->validated()) {
                $role = Role::create([
                    'name' => $request->name,
                    'guard_name' => 'web'
                ]);
            } else {
                return redirect()->back()->withErrors('errors', 'Select name');
            }

            if ($request->permission) {
                $role->syncPermissions($request->permission);
            } else {
                return redirect()->back()->withErrors(['errors', 'Select permission']);
            }
            return redirect()->back()->with('success','Role successfully created');
        }
        return redirect()->back()->withErrors(['errors', 'The role with this name is already taken']);

    }

}
