<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\sort;
use App\Model\myvideo;
use App\Model\Tovideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SortController extends Controller
{
        public function video()
    {
        $hotvideo=Tovideo::where('tovideo'  ,'1')->get();
        $re = DB::select('select * from invideo where tovideo = 0 limit 0,4 ');
        $all=Tovideo::all();
        return view('/home/user/video',compact('hotvideo','re','all'));
    }
    public function videoshow($id)
    {
        $re=myvideo::find($id);
        return view('/home/user/videoshow',compact('re'));
    }
    public function videoload($id)
    {
        $re=myvideo::find($id);
        $filepath=url($re->videox);
        $filename='敢问路在何方？.mp4';
        header('content-Disposition:attachment; filename="'.$filename.'"');
        readfile($filepath);
        return back();
    }
    public function index()
    {

        $sort=sort::paginate(2);
//        dd($sort);
        return view('/admin/sort',compact('sort'));
    }
    public function add()
    {
        return view('/admin/sortadd');
    }
    public function addd(Request $request)
    {
        $a=$request->route;
        $b=$request->name;
        $c=new sort();
        $c->name=$a;
        $c->url=$b;
        $c->save();
        return redirect('/admin/user/sort_list');
    }
    public function edit(Request $request,$id){

        if ($request->isMethod('post')){
            $user=sort::find($id);
            $user->name=$request->route;
            $user->url=$request->name;
            $user->save();
            return redirect('/admin/user/sort_list');
        }
        $re=sort::find($id);
        return view('/admin/sortedit',compact('re'));
    }

    public function del(Request $request){
        $id=$request->id;
        $a=sort::where('id',$id)->delete();
        return redirect('/admin/user/sort_list');

    }
}
