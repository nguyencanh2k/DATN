<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Auth;
class AuthController extends Controller
{

    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }
    public function login(Request $request){
        $this->validate($request,[
            'admin_email'=>'required|email|max:255',
            'admin_password'=>'required|max:255',
        ]);
        // $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
            return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->with('message', 'Email hoặc mật khẩu không chính xác');
        }
    }
    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng xuất thành công');
    }
}
