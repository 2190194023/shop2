<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mycar;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\Discuss;
use App\Models\Users;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $arr = array(
            'uid' => $uid,
            'moren' => 1,
        );
        // 获取收货地址
        $address = Address::where($arr)->first();

        if(!$address){
            $ars = Address::where('uid',$uid)->get();
            if(!$ars){
                echo "<script>alert('请添加地址');location.href='/home/geren/ress/$uid'</script>";
            }else{
                echo "<script>alert('请添加默认地址');location.href='/home/geren/ress/$uid'</script>";
            }
        }
        // 将获取到的数据添加入订单
        $order = new Order;
        // 将获取到的数据添加入 订单详情
        $odetail = new OrderDetail;
            foreach($mycar as $k=>$v){
                // 将获取到的数据添加入订单
                $order = new Order;
                // 将获取到的数据添加入 订单详情
                $odetail = new OrderDetail;
                // 订单号
                $oid = date('mdHis',time()).rand(0,10000);
                // 快递单号
                $kdd = date('mdHi',time()).rand(0,10000);
                // 获取商品价格
                $goods = Goods::where('id',$v->gid)->first();
                // 获取 商品总价格
                $gnum = $v->num * $goods->gprice;

                // 压入数据 到 订单表
                $order->oid = $oid;
                $order->uid = $v->uid;
                $order->oname = $address->name;
                $order->oaddress = $address->province;
                $order->ophone = $address->phone;
                $order->onum = $v->num;
                $order->oaddtime = date('Y-m-d H:i:s',time());
                $order->ototal = $gnum;
                $order->good = $v->gid;
                $order->kdd = $kdd;

                // 执行添加
                $order->save();


                // 压入数据 到 订单详情
                $odetail->uid = $v->uid;
                $odetail->oid = $oid;
                $odetail->money = $v->gid;
                $odetail->qian = $goods->gprice;
                $odetail->hou = $gnum;
                $odetail->otime = date('Y-m-d H:i:s',time());
                // 执行添加
                $odetail->save();

                Mycar::where('id',$v->id)->delete();
        }
        

        // 查询订单
        $order_data = Order::where('uid',$uid)->paginate(20);


        // 订单页 视图
        return view('home.order.index',['cate_data'=>$cate_data,'order_data'=>$order_data,'user'=>$user,'mycarnum'=>$mycarnum]);
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
    // 添加商品评论
    public function show(Request $request,$id)
    {
        // 判断
        if(empty($request->input('content',''))){
            return back()->with('error','请填写评论');
        }
        // 获取用户信息
        $order = Order::where('id',$id)->first();


        $discuss = new Discuss;

        // 压入数据
        $discuss->uid = $order->uid;
        $discuss->gid = $order->good;
        $discuss->content = $request->input('content','');
        $discuss->addtime = date('Y-m-d H:i:s',time());
        $discuss->otime = $order->oaddtime;

        $res = $discuss->save();
        if($res){
            return redirect('home/order')->with('success','请填写评论');
        }else{
            return back()->with('error','请填写评论');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 商品评论
    public function edit($id)
    {   
        // 获取商品信息
        $order = Order::where('id',$id)->first();

        $goods = Goods::where('id',$order->good)->first();
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

        // 视图 跳转 评论商品页
        return view('home.order.discuss',['cate_data'=>$cate_data,'goods'=>$goods,'user'=>$user,'order'=>$order,'mycarnum'=>$mycarnum]);
    }

    // 订单详情页
    public function detail($id)
    {
        // 列表页 
        $cate_data = Cates::where('pid',0)->paginate(7);
        // 获取订单详情数据 根据订单号查询
        $detail = OrderDetail::where('oid',$id)->first();

        // 获取订单状态
        $order = Order::where('oid',$id)->first();

        // 获取用户信息
        $uname = Users::where('id',$detail->uid)->first(['uname']);

        // 获取用户 id
        $uid = session('home_userinfo')['id'];

        // 获取用户的 购物车
        $mycar = Mycar::where('uid',$uid)->get();
        // 获取购物车数量
        $mycarnum = $mycar->count();

        // 获取用户名
        $user = Users::where('id',$uid)->first();

        // 获取商品信息
        $goods = Goods::where('id',$detail->money)->first();

        return view('home.order.detail',['cate_data'=>$cate_data,'user'=>$user,'detail'=>$detail,'uname'=>$uname,'goods'=>$goods,'order'=>$order,'mycarnum'=>$mycarnum]);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 修改 订单状态
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 获取数据
        $order = Order::where('id',$id)->first();
        OrderDetail::where('oid',$order->oid)->delete();

        // 执行删除
        $res = Order::find($id)->delete();
        // 判断
        if($res){
            return back()->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
