<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slideshow;

class SlideshowController extends Controller
{
    /**
     * 轮播图 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $data = Slideshow::where('title','like','%'.$search.'%')->orderBy('status','desc')->paginate(5);

        // 获取 数据 数量
        $num = $data->count();
        return view('admin.slideshow.index',['data'=>$data,'search'=>$search,'num'=>$num]); 
    }

    /**
     * 修改
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 视图
        return view('admin.slideshow.create');
    }

    /**
     * 执行修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 检测文件上传
        if($request->hasFile('surl')){
            $url = $request->file('surl')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
        }
        $data = new Slideshow;

        // 接受数据
        $data->title = $request->input('title','');
        $data->furl = $request->input('furl','');
        $data->surl = $url;
        $data->status = $request->input('status','');

        $res = $data->save();
        if($res){
            return redirect('admin/slideshow')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * 执行修改
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
     * 修改状态
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $res = Slideshow::where('id',$id)->update($stu);

        // 判断
        if($res){
            echo "ok";
        }else{
            echo 'error';
        }
    }

    /**
     * 执行删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 获取数据
        $id = $request->input('id','');

        // 执行删除
        $res = Slideshow::find($id)->delete();
        // 判断
        if($res){
            echo "ok";
        }else{
            echo "error";
        }
    }
}
