<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\public/../application/index\view\index\index.html";i:1534237691;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\index\view\Public\head.html";i:1534240448;s:81:"D:\huanjing\phpStudy\PHPTutorial\WWW\demo\application\index\view\Public\foot.html";i:1534225523;}*/ ?>
			<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>旬阳电子商务服务中心</title>
		<link rel="stylesheet" href="/static/index/css/recss.css"  />
		<link rel="stylesheet" type="text/css" href="/static/index/css/index.css" />
		<link rel="stylesheet" type="text/css" href="/static/index/css/navAll.css" />
	</head>

	<body>
		<?php $title=getTitle();?>
		<div id="mainBox">
			<!-- 公用头部 开始-->
			<div class="centerBox top clear">
				<div class="logoBox left">
					<img src="/static/index/images/logo.png" alt="" />
				</div>
				<div class="nav clear over">
					<a href="/index/Index/index" class="<?php if($title=='head')echo 'active';?>">首页</a>
					<a href="/index/About/index" class="<?php if($title=='about')echo 'active';?>">关于旬阳</a>
					<a href="/index/Notify/schedule" class="<?php if($title=='schedule')echo 'active';?>">项目进度</a>
					<a href="/index/Notify/product" class="<?php if($title=='product')echo 'active';?>">产品展示</a>
					<a href="/index/Network/index" class="<?php if($title=='network')echo 'active';?>">电商服务网点</a>
					<a href="/index/Notify/village" class="<?php if($title=='village')echo 'active';?>">村站展示</a>
					<a href="/index/Notify/company" class="<?php if($title=='company')echo 'active';?>">电商企业展示</a>
					<a href="/index/Notify/policy" class="<?php if($title=='policy')echo 'active';?>">政策法规</a>
					<a href="/index/Notify/train" class="<?php if($title=='train')echo 'active';?>">电商培训</a>
					<a href="/index/Logistics/index" class="<?php if($title=='logistics')echo 'active';?>">物流介绍</a>
					<a href="/index/Contact/index" class="<?php if($title=='contact')echo 'active';?>">联系我们</a>
				</div>
			</div>
			<div class="bannerBox">
				<div class="banner">
					<?php $system=getSystem();?>
					<div class="device clearfix">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<img src="/static<?php echo $system->head1; ?>" class="img-responsive" width="100%">
								</div>
								<div class="swiper-slide">
									<img src="/static<?php echo $system->head2; ?>" class="img-responsive" width="100%">
								</div>
							</div>
						</div>
						<div class="pagination"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="floor-2">
				<div class="centerBox clear">
					<div class="left pd-20 box-50">
						<p class="font-28 bTitle">ABOUT US</p>
						<div class="clear">
							<p class="left fs-18">关于旬阳</p>
							<a href="/index/About/index" class="more right fs-14">更多 +</a>
						</div>
						<div class="aboutImgBox">
							<img src="/static<?php echo $about->img1; ?>" alt="" />
						</div>
						<?php
							$string = $about->content1;
							//把一些预定义的 HTML 实体转换为字符
							$html_string = htmlspecialchars_decode($string);
							//将空格替换成空
							$content = str_replace(" ", "", $html_string);
							//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
							$contents = strip_tags($content);
							 
							//返回字符串中的前80字符串长度的字符
							$content = mb_substr($contents, 0, 180, "utf-8");
						?>
						<div class="aboutText fs-14">
							<?php echo $content; ?>...
						</div>
					</div>
					<div class="left pd-20 box-50">
						<p class="font-28 bTitle">Project progress</p>
						<div class="clear">
							<p class="left fs-18">项目进度</p>
							<a href="/index/Notify/schedule" class="more right fs-14">更多 +</a>
						</div>
						<div class="projectMainBox1">
							<!-- 循环壳子 -->
							<?php foreach($schedules as $schedule): ?>
							<div class="clear proBox">
								<a href="/index/Notify/schedule_detail?id=<?php echo $schedule->id; ?>">
									<div class="projectTimeBox left">
										<?php 
											$date=$schedule->create_time;
											$mon=substr($date,0,7);
											$day=substr($date,8,2);
										?>
										<p class="proDay fs-42"><?php echo $day; ?></p>
										<p class="fs-14"><?php echo $mon; ?></p>
									</div>
									<div class="proTextBox">
										<div class="proTitle shenglue fs-18">
											<?php echo $schedule->title; ?>
										</div>
										<?php
											$string = $schedule->content;
											//把一些预定义的 HTML 实体转换为字符
											$html_string = htmlspecialchars_decode($string);
											//将空格替换成空
											$content = str_replace(" ", "", $html_string);
											//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
											$contents = strip_tags($content);
											 
											//返回字符串中的前80字符串长度的字符
											$content = mb_substr($contents, 0, 100, "utf-8");
										?>
										<div class="proMsg shenglue fs-14">
											<?php echo $content; ?>
										</div>
									</div>
								</a>
							</div>
							<?php endforeach; ?>
							<!-- 循环壳子 -->

						</div>
					</div>
				</div>
			</div>
			<div class="floor-3">
				<div class="pd-20 tac villageTitleBox">
					<p class="fs-32 ">村站展示</p>
					<p class="fs-18 pd-20">VILLAGE STATION</p>
				</div>
				<div class="villageMainBox clear" style="width:auto;">
					<div class="villageleftBox left">
						<!-- 左边上下两张图-->
						<div class="LeftUpImgBox">
							<?php if(isset($villages[0])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[0]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[0]->img; ?>" alt="" />
								<div class="posTextBg fs-28">
									<div class="posText">
										<?php echo $villages[0]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
						<div class="leftDownImgBox">
							<?php if(isset($villages[1])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[1]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[1]->img; ?>" alt="" />
								<div class="posTextBg fs-28">
									<div class="posText">
										<?php echo $villages[1]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="villageMidBox left">
						<div class="clear midUpImgsBox">
							<div class="midUpLeftImgMainBox midUpImgMainBox left">
								<div class="midUpImgBox">
									<?php if(isset($villages[2])): ?>
									<a href="/index/Notify/village_detail?id=<?php echo $villages[2]->id; ?>" class="posTextBox">
										<img src="/static<?php echo $villages[2]->img; ?>" alt="" />
										<div class="posTextBg fs-20">
											<div class="posText">
												<?php echo $villages[2]->title; ?>
											</div>
										</div>
									</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="midUpRightImgMainBox midUpImgMainBox left">
								<div class="midUpImgBox">
									<?php if(isset($villages[3])): ?>
									<a href="/index/Notify/village_detail?id=<?php echo $villages[3]->id; ?>" class="posTextBox">
										<img src="/static<?php echo $villages[3]->img; ?>" alt="" />
										<div class="posTextBg fs-20">
											<div class="posText">
												<?php echo $villages[3]->title; ?>
											</div>
										</div>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="midDownImgBox">
							<?php if(isset($villages[4])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[4]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[4]->img; ?>" alt="" />
								<div class="posTextBg fs-42">
									<div class="posText">
										<?php echo $villages[4]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="villageRightBox left">
						<div class="rightImgBox">
							<?php if(isset($villages[5])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[5]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[5]->img; ?>" alt="" />
								<div class="posTextBg fs-24">
									<div class="posText">
										<?php echo $villages[5]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
						<div class="rightImgBox rightMidImgBox">
							<?php if(isset($villages[6])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[6]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[6]->img; ?>" alt="" />
								<div class="posTextBg fs-24">
									<div class="posText">
										<?php echo $villages[6]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
						<div class="rightImgBox">
							<?php if(isset($villages[7])): ?>
							<a href="/index/Notify/village_detail?id=<?php echo $villages[7]->id; ?>" class="posTextBox">
								<img src="/static<?php echo $villages[7]->img; ?>" alt="" />
								<div class="posTextBg fs-24">
									<div class="posText">
										<?php echo $villages[7]->title; ?>
									</div>
								</div>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<a href="/index/Notify/village" class="villageMore">查看更多</a>
			</div>
			<div class="floor-4">
				<div class="pd-20 tac qiyeTitleBox">
					<p class="fs-32 ">电商企业展示</p>
					<p class="fs-18 pd-20">ELECTRIC BUSINESS ENTERPRISE DISPLAY</p>
				</div>
				<div class="dsBannerMainBox clear">
					<div class="dsBigBannerBox left">
						<?php if(isset($companys[0])): ?>
						<a href="/index/Notify/company_detail?id=<?php echo $companys[0]->id; ?>">
							<img src="/static<?php echo $companys[0]->img; ?>" alt="" />
							<div class="dsBannerTextBox">
								<p class="dsBannerText"><?php echo $companys[0]->title; ?></p>
							</div>
						</a>
						<?php endif; ?>
					</div>
					<div class="dsRightBannerBox left">
						<div class="dsPrevBtn">
							<p class="dsPrevDisableText">没有更多内容了</p>
							<div class="icon dsPrevIcon"></div>
						</div>
						<div class="dsBannerPosBox">
							<div class="dsBannerBox">
								<?php foreach($companys as $company): ?>
								<div class="dsBannerImgBox" onclick="comp('<?php echo $company->id; ?>')">
									<img src="/static<?php echo $company->img; ?>" alt="" />
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="dsNextBtn">
							<p class="dsNextDisableText">没有更多内容了</p>
							<div class="icon dsNextIcon"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="floor-5">
				<div class="pd-20 tac qiyeTitleBox">
					<p class="fs-32 ">便民服务</p>
					<p class="fs-18 pd-20">ELECTRIC BUSINESS ENTERPRISE DISPLAY</p>
				</div>
				<div class="fuwuNavBox clear">
					<a href="https://jiaofei.alipay.com/jiaofei.htm?_pdType=aecfbbfgeabbifdfdieh&_scType=bacfajegafdd" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon ranqiIcon"></b>
							</dt>
							<dd class="fs-14">水电燃气</dd>
						</dl>
					</a>
					<a href="https://www.baifubao.com/?from=pdc" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon phonIcon"></b>
							</dt>
							<dd class="fs-14">手机充值</dd>
						</dl>
					</a>
					<a href="http://www.118114.cn/vip/login.jsp" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon telIcon"></b>
							</dt>
							<dd class="fs-14">电话查询</dd>
						</dl>
					</a>
					<a href="http://www.weather.com.cn/" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon tianqiIcon"></b>
							</dt>
							<dd class="fs-14">天气查询</dd>
						</dl>
					</a>
					<a href="http://sn.122.gov.cn/" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon jiaotongIcon"></b>
							</dt>
							<dd class="fs-14">交通违规</dd>
						</dl>
					</a>
					<a href="https://map.baidu.com/" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon busIcon"></b>
							</dt>
							<dd class="fs-14">公交查询</dd>
						</dl>
					</a>
					<a href="http://www.12306.cn/mormhweb/" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon trainIcon"></b>
							</dt>
							<dd class="fs-14">车票购买</dd>
						</dl>
					</a>
					<a href="http://www.kuaidi100.com/" target="_blank">
						<dl>
							<dt>
								<b class="icon fuwuNavicon wuliuIcon"></b>
							</dt>
							<dd class="fs-14">物流配送</dd>
						</dl>
					</a>
				</div>
			</div>
						<div class="foot">
				<div class="footNavBox centerBox clear">
					<a href="/index/Index/index">首页</a>
					<a href="/index/About/index">关于旬阳</a>
					<a href="/index/Notify/schedule">项目进度</a>
					<a href="/index/Network/index">电商服务网点</a>
					<a href="/index/Notify/village">村站展示</a>
					<a href="/index/Notify/company">电商企业展示</a>
					<a href="/index/Notify/policy">政策法规</a>
					<a href="/index/Notify/train">电商培训</a>
					<a href="/index/Logistics/index">物流介绍</a>
					<a href="/index/Contact/index">联系我们</a>
				</div>
				<div class="centerBox banquan">
					陕西畅通网络科技有限公司 版权所有 @2015, CT.com Inc. 陕ICP备16017871号
				</div>
			</div>
			<!-- 公用底部 结束 -->

		</div>
		<script src="/static/index/js/jquery-1.11.3.js"></script>
		<script src="/static/index/js/jquery.SuperSlide.2.1.1.js"></script>
		<script src="/static/index/js/idangerous.swiper.min.js"></script>
		<script type="text/javascript">
			$(function() {
				mySwiper = new Swiper('.swiper-container', {
					pagination: '.pagination',
					loop: true, //循环模式  是/否
					grabCursor: true, //光标属性   当为true时，光标移动到banner上变成手掌的样式
					paginationClickable: false, //生成分页控件
					calculateHeight: true, //响应式容器高度
					autoplay: 5000 //过度时间
				});
			})
		</script>
		<script src="/static/index/js/index.js" type="text/javascript" charset="utf-8"></script>
	</body>

</html>
			<script>
				function comp(id){
					$.ajax({ 
		                type : "get", //提交方式 
		                url : "/index/Notify/getById?id="+id, 
		                success : function(flag) { 
		                    var res=flag.res;
		                    $(".dsBigBannerBox .dsBannerText").html(res.title);
		                    $(".dsBigBannerBox a").attr('href','/index/Notify/company_detail?id='+res.id);
		                    $(".dsBigBannerBox img").attr('src','/static'+res.img);
		                    
		                } 
	            	}); 
				}
			</script>