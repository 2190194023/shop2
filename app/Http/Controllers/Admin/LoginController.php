<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash; 

class LoginController extends Controller
{
    // 显示登录页面
    public function login()
    {
        // 加载登录页面
        return view('admin.login');
    }

    // 执行登录
    public function dologin(Request $request)
    {
        $uname = $request->input('uname','');
        $password = $request->input('password','');

        $admin_user_data = DB::table('admin_users')->where('uname',$uname)->first();

        if (!$admin_user_data) {
            return back()->with('error','用户名或密码错误');
        }

        // 验证密码
        if (!Hash::check($password, $admin_user_data->password)) {
             return back()->with('error','用户名或密码错误');
        }

        // 执行登录
        session(['admin_login'=>true]);
        session(['admin_user'=>$admin_user_data]);

        // 获取当前用户的权限
        $admin_user_nodes = DB::select('select n.aname,n.cname from nodes as n,roles_nodes as rn,adminusers_roles as ur where ur.uid = '.$admin_user_data->id.' and ur.rid = rn.rid and rn.nid = n.id;');

        $temp = [];
        foreach ($admin_user_nodes as $key => $value) {
            $temp[$value->cname][] = $value->aname;
            if ($value->aname == 'create') {
                $temp[$value->cname][] = 'store';
            }

            if ($value->aname == 'edit') {
                $temp[$value->cname][] = 'update';
            }

            if ($value->aname == 'index') {
                $temp[$value->cname][] = 'show';
            }
        }
              
        session(['admin_user_nodes'=>$temp]);


        // 跳转
        return redirect('admin');
    }
    
    // 退出
    public function outlogin()
    {
        session(['admin_login'=>false]);
        session(['admin_user'=>null]);

        return redirect('admin/login');
    }

    // 修改头像
    public function profile()
    {
        // 获取当前用户id
        $id = session('admin_user')->id;

        // 根据id查询当前用户的信息
        $data = DB::table('admin_users')->where('id',$id)->first();

        return view('admin.profile',['data'=>$data]);
    }

    // 执行修改头像
    public function doprofile(Request $request)
    {
        // 获取当前用户id
        $id = session('admin_user')->id;

        $file = $request->file('profile');

        if ($request->hasFile('profile')) {

            // 删除以前 旧图片
            Storage::delete($request->input('profile_path'));

            // 如果修改了 接收新头像
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else {
            // 如果没修改头像 接收以前的头像
            $file_path = $request->input('old_profile');
        }

        $data['profile'] = $file_path;

        // 执行修改
        $res = DB::table('admin_users')->update($data);

        // 判断逻辑
        if($res){
            // 获取管理员id 查询出图片路径 将其填入session
            $data = DB::table('admin_users')->where('id',$id)->first();
            session('admin_user')->profile = $data->profile;

            // 跳转页面
            return redirect('/admin')->with('success','修改成功');
        }else {
            return back()->with('error','修改失败');
        }
    }

    // 修改密码
    public function pass(Request $request)
    {
        // 加载后台页面
        return view('admin.pass');
    }

    // 执行修改密码
    public function dopass(Request $request)
    {
        // 验证密码
        $this->validate($request, [     
                'oldpass' => 'required',
                'password' => 'required|regex:/^[a-zA-Z]\w{5,17}$/',
                'repass' => 'required|same:password'       
            ],[   
                'oldpass.required' => '原密码不能为空!',
                'password.required' => '密码不能为空!',
                'password.regex' => '密码格式不正确!',
                'repass.required' => '确认密码不能为空!',
                'repass.same' => '两次密码不一致!!'
          ]);

        // 获取旧密码
        $pass = $request->oldpass;

        // 获取当前管理员的id
        $id = session('admin_user')->id;

        // 获取当前用户的信息
        $result = DB::table('admin_users')->where('id',$id)->first();

        // 检测原密码是否正确
        if(!Hash::check($pass,$result->password)){
            return back()->with('error','原密码有误');
        }
        
        // 密码加密
        $res['password'] = Hash::make($request->password);

        $data = DB::table('admin_users')->where('id',$id)->update($res);

        if($data){
            return redirect('/admin/login');
        }else{
            return back();
        }
    }
}
