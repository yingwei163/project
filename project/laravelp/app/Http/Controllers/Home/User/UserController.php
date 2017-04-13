<?php

namespace App\Http\Controllers\Home\User;

use App\Http\Requests\Home\UserLogin;
use App\Http\Requests\Home\UserRegist;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

header('conetnt-type:text/html;charset=utf8');
class UserController extends Controller
{
    private $pwd;
    public function regist(UserRegist $request)
    {
        $this->pwd=Hash::make($request->pwd);
        $user=new UserModel();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$this->pwd;
        $user->save();
        $a='{"bz":1}';
        return  $a;

    }
    public function login(UserLogin $request)
    {
       $re= Auth::attempt(['name'=>$request->input('name'),'password'=>$request->input('pwd')]);
       if ($re){
           $a='{"bz":1}';
       }else{
           $a='{"bz":0}';
       }
        return $a;
    }
    public function loginout()
    {
            Auth::logout();
            return redirect('/index');
    }
        public function myzone()
    {
        return view('home\user\c-index');
    }
    public function addgod()
    {
        return view('home\user\addgod');
    }
    public function addcomic()
    {
        return view('home\user\addcomic');
    }
}
