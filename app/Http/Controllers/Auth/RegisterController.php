<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make( $data, [
            'username' => ['required','string','between:4,12'],
            'mail' => ['required','string','email','min:4','unique:users'],
            'password' => ['required','string','between:4,12','confirmed'],
            'password_confirmation' => ['required'],
        ],
        [
            'username.required' => 'ユーザーネームは必須項目です',
            'email.required' => 'メールアドレスは必須項目です',
            'mail.email' => 'メールアドレスではありません',
            'mail.unique' => 'このメールアドレスは既に使われています',
            'password.required' => 'パスワードは必須項目です',
            'password.min' => 'パスワードは4文字以上で入力してください',
            'password.confirmed' => '確認用パスワードが一致しません',
            'password_confirmation.required' => '確認用パスワードは必須項目です',
        ]
        )->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $this->validator($data);
            $this->create($data);
            $request->session()->put('name', $data['username']);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(Request $request){
        $name = $request->session()->get('name');
        return view("auth.added",['name' => $name]);
    }
}
