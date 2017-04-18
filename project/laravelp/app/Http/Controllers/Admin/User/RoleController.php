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
   public function rolelist()
   {
       $roles=RoleModel::paginate(3);

       foreach ($roles as $role)
       {
        $perms=array();
//        dd($role);
        foreach($role->roles as $perm){
//            dd($role->roles);
            $perms[]=$perm->name;
//            dd($perm->name);
        }
        $role->roles=implode(',',$perms);
//           dd($role);
       }
       return view('admin.role',compact('roles'));
   }
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
//            dd($request->all());
            $role=RoleModel::find($id);
            $role->name=$request->name;
            $role->roletake=$request->roletake;
            $role->save();
            return redirect('/admin/user/role_list');
        }
        $role=RoleModel::find($id);
        return view('/admin/roleedit',compact('role'));
    }
    public function roledel($id)
    {
        $role=RoleModel::find($id);
        $role->delete();
        $rolelink=RolelinkModel::where('rid',$id)->get();
        foreach ($rolelink as $v)
        {
            $v->delete();
        }

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
          $role=new RoleModel();
            $role->name=$request->name;
           $role->roletake=$request->roletake;
          $role->save();
          $rid=$role->id;
            foreach ($request->attach as  $v) {
                $rolelink=new RolelinkModel();
                $rolelink->rid=$rid;
                $rolelink->aid=$v;
                $rolelink->save();
            }

           return redirect('/admin/user/role_list');
        }
        $attach=AttachModel::all(['name','id']);
        return view('/admin/roleadd',compact('attach'));
    }
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
            foreach ($request->attach as  $v) {
                $rolelink=new RolelinkModel();
                $rolelink->rid=$id;
                $rolelink->aid=$v;
                $rolelink->save();
            }
            return redirect('/admin/user/role_list');
        }
        $assign=RolelinkModel::where('rid',$id)->get();
        foreach ($assign as $v)
        {
            $v->delete();
        }
        $attach=AttachModel::all(['name','id']);
        $role=RoleModel::find($id);
        return view('/admin/roleassign',compact('attach','role'));
    }


}
