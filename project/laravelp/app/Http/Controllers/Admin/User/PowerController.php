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
    public function powerlist(){
        $powers=PowerModel::paginate(3);
        foreach ($powers as $role)
        {
            $perms=array();
//        dd($role);
            foreach($role->powers as $perm){
//            dd($role->roles);
                $perms[]=$perm->name;
//            dd($perm->name);
            }
            $role->powers =implode(',',$perms);
//           dd($role);
        }
        return view('/admin/power',compact('powers'));
    }
    public function poweredit($id)
    {
        $power=PowerModel::find($id);
        return view('/admin/powedit',compact('power'));
    }
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
                $pwd = Hash::make($request->password);
                $power = new PowerModel();
                $power->name = $request->name;
                $power->password = $pwd;
                $power->save();
                $uid=$power->id;
                foreach ($request->role as  $v) {
                    $powerlink=new PowerlinkModel();
                    $powerlink->uid=$uid;
                    $powerlink->rid=$v;
                    $powerlink->save();
                }
                return redirect('/admin/user/power_list');
            }
        }
        $role=RoleModel::all(['name','id']);
        return view('/admin/powadd',compact('role'));
    }
    public function powerdel($id)
    {
        $role=PowerModel::find($id);
        $role->delete();
        $rolelink=PowerlinkModel::where('uid',$id)->get();
        foreach ($rolelink as $v)
        {
            $v->delete();
        }
        return redirect('/admin/user/power_list');
    }
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
            foreach ($request->role as  $v) {
                $rolelink=new PowerlinkModel();
                $rolelink->uid=$id;
                $rolelink->rid=$v;
                $rolelink->save();
            }
            return redirect('/admin/user/power_list');
        }
        $assign=PowerlinkModel::where('uid',$id)->get();
        foreach ($assign as $v)
        {
            $v->delete();
        }
        $role=RoleModel::all(['name','id']);
        $power=PowerModel::find($id);
        return view('/admin/poweassign',compact('role','power'));
    }

}
