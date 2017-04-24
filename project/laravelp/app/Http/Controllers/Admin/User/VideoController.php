<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\myvideo;
use App\Model\Tovideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function videolist()
    {
        $video=myvideo::paginate(3);
        return view('/admin/video',compact('video'));
    }
    public function videoadd(Request $request)
    {
            if ($request->isMethod('post')){
                if ($request->tovideo==1){
                    $yz=Tovideo::where('tovideo','1')->get();

                    if ($yz->first()){
                        $request->session()->flash('video', '已有最热修改后可继续添加');
                        return back();
                    }
                }
                $rules=array(
                    'videox'=>'required',
                    'videob'=>'required',
                    'image'=>'required',
                    'tovideo'=>'required',
                );
                $mess=array(
                    'videox.required'=>'上传内容不能为空',
                    'videob.required'=>'上传标题不能为空',
                    'image.required'=>'上传视频图片不能为空',
                    'tovideo.required'=>'是否为热图不能为空',
                );
                $this->validate($request,$rules,$mess);
                $id=session('id');
                $name=session(('name'));
                $file=$request->file("videox");
                $img=$request->file("image");
                // 文件是否上传成功
                if($file->isValid()) {
                    // 获取文件相关信息
//                    $fname = $file->getClientOriginalName(); // 文件原名
                    $ext = $file->getClientOriginalExtension();     // 扩展名
                    $img= $img->getClientOriginalExtension();
//                    $realPath = $file->getRealPath();   //临时文件的绝对路径
//                    $type = $file->getClientMimeType();     // image/jpeg
                    $filepath = 'video/'.date('Y/m/d') . '/video/';
                    // 上传文件
                    $filename = md5(time()) . $id . '.' . $ext;
                    $imgname=md5(time().$id) . $id . '.' . $img;
                    $path='video/'.date('Y/m/d') . '/video/'.md5(time()) . $id . '.' . $ext;
                    $imgpath='video/'.date('Y/m/d') . '/video/'.md5(time().$id) . $id . '.' . $img;
                    $video=new myvideo();
                    $video->userid=$id;
                    $video->name=$name;
                    $video->videox=$path;
                    $video->videob=$request->videob;
                    $video->videot=date('Y-m-d H:i:s');
                    $video->image=$imgpath;
                    $video->save();
                    $videoid=$video->id;
                    $tovideo=new Tovideo();
                    $tovideo->videoid=$videoid;
                    $tovideo->videob=$request->videob;
                    $tovideo->name=$name;
                    $tovideo->images=$imgpath;
                    $tovideo->tovideo=$request->tovideo;
                    $tovideo->save();
                    // 使用我们新建的uploads本地存储空间（目录）
                    $request->videox->move($filepath, $filename);
                    $request->image->move($filepath,$imgname);
                    return redirect('/admin/user/video_list');
                }
            }
            return view('/admin/videoadd');
    }
    public function videodel($id)
    {
        $re=myvideo::find($id);
        $video=$re->videox;
        $image=$re->image;
        $re->delete();
        $link=Tovideo::find($id);
        $link->delete();
        unlink($video);
        unlink($image);
        return redirect('/admin/user/video_list');
    }
    public function videoedit(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'tovideo'=>'required',
            );
            $mess=array(
                'tovideo.required'=>'是否为热图不能为空',
            );
            $this->validate($request,$rules,$mess);
            $re=Tovideo::find($id);
            $re->tovideo=$request->tovideo;
            $re->save();
            return redirect('/admin/user/video_list');
        }
        DB::update('update invideo set tovideo= 0 ');
        $re=Tovideo::find($id);
        return view('/admin/videoedit',compact('re'));
    }

}
