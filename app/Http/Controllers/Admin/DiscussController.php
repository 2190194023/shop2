<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discuss;
use App\Models\Goods;
use App\Models\Users;
use App\Models\Goodsimg;

class DiscussController extends Controller
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
        // 获取 商品名称数据
        $good_data = Goods::find($id);

        $goodname = $good_data->gname;

        // 获取 商品图片数据
        $good_img = Goodsimg::where('gid',$id)->first();

        if(isset($good_img)){
            $goodimg = $good_img->lujing;
        }else{
            $goodimg = '';
        }
        
         
        // 获取评论 数据
        $discuss_data = Discuss::where('gid',$id)->orderBy('addtime','desc')->paginate(12);

        // 获取 数据 数量
        $num = $discuss_data->count();

        // 获取用户名
        $uname = [];
        foreach($discuss_data as $k => $v){
           $temp = Users::where('id',$v->uid)->first(['uname']);
           
           $uname[] = $temp->uname;
        }
              
        // 视图
        return view('admin.discuss.index',['discuss_data'=>$discuss_data,'goodname'=>$goodname,'uname'=>$uname,'goodimg'=>$goodimg,'num'=>$num]);
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
        $res = Discuss::find($id)->delete();
        // 判断
        if($res){
            echo "ok";
        }else{
            echo "error";
        }
    }
}
