<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
	<title>制作_选择音乐</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	
	<link rel="stylesheet" href="/Public/Wedding/css/pages.css?t-321a" />
	 <script src="/Public/Wedding/js/require.js" data-main="/Public/Wedding/js/main"></script>
</head>
<body>
<div class="bod_cent">
	<div class="zz_xzyy">
		<audio src="/Public/Wedding/img/123.mp3" controls preload id="music_a" class="music_a p_a"></audio>

		<section class="ckly_top c4c">一共有<font class='d_ib'>62</font>个可供选择的</section>
		<div class="zz_xzyy_t bg_fff">
<?php foreach($musics as $music):?>
			<div class="zz_xzyy_ta d_tb row100">
				<div class="zz_xzyy_ta1 d_tb_c">
					<img src="/Public/Wedding/img/music_bg.jpg" class="img1" alt="">
					<font data-id="<?php echo $music['id']?>" data-url="<?php echo $music['url']?>"><?php echo $music['name']?></font>
				</div>
				<div class="zz_xzyy_ta2 d_tb_c">
					<a href="javascript:void(0)" class="control d_ib" name="pause"><img src="/Public/Wedding/img/stop.png" alt=""></a>
					<a href="javascript:void(0)" class="select d_ib btn2" name="check">选择</a>
				</div>
			</div>
<?php endforeach;?>
			<!-- <div class="zz_xzyy_ta d_tb row100">
				<div class="zz_xzyy_ta1 d_tb_c">
					<img src="/Public/Wedding/img/music_bg.jpg" class="img1" alt="">
					<font data-url="/Public/Wedding/img/she.mp3">北欧神话-she</font>
				</div>
				<div class="zz_xzyy_ta2 d_tb_c">
					<a href="javascript:void(0)" class="control d_ib" name="pause"><img src="/Public/Wedding/img/stop.png" alt=""></a>
					<a href="javascript:void(0)" class="select d_ib btn2" name="check">选择</a>
				</div>
			</div>

			<div class="zz_xzyy_ta d_tb row100 bor_no">
				<div class="zz_xzyy_ta1 d_tb_c">
					<img src="/Public/Wedding/img/music_bg.jpg" class="img1" alt="">
					<font data-url="/Public/Wedding/img/123.mp3">洋葱-五月天</font>
				</div>
				<div class="zz_xzyy_ta2 d_tb_c">
					<a href="javascript:void(0)" class="control d_ib" name="pause"><img src="/Public/Wedding/img/stop.png" alt=""></a>
					<a href="javascript:void(0)" class="select d_ib btn2" name="check">选择</a>
				</div>
			</div>

			<div class="zz_xzyy_ta d_tb row100">
				<div class="zz_xzyy_ta1 d_tb_c">
					<img src="/Public/Wedding/img/music_bg.jpg" class="img1" alt="">
					<font data-url="/Public/Wedding/img/she.mp3">北欧神话-she</font>
				</div>
				<div class="zz_xzyy_ta2 d_tb_c">
					<a href="javascript:void(0)" class="control d_ib" name="pause"><img src="/Public/Wedding/img/stop.png" alt=""></a>
					<a href="javascript:void(0)" class="select d_ib btn2" name="check">选择</a>
				</div>
			</div>
 -->
		</div>

		<div class="emp20"></div>
		<a href="javascript:void(0)" class="btn1">确认</a>
		<div class="emp20"></div>
	</div>
</div>
</body>
</html>