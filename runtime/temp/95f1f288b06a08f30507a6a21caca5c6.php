<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"D:\phpStudy\PHPTutorial\WWW\wangying\public/../application/admin\view\week\index.html";i:1535512576;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\head.html";i:1534821245;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\left.html";i:1535511501;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\foot.html";i:1534821326;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>管理中心 - 网站管理员 </title>
    <meta name="Copyright" content="Douco Design." />
    <link rel="stylesheet" href="/static/extend/uploadimg/upImg.css" />
    <link rel="stylesheet" href="/static/admin/css/public.css">
    
    <script type="text/javascript" src="/static/admin/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/extend/uploadimg/upImg.js"></script>
    <script type="text/javascript" src="/static/admin/js/global.js"></script>
    <script type="text/javascript" src="/static/extend/layer/layer.js"></script>
    <script type="text/javascript" src="/static/extend/umeditor/ueditor.config.js" charset="utf-8" ></script>
    <script type="text/javascript" src="/static/extend/umeditor/ueditor.all.min.js" charset="utf-8" ></script>
    <script type="text/javascript" src="/static/extend/umeditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<?php $username=user("username")?>
<div id="dcWrap"> <div id="dcHead">
    <div id="head">
        <div class="logo"><a href="index.html"><!--<img src="images/dclogo.gif" alt="logo">-->
        </a></div>
        <div class="nav">
            <ul class="navRight">
                <li class="M noLeft"><a href="JavaScript:void(0);">您好,&nbsp;&nbsp;<?php echo $username; ?></a>
                </li>
                <li class="noRight"><a href="<?php echo url('Index/loginout'); ?>">安全退出</a></li>
            </ul>
        </div>
    </div>
</div></div>
<div id="dcLeft">
    <div id="menu">
        <ul>
            <li><a href="/admin/Admin/index"><i class="manager"></i><em>网站管理员</em></a></li>
        </ul>
<!--         <ul>
            <li><a href="/admin/Demo/index"><i class="manager"></i><em>demo</em></a></li>
        </ul> -->
        <ul>
            <li><a href="/admin/Daily/index"><i class="manager"></i><em>日报</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Week/index"><i class="manager"></i><em>周报</em></a></li>
        </ul>
<!--         <ul>
            <li><a href="/admin/Month/index"><i class="manager"></i><em>月报</em></a></li>
        </ul> -->
    </div>
</div>
<script type="text/javascript">

    function del(id) {
        layer.confirm('确定要删除吗？',  function(){
            window.location.href="/admin/Demo/del?id="+id;
        });
    }
</script>
<div id="dcMain"><!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>Demo</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>
      <!-- <a href="/admin/Demo/add"  class="actionBtn">添加</a> -->
        周报
    </h3>
    <div class="filter">
<!--         <form action="" method="post">
         <select name="cat_id">
          <option value="0">未分类</option>
                      <option value="1"> 电子数码</option>
                            <option value="4">- 智能手机</option>
                            <option value="5">- 平板电脑</option>
                            <option value="2"> 家居百货</option>
                            <option value="3"> 母婴用品</option>
                     </select>
         <input name="keyword" type="text" class="inpMain" value="" size="20" />
         <input name="submit" class="btnGray" type="submit" value="筛选" />
        </form> -->
        <span>
            <form action="/admin/Week/import" method="post" enctype="multipart/form-data" id="import">
                <input type="file" required name="excel" class="excel">
                <input type="hidden" name="token" value="">
                <a class="btnGray submit" href="javascript::void(0)">导入</a>
            </form>
            <a class="btnGray" href="/admin/Week/export">导出</a>
            <a class="btnGray" href="/admin/Week/remove">数据清空</a>
        </span>
    </div>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <th align="center">序号</th>
                <th align="center">工号</th>
                <th align="center">姓名</th>
                <th align="center">部门</th>
                <th align="center">次数</th>
<!--                 <th align="center">操作</th> -->
            </tr>
            <?php $id=1;if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $id; ?></td>
                <td align="center"><?php echo $list['number']; ?></td>
                <td align="center"><?php echo $list['realname']; ?></td>
                <td align="center"><?php echo $list['depart']; ?></td>
                <td align="center"><?php echo $list['count(*)']; ?></td>
<!--                 <td align="center">
                  <a href="<?php echo url('Daily/edit'); ?>?id=<?php echo $list['number']; ?>">查看详情</a>
                </td> -->
            </tr>
            <?php $id++;endforeach; endif; else: echo "" ;endif; ?>
         </table>

    </div>
</div>
<script>
    $(".submit").click(function(){
        var exc=$(".excel").value();
        if(exc==""){
            
        }
        $("#import").submit();
    })
</script>
<div class="clear"></div>
<div id="dcFooter">
    <div id="footer">
        <div class="line"></div>
        <ul>
            版权所有 ©2015  琼ICP备0000000000号。
        </ul>
    </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>