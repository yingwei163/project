<?php

namespace App\Http\Controllers\Home\User;

use App\Http\Requests\Home\UserInfo;
use App\Http\Requests\Home\AddrageComic;
use App\Http\Requests\Home\UserLogin;
use App\Http\Requests\Home\UserRegist;
use App\Model\AddrModel;
use App\Model\sort;
use App\Model\Home\collect;
use App\Model\Home\imgcollect;
use App\Model\Home\imgmessage;
use App\Model\Home\message;
use App\Model\InforModel;
use App\Model\UserModel;
use App\Model\AddComic;
use App\Model\Addimg;
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
            $uf->save();
            return '1';
        }else{
            return '2';
        }


    }

    public function sort(){
        $sort=sort::all();
//        dd($sort);
        return view('/index')->with('show','')->with('bodycolor','')->with('sort',$sort);


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
        $info->save();
        $a='{"bz":1}';
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
        public function myzone()
    {
        return view('home\user\c-index');
    }
    public function addgod()
    {
        return view('home\user\addgod');
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
        if ($userinfo->cash >500){
            $user=UserModel::find($id);
            $user->name=$request->nameaj;
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
        return view('/home/user/usercon',compact('userinfo','user'));
    }
    public function userindex()
    {
        $id=Auth::id();
        $userinfo=InforModel::where('uid',$id)->get()[0];
        $user=UserModel::find($id);
        return view('/home/user/c-index',compact('userinfo'));

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
        return back();
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
        if($request->channel==1){
            $zhi=AddComic::create([
                'userid'=>Auth::id(),
                'auditid'=>'1',
                'auditto'=>'1',
                'bimgx'=>'write_image/'.date('Y-m-d').'/'.date('H-i-s').'/'.$imgname,
                'bimgb'=>$request->title,
                'bimgt'=>date('Y-m-d/H-i-s'),
            ]);
            $id=$zhi->id; //添加的图片新增id
            $result=AddComic::find($id); //根据新增id查询 数据【暴走图片库】中对应的数据
            //【个人信息表的操作】
            $mygod=InforModel::where('uid','=',Auth::id())->get(); //根据用户id查询用户的个人信息
            $sum=($mygod[0]->clan)+1;  //获取个人信息中的神作数量（作品添加成功我们应该用户的神作+1）
            $mygod[0]->clan=$sum;
            $mygod[0]->save();
            //【暴漫-作品评论数据表操作：初始化】
            $collect=message::create([
                'works_id'=>$id,
                'message_id'=>0,
                'collect'=>0,
                'talk'=>0,
                'praise'=>0,
                'rotten'=>0,
            ]);
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
                'auditto'=>'1',
                'imgx'=>'write_image/'.date('Y-m-d').'/'.date('H-i-s').'/'.$imgname,
                'imgb'=>$request->title,
                'imgt'=>date('Y-m-d/H-i-s'),
            ]);
            $id=$zhi->id;
            $result=Addimg::find($id);
            $mygod=InforModel::where('uid','=',Auth::id())->get(); //根据用户id查询用户的个人信息
            $sum=($mygod[0]->clan)+1;  //获取个人信息中的神作数量（作品添加成功我们应该用户的神作+1）
            $mygod[0]->clan=$sum;
            $mygod[0]->save();
            //【趣图-作品评论数据表操作：初始化】
            $collect=imgmessage::create([
                'works_id'=>$id,
                'message_id'=>0,
                'collect'=>0,
                'talk'=>0,
                'praise'=>0,
                'rotten'=>0,
            ]);
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
        $dataone=AddComic::where('userid','=',$id)->get();
        $datatow=Addimg::where('userid','=',$id)->get();
        return view('/home/user/mygod',compact('userinfo','user','dataone','datatow'));

    }
    //通过ajax来删除自己的神作-》暴漫
    public function bbgoddel($id)
    {
        $one=message::where('works_id','=',$id)->delete();
        $tow=collect::where('works_id','=',$id)->delete();
        $result=InforModel::where('uid','=',Auth::id())->get();
        if($result[0]->clan==0){
            $result[0]->clan=0;
            $three=$result[0]->save();
        }else{
            $result[0]->clan-=1;
            $three=$result[0]->save();
        }
        $tetra=AddComic::find($id)->delete();
        if($one && $tow && $three){
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



}
