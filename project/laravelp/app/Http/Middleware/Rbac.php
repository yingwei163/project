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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route=Route::current()->uri();
//        dd($route);
        $id=session('id');
        $re=PowerlinkModel::where('uid',$id)->get();
        foreach ($re as $v){
            $rid=$v->rid;
        }
        if (empty($rid)){
            return redirect('/admin/login');
        }
        $re=RolelinkModel::where('rid',$rid)->get();
        foreach ($re as $v){
            $aid[]=$v->aid;
        }
        foreach ($aid as $v){
            $aname[]=AttachModel::where('id',$v)->get();
        }
//        dd($aname);
        foreach ($aname as $av){
//            dd($av);
            foreach ($av as $arv){
                $arout[]=$arv->route;
            }
        }
//        dd($arout);
        if (!in_array($route,$arout)){
           return back();
        }
        return $next($request);
    }
}
