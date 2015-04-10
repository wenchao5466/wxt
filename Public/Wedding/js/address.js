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
	function saveAddress (url,form) {
		$.ajax({
           url: url,
           data: $("#"+form).serialize(),
           dataType:'json',
           success: function(result){
				/*if(result.code == 100){
					alert('保存成功');
					window.location.href='/wxt/wedding/index';
				}else{
					alert('保存失败，请重新尝试。');
				}*/
				window.location.href='/wxt/wedding/index';
           }
       });
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

								str += '<div style="cursor:pointer" class="zz_ddsr_texta" id="item_'+(i + 1)+'" onClick="setMapcenter(\'' + list[i].latLng.lat+ '\',\''+ list[i].latLng.lng+ '\',this)"><font class="d_b">'+list[i].address+'</font>';
								str += list[i].name;
								str += '	<em class="checked"><img src="/Public/Wedding/img/map_img2.jpg" alt="" style="display:none;"></em>';
								str += '</div>';
								
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
	function setMapcenter(lat, lng, document) {
		$("#mapX").val(lng);
		$("#mapY").val(lat);
		//document.getElementById("mapX").value = lng;
		//document.getElementById("mapY").value = lat;
		$('#m_isqqmap').val('1');
		var latLng = new qq.maps.LatLng(lat, lng);
		marker.setPosition(latLng);
		setTimeout(function() {
			map.panTo(latLng);
			//$('#address_form').submit()
			$(".zz_ddsr_texta").each(function(){
				$(this).find('img').hide();
			});
			$(document).find('img').show();
			//$("p").find("span").css('color','red');
			var url = '/wxt/wedding/index/saveAddress';
			saveAddress(url,"address_form");
		}, 100);
		
	}
	
	
	
	
	$(document).ready(function() {
		initmap();
		openmap(0);
	});

