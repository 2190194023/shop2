<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
    	$link = Link::where('status',1)->get();
    	return view('home.link.index',['link'=>$link]);
    }

    public function create(request $request)
    {
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
            return redirect('/')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }
}
