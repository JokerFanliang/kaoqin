<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\public/../application/admin\view\demo\index.html";i:1534821315;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\head.html";i:1534821245;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\left.html";i:1534818527;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\foot.html";i:1534821326;}*/ ?>
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
            <li><a href="/admin/Demo/index"><i class="manager"></i><em>demo</em></a></li>
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
      <a href="/admin/Demo/add"  class="actionBtn">添加</a>
        Demo
    </h3>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <th width="30" align="center">编号</th>
                <th align="center">标题</th>
                <th align="center">图片</th>
                <th align="center">内容</th>
                <th align="center">添加时间</th>
                <th align="center">操作</th>
            </tr>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $list->id; ?></td>
                <td align="center"><?php echo $list->title; ?></td>
                <td align="center">
                  <img src="/static<?php echo $list->img; ?>" width="100px">
                </td>
                <?php
                    $string = $list->content;
                    //把一些预定义的 HTML 实体转换为字符
                    $html_string = htmlspecialchars_decode($string);
                    //将空格替换成空
                    $content = str_replace(" ", "", $html_string);
                    //函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
                    $contents = strip_tags($content);
                         
                    //返回字符串中的前80字符串长度的字符
                    $content = mb_substr($contents, 0, 30, "utf-8");
                ?>
                <td align="center"><?php echo $content; ?>...</td>
                <td align="center"><?php echo $list->create_time; ?></td>
                <td align="center">
                  <a href="<?php echo url('Demo/edit'); ?>?id=<?php echo $list->id; ?>">编辑</a> |
                  <a href="javascript::void(0)" onclick="javascript:return del('<?php echo $list->id; ?>')">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
         </table>
         <?php echo $lists->render(); ?>
    </div>
</div>
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
