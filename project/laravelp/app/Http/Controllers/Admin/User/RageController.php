<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\AddComic;
use App\Model\Addimg;
use App\Model\Home\bimgtalk;
use App\Model\Home\hots;
use App\Model\Home\imgtalk;
use App\Model\Home\Mytxt;
use App\Model\Home\publish;
use App\Model\myvideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RageController extends Controller
{
    //暴漫审核页面
    public function bimg()
    {
        $result=AddComic::paginate(3);

        return view('/admin/bimg',compact('result'));
    }


 //暴漫的通过审核
    public function bimgtrue($id){
       $bimg=AddComic::find($id);
       if($bimg->auditto==1){
           return 2;
       }
       $bimg->auditto=1;
       $result=$bimg->save();
       if($result){
           return json_encode(1);
       }else{
           return json_encode(0);
       }

    }
//  暴漫的审核删除
    public function bimgfalse($id){
        $bimg=AddComic::where('id',$id)->delete();
        return json_encode($bimg);

    }
//趣图审核
    public function img()
    {
        $result=Addimg::paginate(3);

        return view('/admin/img',compact('result'));
    }
    //暴漫的通过审核
    public function imgtrue($id){
        $img=Addimg::find($id);
        if($img->auditto==1){
            return 2;
        }
        $img->auditto=1;
        $result=$img->save();
        if($result){
            return json_encode(1);
        }else{
            return json_encode(0);
        }

    }
//  暴漫的审核删除
    public function imgfalse($id){
        $img=Addimg::where('id',$id)->delete();
        return json_encode($img);

    }
//   热门管理
    public function works_hot()
    {
       $result=hots::all()->toArray();
//       dd($result);
        if(count($result)==0){
            $result=0;
        }else{
            for($i=0;$i<count($result);$i++){
                if($result[$i]['type']=='bimg'){
                  $bimg[0]=AddComic::find($result[$i]['works_id'])->toArray();
                  $result[$i]=array_merge($result[$i],$bimg);
                }
                if($result[$i]['type']=='img'){
                    $img[0]=Addimg::find($result[$i]['works_id'])->toArray();
                    $result[$i]=array_merge($result[$i],$img);
                }
                if($result[$i]['type']=='txt'){
                    $txt[0]=Mytxt::find($result[$i]['works_id'])->toArray();
                    $result[$i]=array_merge($result[$i],$txt);
                }
                if($result[$i]['type']=='video'){
                    $video[0]=myvideo::find($result[$i]['works_id'])->toArray();
                    $result[$i]=array_merge($result[$i],$video);
                }
            }
        }

        return  view('/admin/works_hot',compact('result'));
    }
//  添加热门
    public function addhot()
    {
        $bimg=AddComic::all();
        $img=Addimg::all();
        $txt=Mytxt::all();
        $video=myvideo::all();
//暴漫
        //如果没有作品就给0   有就判断是否在已经在热门了
        if(count($bimg)==0){
            $rebimg=0;
        }else{
            $rebimg=array();
            for($i=0;$i<count($bimg);$i++){
               if(count(hots::where('works_id',$bimg[$i]['id'])->where('type','bimg')->get())==0){  //表示作品不在热门中就遍历
                  $rebimg[$i]=$bimg[$i];
               }else{
                  $rebimg[$i]='0';
               }
            }
        }
//    趣图
        if(count($img)==0){
            $reimg=0;
        }else{
            for($i=0;$i<count($img);$i++){
                if(count(hots::where('works_id',$img[$i]['id'])->where('type','img')->get())==0){  //表示作品不在热门中就遍历
                    $reimg[$i]=$img[$i];
                }else{
                    $reimg[$i]='0';
                }
            }
        }
//      文本
        if(count($txt)==0){
            $retxt=0;
        }else{
            for($i=0;$i<count($txt);$i++){
                if(count(hots::where('works_id',$txt[$i]['id'])->where('type','txt')->get())==0){  //表示作品不在热门中就遍历
                    $retxt[$i]=$txt[$i];
                }else{
                    $retxt[$i]='0';
                }
            }
        }
//       视频
        if(count($video)==0){
            $revideo=0;
        }else{
            for($i=0;$i<count($video);$i++){
                if(count(hots::where('works_id',$video[$i]['id'])->where('type','video')->get())==0){  //表示作品不在热门中就遍历
                    $revideo[$i]=$video[$i];
                }else{
                    $revideo[$i]='0';
                }
            }
        }
      return  view('/admin/addhot',compact('rebimg','reimg','retxt','revideo'));
    }

    public function hottrue(Request $request)
    {
        $bimg=$request->bimg;
        $img=$request->img;
        $txt=$request->txt;
        $video=$request->video;
        //暴漫
        if($bimg){
            for ($i=0;$i<count($bimg);$i++){
                $hotb=hots::create([
                    'type'=>'bimg',
                    'works_id'=>$bimg[$i],
                ]);
            }
        }
        //趣图
        if($img){
            for ($i=0;$i<count($img);$i++){
                $hotb=hots::create([
                    'type'=>'img',
                    'works_id'=>$img[$i],
                ]);
            }
        }
        //文本
        if($txt){
            for ($i=0;$i<count($txt);$i++){
                $hotb=hots::create([
                    'type'=>'txt',
                    'works_id'=>$txt[$i],
                ]);
            }
        }
        //视频
        if($video){
            for ($i=0;$i<count($video);$i++){
                $hotb=hots::create([
                    'type'=>'video',
                    'works_id'=>$video[$i],
                ]);
            }
        }
        return redirect('/admin/user/works_hot');
    }

    //删除热门
    public function delhot($id)
    {
        $result=hots::where('id','=',$id)->delete();
        return $result;
    }
    //最新排行
    public  function works_up()
    {
        $bimg=AddComic::where('id','>',0)->where('auditto',1)->orderBy('bimgt','desc')->get()->toArray();
        $img=Addimg::where('id','>',0)->where('auditto',1)->orderBy('imgt','desc')->get()->toArray();
        $txt=Mytxt::where('id','>',0)->where('auditto',1)->orderBy('txtt','desc')->get()->toArray();
//        $video=myvideo::where('id','>',0)->where('auditto',1)->orderBy('videot','desc')->get()->toArray();
        if(empty($bimg)){
            $bimg=0;
        }
        if(empty($img)){
            $img=0;
        }
        if(empty($txt)){
            $txt=0;
        }
//        if(empty($video)){
//            $video=0;
//        }

        return view('/admin/works_up',compact('bimg','img','txt'));

    }
    //删除最新排行
    public function delupbimg($id)
    {
        $result=AddComic::where('id',$id)->delete();
        return $result;
    }
    public function delupimg($id)
    {
        $result=Addimg::where('id',$id)->delete();
        return $result;
    }
    public function deluptxt($id)
    {
        $result=Mytxt::where('id',$id)->delete();
        return $result;
    }
    public function delupvideo($id)
    {
        $result=myvideo::where('id',$id)->delete();
        return $result;
    }

//暴漫评论
    public function bimgtalks()
    {
       $bimg=bimgtalk::all()->toArray();
        if (empty($bimg)){
           $bimg='0';
       }
        if($bimg!=0){
            for ($i=0;$i<count($bimg);$i++){
               $desc=AddComic::where('userid',$bimg[0]['user_id'])->get()->toArray();
               $bimg[$i]['bimgb']=$desc[$i]['bimgb'];
               $bimg[$i]['bimgt']=$desc[$i]['bimgt'];
               $bimg[$i]['bimgx']=$desc[$i]['bimgx'];
           }
       }
       return view('/admin/bimgtalks',compact('bimg'));
    }
//趣图评论
    public function imgtalks()
    {
        $img=imgtalk::all()->toArray();
        if (empty($img)){
            $img='0';
        }
        if($img!=0){
            for ($i=0;$i<count($img);$i++){
                $desc=Addimg::where('userid',$img[$i]['user_id'])->get()->toArray();
                $img[$i]['imgb']=$desc[$i]['imgb'];
                $img[$i]['imgt']=$desc[$i]['imgt'];
                $img[$i]['imgx']=$desc[$i]['imgx'];
            }
        }
        return view('/admin/imgtalks',compact('img'));
    }
    //删除暴漫评论
    public function delbimgtalk($id)
    {
        $bimgtalks=bimgtalk::where('id',$id)->delete();
        return $bimgtalks;
    }
    //删除趣图评论
    public function delimgtalk($id)
    {
        $imgtalks=imgtalk::where('id',$id)->delete();
        return $imgtalks;
    }

    //连载管理
    public function publishs()
    {
        $data=publish::all()->toArray();
        if (!empty($data)){
            for ($i=0;$i<count($data);$i++){
                $names=explode(',',rtrim($data[$i]['names'],','));
                $icons=explode(',',rtrim($data[$i]['icons'],','));
                $bimg_id=explode(',',rtrim($data[$i]['bimg_id'],','));
                $data[$i]['names']=$names;
                $data[$i]['icons']=$icons;
                $data[$i]['bimg_id']=$bimg_id;
            }
        }else{
            $data='0';
        }
        return view('/admin/publishs',compact('data'));
    }

    public function delpublish($id)
    {
        $result=publish::where('id',$id)->delete();
        return $result;
    }
}

