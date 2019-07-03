<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;

class LoginController extends Controller
{
    // 加载登录页面
    public function index()
    {
        return view('home.login.index');
    }

    // 执行用户登录
    public function dologin(Request $request)
    {

        // 验证密码
        $this->validate($request, [
            'uname' => 'required',
            'password' => 'required|regex:/^[\w]{6,18}$/',
        ],[
            'uname.required' => '用户名必填',

            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不正确',
        ]);

        $uname = $request->input('uname' ,'');
        $password = $request->input('password' , '');

        $user_data = Users::where('uname' , $uname)->orwhere('email' , $uname)->orwhere('phone',$uname)->first();
         
        if ($user_data ==null) {
            return back()->with('error' , '用户名不存在');
        }

        $user_pass = $user_data->password;

        // 验证密码
        if(!Hash::check($password,$user_pass)){
            return back()->with('error' , '用户名或密码错误');
        }

        // 验证状态
        if($user_data->status == 0){
            return back()->with('error' , '账号未激活');
        }

        // 登录
        session(['home_login'=>true]);
        session(['home_userinfo'=>$user_data]);

        return redirect('/');

    }
    
    //用户退出
    public function logout()
    {  
        session(['home_login'=>false]);
        session(['home_usersinfo'=>false]);
        return  back();
 
       
    }
}
