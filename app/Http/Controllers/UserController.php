<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\UserModel;

class UserController extends Controller
{
    //

    public function vFindPass()
    {
        $data = [];
        return view('user.findpass',$data);
    }

    public function findPass(Request $request)
    {
        echo '<pre>';print_r($_POST);echo '</pre>';
        $user_name = $request->input('u');
        $u = UserModel::where(['user_name'=>$user_name])
            ->orWhere(['email'=>$user_name])
            ->orWhere(['mobile'=>$user_name])
            ->first();
        //var_dump($u);

        //找到用户 发送重置密码邮件
        if($u){
            echo "用户邮件：". $u->email;

            //生成密码重置连接

        }
    }


    public function vResetpass()
    {
        $data = [];
        return view('user.resetpass');
    }

    public function resetPass(Request $request)
    {
        echo '<pre>';print_r($_POST);echo '</pre>';
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');

        if($pass1 != $pass2){
            die("两次密码不一致");
        }

        $new_pass = password_hash($pass1,PASSWORD_BCRYPT);
        echo $new_pass;

        //更新密码
        UserModel::where([])->update(['pass'=>$new_pass]);
    }
}
