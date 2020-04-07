<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function password()
    {
        return view('password.password');
    }
    public function update(ChangePasswordRequest $request)
    {
        if (\Hash::check($request->get('old_password'),user()->password)){
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('密码修改成功','success');
            return back();
        }
        flash('原始密码输入错误，密码修改失败！','danger');
        return back();
    }

}
