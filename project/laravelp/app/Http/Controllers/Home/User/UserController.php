<?php

namespace App\Http\Controllers\Home\User;

<<<<<<< HEAD
use App\Model\Home\User\channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('index');
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
        $result=channel::all();
        return view('home\user\addcomic',compact('result',$result));
=======
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
>>>>>>> a834791b12e41dc0acf5b98e6d119d0ad9a2dae6
    }
}
