<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function profile(){
        return view('users.profile');
    }
    //検索機能
    public function search(Request $request){
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
            $userlist = \DB::table('users')
            ->where('users.username', 'LIKE', "%{$keyword}%")
            ->orderBy('users.id','ASC')
            ->get();

             $is_following = \DB::table('follows')
            ->where('follower', Auth::user()->id)
            ->pluck('follow');

             return view('search', ['userlist'=>$userlist, 'keyword'=>$keyword,'is_following' => $is_following]);
        } else {
            $userlist = \DB::table('users')
            ->select('users.id','users.username','users.images')
            ->orderBy('users.id','ASC')
            ->get();
            //フォローしている相手の変数idを格納した変数
            $is_following = \DB::table('follows')
            ->where('follower', Auth::user()->id)
            ->pluck('follow');

            return view('search', ['userlist'=>$userlist, 'keyword'=>$keyword, 'is_following' => $is_following]);
        }
    }
    //フォロー機能
public function follow($id){
                \DB::table('follows')
                ->insert([
                    'follow' => $id,
                    'follower' => Auth::user()->id,
                    'created_at' => now(),
                ]);
                return redirect('search');
    }
    //フォロー解除
    public function unfollow($id){
            \DB::table('follows')
                ->where('follower', \Auth::user()->id,)
                ->where('follow', $id)
                ->delete();
        return redirect('search');
    }

}
