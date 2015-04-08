<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <title>WE喜帖</title> 
  <link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
  <script src="/Public/Member/js/jquery-1.4.2.min.js" type="text/javascript"></script> 
  <script src="/Public/Member/js/jquery.Jcrop.js" type="text/javascript"></script> 
  <script>
var m_inv_lng = '<?php echo $userpost["location_x"]?>';
var m_inv_lat = '<?php echo $userpost["location_y"]?>';
</script> 

  <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script> 
  <script>

var marker=null;
var map = null;
function initmap() {
     var center = new qq.maps.LatLng(39.916527,116.397128);
     if(m_inv_lng!==""&&m_inv_lat!='')
     {
              center = new qq.maps.LatLng(m_inv_lat,m_inv_lng);
     }
   
     map = new qq.maps.Map(document.getElementById('container'),{
        center: center,
        zoom: 15,
        draggableCursor:'crosshair'
     });
     marker = new qq.maps.Marker({
        position: center,
        map: map
    });
    var info = new qq.maps.InfoWindow({
        map: map
    });

  qq.maps.event.addListener(map, 'click', function(event) {
        // alert('您点击的位置为: [' + event.latLng.getLat() + ', ' + event.latLng.getLng() + ']');
            var latLng=new qq.maps.LatLng(event.latLng.getLat(),event.latLng.getLng());
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

function openmap(v)
{
	if($.trim($('#m_inv_address').val())=='')
	{
		alert('地址不可以为空！');	return ;
	}
	if(v==0)
	{
		$('#closemap').css('display','block');
		$('#container').css('display','block');
		$('#daohang').css('display','block');
		getResult(1);
	}
	else
	{
		$('#closemap').css('display','none');
		$('#container').css('display','none');
		$('#daohang').css('display','none');
	}
}
function getResult(ipage) {
	
    var poiText = document.getElementById("m_inv_address").value;
    var regionText = document.getElementById("m_inv_city").value;
    var pnumber=6;
    var latlngBounds = new qq.maps.LatLngBounds();
    searchService = new qq.maps.SearchService({
		
        complete : function(results){
			//$('#print').html(print_r(results));
		    var count=results.detail.totalNum;
			
			if(count>0)
			{
				var cpage=Math.ceil(count/pnumber);
				
				var str="";
				var list=results.detail.pois;
				for(var i=0;i<list.length;i++)
				{
					str+=' <table width="100%"   style="cursor:pointer" onClick="setMapcenter(\''+list[i].latLng.lat+'\',\''+list[i].latLng.lng+'\')"  border="0" cellspacing="0" cellpadding="0">     <tr>       <td width="16%"  height="35" align="center" valign="middle" >'+(i+1)+'</td>       <td width="84%" style="font-size:12px;text-align:left;" height="55"><strong>'+list[i].name+'</strong><br>         地址：'+list[i].address+'<br>         </td>     </tr>     <tr>       <td height="1" colspan="2" align="center" bgcolor="#999999" ></td>       </tr>   </table>';
				}
				
				var pstr="";
				if(ipage<=1)
				{
					pstr+="上一页";
				}
				else
				{
					pstr+="<span style='cursor:pointer' onClick='getResult("+(ipage-1)+")' >上一页</span>";
				}
				
				pstr+="&nbsp;"+ipage+"/"+cpage+"&nbsp;"
				if(ipage>=cpage)
				{
					pstr+="下一页";
				}
				else
				{
					pstr+="<span style='cursor:pointer' onClick='getResult("+(ipage+1)+")' >下一页</span>";
				}
				var page=' <table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>  <td height="25" align="center" style="font-size:12px;"  >'+pstr+'</td></tr></table>';
				$('#daohang').html(str+page);
				
			}
        }
    });
	
    searchService.setLocation(regionText);
    searchService.setPageIndex(ipage-1);
    searchService.setPageCapacity(pnumber);
    searchService.search(poiText);
}
function setMapcenter(lat,lng)
{
	document.getElementById("mapX").value = lng;  
	document.getElementById("mapY").value = lat;
	$('#m_isqqmap').val('1');
        var latLng=new qq.maps.LatLng(lat,lng);
        marker.setPosition(latLng);
        setTimeout(function() {
              map.panTo(latLng);
      }, 100);
}

 $(document).ready(
	function ()
	{
		initmap(); 
	}
 );
 
</script> 
 </head> 
 <body> 
  <div id="content01"> 
   <table id="mscenter01" cellpadding="10" cellspacing="6" bgcolor="#CCCCCC" width="800px"> 
    <tbody>
     <tr>
      <td bgcolor="#FFFFFF" align="center">编辑婚礼请柬</td>
     </tr> 
     <tr>
      <td bgcolor="#ffffff" align="center"> 
       <table width="714" cellpadding="6" cellspacing="0"> 
        <tbody>
         <tr> 
          <td align="right">城市：</td> 
          <td colspan="2" align="left"><input type="text" id="m_i nv_city" name="m_inv_city" value="<?php echo $userpost['city']?>" />&nbsp;&nbsp;只写城市名称即可，如“青岛”，而非“青岛市、山东青岛”<br />
           <!--onKeyUp="get_city()" onFocus="get_city()"--> 
           </td> 
         </tr> 

         <tr> 
          <td align="right">地点：</td>
          <td width="319" align="left"><input type="text" id="m_inv_address" name="m_inv_address" value="<?php echo $userpost['location']?>" /><span style="color:#F00">*</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor:pointer" onclick="openmap(0)">[地图标点]<img src="http://api.amap.com/webapi/static/Images/1.png" /> </a></td> 
          <td width="287" align="left" valign="bottom">
           <div onclick="openmap(1)" id="closemap" style="display:none; cursor:pointer; margin-bottom:1px; color:#F00">
            [收起地图]
           </div> </td> 
         </tr> 
         <tr> 
          <td>&nbsp;</td> 
          <td colspan="2">
           <table width="603" border="0" align="right" cellpadding="0" cellspacing="0"> 
            <tbody>
            
             <tr> 
              <td>
               <div style="width:196px;height:400px; float:left; display:none" id="daohang"></div> 
               <div style="width:403px;height:400px; float:right; display:none" id="container"></div></td> 
             </tr> 
            </tbody>
           </table></td> 
         </tr> 
         <tr> 
          <td>&nbsp;</td> 
          <td colspan="2">
           <table width="603" border="0" align="right" cellpadding="0" cellspacing="0"> 
            <tbody>
             <tr> 
              <td>
               <div style="width:196px;height:400px; float:left; display:none" id="daohang"></div> 
               <div style="width:403px;height:400px; float:right; display:none" id="container"></div></td> 
             </tr> 
            </tbody>
           </table></td> 
         </tr> 
        </tbody>
       </table> </td>
     </tr> 
    </tbody>
   </table> 
  </div> 
     
 </body>
</html>