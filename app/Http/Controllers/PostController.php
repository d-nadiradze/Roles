<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PostController extends Controller
{
    public function show(){
        $this->checkAdmin();
        return view('post.post',['posts' => Post::all()]);
    }

    public function create(){
        return view('post.create',['data' => Post::all()]);
    }

    public function store(PostRequest $request){

        if($request->validated()){
            Post::create([
                'name' => $request->name,
                'title' => $request->title,
                'body' => $request->body,
            ]);
            return redirect()->route('post.show')->with('success','Post successfully created');
        }
    }

    public function editById($id){
        $data = Post::all()->find($id);
        return view('post.edit',['data' => $data]);
    }

    public function edit(PostRequest $request){

        $data = Post::findOrFail($request->input('post_id'));

        if($request->validated($data)) {
            $data->update([
                'name' => $request->name,
                'title' => $request->title,
                'body' => $request->body,
            ]);
            return redirect()->route('post.show')->with('success','Post successfully edited');;
        }
        else redirect()->back()->withErrors(['errors','Validation error']);
    }

    public function destroy($id){
       Post::find($id)->delete();
       return redirect()->back();
    }

    public function checkAdmin(){
        $user = Auth::user();

        if($user->admin == '1'){
            $user->assignRole('admin');
        }
        $role = Role::findByName('admin');
        $role->syncPermissions('add post','edit post','view post','delete post');
    }
}
