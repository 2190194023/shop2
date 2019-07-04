<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Users;
use App\Models\Address;
use App\Models\Mycar;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash;


class GerenController extends Controller
{
    //
    public function index()
    {

    	$id = session('home_userinfo')['id'];
        
    	// 获取个人信息
    	$user = Users::where('id',$id)->first();

        $mycar = Mycar::where('uid',$id)->get();

        $mycarnum = $mycar->count();

    	// 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

    	return view('home.geren.index',['cate_data'=>$cate_data,'user'=>$user,'mycarnum'=>$mycarnum]);
    }

    // 修改个人信息
    public function edit($id)
    {
    	// 获取数据库信息
        $user = Users::find($id);

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        $mycar = Mycar::where('uid',$id)->get();

        $mycarnum = $mycar->count();

        // 加载修改页面
        return view('home.geren.edit',['cate_data'=>$cate_data,'user'=>$user,'mycarnum'=>$mycarnum]);  
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

        $mycar = Mycar::where('uid',$id)->get();

        $mycarnum = $mycar->count();

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 加载修改页面
        return view('home.geren.pass',['cate_data'=>$cate_data,'user'=>$user,'mycarnum'=>$mycarnum]);  
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

    public function ress($id)
    {

        // 获取数据库信息
        $user = Users::find($id);

        $mycar = Mycar::where('uid',$id)->get();

        // 获取 购物车 数量
        $mycarnum = $mycar->count();

        $ress = DB::table('address')->where('uid',$id)->get();

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 加载修改页面
        return view('home.geren.ress',['cate_data'=>$cate_data,'ress'=>$ress,'user'=>$user,'mycarnum'=>$mycarnum]);
    }

    // 添加地址
    public function ressjia($id)
    {
        // 获取数据库信息
        $user = Users::find($id);

        $ress = DB::table('address')->where('uid',$id)->get();

        $mycar = Mycar::where('uid',$id)->get();

        // 获取 购物车 数量
        $mycarnum = $mycar->count();

        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 加载修改页面
        return view('home.geren.ressjia',['cate_data'=>$cate_data,'ress'=>$ress,'user'=>$user,'mycarnum'=>$mycarnum]);
    }
    // 执行添加地址
    public function doressjia(Request $request)
    {
        $uid = $request->input('id','');
        $province = $request->input('province','');
        $country = $request->input('country','');
        $town = $request->input('town','');

        if(empty($province) || empty($country) || empty($town)){
            return back();
        }

        $data = new Address;

        $data->uid = $uid;
        $data->name = $request->input('name','');
        $data->phone = $request->input('phone','');
        $data->province = $request->input('addr','');
        $data->cont = $province.$country.$town;
        $data->moren = 0;
        $data->bian = $request->input('bian','');

        $res = $data->save();
        if($res){
            echo "<script>alert('添加成功');location.href='/home/geren/ress/$uid'</script>";
        }else{
            return back();
        }
    }
    // 修改地址
    public function show($id)
    {
        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);
       
        // 获取地址数据
        $address = Address::where('id',$id)->first();
        // 获取数据库信息
        $user = Users::where('id',$address->uid)->first();

        $mycar = Mycar::where('uid',$address->uid)->get();

        // 获取 购物车 数量
        $mycarnum = $mycar->count();

        return view('home.geren.moren',['cate_data'=>$cate_data,'user'=>$user,'address'=>$address,'mycarnum'=>$mycarnum]);
    }

    // 执行修改 地址
    public function moren(Request $request)
    {
        // 获取数据
        $id = $request->input('id','');
        $uid = $request->input('uid','');
        $moren = $request->input('moren','');
        $address = Address::where('id',$id)->first();
        // 压入数据
        $address['uid'] = $uid;
        $address['phone'] = $request->input('phone','');
        $address['cont'] = $request->input('cont',$address['cont']);
        $address['province'] = $request->input('province','');
        $address['bian'] = $request->input('bian','');

        // 获取 本用户 所有 地址
        $adrs = Address::where('uid',$uid)->get();
        // 判断  只能有一个默认地址  如果设置  那么其他地址将更改为 普通地址
        if($moren == 1){
            foreach($adrs as $k=>$v){
                DB::table('address')->where('id',$v->id)->update(['moren'=>0]);
            }
        }
        // 压入数据
        $address['moren'] = $moren;
        $res = $address->save();
        if($res){
            echo "<script>alert('修改成功');location.href='/home/geren/ress/$uid'</script>";
        }else{
            return back()->with('error','修改失败');
        }
    }

    // 执行删除 收货地址
    public function destory($id)
    {
        Address::where('id',$id)->delete();

        return back();
    }
}
