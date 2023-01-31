<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\LoginFormDataRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function signup() {
        return view('signup');
    }

    public function store() {
        $name = request('name');
        $email = request('email');
        $password = request('password');
        $password_confirmation = request('password_confirmation');
        
        request() -> validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        
        $current_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        // 회원가입 후 바로 로그인 상태 적용
        Auth::login($current_user);

        return redirect() -> route('home.index');
    }

    public function enter(LoginFormDataRequest $request) {
        $credentials = $request -> validated();

        if(Auth::attempt($credentials)) {
            // 보안상의 이유로 로그인 성공시 새 세션 발급
            request() -> session() -> regenerate();
            return redirect() -> route('home.index');
        };

        return back() -> with('error', '인증에 실패했습니다.') -> withInput(request() -> except('password'));
    }

    public function exit() {
        Auth::logout();

        request() -> session() -> invalidate();
        request() -> session() -> regenerateToken();
        
        return redirect() -> route('home.index');
    }

    public function confirmEmail() {
        $result = true;
        $request_email = request('email');
        $is_possible = User::firstWhere('email',$request_email);

        if($is_possible){
            $result = false;
        }

        return response()->json(['possible' => $result]);
    }
}
