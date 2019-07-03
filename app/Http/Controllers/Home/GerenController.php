<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Users;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash;


class GerenController extends Controller
{
    //
    public function index()
    {
    	$id = session('home_userinfo')->id;
    	// 获取个人信息
    	$user = Users::where('id',$id)->first();

    	// 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

    	return view('home.geren.index',['cate_data'=>$cate_data,'user'=>$user]);
    }

    // 修改个人信息
    public function edit($id)
    {
    	// 获取数据库信息
        $user = Users::find($id);

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 加载修改页面
        return view('home.geren.edit',['cate_data'=>$cate_data,'user'=>$user]);  
    }

    // 执行修改个人信息
    public function update(Request $request,$id)
    {
    	// 获取头像
        if ($request->hasFile('profile')) {
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = 'touxiang.jpg';
        }

        $user = Users::find($id);
        $user->uname = $request->input('uname','');
        $user->phone = $request->input('phone','');
        $user->email = $request->input('email','');
        $user->profile = $file_path;

        $res = $user->save();

        if($res){
        	echo "<script>alert('修改成功');location.href='/home/geren/index'</script>";
        }else{
            echo "<script>alert('修改失败');location.href='home/geren/edit'</script>";
        }
    }

    public function pass($id)
    {
    	// 获取数据库信息
        $user = Users::find($id);

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 加载修改页面
        return view('home.geren.pass',['cate_data'=>$cate_data,'user'=>$user]);  
    }

    // 执行修改密码
    public function dopass(Request $request)
    {
        // 验证密码
        $this->validate($request, [     
                'oldpass' => 'required',
                'password' => 'required|regex:/^\w{5,17}$/',
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
        $id = session('home_userinfo')->id;

        // 获取当前用户的信息
        $result = DB::table('users')->where('id',$id)->first();

        // 检测原密码是否正确
        if(!Hash::check($pass,$result->password)){
        	return back()->with('error','原密码不正确');
        }
        
        // 密码加密
        $res['password'] = Hash::make($request->password);

        $data = DB::table('users')->where('id',$id)->update($res);

        if($data){
        	echo "<script>alert('修改成功');location.href='/home/geren/index'</script>";
        }else{
            return back();
        }
    }
}
