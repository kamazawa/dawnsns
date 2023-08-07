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

            $timeline = \DB::table('posts')
            ->leftJoin('users','posts.user_id','=','users.id')
            ->whereIn('posts.user_id',$is_following)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();

            return view('follows.followList', ['is_following' => $is_following,'timeline'=>$timeline,]);

    }

    public function followerList(){
      $is_following = \DB::table('follows')
            ->where('follow', Auth::user()->id)
            ->pluck('follower');

            $timeline = \DB::table('posts')
            ->leftJoin('users','posts.user_id','=','users.id')
            ->whereIn('posts.user_id',$is_following)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();

            return view('follows.followList', ['is_following' => $is_following,'timeline'=>$timeline,]);
    }

    public function profile($id){

        $timeline = \DB::table('posts')
            ->leftJoin('users','posts.user_id','=','users.id')
            ->where('posts.user_id',$id)
            ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.id','users.username','users.images')
            ->get();

        return view('follows.profile',['timeline'=>$timeline,'id'=>$id]);

    }



}
