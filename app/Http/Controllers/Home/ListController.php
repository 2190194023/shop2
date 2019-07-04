<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Users;
use App\Models\Mycar;
use DB;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 所有品牌页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 获取用户 id
        $uid = session('home_userinfo')['id'];

        // 获取用户的 购物车
        $mycar = Mycar::where('uid',$uid)->get();
        // 获取购物车数量
        $mycarnum = $mycar->count();

        // 获取用户名
        $user = Users::where('id',$uid)->first();

        // 获取 所有栏目名称 50条 一页
        $cate_res = Cates::paginate(50);
        // 视图
        return view('home.list.allcates',['cate_data'=>$cate_data,'cate_res'=>$cate_res,'user'=>$user,'mycarnum'=>$mycarnum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Request $request,$id)
    {

        // 获取本栏目名称
        $cname = Cates::where('id',$id)->first(['cname']);
        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);
        // 获取用户 id
        $uid = session('home_userinfo')['id'];

        // 获取用户的 购物车
        $mycar = Mycar::where('uid',$uid)->get();
        // 获取购物车数量
        $mycarnum = $mycar->count();

        // 获取用户名
        $user = Users::where('id',$uid)->first();

        // 获取 所有 栏目名称 15条
        $cate_res = Cates::paginate(15);
        // 获取 此栏目下商品数据 24条
        if($id == 000){
            $goods_data = Goods::paginate(24);
        }else if($id == 001){
            // 
            $search = $request->input('search','');
            $goods_data = Goods::where('gname','like','%'.$search.'%')->paginate(24);
            $cname->cname = '相似搜索商品';
        }else{
            $goods_data = Goods::where('tid',$id)->paginate(24);
        }
        

        // 视图
        return view('home.list.index',['cate_data'=>$cate_data,'goods_data'=>$goods_data,'cname'=>$cname,'user'=>$user,'cate_res'=>$cate_res,'mycarnum'=>$mycarnum]);
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
    public function destroy($id)
    {
        //
    }
}
