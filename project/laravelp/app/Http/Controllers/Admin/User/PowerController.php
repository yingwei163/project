<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\InforModel;
use App\Model\PowerlinkModel;
use App\Model\RoleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PowerModel;
use Illuminate\Support\Facades\Hash;

class PowerController extends Controller
{
    /**
     * 方法名  powerlist
     * 路由名  /admin/user/power_list  get
     * 作用值  分页显示当前管理员的所有角色
     * 返回值  传值进入/admin/power视图
     */
    public function powerlist(){
        //分页3条数据
        $powers=PowerModel::paginate(3);
        //用多对多模型直接查询当前管理员对应的管理员角色关系表里的 角色名称
        foreach ($powers as $role)
        {
            $perms=array();
            foreach($role->powers as $perm){
                $perms[]=$perm->name;
            }
            $role->powers =implode(',',$perms);
        }
        return view('/admin/power',compact('powers'));
    }
    /**
     * 方法名  poweredit
     * 路由名  /admin/user/power_edit/{id}  get
     * 作用值  在/admin/powedit视图中遍历当前管理员属性
     * 返回值  /admin/powedit视图
     */
    public function poweredit($id)
    {
        $power=PowerModel::find($id);
        return view('/admin/powedit',compact('power'));
    }
    /**
     * 方法名  powereditp
     * 路由名  /admin/user/power_editp  post
     * 作用值  修改当前管理员的信息
     * 返回值  重定向到列表页
     */
    public function powereditp(Request $request)
    {
        $rules = array(
            'name' => 'required',
        );
        $mess = array(
            'name.required' => '管理员名不能为空',
        );
        $this->validate($request, $rules, $mess);
        $power=PowerModel::find($request->id);
        $power->name=$request->name;
        $power->save();
        return redirect('/admin/user/power_list');
    }
    /**
     * 方法名  poweradd
     * 路由名  /admin/user/power_add  any
     * 作用值  添加一个有角色的管理员
     * 返回值  get/admin/powadd视图 post重定向列表页
     */
    public function poweradd(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'name' => 'required',
                'password' => 'required',
                'role' => 'required',
            );
            $mess = array(
                'name.required' => '角色名名不能为空',
                'password.required' => '密码不能为空',
                'role.required'=>'角色不能为空',
            );
            $this->validate($request, $rules, $mess);
            if ($request->isMethod('post')) {
                //吧接收到信息存入管理员表中
                $pwd = Hash::make($request->password);
                $power = new PowerModel();
                $power->name = $request->name;
                $power->password = $pwd;
                $power->save();
                $uid=$power->id;
                //遍历所有选择的角色ID和新增管理员ID一起存入管理员与角色关系表中
                foreach ($request->role as  $v) {
                    $powerlink=new PowerlinkModel();
                    $powerlink->uid=$uid;
                    $powerlink->rid=$v;
                    $powerlink->save();
                }
                return redirect('/admin/user/power_list');
            }
        }
        //get进入提交当前的所有角色名和角色ID
        $role=RoleModel::all(['name','id']);
        return view('/admin/powadd',compact('role'));
    }
    /**
     * 方法名  powerdel
     * 路由名  /admin/user/power_del/{id}  any
     * 作用值  删除一个管理员
     * 返回值  列表页
     */
    public function powerdel($id)
    {
        //根据当前管理员ID删除管理员表数据和管理员角色关系表数据
        $role=PowerModel::find($id);
        $role->delete();
        $rolelink=PowerlinkModel::where('uid',$id)->get();
        foreach ($rolelink as $v)
        {
            $v->delete();
        }
        return redirect('/admin/user/power_list');
    }
    /**
     * 方法名  powerassign
     * 路由名  /admin/user/power_assign/{id}  any
     * 作用值  给管理员重新分配角色
     * 返回值  get分配页 post列表页
     */
    public function powerassign(Request $request,$id)
    {
        $name=session('name');
        if ($name=='超级管理员'){
            return redirect('/admin/user/power_list');
        }
        if ($request->isMethod('post')){
            $rules=array(
                'role'=>'required',
            );
            $mess=array(
                'role.required'=>'权限不能为空',
            );
            $this->validate($request,$rules,$mess);
            //遍历选择的角色ID数据存入管理员与角色关系表中
            foreach ($request->role as  $v) {
                $rolelink=new PowerlinkModel();
                $rolelink->uid=$id;
                $rolelink->rid=$v;
                $rolelink->save();
            }
            return redirect('/admin/user/power_list');
        }
        //先删除管理员与角色表中与该管理员有关系的数据
        $assign=PowerlinkModel::where('uid',$id)->get();
        foreach ($assign as $v)
        {
            $v->delete();
        }
        //传入所有角色的名字和ID
        $role=RoleModel::all(['name','id']);
        $power=PowerModel::find($id);
        return view('/admin/poweassign',compact('role','power'));
    }

}
