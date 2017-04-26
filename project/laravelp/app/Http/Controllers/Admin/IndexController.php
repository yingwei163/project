<?php

namespace App\Http\Controllers\Admin;


use App\Model\PowerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Pow;

class IndexController extends Controller
{
    public function index()
    {
        return view('/admin/index');
    }
    public function login()
    {
        return  view('/admin/login');
    }
    public function loginp(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $rules=array(
                'name'=>'required',
                'password'=>'required',
            );
            $mess=array(
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            );
            $this->validate($request,$rules,$mess);
            $re=PowerModel::where('name',$request->name)->get();
            foreach ($re as $v){
                if (Hash::check($request->password, $v->password)) {
                            session(['name'=>$request->name,'id'=>$v->id]);
                            return redirect('/admin/index');
                }else{
                    return redirect('/admin/login');
                }
            }
            return redirect('/admin/login');
        }
    }
    public function loginout()
    {
        session()->flush();
        return redirect('/admin/login');
    }
}
