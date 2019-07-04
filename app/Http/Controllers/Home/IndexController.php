<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Mycar;
use App\Models\Cates;
use App\Models\Slideshow;
use App\Models\Goods;
use App\Models\Miao;
use App\MOdels\Link;
use App\Models\Guang;
use App\Models\Huodong;
use DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
   	public static function getPidCates($pid = 0)
   	{
   		//查询所有一级分类
   		$data = Cates::where('pid',$pid)->get();
   		//遍历  调用本静态方法 无线查询子分类
   		foreach($data as $k=>$v){
   			$v->sub = self::getPidCates($v->id);
   		}
   		return $data;
   	}
    public function index()
    {
        //所有活动商品
        $huodong = Huodong::get();
        //查询所有商品
         $goodss = Goods::orderBy(DB::raw('RAND()')) 
         ->paginate(18);
         if (!empty(session('home_userinfo'))) {
            $id = session('home_userinfo')->id;
            $user = Users::where('id',$id)->first();
        }else{
            $user = 0;
        }
        // 获取购物车 数量
        $uid = session('home_userinfo')['id'];

        $mycar = Mycar::where('uid',$uid)->get();

        $mycarnum = $mycar->count();

        $cate_data = Cates::where('pid',0)->paginate(9);
        
        //查询轮播图 显示四条
       $slideshow = Slideshow::where('status',1)->paginate(4);
       //按照销售受量 查询五条
       $goods = Goods::orderBy('gtock','desc')->paginate(5);
       //查询广告 显示两条
       $guang = Guang::where('status',1)->paginate(2);
       // 首页秒杀
       $miao = Miao::where('status',1)->paginate(6);
       $miaosha = [];
       foreach($miao as $k=>$v){
        $sha = Goods::where('id',$v->gid)->first();
        $miaosha[] = $sha;
        }
        //查询所有友情链接
        $link = Link::where('status',1)->get();
        return view('home.index.index',['slideshow'=>$slideshow,'goods'=>$goods,'miaosha'=>$miaosha,'miao'=>$miao,'link'=>$link,'guang'=>$guang,'huodong'=>$huodong,'goodss'=>$goodss,'cate_data'=>$cate_data,'user'=>$user,'mycarnum'=>$mycarnum]);
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
