<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * ak unda geceros cesit middleware ebi
         *
         */
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = Role::all();
        $admin = Role::findByName('admin');

            if ($admin){
                return view('home');
            }

             else{
                if($user->admin == '1'){
                Role::create(['name'=>'admin']);

                $user->assignRole('admin');
                }
            }
        return view('home');
    }

}
