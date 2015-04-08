<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
	<title>制作—模版</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	
	<link rel="stylesheet" href="/public/Wedding/css/pages.css?t=123a2a" />
	 <script src="/public/Wedding/js/require.js" data-main="/public/Wedding/js/main"></script>
</head>
<body>
<div class="bod_cent">
	<div class="emp5"></div>
	<table class="zz_mb">
	<?php foreach($templates as $key=>$template):?>
	<?php if($key%3==0){?>
		<tr>
	<?php }?>
			<td>
				<img src="<?php echo $template['url']; ?>" alt="">
				<div class="theme_tit p_a t_al_c">
					<span data-id="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></span>
				</div>
				<?php if($key==0){ ?>
				<em class="theme_checked" style="display:block"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
				<?php } else {?>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
				<?php }?>
			</td>
		<?php if($key%3==2){?>
		</tr>
		<?php }?>
		<?php endforeach;?>
		<!-- <tr>
			<td>
				<img src="/public/Wedding/img/theme_htxs.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>花田喜事</span>
				</div>
				<em class="theme_checked" name='aa'><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_qsyx.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>浅水语行</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_gzrj.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>公主日记</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
		</tr>		<tr>
			<td>
				<img src="/public/Wedding/img/theme_jqrm.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>佳期如梦</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_zmsg.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>最美时光</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_hhyy.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>花好月圆</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
		</tr>
		<tr>
			<td>
				<img src="/public/Wedding/img/theme_htxs.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>花田喜事</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_qsyx.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>浅水语行</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
			<td>
				<img src="/public/Wedding/img/theme_gzrj.jpg" alt="">
				<div class="theme_tit p_a t_al_c">
					<span>公主日记</span>
				</div>
				<em class="theme_checked"><img src="/public/Wedding/img/theme_checked.png" alt=""></em>
			</td>
		</tr> -->
	</table>

	<div class="emp20"></div>
	<a href="javascript:void(0)" class="btn1 btn1_mb">确认</a>
	<div class="emp20"></div>
</div>
</body>
</html>