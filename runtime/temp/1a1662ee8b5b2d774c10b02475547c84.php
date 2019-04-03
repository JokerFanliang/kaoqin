<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"D:\phpStudy\PHPTutorial\WWW\wangying\public/../application/admin\view\outer\add.html";i:1536632056;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\head.html";i:1534821245;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\left.html";i:1536310276;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\foot.html";i:1534821326;}*/ ?>
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
            <li><a href="/admin/outer/index"><i class="manager"></i><em>外派人员</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Work/index"><i class="manager"></i><em>考勤</em></a></li>
        </ul>

<!--         <ul>
            <li><a href="/admin/Speech/index"><i class="manager"></i><em>语音识别</em></a></li>
        </ul> -->
<!--         <ul>
            <li><a href="/admin/Month/index"><i class="manager"></i><em>月报</em></a></li>
        </ul> -->
    </div>
</div>
<div id="dcMain">
    <!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>外派人员</strong> </div>   
    <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>添加外派人员</h3>
    <form action=""  method="post" id="form" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <td align="right">分公司名称</td>
                <td>
                    <input type="text" required name="company" size="40" class="inpMain" value="" />
                </td>
            </tr>
            <tr>
                <td align="right">姓名</td>
                <td>
                    <input type="text" required name="realname" size="40" class="inpMain" value="" />
                </td>
            </tr>
            <tr>
                <td align="right">岗位</td>
                <td>
                    <input type="text" required name="job" size="40" class="inpMain" value="" />
                </td>
            </tr>
            <tr>
                <td align="right">本地/外派</td>
                <td>
                    <select name="local" required>
                        <option value="本地">本地</option>
                        <option value="外派">外派</option>
                        <option value="出差">出差</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">外派时间</td>
                <td>
                    <input type="text" name="out_date" size="40" class="inpMain" value="" />
                </td>
            </tr>
            <tr>
                <td align="right">单休/双休</td>
                <td>
                    <select name="rest" required>
                        <option value="0">单休</option>
                        <option value="1">双休</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">上班时间</td>
                <td>
                    <select name="start" required>
                        <option value="0">8:00</option>
                        <option value="1">8:30</option>
                        <option value="2">9:00</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">下班时间</td>
                <td>
                    <select name="end" required>
                        <option value="0">5:30</option>
                        <option value="1">6:00</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right">备注</td>
                <td>
                    <input type="text" name="remark" size="40" class="inpMain" value="" />
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <div >
                        <input type="hidden" value="1" name="types">
                        <input type="submit" value="添加" class="btn sub">
                    </div>
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
<div class="clear"></div>
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