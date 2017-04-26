<?php

namespace App\Http\Controllers\Home\User;

use App\Http\Requests\Home\UserInfo;
use App\Http\Requests\Home\AddrageComic;
use App\Http\Requests\Home\UserLogin;
use App\Http\Requests\Home\UserRegist;
use App\Http\Requests\Home\Publishs;
use App\Model\advertising;
use App\Model\bao;
use App\Model\Home\publish;
use App\Model\AddrModel;
use App\Model\Home\hots;
use App\Model\Home\Mytxt;
use App\Model\lbt;
use App\Model\link;
use App\Model\myvideo;
use App\Model\FeedModel;
use App\Model\PaperModel;
use App\Model\sort;
use App\Model\Home\bimgtalk;
use App\Model\Home\imgtalk;
use App\Model\Home\collect;
use App\Model\Home\imgcollect;
use App\Model\Home\imgmessage;
use App\Model\Home\message;
use App\Model\InforModel;
use App\Model\Tovideo;
use App\Model\UserModel;
use App\Model\AddComic;
use App\Model\Addimg;
use App\Model\zzq;
use APP\Tool\Result;
use App\Tool\SMS\SendTemplateSMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;

header('conetnt-type:text/html;charset=utf8');
class UserController extends Controller
{
    private $pwd;
     public function sort(){
             $sort=sort::all();
             $link=link::all();
             $lbt=lbt::all();
             $bao=bao::all();
             $zzq=zzq::all();
             $ad=advertising::all();
         $bimg=AddComic::where('auditto',1)->get();
         $img=Addimg::where('auditto',1)->get();
         $txt=Mytxt::where('auditto',1)->get();
         $video=myvideo::all();
         if(count($bimg)=='0'){
               $bimgxin=0;
         }else{
             //获取暴漫信息
             for($i=0;$i<count($bimg);$i++){
                 $bimgxin[]=array();
                 $bimgxin[$i]=$bimg[$i]->toArray();  //获取作品信息
                 $user=UserModel::find($bimg[$i]->toArray()['userid'])->toArray();
                 $bimgxin[$i]['username']=$user['name'];//填写作品制作人名
                 $userinfo=InforModel::find($bimg[$i]->toArray()['userid'])->toArray();
                 $bimgxin[$i]['usericon']=$userinfo['icon'];  //填写作品头像
                 $collect=collect::where('works_id',$bimg[$i]->toArray()['id'])->get()->toArray();
                 $bimgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
                 $bimgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
                 $bimgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
             }
         }
         if(count($img)==0){
             $imgxin=0;
         }else{
             //获取趣图信息
             for($i=0;$i<count($img);$i++){
                 $imgxin[]=array();
                 $imgxin[$i]=$img[$i]->toArray();  //获取作品信息
                 $user=UserModel::find($img[$i]->toArray()['userid'])->toArray();
                 $imgxin[$i]['username']=$user['name'];//填写作品制作人名
                 $userinfo=InforModel::find($img[$i]->toArray()['userid'])->toArray();
                 $imgxin[$i]['usericon']=$userinfo['icon'];
                 $collect=imgcollect::where('works_id',$img[$i]->toArray()['id'])->get()->toArray();
                 $imgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
                 $imgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
                 $imgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
             }
         }

         if(count($txt)==0){
             $txtxin=0;
         }else{
             //获取文本信息
             for($i=0;$i<count($txt);$i++){
                 $txtxin[]=array();
                 $txtxin[$i]=$txt[$i]->toArray();  //获取作品信息
                 $user=UserModel::find($txt[$i]->toArray()['userid'])->toArray();
                 $txtxin[$i]['username']=$user['name'];//填写作品制作人名
                 $userinfo=InforModel::find($txt[$i]->toArray()['userid'])->toArray();
                 $txtxin[$i]['usericon']=$userinfo['icon'];
             }
         }
         if(count($video)==0){
             $videoxin=0;
         }else{
             //获取视频信息
             for($i=0;$i<count($video);$i++){
                 $videoxin[]=array();
                 $videoxin[0]=$video[$i]->toArray();  //获取作品信息
                 $user=UserModel::find($video[$i]->toArray()['userid'])->toArray();
                 $videoxin[0]['username']=$user['name'];//填写作品制作人名
                 $userinfo=InforModel::find($video[$i]->toArray()['userid'])->toArray();
                 $videoxin[0]['usericon']=$userinfo['icon'];
             }
         }
        return view('/index')->with('show','')->with('bodycolor','')->with('sort',$sort)->with('link',$link)->with('zzq',$zzq)
            ->with('lbt',$lbt)->with('bao',$bao)->with('bimgxin',$bimgxin)->with('ad',$ad)->with('imgxin',$imgxin)->with('txtxin',$txtxin)->with('videoxin',$videoxin);
    }
    public function sorts($show,$bodycolor){
        $sort=sort::all();
        $link=link::all();
        $lbt=lbt::all();
        $bao=bao::all();
        $zzq=zzq::all();
        $ad=advertising::all();
        $bimg=AddComic::where('auditto',1)->get();
        $img=Addimg::where('auditto',1)->get();
        $txt=Mytxt::where('auditto',1)->get();
        $video=myvideo::all();
        if(count($bimg)=='0'){
            $bimgxin=0;
        }else{
            //获取暴漫信息
            for($i=0;$i<count($bimg);$i++){
                $bimgxin[]=array();
                $bimgxin[$i]=$bimg[$i]->toArray();  //获取作品信息
                $user=UserModel::find($bimg[$i]->toArray()['userid'])->toArray();
                $bimgxin[$i]['username']=$user['name'];//填写作品制作人名
                $userinfo=InforModel::find($bimg[$i]->toArray()['userid'])->toArray();
                $bimgxin[$i]['usericon']=$userinfo['icon'];  //填写作品头像
                $collect=collect::where('works_id',$bimg[$i]->toArray()['id'])->get()->toArray();
                $bimgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
                $bimgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
                $bimgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
            }
        }
        if(count($img)==0){
            $imgxin=0;
        }else{
            //获取趣图信息
            for($i=0;$i<count($img);$i++){
                $imgxin[]=array();
                $imgxin[$i]=$img[$i]->toArray();  //获取作品信息
                $user=UserModel::find($img[$i]->toArray()['userid'])->toArray();
                $imgxin[$i]['username']=$user['name'];//填写作品制作人名
                $userinfo=InforModel::find($img[$i]->toArray()['userid'])->toArray();
                $imgxin[$i]['usericon']=$userinfo['icon'];
                $collect=imgcollect::where('works_id',$img[$i]->toArray()['id'])->get()->toArray();
                $imgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
                $imgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
                $imgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
            }
        }

        if(count($txt)==0){
            $txtxin=0;
        }else{
            //获取文本信息
            for($i=0;$i<count($txt);$i++){
                $txtxin[]=array();
                $txtxin[$i]=$txt[$i]->toArray();  //获取作品信息
                $user=UserModel::find($txt[$i]->toArray()['userid'])->toArray();
                $txtxin[$i]['username']=$user['name'];//填写作品制作人名
                $userinfo=InforModel::find($txt[$i]->toArray()['userid'])->toArray();
                $txtxin[$i]['usericon']=$userinfo['icon'];
            }
        }
        if(count($video)==0){
            $videoxin=0;
        }else{
            //获取视频信息
            for($i=0;$i<count($video);$i++){
                $videoxin[]=array();
                $videoxin[0]=$video[$i]->toArray();  //获取作品信息
                $user=UserModel::find($video[$i]->toArray()['userid'])->toArray();
                $videoxin[0]['username']=$user['name'];//填写作品制作人名
                $userinfo=InforModel::find($video[$i]->toArray()['userid'])->toArray();
                $videoxin[0]['usericon']=$userinfo['icon'];
            }
        }

        return view('/index')->with('show',$show)->with('bodycolor',$bodycolor)->with('sort',$sort)->with('link',$link)->with('zzq',$zzq)
            ->with('lbt',$lbt)->with('bao',$bao)->with('ad',$ad)->with('bimgxin',$bimgxin)->with('imgxin',$imgxin)->with('txtxin',$txtxin)->with('videoxin',$videoxin);

    }
    //暴漫频道
    public function ragecomic(){
        $sort=sort::all();
        $bimg=AddComic::where('auditto',1)->get();
        $ad=advertising::all();
        //获取暴漫信息
        for($i=0;$i<count($bimg);$i++){
            $bimgxin[]=array();
            $bimgxin[$i]=$bimg[$i]->toArray();  //获取作品信息
            $user=UserModel::find($bimg[$i]->toArray()['userid'])->toArray();
            $bimgxin[$i]['username']=$user['name'];//填写作品制作人名
            $userinfo=InforModel::find($bimg[$i]->toArray()['userid'])->toArray();
            $bimgxin[$i]['usericon']=$userinfo['icon'];  //填写作品头像
            $collect=collect::where('works_id',$bimg[$i]->toArray()['id'])->get()->toArray();
            $bimgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
            $bimgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
            $bimgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
        }
        if(empty($bimgxin)){
            $bimgxin=0;
        }
          return view('/ragecomic')->with('show','')->with('bodycolor','')->with('ad',$ad)->with('sort',$sort)->with('bimgxin',$bimgxin);
    }
    //趣图频道
    public function cuteimg(){
        $sort=sort::all();
        $img=Addimg::where('auditto',1)->get();
        $ad=advertising::all();
        //获趣图漫信息
        for($i=0;$i<count($img);$i++){
            $imgxin[]=array();
            $imgxin[$i]=$img[$i]->toArray();  //获取作品信息
            $user=UserModel::find($img[$i]->toArray()['userid'])->toArray();
            $imgxin[$i]['username']=$user['name'];//填写作品制作人名
            $userinfo=InforModel::find($img[$i]->toArray()['userid'])->toArray();
            $imgxin[$i]['usericon']=$userinfo['icon'];
            $collect=imgcollect::where('works_id',$img[$i]->toArray()['id'])->get()->toArray();
            $imgxin[$i]['praises']=$collect[0]['praises']; //作品点赞
            $imgxin[$i]['rottens']=$collect[0]['rottens']; //作品差评
            $imgxin[$i]['talks']=$collect[0]['talks']; //作品评论数
        }
        if(empty($imgxin)){
            $imgxin=0;
        }
        return view('/cuteimg')->with('show','')->with('bodycolor','')->with('ad',$ad)->with('sort',$sort)->with('imgxin',$imgxin);
    }

    public function upphone(Request $request){
            $preg = '/^1[3|4|5|7|8]\d{9}$/';
            if(!preg_match($preg, $request->phone)){
             return '0';
            }
        $id=Auth::id();
        $uf=InforModel::find($id);
        $codes='123456';
        $code=str_shuffle($codes);
        $uf->phone=$request->phone;
        $uf->phonecode=$code;
        $uf->is_phone='0';
        $uf->save();
       $sms= new SendTemplateSMS();
                    //手机号       验证码 时间数 ID号
       $re=$sms->sendSMS('15968659166',array($code,5),1);
        return '1';
    }
    public function upcode(Request $request)
    {
            if (empty($request->codes)){
                return '0';
            }
        $id=Auth::id();
        $uf=InforModel::find($id);
        $code=$uf->phonecode;
        if ($code==$request->codes)
        {
            $uf->is_phone='1';
            $num=$uf->cash + 250;
            $uf->cash=$num;
            $uf->save();
            return '1';
        }else{
            return '2';
        }


    }
    //纸飞机
    public function paper()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        $paper=PaperModel::where('userid',$id)->get();
        $sort=sort::all();
        return view('/home/user/paper',compact('userinfo','user','paper','sort'));
    }
    //反馈
    public function feedback(Request $request)
    {
        $id=Auth::id();
        $time=date('Y-m-d H:i:s');
        $dev=$request->intel==0?'电脑':'手机';
        $re=new FeedModel();
        $re->userid=$id;
        $re->feedx=$request->feedinfo;
        $re->feedt=$time;
        $re->device=$dev;
        $re->is_feedback='0';
        $re->save();
        return 1;
    }
    public function regist(UserRegist $request)
    {
        $this->pwd=Hash::make($request->pwd);
        $user=new UserModel();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$this->pwd;
        $user->save();
        $userid=$user->id;
        $info=new InforModel();
        $info->uid=$userid;
        $info->phone='0';
        $info->icon='/images/default.png';
        $info->bir='0';
        $info->addr='0';
        $info->sex='0';
        $info->foll='0';
        $info->fan='0';
        $info->clan='0';
        $info->cash='0';
        $info->comm='0';
        $info->total='0';
        $info->join='0';
        $info->idea='0';
        $info->confirmed_code='0';
        $info->is_confirmed=0;
        $info->phonecode='0';
        $info->is_phone='0';
        $info->save();
        $a=1;
        return  $a;

    }
    public function login(UserLogin $request)
    {
       $re= Auth::attempt(['name'=>$request->input('name'),'password'=>$request->input('pwd')]);
       if ($re){
           $a='1';
       }else{
           $a='0';
           $request->session()->flash('loginer', '用户名或密码错误请重试');
       }
        return $a;
    }
    public function userloginout()
    {
            Auth::logout();
            return redirect('/');
    }
    public function addgod()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        $worko=AddComic::where('userid',$id)->where('auditto','1')->get()->toArray();
        $sort=sort::all();
        return view('/home/user/addgod',compact('userinfo','user','worko','sort'));
    }
    public function ucnrename(Request $request)
    {
        $rules=array(
            'nameaj'=>'required|between:3,16',
        );
        $mess=array(
            'nameaj.required'=>'用户名不能为空',
            'nameaj.between'=>'用户名必须在:min和:max中'
        );
       $val=Validator::make($request->all(),$rules,$mess);
    if ($val->fails()){
        return back()->withErrors($val);
    }else{
        $id=Auth::id();
        $userinfo=InforModel::find($id);
        if ($userinfo->cash >=500){
            $userinfo->cash=0;
            $userinfo->save();
            $user=UserModel::find($id);
            $user->name=$request->nameaj;
            $user->save();
            $request->session()->flash('success', '修改用户名成功');
            return back();
        }else{
            $request->session()->flash('success', '修改失败尼玛币不足');
            return back();
            }
        }
    }
    public function usercon()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        $sort=sort::all();
        return view('/home/user/usercon',compact('userinfo','user','sort'));
    }
    public function userindex()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        $sort=sort::all();
        $publish=publish::paginate(2);
        return view('/home/user/c-index',compact('userinfo','user','sort','publish'));

    }
    public function  ucnrefile(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->newfile) {
                $id = Auth::id();
                $userinfo = InforModel::find($id);
                $path = date('Y/m/d') . '/userimg/' . $userinfo->id . '.jpg';
                $filepath = date('Y/m/d') . '/userimg';
                $filename = $userinfo->id . '.jpg';
                $fileinfo=$userinfo->icon;
                $userinfo->icon = $path;
                $userinfo->save();
                $request->newfile->move($filepath, $filename);
                $request->session()->flash('successf', '修改头像成功');
                return back();
            } else {
                $request->session()->flash('successf', '修改头像失败');
                return back();
            }
        }
    }
    public function addrin($upid)
    {
        $data=AddrModel::where('upid',$upid)->get();
        echo json_encode($data);
    }
    public function infoup(UserInfo $request)
    {
        $id = Auth::id();
        $userinfo = InforModel::find($id);
        $userinfo->bir=$request->bir;
        $addre=$request->addr.','.$request->addrr;
        $userinfo->addr=$addre;
        $userinfo->sex=$request->sex;
        $userinfo->save();
        $request->session()->flash('successfo', '修改基本信息成功');
        return 1;
    }
    public function inemail(Request $request)
    {
        $rules=array(
            'email'=>'required',
        );
        $mess=array(
            'email.required'=>'邮箱名不能为空',
        );
        $this->validate($request,$rules,$mess);
        $id=Auth::id();
        $user=UserModel::find($id);
        $view='/home/user/upemail';
        $confirmed_code=str_random(48);
        $datas=InforModel::find($id);
        $datas->confirmed_code=$confirmed_code;
        $datas->save();
        $subject='请验证邮箱';
        $data=['id'=>$id,'confirmed_code'=>$confirmed_code,];
        //用户信息 视图  邮件名 验证后缀码
        $this->sendEmail($user,$view,$subject,$data);

        return back();
    }
//    public function upemail()
//    {
//        return view('/home/user/upemail');
//    }
    public function sendEmail($user,$view,$subject,$data)
    {
        Mail::send($view, $data, function ($m) use ($subject,$user) {
            $m->to($user->email)->subject($subject);
        });
    }
    public function emailConfirm($code)
    {
        //查询与回传值匹配的用户code
        $user=InforModel::where('confirmed_code',$code)->first();
        if (is_null($user)){
            return redirect('/');
        }
        $user->confirmed_code=str_random(10);
        $user->is_confirmed=1;
        $user->cash='250';
        $user->save();
       return  redirect('/home/user/usercon');
    }
    public function addcomic()
    {
        return view('home\user\addcomic');
    }
    public function addrage(AddrageComic $request)
    {
        //制作随机数
        $array=array_merge(range(1,9),range('a','z'));
        $imgname='';
        for($i=0;$i<16;$i++){
            $imgname.=$array[mt_rand(1,34)];
        }
        //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
        $imgname=time().Auth::id().$imgname.'.jpg';
        $request->file('content')->move('write_image/'.date('Y-m-d').'/'.date('H-i-s'),$imgname);
        $users=InforModel::find(Auth::id());
        $my=UserModel::find(Auth::id());
        if($request->channel==1){
            $zhi=AddComic::create([
                'userid'=>Auth::id(),
                'auditid'=>'1',
                'auditto'=>'0',
                'bimgx'=>'write_image/'.date('Y-m-d').'/'.date('H-i-s').'/'.$imgname,
                'bimgb'=>$request->title,
                'bimgt'=>date('Y-m-d/H-i-s'),
                'name'=>$my->name,
                'userimg'=>$users->icon,
            ]);
            $id=$zhi->id; //添加的图片新增id
            $result=AddComic::find($id); //根据新增id查询 数据【暴走图片库】中对应的数据
            //【个人信息表的操作】
            $mygod=InforModel::where('uid','=',Auth::id())->get(); //根据用户id查询用户的个人信息
            $sum=($mygod[0]->clan)+1;  //获取个人信息中的神作数量（作品添加成功我们应该用户的神作+1）
            $mygod[0]->clan=$sum;
            $mygod[0]->save();
            //************************
            //【暴漫-作品评论的统计表操作：初始化】
            $collect=collect::create([
                'works_id'=>$id,
                'collects'=>0,
                'talks'=>0,
                'praises'=>0,
                'rottens'=>0,
            ]);
        }else{
            $zhi=Addimg::create([
                'userid'=>Auth::id(),
                'auditid'=>'1',
                'auditto'=>'0',
                'imgx'=>'write_image/'.date('Y-m-d').'/'.date('H-i-s').'/'.$imgname,
                'imgb'=>$request->title,
                'imgt'=>date('Y-m-d/H-i-s'),
                'name'=>$my->name,
                'userimg'=>$users->icon,
            ]);
            $id=$zhi->id;
            $result=Addimg::find($id);
            $mygod=InforModel::where('uid','=',Auth::id())->get(); //根据用户id查询用户的个人信息
            $sum=($mygod[0]->clan)+1;  //获取个人信息中的神作数量（作品添加成功我们应该用户的神作+1）
            $mygod[0]->clan=$sum;
            $mygod[0]->save();
            //************************
            //【趣图-作品评论的统计表操作：初始化】
            $collect=imgcollect::create([
                'works_id'=>$id,
                'collects'=>0,
                'talks'=>0,
                'praises'=>0,
                'rottens'=>0,
            ]);
        }
        $channel=$request->channel;
        return view('/home/user/trueadd',compact('result','channel'));
    }
    public function trueadd(Request $request)
    {
        return view('/home/user/trueadd');
    }
//个人中心->我的神作
    public function mygod()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        //查询所有神作
        $dataone1=AddComic::where('userid','=',$id)->where('auditto',1)->get()->toArray();  //拿暴漫
        $datatow1=Addimg::where('userid','=',$id)->where('auditto',1)->get()->toArray();    //拿趣图
        if(!empty($dataone1)) {
            for ($i=0;$i<count($dataone1);$i++){
                $dataone2 = AddComic::find($dataone1[$i]['id'])->collect()->get()->toArray()[0];
                $dataonex[$i]= array_merge($dataone1[$i],$dataone2);
            }
        }
        if(!empty($datatow1)) {
            for ($i=0;$i<count($datatow1);$i++){
                $datatow2 = Addimg::find($datatow1[$i]['id'])->collect()->get()->toArray()[0];
                $datatowx[$i]= array_merge($datatow1[$i],$datatow2);
            }
        }
        $publish=publish::paginate(2);
        $sort=sort::all();
        return view('/home/user/mygod',compact('userinfo','user','dataonex','datatowx','publish','sort'));
    }

    public function mytalks()
    {

        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        //查询bimg评论别人的
        $bimg=bimgtalk::where('user_id',$id)->get()->toArray();
        $usero=UserModel::find($id)->toArray();
        $infoa=InforModel::where('uid',$id)->get()->toArray();
        if(count($bimg)){
            for($i=0;$i<count($bimg);$i++)
            {
                $bimg[$i]['name']=$usero['name'];
                $bimg[$i]['icon']=$infoa[0]['icon'];
            }
            $one=$bimg;
        }else{
            $one='0';
        }
        //查询img评论别人的
        $img=imgtalk::where('user_id',$id)->get()->toArray();
        $usert=UserModel::find($id)->toArray();
        $infob=InforModel::where('uid',$id)->get()->toArray();
        if(count($img)){
            for($i=0;$i<count($img);$i++)
            {
                $img[$i]['name']=$usert['name'];
                $img[$i]['icon']=$infob[0]['icon'];
            }
            $tow=$img;
        }else{
            $tow='0';
        }

        //查询评论自己的信息bimg
        $wbimg=bimgtalk::all()->toArray();
        if(count($wbimg)){
            for($i=0;$i<count($wbimg);$i++){
                if($wbimg[$i]['user_id']==Auth::id()){
                    $three[]=$wbimg[$i];
                }
            }
        }else{
            $three='0';
        }
        //获取从获取的id信息查询对应商品bimg
        if($three!=0){
            for($i=0;$i<count($three);$i++){
                $cjuser=UserModel::find($three[$i]['user_id']);
                $infoc=InforModel::where('uid',$three[$i]['user_id'])->get()->toArray();
                $three[$i]['name']=$cjuser->name;
                $three[$i]['icon']=$infoc[0]['icon'];
            }
        }
        //查询评论自己的信息img
        $wimg=imgtalk::all()->toArray();
        if(count($wimg)){
            for($i=0;$i<count($wimg);$i++){
                if($wimg[$i]['user_id']==Auth::id()){
                    $tetra[]=$wimg[$i];
                }
            }
        }else{
            $tetra='0';
        }
        //获取从获取的id信息查询对应商品img
        if($tetra!=0){
            for($i=0;$i<count($tetra);$i++){
                $cjuser=UserModel::find($tetra[$i]['user_id']);
                $infod=InforModel::where('uid',$tetra[$i]['user_id'])->get()->toArray();
                $tetra[$i]['name']=$cjuser->name;
                $tetra[$i]['icon']=$infod[0]['icon'];
            }
        }
        $sort=sort::all();
        $publish=publish::paginate(2);
        return view('/home/user/talks',compact('userinfo','user','one','tow','three','tetra','sort','publish'));
    }

    //通过ajax来删除自己的神作-》暴漫
    public function bbgoddel($id)
    {
        $one=message::where('works_id','=',$id)->delete();  //删除 个人对作品的评论信息表  如果个人没有评论就没有了
        $tow=collect::where('works_id','=',$id)->delete();  //删除 作品的信息集合表
        $result=InforModel::where('uid','=',Auth::id())->get();  //查询用户自己的神作-1  如果是0就赋值为0
        if($result[0]->clan==0){
            $result[0]->clan=0;
            $three=$result[0]->save();
        }else{
            $result[0]->clan-=1;
            $three=$result[0]->save();
        }
        $tetra=AddComic::find($id)->delete();   //最后删除作品表
        if($tow && $three && $tetra){
            return json_decode('1');
        }else{
            return json_decode('0');
        }
    }
    //通过ajax来删除自己的神作-》趣图
    public function iigoddel($id)
    {
        $one=imgmessage::where('works_id','=',$id)->delete();
        $tow=imgcollect::where('works_id','=',$id)->delete();
        $result=InforModel::where('uid','=',Auth::id())->get();
        $result[0]->clan-=1;
        $three=$result[0]->save();
        $tetra=Addimg::find($id)->delete();
        if($one && $tow && $three){
            return json_decode('1');
        }else{
            return json_decode('0');
        }
    }
    //暴漫点赞
    public function praise_bimg($id)
    {
        $bool=message::where('message_id','=',Auth::id())->where('works_id','=',$id)->get();
        if(!count($bool)){
            //生成做对的一对一数据评论表
            $addmes=message::create([
                'works_id'=>$id,
                'message_id'=>Auth::id(),
                'collect'=>0,
                'talk'=>0,
                'praise'=>1,
                'rotten'=>0,
            ]);
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=collect::where('works_id',$id)->get();
            $collects[0]->praises+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=AddComic::where('id',$id)->get(); //先获取作品
            $user=InforModel::where('uid',$works[0]->userid)->get();
            $user[0]->total+=1;
            $user[0]->save();

            return 1;
        }else{
            if($bool[0]->praise==1){   //如果查出来的点赞已经点过了就直接给返回
                return 0;
            }else if($bool[0]->rotten==1){
                return 9;
            }else{
                $bool[0]->praise=1;
                $bool[0]->save();
                //在作品的评论集合表上的总点赞数 累计加一
                $collects=collect::where('works_id',$id)->get();
                $collects[0]->praises+=1;
                $collects[0]->save();
                //作品的作者的顶数+1
                $works=AddComic::where('userid',$id)->get();
                $user=InforModel::where('uid',$works[0]->userid)->get();
                $works[0]->total+=1;
                $works[0]->save();
                return 1;
            }
        }



    }
//暴漫差评
    public function rotten_bimg($id)
    {
        $bool=message::where('message_id','=',Auth::id())->where('works_id','=',$id)->get();
        if(!count($bool)){
            //生成做对的一对一数据评论表
            $addmes=message::create([
                'works_id'=>$id,
                'message_id'=>Auth::id(),
                'collect'=>0,
                'talk'=>0,
                'praise'=>0,
                'rotten'=>1,
            ]);
            //在作品的评论集合表上的总差评数 累计加一
            $collects=collect::where('works_id',$id)->get();
            $collects[0]->rottens+=1;
            $collects[0]->save();

            return 1;
        }else{
            if($bool[0]->rotten==1){   //如果查出来的差评已经点过了就直接给返回
                return 0;
            }else if($bool[0]->praise==1){
                return 9;
            }else{
                $bool[0]->rotten=1;
                $bool[0]->save();
                //在作品的评论集合表上的差评数 累计加一
                $collects=collect::where('works_id',$id)->get();
                $collects[0]->rottens+=1;
                $collects[0]->save();
                return 1;
            }
        }



    }
//趣图点赞
    public function praise_img($id)
    {
        $bool=imgmessage::where('message_id','=',Auth::id())->where('works_id','=',$id)->get();
        if(!count($bool)){
            //生成做对的一对一数据评论表
            $addmes=imgmessage::create([
                'works_id'=>$id,
                'message_id'=>Auth::id(),
                'collect'=>0,
                'talk'=>0,
                'praise'=>1,
                'rotten'=>0,
            ]);
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=imgcollect::where('works_id',$id)->get();
            $collects[0]->praises+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=Addimg::where('userid',$id)->get();
            $user=InforModel::where('uid',$works[0]->userid)->get();
            $works[0]->total+=1;
            $works[0]->save();

            return 1;
        }else{
            if($bool[0]->praise==1){   //如果查出来的点赞已经点过了就直接给返回
                return 0;
            }else if($bool[0]->rotten==1){
                return 9;
            }else{
                $bool[0]->praise=1;
                $bool[0]->save();
                //在作品的评论集合表上的总点赞数 累计加一
                $collects=imgcollect::where('works_id',$id)->get();
                $collects[0]->praises+=1;
                $collects[0]->save();
                //作品的作者的顶数+1
                $works=Addimg::where('userid',$id)->get();
                $user=InforModel::where('uid',$works[0]->userid)->get();
                $works[0]->total+=1;
                $works[0]->save();
                return 1;
            }
        }



    }//--
    //暴漫评论
    public function bimgtalk(Request $request)
    {

        //判断之前是否存在 用户单对单作品表$request->works_id
        $message=message::where('works_id',$request->works_id)->where('message_id',Auth::id())->get();
        if(count($message)){
            if($message[0]->talk==1){
                return 0;
            }
            //生成评论表
            $mytalk=bimgtalk::create([
                'user_id'=>Auth::id(),
                'talk_txt'=>$request->talktxt,
                'work_id'=>$request->works_id,
            ]);
            //在已存在的单对单表中写入已评论
            $message[0]->talk=1;
            $message[0]->save();
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=collect::where('works_id',$request->works_id)->get();
            $collects[0]->talks+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=AddComic::where('id',$request->works_id)->get();
            $user=InforModel::where('uid',$works[0]->userid)->get();// 在获取作品的作者id 对作者表进行操作
            $user[0]->comm+=1;
            $user[0]->save();
            //查询用户列表
            $my=UserModel::where('id',Auth::id())->get();
            $result['name']=$my[0]->name;
            $result['icon']=$user[0]->icon;
            $result['created_at']=$mytalk->created_at;
            $result['talk_txt']=$mytalk->talk_txt;
            return ($result);
        }else{
            //生成评论表
            $mytalk=bimgtalk::create([
                'user_id'=>Auth::id(),
                'talk_txt'=>$request->talktxt,
                'work_id'=>$request->works_id,
            ]);
            //生成做对的一对一数据评论表
            $addmes=message::create([
                'works_id'=>$request->works_id,
                'message_id'=>Auth::id(),
                'collect'=>0,
                'talk'=>1,
                'praise'=>0,
                'rotten'=>0,
            ]);
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=collect::where('works_id',$request->works_id)->get();
            $collects[0]->talks+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=AddComic::where('id',$request->works_id)->get();
            $user=InforModel::where('uid',$works[0]->userid)->get();// 在获取作品的作者id 对作者表进行操作
            $user[0]->comm+=1;
            $user[0]->save();
            //查询用户列表
            $my=UserModel::where('id',Auth::id())->get();
            $result['name']=$my[0]->name;
            $result['icon']=$user[0]->icon;
            $result['created_at']=$mytalk->created_at;
            $result['talk_txt']=$mytalk->talk_txt;
            return ($result);
        }


    }
    //趣图评论
    public function imgtalk(Request $request)
    {

        //判断之前是否存在 用户单对单作品表$request->works_id
        $message=imgmessage::where('works_id',$request->works_id)->where('message_id',Auth::id())->get();
        if(count($message)){
            if($message[0]->talk==1){
                return 0;
            }
            //生成评论表
            $mytalk=imgtalk::create([
                'user_id'=>Auth::id(),
                'talk_txt'=>$request->talktxt,
                'work_id'=>$request->works_id,
            ]);
            //在已存在的单对单表中写入已评论
            $message[0]->talk=1;
            $message[0]->save();
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=imgcollect::where('works_id',$request->works_id)->get();
            $collects[0]->talks+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=Addimg::where('id',$request->works_id)->get();
            $user=InforModel::where('uid',$works[0]->userid)->get();// 在获取作品的作者id 对作者表进行操作
            $user[0]->comm+=1;
            $user[0]->save();
            //查询用户列表
            $my=UserModel::where('id',Auth::id())->get();
            $result['name']=$my[0]->name;
            $result['icon']=$user[0]->icon;
            $result['created_at']=$mytalk->created_at;
            $result['talk_txt']=$mytalk->talk_txt;
            return ($result);
        }else{
            //生成评论表
            $mytalk=imgtalk::create([
                'user_id'=>Auth::id(),
                'talk_txt'=>$request->talktxt,
                'work_id'=>$request->works_id,
            ]);
            //生成做对的一对一数据评论表
            $addmes=imgmessage::create([
                'works_id'=>$request->works_id,
                'message_id'=>Auth::id(),
                'collect'=>0,
                'talk'=>1,
                'praise'=>0,
                'rotten'=>0,
            ]);
            //在作品的评论集合表上的总点赞数 累计加一
            $collects=imgcollect::where('works_id',$request->works_id)->get();
            $collects[0]->talks+=1;
            $collects[0]->save();
            //作品的作者的顶数+1
            $works=Addimg::where('id',$request->works_id)->get();
            $user=InforModel::where('uid',$works[0]->userid)->get();// 在获取作品的作者id 对作者表进行操作
            $user[0]->comm+=1;
            $user[0]->save();
            //查询用户列表
            $my=UserModel::where('id',Auth::id())->get();
            $result['name']=$my[0]->name;
            $result['icon']=$user[0]->icon;
            $result['created_at']=$mytalk->created_at;
            $result['talk_txt']=$mytalk->talk_txt;
            return ($result);
        }


    }
    //将当前作品对应的所有评论找出
    public function loadbimgtalks(Request $request)
    {
        $bimgtalks=bimgtalk::where('work_id',$request->works_id)->orderBy('created_at','desc')->get()->toArray();
        if(count($bimgtalks)==0){
            return 0;
        }
        for($i=0;$i<count($bimgtalks);$i++){
            $userxin[$i]=InforModel::where('uid',$bimgtalks[$i]['user_id'])->get()->toArray();
            $user[$i]=UserModel::where('id',$bimgtalks[$i]['user_id'])->get()->toArray();
            $datas[$i]=array_merge($bimgtalks[$i],$userxin[$i],$user[$i]);
        }
        return ($datas);

    }
    public function loadimgtalks(Request $request)
    {
        $bimgtalks=imgtalk::where('work_id',$request->works_id)->orderBy('created_at','desc')->get()->toArray();
        if(count($bimgtalks)==0){
            return 0;
        }
        for($i=0;$i<count($bimgtalks);$i++){
            $userxin[$i]=InforModel::where('uid',$bimgtalks[$i]['user_id'])->get()->toArray();
            $user[$i]=UserModel::where('id',$bimgtalks[$i]['user_id'])->get()->toArray();
            $datas[$i]=array_merge($bimgtalks[$i],$userxin[$i],$user[$i]);
        }
        return ($datas);

    }

    public function works_hot()
    {
        $ad=advertising::all();
        $sort=sort::all();
        $bimg=AddComic::where('auditto',1)->get();
        $hots=hots::all()->toArray();
        if(count($hots)==0){
            $result=0;
        }else{
            for($i=0;$i<count($hots);$i++){
                if($hots[$i]['type']=='bimg'){
                    $bimg=AddComic::where('id','=',$hots[$i]['works_id'])->get()->toArray();
                    $user=UserModel::find($bimg[0]['userid']);
                    $userinfo=InforModel::where('uid','=',$user->id)->get();
                    $worksxin=collect::where('works_id','=',$bimg[0]['id'])->get();
                    $one[$i]['praises']=$worksxin[0]->praises;
                    $one[$i]['rottens']=$worksxin[0]->rottens;
                    $one[$i]['talks']=$worksxin[0]->talks;
                    $one[$i]['usericon']=$userinfo[0]->icon;
                    $one[$i]['username']=$user->name;
                    $one[$i]['username']=$user->name;
                    $one[$i]['works_id']=$bimg[0]['id'];
                    $one[$i]['bimgx']=$bimg[0]['bimgx'];
                    $one[$i]['bimgb']=$bimg[0]['bimgb'];
                    $one[$i]['bimgt']=$bimg[0]['bimgt'];
                }
                if($hots[$i]['type']=='img'){
                    $img=Addimg::where('id','=',$hots[$i]['works_id'])->get()->toArray();
                    $user=UserModel::find($img[0]['userid']);
                    $userinfo=InforModel::where('uid','=',$user->id)->get();
                    $worksxin=imgcollect::where('works_id','=',$img[0]['id'])->get();
                    $tow[$i]['praises']=$worksxin[0]->praises;
                    $tow[$i]['rottens']=$worksxin[0]->rottens;
                    $tow[$i]['talks']=$worksxin[0]->talks;
                    $tow[$i]['usericon']=$userinfo[0]->icon;
                    $tow[$i]['username']=$user->name;
                    $tow[$i]['username']=$user->name;
                    $tow[$i]['works_id']=$img[0]['id'];
                    $tow[$i]['imgx']=$img[0]['imgx'];
                    $tow[$i]['imgb']=$img[0]['imgb'];
                    $tow[$i]['imgt']=$img[0]['imgt'];
                }
                if($hots[$i]['type']=='txt'){
                    $txt=Mytxt::where('id','=',$hots[$i]['works_id'])->get()->toArray();
                    $user=UserModel::find($txt[0]['userid']);
                    $userinfo=InforModel::where('uid','=',$user->id)->get();
                    $three[$i]['usericon']=$userinfo[0]->icon;
                    $three[$i]['username']=$user->name;
                    $three[$i]['username']=$user->name;
                    $three[$i]['works_id']=$txt[0]['id'];
                    $three[$i]['txtx']=$txt[0]['txtx'];
                    $three[$i]['txtb']=$txt[0]['txtb'];
                    $three[$i]['txtt']=$txt[0]['txtt'];
                }
                if($hots[$i]['type']=='video'){
                    $video=myvideo::where('id','=',$hots[$i]['works_id'])->get()->toArray();
                    $user=UserModel::find($video[0]['userid']);
                    $userinfo=InforModel::where('uid','=',$user->id)->get();
                    $tetra[$i]['usericon']=$userinfo[0]->icon;
                    $tetra[$i]['username']=$user->name;
                    $tetra[$i]['username']=$user->name;
                    $tetra[$i]['works_id']=$video[0]['id'];
                    $tetra[$i]['videox']=$video[0]['videox'];
                    $tetra[$i]['videob']=$video[0]['videob'];
                    $tetra[$i]['videot']=$video[0]['videot'];
                }
            }

        }
        if(empty($one)){
            $one=0;
        }
        if(empty($tow)){
            $tow=0;
        }
        if(empty($three)){
            $three=0;
        }
        if(empty($tetra)){
            $tetra=0;
        }
        return view('/works_hot')->with('show','')->with('bodycolor','')->with('ad',$ad)->with('sort',$sort)->with('one',$one)->with('tow',$tow)->with('three',$three)->with('tetra',$tetra);
    }
    public function publish(Publishs $request)
    {
        $data=$request->toArray();
        $names='';
        $bimg_id='';
        $icons='';
        for($i=0;$i<count($data['bimgw']);$i++){
            $bimg=AddComic::find($data['bimgw'][$i])->toArray();
            $names.=($bimg['bimgb']).',';
            $bimg_id.=($bimg['id']).',';
            $icons.=($bimg['bimgx']).',';
        }
//      dd(explode(',',rtrim($name,',')));    //names、icons或者bimg_id取值
        //制作随机数
        $array=array_merge(range(1,9),range('a','z'));
        $imgname='';
        for($i=0;$i<16;$i++){
            $imgname.=$array[mt_rand(1,34)];
        }
        $imgname=time().Auth::id().$imgname.'.jpg';
        //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
        $request->file('cover')->move('write_image/'.date('Y-m-d').'/'.date('H-i-s'),$imgname);
        $publish=publish::create([
            'bimg_id'=>$bimg_id,
            'names'=>$names,
            'icons'=>$icons,
            'user_id'=>Auth::id(),
            'title'=>$data['title'],
            'cover'=>'write_image/'.date('Y-m-d').'/'.date('H-i-s').'/'.$imgname,
        ]);
        return redirect(url('/home/user/addgod'));
    }

    public function mypublish()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        $publish=publish::paginate(2);   //连载分页
        $publishs=publish::all()->toArray();         //这个代表查询所有连载信息
        $sort=sort::all();
        return view('/home/user/mypublish',compact('userinfo','user','publishs','publish','sort'));
    }
   public function works_up()
   {
       $ad=advertising::all();
       $bimg=AddComic::where('id','>',0)->where('auditto',1)->orderBy('bimgt','desc')->get()->toArray();
       $img=Addimg::where('id','>',0)->where('auditto',1)->orderBy('imgt','desc')->get()->toArray();
       $txt=Mytxt::where('id','>',0)->where('auditto',1)->orderBy('txtt','desc')->get()->toArray();
        $video=Tovideo::where('tovideo','=',1)->get()->toArray();

       if(empty($bimg)){
           $bimg=0;
       }else{
         for ($i=0;$i<count($bimg);$i++){
            $user=UserModel::find($bimg[$i]['userid']);
            $xin=InforModel::where('uid',$bimg[$i]['userid'])->get()->toArray();
            $collect=collect::where('works_id',$bimg[$i]['id'])->get()->toArray();
             $bimg[$i]['username']=$user->name;
             $bimg[$i]['usericon']=$xin[0]['icon'];
             $bimg[$i]['praises']=$collect[0]['praises'];
             $bimg[$i]['rottens']=$collect[0]['rottens'];
             $bimg[$i]['talks']=$collect[0]['talks'];
         }

       }

       if(empty($img)){
           $img=0;
       }else {
           for ($i = 0; $i < count($img); $i++) {
               $user = UserModel::find($img[$i]['userid']);
               $xin = InforModel::where('uid', $img[$i]['userid'])->get()->toArray();
               $collect=imgcollect::where('works_id',$img[$i]['id'])->get()->toArray();
               $img[$i]['username'] = $user->name;
               $img[$i]['usericon'] = $xin[0]['icon'];
               $img[$i]['praises']=$collect[0]['praises'];
               $img[$i]['rottens']=$collect[0]['rottens'];
               $img[$i]['talks']=$collect[0]['talks'];
           }
       }


           $sort=sort::all();
           return view('/works_up')->with('show', '')->with('bodycolor', '')->with('ad',$ad)->with('sort', $sort)->with('bimg', $bimg)->with('img', $img);
       }
       public function nav()
       {
           $sort=sort::all()->toArray();
           $arr='';
           foreach ($sort as $v)
           {
               $arr[]=$v['name'];
               $arru[]=$v['url'];
           }
//           dd($arr);
//           dd($arru);
           $search=$_GET['search'];
           if (in_array($search,$arr)){
               $path=sort::where('name',$search)->get(['url']);
               foreach ($path as $vs){

                   return redirect($vs->url);
               }
           }
            return redirect('/');

       }

}
