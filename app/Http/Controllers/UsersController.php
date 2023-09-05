<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //ユーザープロフィール
    public function show(Request $request){
         $user = Auth::user();

         $count = $request->session()->get('count');

        return view('users.profile',['user' => $user, 'count'=>$count]);
    }

    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(),[
        'username' => ['required','string','between:4,12'],
        'mail' => ['required','string','email','min:4', Rule::unique('users')->ignore(Auth::id())],
        'password' => ['nullable','string','between:4,12'],
        'bio' => ['nullable'],
        'images' => ['nullable','file']
        ],
        [
            'username.required' => 'ユーザーネームは必須項目です',
            'email.required' => 'メールアドレスは必須項目です',
            'mail.email' => 'メールアドレスではありません',
            'mail.unique' => 'このメールアドレスは既に使われています',
            'password.min' => 'パスワードは4文字以上で入力してください',
        ]);

        $validator->validate();

        $username = $request -> username;
        $mail = $request -> mail;
        $bio = $request->bio;

        if(request('new_password')){
        $new_password = bcrypt($request->new_password);
        }else{
        $new_password = Auth::user()->password;
        }

        if(request('images')){
        $images = $request->file('images')->store('public/images');
        $image_name=$request->file('images')->getClientOriginalName();
        }

        DB::table('users')->where('id',Auth::id())->update([
            'username'=>$username,
            'mail'=>$mail,
            'password'=>$new_password,
            'bio'=>$bio,
            'images'=>$image_name,
            'updated_at'=>now()
        ]);

        return redirect('/profile');
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
