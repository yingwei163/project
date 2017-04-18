<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    //进去后台主页
    public function index()
    {
        return view('admin\user\index');
    }
    //后台登录页面
    public function login()
    {
        return view('admin\user\login');
    }
    //保存用户信息
    public function seteing(AdminLogin $request)
    {
        dd($request->all());
    }
}
