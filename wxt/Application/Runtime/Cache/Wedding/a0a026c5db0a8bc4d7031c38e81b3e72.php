<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
	<title>应邀嘉宾</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	
	<link rel="stylesheet" href="/Public/Wedding/css/pages.css?t=321a" />
	 <script src="/Public/Wedding/js/require.js?t=123ssaa" data-main="/Public/Wedding/js/main"></script>
</head>
<body>
<div class="bod_cent">
	<div class="yyjb" id='target'>
		<section class="yyjb_top">
			<h4 class="c1a">应邀嘉宾</h4>
			<font class="d_ib">男方： <em><?php echo $man?></em> 人</font>
			<font class="d_ib">女方： <em><?php echo $men?></em> 人</font>
			<font class="d_ib">共： <em class="cff6582"><?php echo $count?></em> 人</font>
		</section>
		<section class="yyjb_cont">
			<div class="yyjb_cont_text bg_fff">
				<div class="yyjb_cont_a">
				 <?php foreach($guests as $guest): $num = 0; $desc = $guest['description']; preg_match('/\d+/',$desc,$arr); $num = (int)$arr[0]; $str = $desc.mb_split("（", $desc); ?>
					<div class="yyjb_cont_t clearfix">
						<div class="f_l">
							<var><?php echo $guest['name']?></var>共<font class="c1a"><?php echo $num?></font>人出席<br />
							<font class="bt">确认时间：<?php echo $guest['create_time']?></font>
						</div>
						<div class="f_r">
							<?php echo $str[0]?>
						</div>
					</div>
					<?php endforeach;?>	
				</div>
			</div>
			<div class="yyjb_cont_b t_al_c">
				(点击)上拉查看更多...
			</div>
		</section>
	</div>

</div>
</body>
</html>