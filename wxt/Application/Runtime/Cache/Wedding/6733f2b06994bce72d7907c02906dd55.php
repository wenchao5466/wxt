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
<script src="/public/Wedding/js/require.js"
	data-main="/Public/Wedding/js/main"></script>
<link rel="shortcut icon" href="/Public/Home/favicon.ico"
	type="image/x-icon" />
<script src="/Public/Member/js/jquery-1.4.2.min.js"
	type="text/javascript"></script>
<script src="/Public/Member/js/jquery.Jcrop.js" type="text/javascript"></script>
<script>
	var m_inv_lng = '<?php echo $userpost["location_x"]?>';
	var m_inv_lat = '<?php echo $userpost["location_y"]?>';
</script>

<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>
	var marker = null;
	var map = null;
	function initmap() {
		var center = new qq.maps.LatLng(39.916527, 116.397128);
		if (m_inv_lng !== "" && m_inv_lat != '') {
			center = new qq.maps.LatLng(m_inv_lat, m_inv_lng);
		}

		map = new qq.maps.Map(document.getElementById('container'), {
			center : center,
			zoom : 15,
			draggableCursor : 'crosshair'
		});
		marker = new qq.maps.Marker({
			position : center,
			map : map
		});
		var info = new qq.maps.InfoWindow({
			map : map
		});

		qq.maps.event.addListener(map, 'click', function(event) {
			// alert('您点击的位置为: [' + event.latLng.getLat() + ', ' + event.latLng.getLng() + ']');
			var latLng = new qq.maps.LatLng(event.latLng.getLat(), event.latLng
					.getLng());
			marker.setPosition(latLng);
			document.getElementById("mapX").value = event.latLng.getLng();
			document.getElementById("mapY").value = event.latLng.getLat();
			$('#m_isqqmap').val('1');
			setTimeout(function() {
				map.panTo(latLng);
			}, 100);
		});
		getResult(1);
	}

	function openmap(v) {
		if ($.trim($('#m_inv_address').val()) == '') {
			alert('地址不可以为空！');
			return;
		}
		if (v == 0) {
			$('#closemap').css('display', 'block');
			$('#container').css('display', 'block');
			$('#daohang').css('display', 'block');
			getResult(1);
		} else {
			$('#closemap').css('display', 'none');
			$('#container').css('display', 'none');
			$('#daohang').css('display', 'none');
		}
	}
	function getResult(ipage) {

		var poiText = document.getElementById("m_inv_address").value;
		var regionText = '';//document.getElementById("m_inv_city").value;
		var pnumber = 6;
		var latlngBounds = new qq.maps.LatLngBounds();
		searchService = new qq.maps.SearchService(
				{

					complete : function(results) {
						//$('#print').html(print_r(results));
						var count = results.detail.totalNum;

						if (count > 0) {
							var cpage = Math.ceil(count / pnumber);

							var str = "";
							var list = results.detail.pois;
							for (var i = 0; i < list.length; i++) {
								str += ' <table width="100%"   style="cursor:pointer" id=item_'+(i + 1)+' onClick="setMapcenter(\''
										+ list[i].latLng.lat
										+ '\',\''
										+ list[i].latLng.lng
										+ '\')"  border="0" cellspacing="0" cellpadding="0">'
									    + '<tr><td width="16%"  height="35" align="center" valign="middle" >'
										+ (i + 1)
										+ '</td>       <td width="84%" style="font-size:12px;text-align:left;" height="55"><strong>'
										+ list[i].name
										+ '</strong><br>         地址：'
										+ list[i].address
										+ '<br> </td> </tr>     <tr>  <td height="1" colspan="2" align="center" bgcolor="#999999" ></td>       </tr>   </table>';
							}

							var pstr = "";
							if (ipage <= 1) {
								pstr += "上一页";
							} else {
								pstr += "<span style='cursor:pointer' onClick='getResult("
										+ (ipage - 1) + ")' >上一页</span>";
							}

							pstr += "&nbsp;" + ipage + "/" + cpage + "&nbsp;"
							if (ipage >= cpage) {
								pstr += "下一页";
							} else {
								pstr += "<span style='cursor:pointer' onClick='getResult("
										+ (ipage + 1) + ")' >下一页</span>";
							}
							var page = ' <table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>  <td height="25" align="center" style="font-size:12px;"  >'
									+ pstr + '</td></tr></table>';
							$('#daohang').html(str + page);

						}
					}
				});

		searchService.setLocation(regionText);
		searchService.setPageIndex(ipage - 1);
		searchService.setPageCapacity(pnumber);
		searchService.search(poiText);
	}
	function setMapcenter(lat, lng) {
		document.getElementById("mapX").value = lng;
		document.getElementById("mapY").value = lat;
		$('#m_isqqmap').val('1');
		var latLng = new qq.maps.LatLng(lat, lng);
		marker.setPosition(latLng);
		setTimeout(function() {
			map.panTo(latLng);
		}, 100);
		$('#address_form').submit();
	}

	$(document).ready(function() {
		initmap();
		openmap(0);
	});
</script>
</head>
<body>

<form id="address_form" method="post" action="/wxt/wedding/index/saveAddress">
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
				<div style="height: 400px; display: none" id="container"></div>
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
	<input type="hidden" id="m_inv_address" name="m_inv_address"
                    value="<?php echo ($address); ?>" /><span style="color: #F00">
	<input type="hidden" id="m_isqqmap" name="m_isqqmap" value="1" />
	<input type="hidden" id="x" name="a_x" value="" />
	<input type="hidden" id="y" name="a_y" value="" />
	<input type="hidden" id="w" name="a_w" value="" />
	<input type="hidden" id="h" name="a_h" value="" />
	<input type="hidden" name="mapX" id="mapX"
		value="<?php echo $userpost['location_x']?>" />
	<input type="hidden" name="mapY" id="mapY"
		value="<?php echo $userpost['location_y']?>" />
</form>
</body>
</html>