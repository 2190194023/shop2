<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Mail;
use Hash;
use DB;
class RegisterController extends Controller
{
    // 加载注册页面
    public function index()
    {
        // 加载注册页面
        return view('home.register.index');
    }

    // 执行注册 邮箱
    public function insert(Request $request)
    {
        // dump($request->all());

        // 接收数据
        $email = $request->input('email','');
        $password = $request->input('password','');
        $repass = $request->input('repass','');

        // 验证密码
        $this->validate($request, [
            'email' => 'required|email:',
            'password' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:password',
        ],[
            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不正确',

            'repass.required'=>'确认密码必填',
            'repass.same'=>'俩次密码不一致',

            'email.required'=>'邮箱必填',
            'email.email'=>'邮箱格式不正确',
        ]);

        $token = str_random(30);

        $uname = str_random(5);

        // 压入数据库
        $user = new Users;
        $user->uname =  $uname;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->profile = 'touxiang.jpg';
        $user->token = $token;
        $res = $user->save();
        if($res){
            // 发送邮件
            Mail::send('home.register.mail', ['id' => $user->id,'token' => $token], function ($m) use ($email) {
                // to 发送地址 subject 标题
                $s = $m->to($email)->subject('【云购物】提醒邮件！');
                if ($s) {
                     echo "<script>alert('用户注册成功,请尽快完成激活');location.href='/home/login'</script>";
                }
            });
        }
    }

    // 激活用户邮件
    public function changeStatus($id,$token)
    {
        // echo "激活------".$id;
        $user = Users::find($id);
        

        // 验证token
        if ($user->token != $token) {
            echo "<script>alert('链接失效');</script>";
            exit;
        }

        // 激活状态为1
        $user->status = 1;

        $user->token = str_random(30);
        if ($user->save()) {
            echo "<script>alert('激活成功');</script>";
        }else{
            echo "<script>alert('激活失败');</script>";
        }
        
    }

    // 执行注册 手机号
    public function store(Request $request)
    {
        // 验证手机验证码(用户输入)
        $phone = $request->input('phone',0);
         // 接收数据
      
        $password = $request->input('password','');

        // 验证
        $this->validate($request, [
            'phone'=>'required|unique:users',
            'password' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:password',
        ],[
            'phone.required'=>'手机号必填',
            'phone.unique'=>'手机号已存在',
            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不正确',

            'repass.required'=>'确认密码必填',
            'repass.same'=>'俩次密码不一致',
        ]);
        // 获取发送到手机上的验证码
        $k = $phone.'_code';

        $phone_code = session($k);

        // 用户输入的验证码
        $code = $request->input('code',0);

        // 验证逻辑
        if ($phone_code != $code) {
            echo "<script>alert('验证码错误');location.href='/home/register'</script>";
            exit;
        }

        $uname = str_random(5);
        // 压入到数据库
        $data['uname'] = $request->input('uname',$uname);
        $data['phone'] = $request->input('phone','');
        $data['password'] = Hash::make($request->input('password',''));
        $data['status'] = 1;

        $res = DB::table('users')->insert($data);

        if($res){
            return redirect('home/index/login')->with('success','注册成功');
        }else{
           return back()->with('error','注册失败请从新注册');
        }
    }

    // 发送手机号 验证码
    public function sendPhone(Request $request)
    {
        // 接收手机号
        $phone = $request->input('phone');

        $code = rand(1234,4321);

        // 如果存入到redis中,注意键名覆盖
        $k = $phone.'_code';
        // 将接收到的验证码存入session
        session([$k=>$code]);

        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key'   => '22ce272321226f3838ea4ec60810194b', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '169642', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
            'dtype'=>'json'
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        echo $content;
        // $result = json_decode($content, true); 将json格式转化成数组

        // 返回结果
        // if ($result) {
        //     var_dump($result);
        // } else {
        //     //请求异常
        // }


    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juheCurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    } 
}
