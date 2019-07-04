<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mycar;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Users;
use App\Models\Link;

class MycarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 购物车 主页
    public function index()
    {
        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 获取用户 id
        $uid = session('home_userinfo')['id'];

        // 获取用户名
        $user = Users::where('id',$uid)->first();

        // 获取用户的 购物车 
        $mycar = Mycar::where('uid',$uid)->get();
        // 获取购物车数量
        $mycarnum = $mycar->count();
        
        // 获取全部商品 数量
        $goods = Goods::get();
        $num = $goods->count();

        //查询所有友情链接
        $link = Link::where('status',1)->get();

        // 视图
        return view('home.mycar.index',['cate_data'=>$cate_data,'mycar'=>$mycar,'num'=>$num,'user'=>$user,'mycarnum'=>$mycarnum,'link'=>$link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 执行加入购物车
    public function show(Request $request,$id,$num)
    {

        // 判断 是否登录 
        if(!session('home_userinfo')){
             return redirect('home/login')->with('error','请先登录');
        }else{
            // 获取 商品id 用户id 加入购物车表
            $uid = session('home_userinfo')['id'];;
            $gid = $id;

            $mycar = new Mycar;
            // 压入数据
            $mycar['uid'] = $uid;
            $mycar['gid'] = $gid;
            $mycar['num'] = $num;

            // 执行添加
            $res = $mycar->save();
            //判断
            if($res){
                return redirect('home/mycar')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 获取数据
        $id = $request->input('id','');


        // 执行删除
        $res = Mycar::find($id)->delete();
        // 判断
        if($res){
            echo "ok";
        }else{
            echo "error";
        }
    }
}
