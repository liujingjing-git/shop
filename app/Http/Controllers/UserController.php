<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
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
        password_hash("pass", PASSWORD_BCRYPT);
        
        $res = UserModel::create($post);
        if($res)
        {
            echo "<script>alert('注册成功');location.href='login'</script>";
        }else{
            echo "<script>alert('注册失败');location.href='reg'</script>";
        }
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
        $post = request()->except('_token');
        $where[] = [
            'user_name', '=' , $post['user_name'],
        ];
        $res = UserModel::where($where)->first();
        if($res['user_name']!==$post['user_name']){
            echo "<script>alert('该用户不存在'),location='login'</script>";
        }
        if($res['pass']!==$post['pass']){
            echo "<script>alert('密码有误 确认后再试'),location='login'</script>";
        }

        if($res){
            session(['user_name'=>$res['user_name']]);
            echo "<script>alert('登陆成功'),location=''</script>";
        }else{
            echo "<script>alert('登陆失败'),location='login'</script>";
        }
    }

    /**
     * 判断用户是否登录
     */
    public function pan()
    {
        //测试session是否有值
        if(session()->has('user_name')){
            echo 1;
        }else{
            echo 2;
        }
    }
}
