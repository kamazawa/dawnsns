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

    //
    public function followList(){

        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }


}
