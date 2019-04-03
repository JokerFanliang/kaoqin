<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\phpStudy\PHPTutorial\WWW\kaoqin\public/../application/admin\view\work\index.html";i:1554219903;s:74:"D:\phpStudy\PHPTutorial\WWW\kaoqin\application\admin\view\public\head.html";i:1534821245;s:74:"D:\phpStudy\PHPTutorial\WWW\kaoqin\application\admin\view\public\left.html";i:1554207526;s:74:"D:\phpStudy\PHPTutorial\WWW\kaoqin\application\admin\view\public\foot.html";i:1534821326;}*/ ?>
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

        <ul>
            <li><a href="/admin/Work/index"><i class="manager"></i><em>考勤</em></a></li>
        </ul>

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
        考勤
    </h3>
    <div class="filter">
        <span>
            <form action="/admin/Work/import" method="post" enctype="multipart/form-data" id="import">
                <input type="file" required name="excel" class="excel">
                <input type="month" required name="month" class="month">
                <a class="btnGray submit" href="javascript::void(0)">导入</a>
            </form>
            <a class="btnGray" href="/admin/Work/sums">统计</a>
            <a class="btnGray" href="/admin/Work/export">导出</a>
            <a class="btnGray" href="/admin/Work/remove">数据清空</a>
        </span>
    </div>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <th align="center">序号</th>
                <th align="center">姓名</th>
                <th align="center">日期</th>
                <th align="center">时间</th>
                <th align="center">上班时间</th>
                <th align="center">下班时间</th>

            </tr>
            <?php $id=1;foreach($lists as $list): ?>
            <tr>
                <td align="center"><?php echo $id; ?></td>
                <td align="center"><?php echo $list->realname; ?></td>
                <td align="center"><?php echo $list->dates; ?></td>
                <td align="center"><?php echo $list->times; ?></td>
                <td align="center"><?php echo $list->start; ?></td>
                <td align="center"><?php echo $list->end; ?></td>
            </tr>
            <?php $id++;endforeach; ?>
         </table>

    </div>
</div>
<script>
    $(".submit").click(function(){
        var month=$(".month").val();
        var file=$(".excel").val();
        if(file==""){
            alert("请选择文件");
            return false;
        }
        if(month==""){
            alert("请先输入月份");
            return false;
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
