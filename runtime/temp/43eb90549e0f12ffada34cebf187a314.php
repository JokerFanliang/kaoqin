<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\public/../application/admin\view\schedule\add.html";i:1534293439;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\head.html";i:1534816280;s:83:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\header.html";i:1531461965;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\left.html";i:1534816386;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\admin\view\public\foot.html";i:1531447133;}*/ ?>
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
         <ul>
            <li><a href="/admin/Schedule/index"><i class="manager"></i><em>项目进度</em></a></li>
            <li><a href="/admin/Product/index"><i class="manager"></i><em>产品展示</em></a></li>
            <li><a href="/admin/Village/index"><i class="manager"></i><em>村站展示</em></a></li>
            <li><a href="/admin/Company/index"><i class="manager"></i><em>电商企业展示</em></a></li>
            <li><a href="/admin/Policy/index"><i class="manager"></i><em>政策法规</em></a></li>
            <li><a href="/admin/Train/index"><i class="manager"></i><em>电商培训</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/About/index"><i class="manager"></i><em>关于旬阳</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Logistics/index"><i class="manager"></i><em>物流介绍</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/Contact/index"><i class="manager"></i><em>联系我们</em></a></li>
        </ul>
        <ul>
            <li><a href="/admin/System/index"><i class="manager"></i><em>图片配置</em></a></li>
        </ul>
    </div>
</div>
<div id="dcMain">
    <!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>项目进度</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>添加进度</h3>
    <form action=""  method="post" id="form" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <td align="right">标题</td>
                <td>
                    <input type="text" required name="title" size="40" class="inpMain" value="" />
                </td>
            </tr>
            <tr>
                <td width="100" align="right">图片</td>
                <td>
                    <div id="upImgBox" class="clear">
                        <label class="left" for="jbImg">图片上传</label>
                        <div class="left upImgBox">
                            <div class="left imgTishi">(尺寸：400*235)</div>
                            <div class="upImgBox">
                                <div class="upImgInputBox clear">
                                    <div class="upImgInput left">
                                        <div class="imgCloseIcon">&times;</div>
                                        <div class="upImgLabBox">
                                            <label for="tupian-1" class="upImgLab"></label>
                                            <input type="file" required name="img" class="inputText" id="tupian-1" accept="image/jpeg,image/gif,image/png" />
                                        </div>
                                        <div class="upImg">
                                            <img src="" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">内容</td>
                <td>
                    <input type="hidden" name="content" class="content">
                    <script id="editor" type="text/plain" style="width:1024px;height:300px;"></script>
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
<script>
    var upImgSrc=$('#upImgBox').find(".upImg>img");
    $.each(upImgSrc,function(i,e){
        if($(e).attr('src')!=""){
            // alert($(this).parent().prve().attr('class'));
            $(this).parent().show();
            $(this).parent().prev().hide();
            $(this).parent().prev().prev().show();
                
        }
    })
    //实例化编辑器
    var ue = UE.getEditor('editor');
    $(".sub").click(function(){
        var arr = [];
        arr.push(UE.getEditor('editor').getContent());
        var text=arr.join("\n");                
        $(".content").val(text);
        $("#form").submit();
    })
</script>
</body>
</html>