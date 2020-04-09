<?php

namespace App\Http\Controllers;

use App\Mail\FindPass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Model\UserModel;
use App\Model\FindpassModel as ps;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //

    public function vFindPass()
    {
        $data = [];
        return view('user.findpass',$data);
    }

    /**
     * 找回密码
     * @param Request $request
     */
    public function findPass(Request $request)
    {
        $user_name = $request->input('u');
        $u = UserModel::where(['user_name'=>$user_name])
            ->orWhere(['email'=>$user_name])
            ->orWhere(['mobile'=>$user_name])
            ->first();

        //找到用户 发送重置密码邮件
        if($u){
            $token = Str::random(32);
            $data = [
                'uid'       => $u->id,
                'token'     => $token,
                'status'    => 0,
                'expire'    => time() + 3600        // 一小时内修改
            ];

            FindpassModel::insertGetId($data);

            //生成密码重置连接
            $data = [
                'url'   => env('APP_URL'). '/resetpass?token='.$token
            ];

            Mail::send('email.findpass',$data,function($message){
                $to = [
                    '165196778@qq.com',
                ];
                $message ->to($to)->subject('密码重置');
            });

            echo "密码重置链接已发送至 " . $u->email;
        }
    }


    /**
     * 重置密码 View
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vResetpass(Request $request)
    {

        //验证token是否有效
        $token = $request->input('token');
        if(empty($token)){
            die("未授权 缺少token");
        }

        $data = [
            'token' => $token
        ];
        return view('user.resetpass',$data);
    }

    /**
     * 重置密码
     * @param Request $request
     */
    public function resetPass(Request $request)
    {

        //echo '<pre>';print_r($_POST);echo '</pre>';
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        $token = $request->input('reset_token');

        if($pass1 != $pass2){
            die("两次密码不一致");
        }

        //验证token 是否已使用 已过期
        $u = FindpassModel::where(['token'=>$token])->orderBy("id","desc")->first();
        if(empty($u)){
            die("未授权 token无效");
        }

        echo '<pre>';print_r($u->toArray());echo '</pre>';
        // token是否过期 ，过期则不能重置密码
        if($u->expire < time() ){
            die("token过期");
        }

        if($u->status==1){
            die("token 已被使用");
        }

        $uid = $u->uid;
        $new_pass = password_hash($pass1,PASSWORD_BCRYPT);
        echo $new_pass;

        //更新密码
        UserModel::where(['id'=>$uid])->update(['pass'=>$new_pass]);

        //设置token状态为 已使用
        FindpassModel::where(['token'=>$token])->update(['status'=>1]);
        echo '<br>';
        echo "密码重置成功";



    }

    public function testMail()
    {

        $data = [
            'url' => env('APP_URL') . '/findpass?token='
        ];

        $rs = Mail::send('email.findpass', $data, function ($message) {
            $to = [
                '165196778@qq.com',
            ];
            $message->to($to)->subject('邮件标题');
        });
        var_dump($rs);

    }
        
        
    /**
     * 注册
     */
    public function reg()
    {
        return view('reg/reg');
    }
    /**
     * 执行注册
     */
    public function regdo()
    {
        $post = request()->except('_token');
        //密码加密
        $pass = password_hash($post['pass'],PASSWORD_BCRYPT);
        $data = [
            'user_name' => $post['user_name'],
            'mobile' => $post['mobile'],
            'email' => $post['email'],
            'pass' => $pass,
        ];
        $res = UserModel::insertGetId($data);
            //发送邮件
        $url = [];
        Mail::send('email.reg', $url, function($message){
            $to = [
                '1807578838@qq.com'
            ];
            $message->to($to)->subject("注册成功");
        });

        echo "<script>alert('注册成功');location.href='login'</script>";
    }

   

    /**
     * 登录视图
     */
    public function login()
    {
        return view('reg/login');
    }

    /**
     * 执行登录
     */
    public function logindo()
    {
        $user_name = request()->input('user_name');
        $pass = request()->input('pass');
        $res = UserModel::where(['mobile'=>$user_name])->orWhere(['email'=>$user_name])->orWhere(['user_name'=>$user_name])->first();
        if($res){
            session(['user_name'=>$res['user_name']]);
            echo "<script>alert('登陆成功 正在跳转...'),location='personal'</script>";
        }else{
            echo "<script>alert('登陆失败'),location='login'</script>";
        }
    }

    /**
     * 个人主页
     */
    public function personal()
    {
        return view('reg.personal');
    }

    /**
     * 修改密码
     */
    public function modify()
    {
        //判断用户是否登录
        if(session()->has('user_name')){
            echo "<h5>已登录</h5>";
        }else{
            echo "<script>alert('您还没有登录'),location='login';</script>";
        }
       
        return view('modify.modify');
    }

    /** 
     * 执行修改
     */
    public function modifydo()
    {
        $post = request()->except('_token');   
        if($post['pass1']!=$post['pass2'])
        {
            echo "<script>alert('两次密码不一致'),location='modify';</script>";
        }
        $pass = $post['pass1'];
        $user_name = session('user_name');
        $id = session('id');
        unset($post['pass2']);
        
        $res = UserModel::where('user_name','=',$user_name)->update(['pass1'=>$pass]);
        
        if($res){
            echo "修改成功 正在跳转至登录页面...";
            header('refresh:2;url=/login');
        } 
    }
    
    
}

