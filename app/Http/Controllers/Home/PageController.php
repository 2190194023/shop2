<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Goodsimg;
use App\Models\Discuss;
use App\Models\Users;
use App\Models\Mycar;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
    public function show($id)
    {
        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);

        // 获取商品数据
        $goods = Goods::find($id);
        $gimg = Goodsimg::where('gid',$id)->paginate(7);

        // 获取用户 id
        $uid = session('home_userinfo')['id'];
        // 获取用户的 购物车
        $mycar = Mycar::where('uid',$uid)->get();
        // 获取购物车数量
        $mycarnum = $mycar->count();

        // 获取用户名
        $user = Users::where('id',$uid)->first();

        // 猜你喜欢  本类别下 最新商品
        $goods_data = Goods::where('tid',$goods->tid)->get();

        // 本商品评价
        $discuss_data = Discuss::where('gid',$id)->orderby('addtime','desc')->paginate(20);

        // 商品评价 数量
        $num = $discuss_data->count();
        // 商品详情首页 视图
        return view('home.page.index',['cate_data'=>$cate_data,'num'=>$num,'user'=>$user,'discuss_data'=>$discuss_data,'goods'=>$goods,'gimg'=>$gimg,'goods_data'=>$goods_data,'mycarnum'=>$mycarnum]);
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
