<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class LinkController extends Controller
{
    /**
     * 友情链接  首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取数据
        $search = $request->input('search','');
        $data = Link::where('lname','like','%'.$search.'%')->orderby('laddtime','desc')->paginate(7);
        
        // 获取 数据 数量
        $num = $data->count();

        // 视图
        return view('admin.link.index',['num'=>$num,'data'=>$data,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 视图
        return view('admin.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证 必填
        $this->validate($request,[
            'lname' => 'required',
            'lurl' => 'required',
        ],[

            'lname.required' => '请填写友情链接名称',
            'lurl.required' => '请填写友情链接地址',
        ]);    

        $link = new Link;
        $link->lname = $request->input('lname','');
        $link->lurl = $request->input('lurl','');
        $link->laddtime = date('Y-m-d H:i:s',time()+8*60*60);                                                    

        // 执行添加
        $res = $link->save();
        if($res){
            return redirect('admin/link')->with('success','添加成功');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 获取 订单 id
        $id = $request->input('id','0');
        // 获取订单状态 并加1
        $status = $request->input('status',0);
        if($status == 0){
            $status = $status+1;
        }else{
            $status = $status-1;
        }
        
        
        $stu = ['status'=>$status];

        // 修改数据
        $res = Link::where('id',$id)->update($stu);

        // 判断
        if($res){
            echo "ok";
        }else{
            echo 'error';
        }
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
        $res = Link::find($id)->delete();
        // 判断
        if($res){
            echo "ok";
        }else{
            echo "error";
        }
    }
}
