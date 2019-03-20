<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"D:\mywork\lotgame\public/../app/admin\view\userlog\index.html";i:1553088615;s:49:"D:\mywork\lotgame\app\admin\view\public\foot.html";i:1553088615;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/static/public/layui/css/layui.css"  media="all">
  <link rel="stylesheet" href="/static/public/font-awesome/css/font-awesome.min.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/admin.css"  media="all">
  <style type="text/css">

/* tooltip */
#tooltip{
  position:absolute;
  border:1px solid #ccc;
  background:#333;
  padding:2px;
  display:none;
  color:#fff;
}
</style>
</head>
<body style="padding:10px;">
  <div class="tplay-body-div">
    <div class="layui-tab">
      <ul class="layui-tab-title">
        <li class="layui-this">用户日志管理</li>
        <!-- <li><a href="<?php echo url('admin/userquestion/publish'); ?>" class="a_menu">创建/修改工单</a></li> -->
      </ul>
    </div> 
      <form class="layui-form serch" action="<?php echo url('admin/userlog/index'); ?>" method="post">
        <div class="layui-form-item" style="float: left;">
          <div class="layui-input-inline">
            <input type="text" name="keywords"  autocomplete="off" placeholder="请输入关键词" class="layui-input layui-btn-sm">
          </div>
          
          <div class="layui-input-inline">
            <input type="text" name="user_id"  autocomplete="off" placeholder="请输入UID" class="layui-input layui-btn-sm">
          </div>

          <div class="layui-input-inline">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" class="layui-input" id="create_time" placeholder="开始时间" name="begin_time">
              </div>
            </div>
          </div>

          <div class="layui-input-inline">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" class="layui-input" id="end_time" placeholder="结束时间" name="end_time">
              </div>
            </div>
          </div>
          <button class="layui-btn layui-btn-primary layui-btn-sm" lay-submit="" lay-filter="serch">查询</button>
        </div>
      </form> 
    <table class="layui-table" lay-size="sm">
      <colgroup>
        <col width="100">
        <col width="200">
        <col width="100">
        <col width="150">
        <col width="100">
        <col width="100">
      </colgroup>
      <thead>
        <tr>
          <th>时间</th>
          <th>用户</th>
          <th>日志</th>
          <th>金币</th>
          <th>经验</th>
          <th>余额</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($userlogs) || $userlogs instanceof \think\Collection || $userlogs instanceof \think\Paginator): $i = 0; $__LIST__ = $userlogs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
          <td><?php echo $vo['create_time']; ?></td>
          <td><?php echo $vo['user']['username']; ?><?php echo $vo['user_id']; ?></td>
          <td><?php echo $vo['desc']; ?></td>
          <td><?php echo $vo['user']['coin']; ?></td>
          <td><?php echo $vo['user']['experiments']; ?></td>
          <td><?php echo $vo['user']['coin']+$vo['user']['bank']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    <div style="padding:0 20px;"><?php echo $userlogs->render(); ?></div> 
        <script src="/static/public/layui/layui.js" charset="utf-8"></script>
    <script src="/static/public/jquery/jquery.min.js"></script>
    <script>
            // var message;
        layui.config({
            base: '/static/admin/js/',
            version: '1.0.1'
        }).use(['app', 'message','laydate'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer,
                //将message设置为全局以便子页面调用
                message = layui.message,
                laydate = layui.laydate;
            //主入口
            app.set({
                type: 'iframe'
            }).init();


            laydate.render({
              elem: '#create_time'
            });

            laydate.render({
              elem: '#begin_time'
            });

            laydate.render({
              elem: '#end_time'
            });

        });
        
        
    </script> 
    <script type="text/javascript">
    $(function(){
      var x = 10;
      var y = 20;
      $(".tooltip").mouseover(function(e){ 
        var tooltip = "<div id='tooltip'><img src='"+ this.href +"' alt='产品预览图' height='200'/>"+"<\/div>"; //创建 div 元素
        $("body").append(tooltip);  //把它追加到文档中             
        $("#tooltip")
          .css({
            "top": (e.pageY+y) + "px",
            "left":  (e.pageX+x)  + "px"
          }).show("fast");    //设置x坐标和y坐标，并且显示
        }).mouseout(function(){  
        $("#tooltip").remove();  //移除 
        }).mousemove(function(e){
        $("#tooltip")
          .css({
            "top": (e.pageY+y) + "px",
            "left":  (e.pageX+x)  + "px"
          });
      });
    })
    </script>
    <script type="text/javascript">
    $('.a_menu').click(function(){
      var url = $(this).attr('href');
      var id = $(this).attr('id');
      var a = true;
      if(id) {
        $.ajax({
          url:url
          ,async:false
          ,data:{id:id}
          ,success:function(res){
            if(res.code == 0) {
              layer.msg(res.msg);
              a = false;
            }
          }
        })
      } else {
        $.ajax({
          url:url
          ,async:false
          ,success:function(res){
            if(res.code == 0) {
              layer.msg(res.msg);
              a = false;
            }
          }
        })
      }
      return a;
    })
    </script>


  </div>
</body>
</html>
