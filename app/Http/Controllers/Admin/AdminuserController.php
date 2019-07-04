<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmin;
use App\Models\Adminuser;
use App\Models\Role;
use Hash;
use DB;
use Illuminate\Support\Facades\Storage;


class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索的参数
        $search_uname = $request->input('search_uname','');
        $search_email = $request->input('search_email','');

        $adminuser = Adminuser::where('uname','like','%'.$search_uname.'%')->where('email','like','%'.$search_email.'%')->paginate(5);

        // 加载用户列表页
        return view('admin.adminuser.index',['adminuser'=>$adminuser,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取所有角色
        $roles_data = DB::table('roles')->get();

        // 显示用户添加页面
        return view('admin.adminuser.create',['roles_data'=>$roles_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmin $request)
    { 
        $uname = $request->input('uname','');
        $password = $request->input('password','');
        $repass = $request->input('repass','');
        $phone = $request->input('phone','');
        $email = $request->input('email','');
        $rid = $request->input('rid','');


        // 上传头像
        if($request->hasFile('profile')){
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }

        $temp['uname'] = $uname;
        $temp['password'] = Hash::make($password);
        $temp['phone'] = $phone;
        $temp['email'] = $email;
        $temp['profile'] = $file_path;
        $temp['created_at'] = date('Y-m-d H:i:s',time());

        $uid = DB::table('admin_users')->insertGetId($temp);

        $res = DB::table('adminusers_roles')->insert(['uid'=>$uid,'rid'=>$rid]);

        if($uid && $res){
            return redirect('admin/adminuser')->with('success','添加成功');
        }else{

            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取数据库信息
        $adminuser = Adminuser::find($id);

        // 获取所有角色
        $roles_data = DB::table('roles')->get();

        $adminrol = DB::table('adminusers_roles')->where('uid',$id)->first();
        // 加载修改页面
        return view('admin.adminuser.edit',['adminuser'=>$adminuser,'roles_data'=>$roles_data,'adminrol'=>$adminrol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rid = $request->input('rid','');

        $adminuser = Adminuser::find($id);
        $adminuser->phone = $request->input('phone','');
        $adminuser->email = $request->input('email','');

        $uid = $adminuser->save();
        $res = DB::table('adminusers_roles')->update(['uid'=>$uid,'rid'=>$rid]);

        if($uid && $res){
            return redirect('admin/adminuser')->with('success','修改成功');
        }else{

            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Adminuser::destroy($id);

        // 删除头像
        Storage::delete('file.jpg');

        if($res){
            return redirect('admin/adminuser')->with('success','删除成功');
        }else{

            return back()->with('error','删除失败');
        }
    }
}
