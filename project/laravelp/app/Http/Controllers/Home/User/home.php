<?php
namespace App\Http\Controllers\Home\User;

use App\Http\Requests\Home\UserInfo;
use App\Http\Requests\Home\UserLogin;
use App\Http\Requests\Home\UserRegist;
use App\Model\advertising;
use App\Model\attention;
use App\Model\CUST;
use App\Model\exhibitors;
use App\Model\Home\Mytxt;
use App\Model\InforModel;
use App\Model\link;
use App\Model\sort;
use App\Model\User;
use App\Model\UserModel;
use App\Model\zan;
use App\Model\zzq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Mockery\Test\Generator\StringManipulation\Pass\InterfacePassTest;


class home extends Controller
{

    public function index()
    {

        return redirect('home/user/txtx');
    }
    //发布表
    public function ajax(Request $request)
    {
        $id = Auth::id();
        $re=UserModel::find($id);

        $name=$re->name;

        $a = $request->all();

        //频道
        $b = $request['pd'];
        $e = $request['nr'];
//        dump($e);
        switch ($b) {
            case 'volvo' :
                $c = '暴走漫画';
                break;
            case 'saab' :
                $c = 'GIF怪兽';
                break;
            case 'opel' :
                $c = '神吐槽';
                break;
            case 'audi' :
                $c = '脑残对话';
                break;
        }
        date_default_timezone_set('Asia/Shanghai');
        $time = Carbon::now();
//        echo $time;
        if ($c == '神吐槽' || $c == '脑残对话') {
            //评论

            $cs=InforModel::find($id);
            $icon=$cs->icon;

            $comment = new Mytxt();
            $comment->userid = $id;  //1
            $comment->icon=$icon;
            $comment->txtx = $e;     //1
            $comment->txtt = $time;

            $comment->txtb = $c;
            $comment->auditid = 0;  //1
            $comment->auditto = 0;  //1
            $comment->name=$name;
            $comment->save();
//            dump($c);
        }
        return redirect('home/user/txt');
    }
    //刚开始传数据
    public function cs()
    {

        $id = Auth::id();


        if (empty($id)) {
            $sort=sort::all();
            $zzq=zzq::all();

            $result = mytxt::where('auditto',1)->get();
            $b=advertising::get();
            return view('home/user/txt')->with('comment', $result)
                ->with('ad',$b)->with('sort',$sort)->with('zzq',$zzq);
        } else {
            $comment=mytxt::where('auditto',1)->get();
//            dd($comment);

            $b=advertising::get();
            $zzq=zzq::all();
            $sort=sort::all();
            return view('home/user/txt', compact('comment'))
                ->with('ad',$b)->with('sort',$sort)->with('zzq',$zzq);

        }
    }
    //最新表更改
    public function latest()
    {
        $result =mytxt::
            orderBy('txtt', 'desc')
            ->LeftJoin(
                'attention', 'mytxt.userid', '=', 'attention.uid'
            )->LeftJoin('y_user', 'mytxt.userid', '=', 'y_user.id')
            ->get();

//        $result=user::groupBy('time','desc')->get();
//        dump($result);

        return view('home/user/txt')->with('comment',$result);
    }
    //关注
    public function guan(Request $request)
    {

        $id=Auth::id();

        $user=new attention();
        $user->gid=$request->zid;
        $user->uid=$id;
        $user->save();
        return 1;
    }
    //取消关注
    public function buguan(Request $request)
    {

        $id=Auth::id();
        $gid=$request->zid;
       $user=attention::where('gid',$gid)
                        ->where('uid',$id)
                       ->delete();
                echo json_encode($gid);
    }
    //点赞
    public function zan(Request $request){
        $id=Auth::id();
        $gid=$request->zid;
        $c=zan::select(['bad'])->where('gid',$gid)->where('bad',1)->count();
//        if($c>0){
//
//             echo json_encode(('你已经赞过了'));
//        }else{
        $zan=new zan();
        $zan->uid=$id;
        $zan->gid=$gid;
        $zan->good=1;
        $zan->save();
        $a=zan::select(['good'])->where('gid',$gid)->where('good',1)->count();
//        dd($a);

            $arr=array(
                'zs'=>$a,'yh'=>$gid,'as'=>$c,'uh'=>$gid
            );
       echo json_encode($arr);
//        }
    }
    //取消赞
    public function quzan(Request $request){
        $id=Auth::id();
        $gid=$request->zid;
        $c=zan::select(['good'])->where('gid',$gid)->where('good',1)->count();


        $zan=new zan();
        $zan->uid=$id;
        $zan->gid=$gid;
        $zan->bad=1;
        $zan->save();

        $a=zan::select(['bad'])->where('gid',$gid)->where('bad',1)->count();
//        dd($a);

        $arr=array(
            'zs'=>$a,'yh'=>$gid,'as'=>$c,'uh'=>$gid
        );
        echo json_encode($arr);

    }
    //关注初始化加载事件
    public function lod()
    {
        $id=Auth::id();
        $commentt=attention::where('uid',$id)->get();

            foreach ($commentt as $v){
                $gidd[]=$v->gid;
            }

        if (!empty($gidd)){

            return $gidd;
        }
        return 0;
    }
    //订阅
    public function dinglod()
    {
        $id=Auth::id();
        $commentt=CUST::where('cid',$id)->get();

        foreach ($commentt as $v){
            $gidd[]=$v->aid;
        }
//            dd($gidd);
        if (!empty($gidd)){

            return $gidd;
        }
        return 0;
    }
    public function ding(Request $request){
        $id=Auth::id();
        $user=new CUST();
        $user->aid=$request->zid;
        $user->cid=$id;
        $user->save();

        return 1;
    }
    public function buding(Request $request){
        $id=Auth::id();
        $gid=$request->zid;
        $user=CUST::where('aid',$gid)
            ->where('cid',$id)
            ->delete();
        echo json_encode($gid);
    }
    //订阅先放着
    public function yue($id)
    {

        $soft=sort::all();
        $ad=advertising::all();
        $advertsing=advertising::where('id',$id)->get();
        $zzq=zzq::all();
        $link=link::all();
        $a=exhibitors::where('eid',$id)->get()->toArray();

        $b=advertising::where('id',$id)->get()->toArray();

//        $phone = exhibitors::find($id)->advertising;
        $comment=exhibitors::join('advertising','exhibitors.eid','advertising.id')->
            where('eid',$id)->get();
//        dd($comment);
        return view('home/user/dingyue')->with('sort',$soft)->with('advertsing',$advertsing)->with('comment',$comment)
            ->with('ad',$ad)->with('zzq',$zzq)->with('link',$link);
    }



//订阅
    public function baoindex()
    {

        return redirect('home/user/bao/man');
    }
    public function baoman(){
        $id=Auth::id();

//        $userinfo=InforModel::find($id);
        $sort=sort::all();
        return view('home/user/bao')->with('sort',$sort);
//        ,compact('userinfo'));

    }

//全部作者
public function author(){
//            $comm=Mytxt::select('userid','name','icon')->distinct()
//                ->get();
    $comm=Mytxt::select('userid','name','icon')->distinct()
               ->get();
    $sort=sort::all();
        return view('/home/user/author',compact('sort'))->with('comment',$comm);
}
}