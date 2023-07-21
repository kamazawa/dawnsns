<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class PostsController extends Controller
{
    //投稿内容
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $is_following = \DB::table('follows')
            ->where('follower', Auth::user()->id)
            ->pluck('follow');

        $timeline = \DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->where('posts.user_id',Auth::user()->id)
        ->orWhereIn('posts.user_id',$is_following)
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.images','users.username')
        ->orderBy('posts.created_at','DESC')
        ->get();

        return view('posts.index',['timeline'=>$timeline]);
        }

        //新規投稿
    public function create(Request $request){
        $user = Auth::id();
        $posts = $request -> input('newPost');
        \DB::table('posts') -> insert([
            'user_id' => $user,
            'posts' => $posts,
            'created_at' => now(),
        ]);
         return redirect('/top');
    }


        //投稿編集
    public function update($id, Request $request){
        $up_post = $request->input('upPost');
        \DB::table('posts')
        ->where('id',$id)
        ->update(['posts'=>$up_post, 'updated_at'=>now()]);
        return redirect('/top');
    }

        //削除
      public function delete($id){
        \DB::table('posts')
        ->where('id',$id)
        ->delete();
        return redirect('/top');
    }
}
