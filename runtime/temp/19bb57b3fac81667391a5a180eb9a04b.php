<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"D:\phpStudy\PHPTutorial\WWW\wangying\public/../application/admin\view\outer\index.html";i:1536632901;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\head.html";i:1534821245;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\left.html";i:1536802640;s:76:"D:\phpStudy\PHPTutorial\WWW\wangying\application\admin\view\public\foot.html";i:1534821326;}*/ ?>
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
        <ul>
            <li><a href="/admin/Leave/index"><i class="manager"></i><em>加班调休</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Chuchai/index"><i class="manager"></i><em>出差</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Qingjia/index"><i class="manager"></i><em>请假</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Waichu/index"><i class="manager"></i><em>外出</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Waiqin/index"><i class="manager"></i><em>外勤</em></a></li>
        </ul>

<!--         <ul>
            <li><a href="/admin/Speech/index"><i class="manager"></i><em>语音识别</em></a></li>
        </ul> -->
<!--         <ul>
            <li><a href="/admin/Month/index"><i class="manager"></i><em>月报</em></a></li>
        </ul> -->
    </div>
</div>
<script type="text/javascript">

    function del(id) {
        layer.confirm('确定要删除吗？',  function(){
            window.location.href="/admin/Outer/del?id="+id;
        });
    }
</script>
<div id="dcMain"><!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>Demo</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>
      <a href="/admin/Outer/add"  class="actionBtn">添加</a>
        外派人员
    </h3>
    <div class="filter">
        <form action="/admin/Outer/index" method="get">
            <select name="com">
                <option value="">请选择分公司</option>
                <option value="泾源">泾源县分公司</option>
                <option value="彭阳">彭阳县分公司</option>
                <option value="淳化">淳化县分公司</option>
                <option value="正宁">正宁县分公司</option>
                <option value="旬阳">旬阳县分公司</option>
                <option value="岚皋">岚皋县分公司</option>
                <option value="三原">三原县分公司</option>
                <option value="靖边">靖边县分公司</option>
                <option value="清涧">清涧县分公司</option>
            </select>
            <select name="local">
                <option value="">请选择本地/外派/出差</option>
                <option value="本地">本地</option>
                <option value="外派">外派</option>
                <option value="出差">出差</option>
            </select>
            <select name="rest">
                <option value="2">请选择单休/双休</option>
                <option value="0">单休</option>
                <option value="1">双休</option>
            </select>
        <input name="realname" type="text" class="inpMain" placeholder="查找姓名" value="" size="20" />
        <input name="submit" class="btnGray" type="submit" value="筛选" />
        </form>
        <span>
<!--             <form action="/admin/Demo/import" method="post" enctype="multipart/form-data" id="import">
                <input type="file" name="excel" class="excel">
                <input type="hidden" name="token" value="">
                <a class="btnGray submit" href="javascript::void(0)">导入</a>
            </form> -->
            <span class="btnGray">数量：<?php echo $count; ?></span>
        </span>
    </div>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <th width="30" align="center">编号</th>
                <th align="center">分公司名</th>
                <th align="center">姓名</th>
                <th align="center">岗位</th>
                <th align="center">本地/外派</th>
                <th align="center">外派时间</th>
                <th align="center">单休/双休</th>
                <th align="center">上班时间</th>
                <th align="center">备注</th>
                <th align="center">操作</th>
            </tr>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $list->id; ?></td>
                <td align="center"><?php echo $list->company; ?></td>
                <td align="center"><?php echo $list->realname; ?></td>
                <td align="center"><?php echo $list->job; ?></td>
                <td align="center"><?php echo $list->local; ?></td>
                <td align="center"><?php echo $list->out_date; ?></td>
                <td align="center"><?php echo $list->rest==1?"双休" : "单休"; ?></td>
                <td align="center"><?php echo $list->start==0?"8:00" : ($list->start==1 ? "8:30" : "9:00"); ?>-<?php echo $list->end==0?"5:30" : "6:00"; ?></td>
                <td align="center"><?php echo $list->remark; ?></td>
                <td align="center">
                  <a href="<?php echo url('Outer/edit'); ?>?id=<?php echo $list->id; ?>">编辑</a> |
                  <a href="javascript::void(0)" onclick="javascript:return del('<?php echo $list->id; ?>')">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
         </table>
    </div>
</div>
<script>
    $(".submit").click(function(){
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
