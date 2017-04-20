<?php

namespace App\Http\Middleware;

use App\Model\AttachModel;
use App\Model\PowerlinkModel;
use App\Model\PowerModel;
use App\Model\RolelinkModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Rbac
{
    /**
     * Handle an incoming request.管理员权限认证
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //调用Route模块获取到当前的路由名
        $route=Route::current()->uri();
        //获取到当前登录的ID
        $id=session('id');
        //在管理员与角色关系表中查到当前管理员拥有多少角色
        $re=PowerlinkModel::where('uid',$id)->get();
        foreach ($re as $v){
            $rid[]=$v->rid;
        }
        //判断当前管理员有没有角色信息没有就返回登录换号
        if (empty($rid)){
            return redirect('/admin/login');
        }
        //遍历当前管理员的角色 获取当前角色相对的权限关系表数据
       foreach ($rid as $vrid){
        $rre[]=RolelinkModel::where('rid',$vrid)->get();
        }
        //遍历查询结果 取出关系表中的关联权限ID
        foreach ($rre as $vs){
            foreach ($vs as $vvs){
                $aid[]=$vvs->aid;
            }
         }
        //通过权限ID查询每个权限ID的路由名称
        foreach ($aid as $v){
            $aname[]=AttachModel::where('id',$v)->get();
        }
        //遍历查询出的值取出当前角色ID 拥有的全部权限路由存到数组中
        foreach ($aname as $av){
            foreach ($av as $arv){
                $arout[]=$arv->route;
            }
        }
        //用当前的路径匹配 存到数组中的权限路由 不成功就返回上一次操作网页
        if (!in_array($route,$arout)){
           return back();
        }
        return $next($request);
    }
}
