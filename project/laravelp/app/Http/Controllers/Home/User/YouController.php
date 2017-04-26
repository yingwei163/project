<?php

namespace App\Http\Controllers\Home\User;

use App\Model\AddComic;
use App\Model\Addimg;
use App\Model\Home\collect;
use App\Model\Home\cropbool;
use App\Model\Home\crops;
use App\Model\Home\imgcollect;
use App\model\home\Mytxt;
use App\Model\Home\publish;
use App\Model\InforModel;
use App\Model\myvideo;
use App\Model\sort;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class YouController extends Controller
{
    //访问他人主页控制器
    public function enter($id)
    {
      $userinfo=InforModel::where('uid',$id)->get()[0];
      $user=UserModel::find($id);
      $sort=sort::all();
      $bimg=AddComic::where('userid',$id)->get()->toArray();
      $img=Addimg::where('userid',$id)->get()->toArray();
      $txt=Mytxt::where('userid',$id)->get()->toArray();
      $video=myvideo::where('userid',$id)->get()->toArray();
      if(empty($bimg)){
          $bimg=0;
      }else{
         for($i=0;$i<count($bimg);$i++){
             $collect=collect::where('works_id',$bimg[0]['id'])->get()->toArray();
             $bimg[$i]['praises']=$collect[0]['praises'];
             $bimg[$i]['rottens']=$collect[0]['rottens'];
             $bimg[$i]['talks']=$collect[0]['talks'];
         }
      }
      if(empty($img)){
          $img=0;
      }else{
          for($i=0;$i<count($img);$i++){
              $collect=imgcollect::where('works_id',$img[0]['id'])->get()->toArray();
              $img[$i]['praises']=$collect[0]['praises'];
              $img[$i]['rottens']=$collect[0]['rottens'];
              $img[$i]['talks']=$collect[0]['talks'];
          }
      }
      if(empty($txt)){
          $txt=0;
      }
      if(empty($video)){
          $video=0;
      }
      return view('/home/other/other',compact('userinfo','user','sort','bimg','img','txt','video'));
    }
//收藏
   public function crop(Request $request)
   {
       $id=$request['id'];
       $type=$request['type'];
       $bool=cropbool::where('user_id',Auth::id())->get()->toArray();
       if($bool){
            return 2;
       }else{
           if($type=='bimg'){
               $bimg=AddComic::find($id)->toArray();
               $user=UserModel::find($bimg['userid'])->toArray();
               $xin=InforModel::where('uid',$bimg['userid'])->get()->toArray()[0];
               $crops=crops::create([
                   'works_id'=>$id,
                   'works_title'=>$bimg['bimgb'],
                   'works_icon'=>$bimg['bimgx'],
                   'user_id'=>$bimg['userid'],
                   'user_name'=>$user['name'],
                   'user_icon'=>$xin['icon'],
               ]);

               if(!empty($crops)){
                   cropbool::create([
                       'user_id'=>Auth::id(),
                       'crop_id'=>$crops->id,
                   ]);
                   return json_encode(1);
               }else{
                   return json_encode(0);
               }
           }
       }

   }
   public function crops()
   {
       $id=Auth::id();
       $userinfo=InforModel::where('uid',$id)->get()[0];
       $user=UserModel::find($id);
       $sort=sort::all();
       $publish=publish::paginate(2);
       $result=crops::where('user_id',Auth::id())->get()->toArray();
       if(empty($result)){
           $result=0;
       }
       return view('/home/user/crops',compact('result','userinfo','user','sort','publish'));
   }

}
