<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class LoginController extends Controller
{
    /**
     * 显示登陆的页面
     */
    public function login()
    {
        return view('admin.login.login');
    }

    /**
     * 执行登陆操作
     */
    public function dologin(Request $request)
    {

        //实例化用户对象
        $user = User::where('username', $request->username)->firstOrFail();
//        dd($user);
        //获取用户信息
        if(Hash::check($request->password, $user->password)) {
//            dd(22);
            //写入登陆状态
            session(['uid'=>$user->id]);
            return redirect('/admin');
        }else{
            return back();
        }
    }

    /**
     * 登出
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }



}
