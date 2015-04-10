<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>制作—地点</title>
<meta charset='utf-8'>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Expires" CONTENT="-1">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">

<link rel="stylesheet" href="/Public/Wedding/css/pages.css?t=123a2ab" />
<script src="/public/Wedding/js/require.js" data-main="/Public/Wedding/js/main"></script>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<script src="/Public/Member/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="/Public/Wedding/js/address.js" type="text/javascript"></script>
<script src="/Public/Member/js/jquery.Jcrop.js" type="text/javascript"></script>
<script>
	var m_inv_lng = '<?php echo $userpost["location_x"]?>';
	var m_inv_lat = '<?php echo $userpost["location_y"]?>';
</script>

<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
	
		

</script>
</head>
<body>


	<div class="bod_cent">
		<div class="zz_ddsr bg_fff">
			<div style="height: auto;">
				<!-- <p align="left">地点：</p>
				<input type="text" id="m_inv_address" name="m_inv_address"
					value="<?php echo ($address); ?>" /><span style="color: #F00">*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a
					style="cursor: pointer" onclick="openmap(0)">[地图标点]<img
					style="width: auto;"
					src="http://api.amap.com/webapi/static/Images/1.png" />
				</a> -->
				<!-- <div onclick="openmap(1)" id="closemap"
					style="display: none; cursor: pointer; margin-bottom: 1px; color: #F00">
					[收起地图]</div> -->
				<div style="height: 200px; display: none" id="container"></div>
			</div>
			<div class="zz_ddsr_text" style="clear: both;">
				<div style="width: 100%; clear: both; display: none" id="daohang"></div>
			</div>
		</div>
	</div>
	<div class="emp60"></div>
	<div class="zz_ddsr_bot row100 t_al_c">
		<a href="/wxt/wedding/index/inputAddress" class="btn1"><img
			src="/Public/Wedding/img/map_img3.jpg" alt="" style="width: 1.4rem">手动输入地址</a>
	</div>
<form id="address_form" method="post" action="/wxt/wedding/index/saveAddress">
	<input type="hidden" id="m_inv_address" name="m_inv_address" value="<?php echo ($address); ?>" />
	<input type="hidden" id="m_isqqmap" name="m_isqqmap" value="1" />
	<input type="hidden" name="mapX" id="mapX" value="<?php echo ($userpost['location_x']); ?>" />
	<input type="hidden" name="mapY" id="mapY" value="<?php echo ($userpost['location_y']); ?>" />
</form>
</body>
</html>