<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>我欲修仙，快乐齐天</title>

    <!-- Bootstrap -->
    <link href="{{url('/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href={{url("/images/bitbug_favicon.ico")}} type="image/x-icon" rel="icon">

    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{url('/js/jquery-1.8.3.min.js')}}"></script>
    <script >
    $(function(){
    $('.daidumap').click(function(){
    $('.map').slideToggle();
    });
    });
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    @section('head')
        @show
</head>
<body>
{{--地图--}}
<span id='daidumaps' class="daidumap" style="position: absolute;left:0;top:225px;margin-left:20px;border:6px solid #c4e3f3;border-radius:6px;padding:2px;cursor: pointer;">地图<span style="font-size:36px;" class="glyphicon glyphicon-map-marker"></span></span>
<div style="position: absolute;left:0;top:285px;display:none;z-index: 9;" class="map">
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
        <meta name="keywords" content="百度地图,百度地图API，百度地图自定义工具，百度地图所见即所得工具" />
        <meta name="description" content="百度地图API自定义地图，帮助用户在可视化操作下生成百度地图" />
        <title>百度地图API自定义地图</title>
        <!--引用百度地图API-->
        <style type="text/css">
            html,body{margin:0;padding:0;}
            .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
            .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    </head>

    <body>
    <!--百度地图容器-->
    <div style="width:290px;height:250px;border:#ccc solid 1px;" id="dituContent"></div>
    </body>
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上，并调整地图视野
            myGeo.getPoint("上海市静安区", function(point){
                if (point) {
                    map.centerAndZoom(point, 16);
                    map.addOverlay(new BMap.Marker(point));
                }
            });

            var myGeo = new BMap.Point(121.448122,31.29858);//定义一个中心点坐标
            map.centerAndZoom(myGeo,17);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
            map.addControl(ctrl_nav);
            //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }


        initMap();//创建和初始化地图
    </script>
    </html>
</div>
{{--end--}}
@section('body')


@show
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
</body>

</html>