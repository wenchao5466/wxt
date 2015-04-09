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
					<div class="section3" id="section3">
						<div id="preview" class="section3a" style="background-image:url(<?php echo $userpost['photo']?>);" >
						
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
 
                //图片上传预览    IE是用了滤镜。
        function previewImage(file)
        {
          var MAXWIDTH  = 260; 
          var MAXHEIGHT = 180;
          var div = document.getElementById('preview');
          if (file.files && file.files[0])
          {
              // div.innerHTML ='<img id=imghead>';
              var img = document.getElementById('imghead');
//               img.onload = function(){
//                 // var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
//                 img.width  =  rect.width;
//                 img.height =  rect.height;
// //                 img.style.marginLeft = rect.left+'px';
//                 img.style.marginTop = rect.top+'px';
//               }
              var reader = new FileReader();
              reader.onload = function(evt){
              	// alert(evt.target.result)
              	// alert(document.getElementById('preview'))
              	document.getElementById('preview').style.backgroundImage = 'url(' + evt.target.result + ')';
              	// img.src = evt.target.result;
              }
              // reader.onload = function(evt){
              // 	alert(evt.target.result)
              // 	div.style.backgroundImage = 'url' + evt.target.result;
              // }
              reader.readAsDataURL(file.files[0]);
          }
         
        }
        
</script>
<style type="text/css">

</style>

    <input type="file" id="filea" style="position:absolute;left:-888em" onchange="previewImage(this)" />   


<div id="datePlugin"></div>

</body>
</html>