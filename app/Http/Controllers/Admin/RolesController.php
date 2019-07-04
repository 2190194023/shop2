<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use DB;

class RolesController extends Controller
{
    public static function conall()
    {
        return [
            'IndexController'=>'首页',
            'LoginController'=>'修改头像',
            'AdminuserController'=>'管理员管理',
            'UsersController'=>'用户管理',
            'RolesController'=>'角色管理',
            'NodesController'=>'权限管理',
            'CatesController'=>'分类管理',
            'SlideshowController'=>'轮播图管理',
            'GoodsController'=>'商品管理',
            'DiscussController'=>'商品评论管理',
            'GoodsimgController'=>'商品图片管理',
            'MiaoController'=>'商品秒杀管理',
            'HuodongController'=>'商品活动管理',
            'OrderController'=>'商品订单管理',
            'LinkController'=>'友情链接管理',
            'GuangController'=>'广告管理',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_uname = $request->input('search_uname','');
        // 显示角色
        $roles_data = DB::table('roles')->where('rname','like','%'.$search_uname.'%')->paginate(5);

        // 加载视图
        return view('admin.roles.index',['roles_data'=>$roles_data,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // 获取所有数据
        $nodes_data = DB::table('nodes')->get();

        $list = [];
        foreach ($nodes_data as $k => $v) {
            $temp['id'] = $v->id;
            $temp['aname'] = $v->aname;
            $temp['desc'] = $v->desc;
            $list[$v->cname][] = $temp;
        }

        // 加载视图
        return view('admin.roles.create',['list'=>$list,'conall'=>self::conall()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        $rname = $request->input('rname','');
        $nids = $request->input('nids','');

        // 添加角色表
        $rid = DB::table('roles')->insertGetId(['rname'=>$rname]);
        // 添加角色关系表
        foreach ($nids as $k => $v) {
            $res = DB::table('roles_nodes')->insert(['rid'=>$rid,'nid'=>$v]);
        }

        if ($rid) {
            return redirect('admin/roles')->with('success','添加成功');
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

        $roles = Role::find($id);

        $nodes = DB::table('nodes')->get();

        $roles_nodes = DB::table('roles_nodes')->get();
        $roles_dd = DB::table('roles_nodes')->where('rid',$id)->get();

        $temp = [];
        foreach($roles_dd as $k=>$v){
            $temp[] = $roles_dd[$k]->nid;
        }
        $list = [];
        foreach ($nodes as $k => $v) {
            $tamp['id'] = $v->id;
            $tamp['aname'] = $v->aname;
            $tamp['desc'] = $v->desc;
            $list[$v->cname][] = $tamp;
        }

        return view('admin.roles.edit',['roles'=>$roles,'list'=>$list,'conall'=>self::conall(),'temp'=>$temp]);

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


        $rname = $request->input('rname','');
        $nids = $request->input('nids','');

        // 删除旧数据
        $data = DB::table('roles_nodes')->where('rid',$id)->delete();

        foreach($nids as $k=>$v){
            // 添加新数据
            $res = DB::table('roles_nodes')->insert(['rid'=>$id,'nid'=>$v]);
        }

        // 判断逻辑
        if($res){
            return redirect('admin/roles')->with('success','修改成功');
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

        $res = Role::destroy($id);

        if($res){
            return redirect('admin/roles')->with('success','删除成功');
        }else{

            return back()->with('error','删除失败');
        }

    }
}
