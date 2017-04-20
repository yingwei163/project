<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\AttachModel;
use App\Model\PowerlinkModel;
use App\Model\RolelinkModel;
use App\Model\RoleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Rolecontroller extends Controller
{
    /**
     * 方法名  rolelist
     * 路由名  /admin/user/role_list    get
     * 作用值  显示出角色属性和角色拥有的权限
     * 返回值  把取出的值传入/admin/role视图
     */
   public function rolelist()
   {
       //分页显示每页的数据
       $roles=RoleModel::paginate(3);

       foreach ($roles as $role)
       {
        $perms=array();
           //使用多对多中间表查询模式 自定义在模块中
           // 调用时自动用指定字段匹配中间表中的权限表ID获得权限名存入数组
        foreach($role->roles as $perm){
            $perms[]=$perm->name;
        }
        //用，分割存入的数组
        $role->roles=implode(',',$perms);
       }
       //结果会把数据存入roles中 调用时在页面中遍历出$roles->roles 属性
       return view('admin.role',compact('roles'));
   }
    /**
     * 方法名  roleedit
     * 路由名  /admin/user/role_edit/{id}   any
     * 作用值  修改当前角色的属性
     * 返回值  get进入/admin/roleedit视图传入角色属性  post判断后重定向到角色列表
     */
    public function roleedit(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'name'=>'required',
                'roletake'=>'required',
            );
            $mess=array(
                'name.required'=>'角色名不能为空',
                'roletake.required'=>'角色描述不能为空',
            );
            $this->validate($request,$rules,$mess);
            //查找当前ID的数据属性 进行修改
            $role=RoleModel::find($id);
            $role->name=$request->name;
            $role->roletake=$request->roletake;
            $role->save();
            return redirect('/admin/user/role_list');
        }
        $role=RoleModel::find($id);
        return view('/admin/roleedit',compact('role'));
    }
    /**
     * 方法名  roleedel
     * 路由名  /admin/user/role_del/{id}   any
     * 作用值  修改当前角色的属性
     * 返回值  get进入获取当前角色的数据删除
     *         角色与管理员关系表中的角色ID
     *         角色与权限关系表中的角色ID
     */
    public function roledel($id)
    {
        //查找当前角色表中的id删除
        $role=RoleModel::find($id);
        $role->delete();
        //查到角色与权限关系表中的角色ID 删除该条数据
        $rolelink=RolelinkModel::where('rid',$id)->get();
        foreach ($rolelink as $v)
        {
            $v->delete();
        }
        //查到角色与管理员关系表中的角色ID 删除该条数据
        $rolelink=PowerlinkModel::where('rid',$id)->get();
        foreach ($rolelink as $rv)
        {
            $rv->delete();
        }
        return redirect('/admin/user/role_list');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    /**
     * 方法名  roleadd
     * 路由名  /admin/user/role_add  any
     * 作用值  添加一个新角色
     * 返回值  get进入/admin/roleadd视图并传入权限的ID和名字  post判断后重定向到角色列表
     */
    public function roleadd(Request $request)
    {
        if ($request->isMethod('post')){
          $rules=array(
              'name'=>'required',
              'roletake'=>'required',
              'attach'=>'required',
            );
          $mess=array(
               'name.required'=>'角色名名不能为空',
              'roletake.required'=>'描述不能为空',
              'attach.required'=>'权限不能为空',
           );
            $this->validate($request,$rules,$mess);
            //把角色名和角色描述直接存入角色表中
          $role=new RoleModel();
            $role->name=$request->name;
           $role->roletake=$request->roletake;
          $role->save();
          $rid=$role->id;
            //然后循环遍历传入的权限ID 把当前新增的ID和选择的权限ID一起存入角色与权限关系表
            foreach ($request->attach as  $v) {
                $rolelink=new RolelinkModel();
                $rolelink->rid=$rid;
                $rolelink->aid=$v;
                $rolelink->save();
            }

           return redirect('/admin/user/role_list');
        }
        //传入权限表的所有权限名称和ID
        $attach=AttachModel::all(['name','id']);
        return view('/admin/roleadd',compact('attach'));
    }
    /**
     * 方法名  roleassign
     * 路由名  /admin/user/role_assing/{id}  any
     * 作用值  修改当前用户的权限
     * 返回值  get进入/admin/roleassign视图并传入权限的ID和名字  post判断后重定向到角色列表
     */
    public function roleassign(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'attach'=>'required',
            );
            $mess=array(
                'attach.required'=>'权限不能为空',
            );
            $this->validate($request,$rules,$mess);
            //遍历用户选择的权限，然后把权限存入角色权限中间表
            foreach ($request->attach as  $v) {
                $rolelink=new RolelinkModel();
                $rolelink->rid=$id;
                $rolelink->aid=$v;
                $rolelink->save();
            }
            return redirect('/admin/user/role_list');
        }
        //get传入先查询关系表中所有有关该角色的权限信息删除
        $assign=RolelinkModel::where('rid',$id)->get();
        foreach ($assign as $v)
        {
            $v->delete();
        }
        //传入全部权限名和ID
        $attach=AttachModel::all(['name','id']);
        //传入当前角色信息
        $role=RoleModel::find($id);
        return view('/admin/roleassign',compact('attach','role'));
    }


}
