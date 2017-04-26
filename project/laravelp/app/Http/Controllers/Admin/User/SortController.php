<?php

namespace App\Http\Controllers\Admin\User;

use App\Model\advertising;
use App\Model\bao;
use App\Model\exhibitors;
use App\Model\FeedModel;
use App\Model\Home\Mytxt;
use App\Model\lbt;
use App\Model\link;
use App\Model\PaperModel;
use App\Model\sort;
use App\Model\myvideo;
use App\Model\Tovideo;
use App\Model\UserModel;
use App\Model\zzq;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SortController extends Controller
{
    /**
     * 方法名  video
     * 路由名  /admin/user/video_list  get
     * 作用值  进入视频列表页
     * 返回值  视频列表页面
     */
        public function video()
    {
        $hotvideo=Tovideo::where('tovideo'  ,'1')->get();
        $re = DB::select('select * from invideo where tovideo = 0 limit 0,4 ');
        $all=Tovideo::all();
        $sort=sort::all();
        return view('/home/user/video',compact('hotvideo','re','all','sort'));
    }
    /**
     * 方法名  videoshow
     * 路由名  /admin/user/video_show/{id}  get
     * 作用值  进入视频单个页
     * 返回值  视频单个页面
     */
    public function videoshow($id)
    {
        $re=myvideo::find($id);
        $sort=sort::all();
        return view('/home/user/videoshow',compact('re','sort'));
    }
    /**
     * 方法名  videoload
     * 路由名  /admin/user/video_load/{id}  get
     * 作用值  下载视频
     * 返回值  下载的视频
     */
    public function videoload($id)
    {
        $re=myvideo::find($id);
        $filepath=url($re->videox);
        $filename='敢问路在何方？.mp4';
        //下载头标签                                            文件下载后的名字
        header('content-Disposition:attachment; filename="'.$filename.'"');
        //下载的文件路径
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
    /**
     * 方法名  paperlist
     * 路由名  /admin/user/paper_list  get
     * 作用值  进入小纸条页面
     * 返回值  进入页面
     */
    public function paperlist()
    {
        $paper=PaperModel::paginate(2);
        return view('/admin/paper',compact('paper'));
    }
    /**
     * 方法名  paperadd
     * 路由名  /admin/user/paper_add  any
     * 作用值  添加小纸条（全体单体）
     * 返回值  get进入添加页面   post业务完后重定向列表页面
     */
    public function paperadd(Request $request)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'paperx'=>'required',
                'paperb'=>'required',
                'userid'=>'required',
            );
            $mess=array(
                'paperx.required'=>'纸条内容不能为空',
                'paperb.required'=>'纸条标题不能为空',
                'userid.required'=>'选择发送的用户ID不能为空',
            );
            $this->validate($request,$rules,$mess);
//            dd($request->all());
            $time=date('Y-m-d H:i:s');
            $name=session(('name'));
            $userimg='/images/offic.png';
            //如果发送给用户ID为0就是全体要遍历全部ID发送否则发送给选择的用户ID遍历
            if ($request->userid=='0'){
                $reid=UserModel::all(['id']);
                foreach ($reid as $v){
                    $re=new PaperModel();
                    $re->userid=$v->id;
                    $re->paperx=$request->paperx;
                    $re->paperb=$request->paperb;
                    $re->papert=$time;
                    $re->name=$name;
                    $re->userimg=$userimg;
                    $re->save();
                }
            }else{
                foreach ($request->userid as $vs)
                {
                    $re=new PaperModel();
                    $re->userid=$vs;
                    $re->paperx=$request->paperx;
                    $re->paperb=$request->paperb;
                    $re->papert=$time;
                    $re->name=$name;
                    $re->userimg=$userimg;
                    $re->save();
                }
            }
            return redirect('/admin/user/paper_list');

        }
        $re=UserModel::all(['id']);
//        dd($re);
        return view('/admin/paperadd',compact('re'));
    }
    /**
     * 方法名  paperedit
     * 路由名  /admin/user/paper_edit  any
     * 作用值  修改小纸条内容（单条修改）
     * 返回值  get进入修改页面   post修改业务完成重定向列表页面
     */
    public function paperedit(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'paperx'=>'required',
                'paperb'=>'required',
            );
            $mess=array(
                'paperx.required'=>'纸条内容不能为空',
                'paperb.required'=>'纸条标题不能为空',
            );
            $this->validate($request,$rules,$mess);
//            dd($request->all());
            $time=date('Y-m-d H:i:s');
            $name=session(('name'));
            $userimg='/images/offic.png';
                    $re=PaperModel::find($request->userid);
                    $re->paperx=$request->paperx;
                    $re->paperb=$request->paperb;
                    $re->save();
            return redirect('/admin/user/paper_list');

        }
        $re=PaperModel::find($id);
//        dd($re);
        return view('/admin/paperedit',compact('re'));
    }
    /**
     * 方法名  paperdel
     * 路由名  /admin/user/paper_del  get
     * 作用值  删除小纸条（单条删除）
     * 返回值  删除业务完后进重定向列表视图
     */
    public function paperdel($id)
    {
        $re=PaperModel::find($id);
        $re->delete();
        return redirect('/admin/user/paper_list');
    }
    /**
     * 方法名  feedbacklist
     * 路由名  /admin/user/feedback _list  get
     * 作用值  进入小纸条页面
     * 返回值  进入页面
     */
    public function feedbacklist()
    {
        $re=FeedModel::paginate(2);
        return view('/admin/feedback',compact('re'));
    }
    public function feedbackedit(Request $request,$id)
    {
        if ($request->isMethod('post')){
            $rules=array(
                'paperx'=>'required',
            );
            $mess=array(
                'paperx.required'=>'回应反馈内容不能为空',
            );
            $this->validate($request,$rules,$mess);
            $time=date('Y-m-d H:i:s');
            $name=session(('name'));
            $userimg='/images/offic.png';
            $re=new PaperModel();
            $re->userid=$request->userid;
            $re->paperx=$request->paperx;
            $re->paperb=$request->paperb;
            $re->papert=$time;
            $re->name=$name;
            $re->userimg=$userimg;
            $re->save();
            $feed=FeedModel::where('userid',$request->userid)->get();
            foreach ($feed as $v)
            {
                $v->is_feedback='1';
                $v->save();
            }

            return redirect('/admin/user/feedback_list');
        }
        $re=FeedModel::find($id);
        return view('/admin/feedbackedit',compact('re'));
    }
    public function manager(){
        $sort=advertising::paginate(5);
//        dd($sort);
        return view('/admin/manage',compact('sort'));

    }
    public function manageradd(){

        return view('/admin/manageadd');

    }
    public function manageraddd(Request $request)
    {
        //制作随机数
        $array = array_merge(range(1, 9), range('a', 'z'));
        $imgname = '';
        for ($i = 0; $i < 16; $i++) {
            $imgname .= $array[mt_rand(1, 34)];
        }

        //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
        $imgname = time().$imgname . '.jpg';

//        dd($request->img);
        $a=($request->toArray());
//        dd($request);
        $request->file('img')->move('write_image/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);

        $user=new advertising();
        $user->img= 'write_image/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;
        $user->nama=$request->nama;
        $user->body=$request->body;
        $user->ad=$request->ad;
        $user->save();
        return redirect('/admin/manage');


    }
    public function manageredit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
//            dd($id);
            $user=advertising::find($id);
            $user->nama=$request->nama;
            $user->body=$request->body;
            $user->ad=$request->ad;
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];

            }
            $imgname = time().$imgname . '.jpg';
            $request->file('img')->move('write_image/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user->img= 'write_image/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;

            $user->save();
            return redirect('/admin/manage');
        }else{
            $user=advertising::where('id',$id)->get();

            return view('/admin/manageedit')->with('user',$user);
        }
    }

    public function managerdel(Request $request){
        $id=$request->id;
        $a=advertising::where('id',$id)->delete();
        return redirect('/admin/manage');

    }

    public function managerdetails(){
        $sort=exhibitors::paginate(5);


        return view('/admin/managerdetails',compact('sort'));
    }

    public function managerdetailsadd(){

        return view('/admin/managerdetailsadd');

    }
    public function managerdetailsaddd(Request $request)
    {
        //制作随机数
        $array = array_merge(range(1, 9), range('a', 'z'));
        $imgname = '';
        for ($i = 0; $i < 16; $i++) {
            $imgname .= $array[mt_rand(1, 34)];
        }

        //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
        $imgname = time().$imgname . '.jpg';

//        dd($request->img);
        $a=($request->toArray());
//        dd($request);
        $time=date('Y-m-d') . '/' . date('H-i-s');
//        dd($time);
        $request->file('eimg')->move('write_image/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
        $user=new exhibitors();
        $user->eimg= 'write_image/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;
        $user->eid=$request->eid;
        $user->tit=$request->tit;
        $user->txt=$request->txt;
        $user->etime=$time;
        $user->save();
        return redirect('/admin/user/managerdetails');


    }
    public function managerdetailsedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
//            dd($id);
            $time=date('Y-m-d') . '/' . date('H-i-s');

            $user=exhibitors::find($id);

            $user->tit=$request->tit;
            $user->txt=$request->txt;
            $user->etime=$time;
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];

            }
            $imgname = time().$imgname . '.jpg';
            $request->file('eimg')->move('write_image/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user->eimg= 'write_image/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;

            $user->save();
            return redirect('/admin/user/managerdetails');

        }else{
            $user=exhibitors::where('id',$id)->get();

            return view('/admin/managerdetailsedit')->with('user',$user);
        }
    }
    public function managerdetailsdel(Request $request){
        $id=$request->id;
        $a=exhibitors::where('id',$id)->delete();
        return redirect('/admin/user/managerdetails');
    }

    //文字
    public function txtindex(){

        $sort= UserModel::Join('mytxt', 'y_user.id', '=', 'mytxt.userid')->paginate(5);

        return view('/admin/txt',compact('sort'));
    }
    public function txtadd(Request $request){
        if ($request->isMethod('post')){
//            dd($request->toArray());
            $id=$request->userid;
            $a=Mytxt::where('userid',$id)->select('icon','name')->get();
            foreach ($a as $k)
            {
                $icon=$k->icon;
                $name=$k->name;
            }
            $user=new Mytxt();
            $user->name=$name;
            $user->txtx=$request->txtx;
            $user->txtb=$request->txtb;
            $user->userid=$request->userid;
            $user->icon=$icon;
            $user->auditid =0;
            $user->auditto =0;
            date_default_timezone_set('Asia/Shanghai');
            $time = Carbon::now();
            $user->txtt=$time;
            $user->save();
            return redirect('/admin/user/txt');

        }
        else{
            return view('admin/txtadd');
        }
    }
    public function txtdel($id){
        $a=Mytxt::where('id',$id)->delete();
        return redirect('/admin/user/txt');
    }
    public function txtedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $a=Mytxt::where('id',$id)->select('userid','name','icon')->get();
            foreach ($a as $k)
            {
                $userid=$k->userid;
                $name=$k->name;
                $icon=$k->icon;
            }
//            dd($userid);
            date_default_timezone_set('Asia/Shanghai');
            $time = Carbon::now();
            $user=new Mytxt();
            $user->txtx=$request->txtx;
            $user->txtb=$request->txtb;
            $user->userid=$userid;
            $user->icon=$icon;
            $user->name=$name;
            $user->auditto=0;
            $user->auditid=0;
            $user->txtt=$time;
            $user->save();
            return redirect('/admin/user/txt');
        }else{

            $user=mytxt::where('id',$id)->get();
//            dd($user);
            return view('/admin/txtedit')->with('re',$user);


        }
    }
    //文字审核
    public function txtauditindex(){

        $sort= UserModel::where('auditto',0)->Join('mytxt', 'y_user.id', '=', 'mytxt.userid')->paginate(5);
//            dd($sort);
        return view('/admin/txtaudit',compact('sort'));
    }
    public function txtgod(){

        $sort= UserModel::where('auditto',1)->Join('mytxt', 'y_user.id', '=', 'mytxt.userid')->paginate(5);
//            dd($sort);
        return view('/admin/txtaudit',compact('sort'));
    }
    public function txton(){

        $sort= UserModel::where('auditto',2)->Join('mytxt', 'y_user.id', '=', 'mytxt.userid')->paginate(5);
//            dd($sort);
        return view('/admin/txtaudit',compact('sort'));
    }
    public function txtauditedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $a=Mytxt::where('id',$id)->find($id);
            $shm=session('name');
            $sh=$request->txtb;
            date_default_timezone_set('Asia/Shanghai');
            $time = Carbon::now();
            $a->auditto=$sh;
            $a->auditid= $shm;
            $a->txtt=$time;
            $a->save();
            return redirect('/admin/user/txtaudit');
        }else{

            $user=Mytxt::where('id',$id)->get();
//            dd($user);
            return view('/admin/txtauditedit')->with('re',$user);


        }
    }
    //友情链接管理
    public function linkindex(){
        $sort=link::paginate(5);
        return view('/admin/link',compact('sort'));


    }
    public function linkadd(Request $request){
        if ($request->isMethod('post')) {
            $user=new link();
            $user->name=$request->name;
            $user->url=$request->url;
            $user->save();
            return redirect('/admin/link');
        }else{
            return view('/admin/linkadd');
        }
    }
    public function linkdel($id){
        $user=link::where('id',$id)->delete();
        return redirect('/admin/link');
    }
    public function linkedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $user=link::find($id);

            $user->name=$request->name;
            $user->url=$request->url;
            $user->save();
            return redirect('/admin/link');
        }else{
            $re=link::where('id',$id)->get();
            return view('/admin/linkedit')->with('re',$re);
        }
    }
    //制作器管理
    public function zzq(){

        $sort=zzq::paginate(5);
//        dd($sort);
        return view('/admin/zzq',compact('sort'));
    }
    public function zzqadd(Request $request){
        if ($request->isMethod('post')) {

            $user=new zzq();
            $user->name=$request->name;
            $user->url=$request->url;
            $user->save();
            return redirect('/admin/user/zzq');
        }
        else {
            return view('/admin/zzqadd');
        }
    }
    public function zzqdel($id){
        $user=zzq::where('id',$id)->delete();
        return redirect('/admin/user/zzq');
    }
    public function zzqedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $user=zzq::find($id);
            $user->name=$request->name;
            $user->url=$request->url;
            $user->save();
            return redirect('/admin/user/zzq');
        }else{
            $re=zzq::where('id',$id)->get();
            return view('/admin/zzqedit')->with('re',$re);
        }
    }
    //轮播图
    public function lbt(){
        $sort=lbt::paginate(5);
        return view('/admin/lbt',compact('sort'));
    }
    public function lbtadd(Request $request){
        if($request->isMethod('post')){
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];
            }
            //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
            $imgname = time().$imgname . '.jpg';
            $time=date('Y-m-d') . '/' . date('H-i-s');
//            dd($request->file('img'));
            $request->file('img')->move('yimg/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user=new lbt();
            $user->img= 'yimg/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;
            $user->save();
            return redirect('/admin/user/lbt');
        }else{
            return view('/admin/lbtadd');
        }
    }
    public function lbtdel($id){
        $user=lbt::where('id',$id)->delete();
        return redirect('/admin/user/lbt');
    }
    public function lbtedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $time=date('Y-m-d') . '/' . date('H-i-s');
            $user=lbt::find($id);
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];

            }
            $imgname = time().$imgname . '.jpg';
            $request->file('img')->move('yimg/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user->img= 'yimg/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;

            $user->save();
            return redirect('/admin/user/lbt');
        }else{
            $re=lbt::where('id',$id)->get();
            return view('/admin/lbtedit')->with('user',$re);
        }
    }
//暴走app管理
    public function bao(){
        $sort=bao::paginate(5);
        return view('/admin/bao',compact('sort'));
    }
    public function baoadd(Request $request){
        if($request->isMethod('post')){
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];
            }
            //制作一个随机码 由时间戳 用户id 加上16位随机数(1~9+'a'~'z')
            $imgname = time().$imgname . '.jpg';
            $time=date('Y-m-d') . '/' . date('H-i-s');
//            dd($request->file('img'));
            $request->file('img')->move('yimg/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user=new bao();
            $user->name=$request->name;
            $user->img= 'yimg/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;
            $user->save();
            return redirect('/admin/user/bao');
        }else{
            return view('/admin/baoadd');
        }
    }
    public function baodel($id){
        $user=bao::where('id',$id)->delete();
        return redirect('/admin/user/bao');
    }
    public function baoedit(Request $request){
        $id=$request->id;
        if ($request->isMethod('post')) {
            $time=date('Y-m-d') . '/' . date('H-i-s');
            $user=bao::find($id);
            //制作随机数
            $array = array_merge(range(1, 9), range('a', 'z'));
            $imgname = '';
            for ($i = 0; $i < 16; $i++) {
                $imgname .= $array[mt_rand(1, 34)];

            }
            $imgname = time().$imgname . '.jpg';
            $request->file('img')->move('yimg/' . date('Y-m-d') . '/' . date('H-i-s'), $imgname);
            $user->img= 'yimg/' . date('Y-m-d') . '/' . date('H-i-s') . '/' . $imgname;
            $user->name=$request->name;
            $user->save();
            return redirect('/admin/user/bao');
        }else{
            $re=bao::where('id',$id)->get();
            return view('/admin/baoedit')->with('user',$re);
        }
    }
}
