<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\AttachModel;
use App\Model\RolelinkModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachController extends Controller
{
    public function attachlist()
    {
        $attach=AttachModel::paginate(3);
        return view('admin.attach',compact('attach'));
    }
    public function attachadd(Request $request)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'name'=>'required',
                'route'=>'required',
                'routetake'=>'required',
            );
            $mess=array(
                'name.required'=>'权限名不能为空',
                'route.required'=>'路由不能为空',
                'routetake.required'=>'描述不能为空',
            );
            $this->validate($request,$rules,$mess);
            $attach=new AttachModel();
            $attach->name=$request->name;
            $attach->route=$request->route;
            $attach->routetake=$request->routetake;
            $attach->save();
            return redirect('/admin/user/attach_list');
        }
        return view('/admin/attachadd');
    }
    public function attachedit(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'name'=>'required',
                'route'=>'required',
                'routetake'=>'required',
            );
            $mess=array(
                'name.required'=>'权限名不能为空',
                'route.required'=>'路由不能为空',
                'routetake.required'=>'描述不能为空',
            );
            $this->validate($request,$rules,$mess);
            $attach=AttachModel::find($id);
            $attach->name=$request->name;
            $attach->route=$request->route;
            $attach->routetake=$request->routetake;
            $attach->save();
            return redirect('/admin/user/attach_list');
        }
        $attach=AttachModel::find($id);
        return view('/admin/attachedit',compact('attach'));
    }
    public function attachdel($id)
    {
        $attach=AttachModel::find($id);
        $attach->delete();
        $role_link=RolelinkModel::where('aid',$id)->get();
        foreach ($role_link as $v){
            $v->delete();
        }

        return redirect('/admin/user/attach_list');
    }

}
