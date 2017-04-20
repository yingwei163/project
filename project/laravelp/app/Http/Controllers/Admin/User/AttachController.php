<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\AttachModel;
use App\Model\RolelinkModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachController extends Controller
{
    /**
     * 方法名  attachlist
     * 路由名  /admin/user/attach_list
     * 作用值  分页输出数据库中查询的权限值
     * 返回值  到页面数据
     */
    public function attachlist()
    {
        //分页显示结果
        $attach=AttachModel::paginate(3);
        return view('admin.attach',compact('attach'));
    }
    /**
     * 方法名  attachadd
     * 路由名  /admin/user/attach_add     any
     * 作用值  新增权限属性
     * 返回值  get进入/admin/attachadd视图  post过逻辑后重定向权限列表视图
     */
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
            //通过验证后添加数据
            $attach=new AttachModel();
            $attach->name=$request->name;
            $attach->route=$request->route;
            $attach->routetake=$request->routetake;
            $attach->save();
            return redirect('/admin/user/attach_list');
        }
        return view('/admin/attachadd');
    }
    /**
     * 方法名  attachedit
     * 路由名  /admin/user/attach_edit/{id}    any
     * 作用值  修改权限属性
     * 返回值  get进入/admin/attachedit视图  post过逻辑后重定向权限列表视图
     */
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
            //通过验证后修改数据
            $attach=AttachModel::find($id);
            $attach->name=$request->name;
            $attach->route=$request->route;
            $attach->routetake=$request->routetake;
            $attach->save();
            return redirect('/admin/user/attach_list');
        }
        //get查找当前ID数据放入页面
        $attach=AttachModel::find($id);
        return view('/admin/attachedit',compact('attach'));
    }
    /**
     * 方法名  attachdel
     * 路由名  /admin/user/attach_del/{id}    get
     * 作用值  删除权限属性
     * 返回值  get过逻辑后重定向权限列表视图
     */
    public function attachdel($id)
    {
        //查找当前ID的数据删除
        $attach=AttachModel::find($id);
        $attach->delete();
        //查找当前关系表中有次权限的关系删除
        $role_link=RolelinkModel::where('aid',$id)->get();
        foreach ($role_link as $v){
            $v->delete();
        }

        return redirect('/admin/user/attach_list');
    }

}
