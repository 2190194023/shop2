<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;

class OrderController extends Controller
{

    // 订单列表
    public function index(Request $request)
    {
    	// 获取数据
        $search = $request->input('search','');
    	$data = Order::where('oid','like','%'.$search.'%')->orderby('id','asc')->paginate(7);
        
    	// 获取 数据 数量
    	$num = $data->count();

    	// 视图
    	return view('admin.order.index',['num'=>$num,'data'=>$data,'search'=>$search]);
    }

    public function destory(Request $request)
    {
    	// 获取数据
    	$id = $request->input('id','');

    	// 执行删除
    	$res = Order::find($id)->delete();
    	// 判断
    	if($res){
    		echo "ok";
    	}else{
    		echo "error";
    	}
    }

    // 订单状态修改
    public function update(Request $request)
    {
    	// 获取 订单 id
    	$id = $request->input('id','');
    	// 获取订单状态 并加1
    	$status = $request->input('status',0);

    	$status = $status+1;
    	$stu = ['ostatus'=>$status];

    	// 修改数据
    	$res = Order::where('id',$id)->update($stu);
    	// 判断
    	if($res){
    		echo "ok";
    	}else{
    		echo "error";
    	}
    }

    // 订单详情
    public function detail($oid)
    {
    	// 获取数据
    	$data = OrderDetail::where('uid',$oid)->first();

    	// 视图
    	return view('admin.order.detail',['data'=>$data]);
    }

}
