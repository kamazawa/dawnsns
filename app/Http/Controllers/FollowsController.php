<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Auth;
use App\Follow;
use App\Post;
use App\User;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //フォローリスト、フォロワーリスト
    public function followList(){

            $is_following = \DB::table('follows')
            ->where('follower', Auth::user()->id)
            ->pluck('follow');

            $timeline = \DB::table('users')
            ->leftJoin('posts','posts.user_id','=','users.id')
            ->whereIn('users.id',$is_following)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();

            return view('follows.followList', ['is_following' => $is_following,'timeline'=>$timeline,]);

    }

    public function followerList(){
      $is_following = \DB::table('follows')
            ->where('follow', Auth::user()->id)
            ->pluck('follower');

            $timeline = \DB::table('users')
            ->leftJoin('posts','users.id','=','posts.user_id')
            ->whereIn('users.id',$is_following)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();


            return view('follows.followList', ['is_following' => $is_following,'timeline'=>$timeline,]);
    }
     //フォロー・フォロワープロフィール
    public function profile($id){

        $timeline = \DB::table('users')
            ->leftJoin('posts','posts.user_id','=','users.id')
            ->where('users.id',$id)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();

            $is_following = \DB::table('follows')
            ->where('follower', Auth::user()->id)
            ->pluck('follow');

        return view('follows.profile',['timeline'=>$timeline,'id'=>$id,'is_following' => $is_following]);

    }
    //フォロー
    public function follow($id){
                \DB::table('follows')
                ->insert([
                    'follow' => $id,
                    'follower' => Auth::user()->id,
                    'created_at' => now(),
                ]);
                return back();
    }
    //フォロー解除
    public function unfollow($id){
            \DB::table('follows')
                ->where('follower', \Auth::user()->id,)
                ->where('follow', $id)
                ->delete();
        return back();
    }



}
