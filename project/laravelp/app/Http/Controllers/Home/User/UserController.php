<?php

namespace App\Http\Controllers\Home\User;

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
    }
}
