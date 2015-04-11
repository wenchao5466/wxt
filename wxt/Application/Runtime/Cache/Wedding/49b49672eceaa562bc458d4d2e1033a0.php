<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
 <html class="ahtml">
<head>
	<title>首页</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	<link rel="stylesheet" href="/Public/Wedding/css/pages.css?t=123a2e" />
	<script src="/Public/Wedding/js/require.js?t=31231" data-main="/Public/Wedding/js/main"></script>
	<link href="/Public/Wedding/date/common.css" rel="stylesheet" type="text/css" />
	
	<script src="/Public/Wedding/js/jquery-1.9.1.min.js"></script>
	<script src="/Public/Wedding/js/jquery.validate.js"></script>
	<script src="/Public/Wedding/js/jquery-form.js"></script>
</head>
<body>
<div class="bod_cent">

	<div class="index box">
		<table class="row100 index_cent">
			<tr>
				<td class="row50"><img src="/Public/Wedding/img/index_img1.jpg" alt=""><div class="mytxt" contenteditable="true"><em class="ema"><?php echo $userpost['man']?></em></div></td>
				<td><img src="/Public/Wedding/img/index_img2.jpg" alt=""><div class="mytxt" contenteditable="true"><em class="ema"><?php echo $userpost['woman']?></em></div></td>
			</tr>
			<tr>
				<td><img src="/Public/Wedding/img/index_img3.jpg" alt=""><div class="section1">婚宴日期</div></td>
				<td rowspan='2'><a href="/wxt/wedding/index/address"><img src="/Public/Wedding/img/index_img8.jpg" alt=""><div class="mytxt section2" ><?php echo $userpost['location']?></div></a></td>
			</tr>
			<tr>
				<td style="padding-top:.4rem"><img src="/Public/Wedding/img/index_img4.jpg" alt=""><div class="section1 row100" id="endTime" style="left:0;font-size:1.4rem;text-align:center;"><?php echo $userpost['date_time']?></div></td>
			</tr>
			<tr>
				<td colspan='2'><img src="/Public/Wedding/img/index_img9.jpg" alt=""><div class="mytxt mytxt1" contenteditable="true"><em class="ema"><?php echo $userpost['welocome']?></em></div></td>
			</tr>
			<tr>
				<td><a href="<?php echo APP_NAME; ?>/wedding/index/template"><img src="/Public/Wedding/img/index_img5.jpg" alt=""><div class="section1"><?php echo $userpost['stylename']?></div></a></td>
				<td><a href="<?php echo APP_NAME; ?>/wedding/index/music"><img src="/Public/Wedding/img/index_img6.jpg" alt=""><div class="section1"><?php echo $userpost['musictitle']?></div></a></td>
			</tr>
			<tr>
				<td colspan='2'>
					<img src="/Public/Wedding/img/index_img10.jpg" alt="">
					
						<form id="image_form" method="post" action=""  enctype="multipart/form-data">
							<input type="file" name="Filedata" id="Filedata" value="" class="file"  style="display:none;"/>
						</form>				
						<div class="section3" id="section3">
							<div id="preview" class="section3a" style="cursor: pointer;background-image:url(<?php echo $userpost['photo']?>);" >
							    <!-- <img id="imghead" width=100 height=100 border=0 src='/Public/Wedding/img/index_img7.jpg'> -->
							</div>
						</div>
				</td>
			</tr>
		</table>
		<a href="" class='btn1 btn1_mb btn1_mb1 row100'>保存</a>
	</div>

</div>
<script>
$(function(){
	
	$("#Filedata").change(function(){
	    //$('#Filedata').bind("blur");
	    $("#image_form").submit();
	});

	$("#preview").click(function(){
		$("#Filedata").click();
	});

    $("#image_form").validate({
        submitHandler: function(form)  {
        	$(".profile_image").attr("src","");
			$("#image_form").ajaxSubmit({
				type:'POST',
				url:"/wxt/wedding/photo/saveUserImage",
				dataType: "json",
				success:function(res){
					$("#preview").css("background-image","url("+res.url+")");
					//alert(res.url+"----"+res.width+"===="+res.height);
					//$(".profile_image").attr("src",res.url);
					//$(".profile_image").attr("width",res.width);
					//$(".profile_image").attr("height",res.height);
				}
			});
			return false;
		}
	});
	
});

</script>
<style type="text/css">

</style>

<div id="datePlugin"></div>

</body>
</html>