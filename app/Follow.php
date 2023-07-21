<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Follow;

class Follow extends Model
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

       public function follow(){
    }
}
