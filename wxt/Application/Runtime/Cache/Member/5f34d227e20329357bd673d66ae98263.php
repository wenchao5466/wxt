<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <title>WE喜帖</title> 
  <link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
  <link href="/Public/Member/css/css.css" rel="stylesheet" type="text/css" /> 
  <link href="/Public/Member/css/datePicker.css" rel="stylesheet" type="text/css" /> 
  <link href="/Public/Member/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" /> 
  <script src="/Public/Member/js/share.js"></script> 
  <script src="/Public/Member/js/jquery-1.4.2.min.js" type="text/javascript"></script> 
  <script src="/Public/Member/js/public.js" type="text/javascript"></script> 
  <script src="/Public/Member/js/jquery.datePicker-min.js"></script> 
  <script src="/Public/Member/js/jquery.Jcrop.js" type="text/javascript"></script> 
  <script src="/Public/Member/js/ajaxfileupload.js" type="text/javascript"></script> 
  <script src="/Public/Member/js/jquery.artDialog.js?skin=idialog"></script> 
  <script src="/Public/Member/js/niftyplayer.js"></script> 
  <script type="text/javascript" src="/Public/Member/js/jquery.jplayer.min.js"></script> 
  <link rel="stylesheet" href="/Public/Member/css/jquery.Jcrop.css" type="text/css" /> 
  <style type="text/css">
li {
	list-style-type: none;
}
.container{width:600px;height:300px;background-color: #fbfbfb;padding:10px}
.container1{width:600px;height:420px;background-color: #fbfbfb;}
#musicList{width:100%;text-indent: 5px}
.header{line-height:30px;background: #999;}
.row{line-height: 40px;background-color: #fefefe;}
.row td{border-bottom: 1px solid #f4f4f4}
.yyc{background: url("/Public/Member/image/yinyuechi.jpg") top left  no-repeat; width:100%;height:50px}
.playicon{background: url("/Public/Member/image/listen.jpg") top  left  no-repeat; width:85px;height:25px ;display: block;}
.chooseicon{background: url("/Public/Member/image/useit.jpg") top  left  no-repeat; width:52px;height:25px ;display: block;}
</style> 
  <script>
var m_inv_lng = '<?php echo $userpost["location_x"]?>';
var m_inv_lat = '<?php echo $userpost["location_y"]?>';
</script> 
  <script type="text/javascript">

function help2(){
	var content = '<pre>若照片超过5MB，<br><br>';
		content += '1.可使用';
		content += '<a href="http://xiuxiu.web.meitu.com/main.html" target="_blank"><span style="color:#03F;">美图秀秀WEB版</span></a>';
		content += '调整大小后在上传，<br>';
		content += '2.可上传到<a href="http://rc.qzone.qq.com/photo/" target="_blank"><span style="color:#03F;">QQ空间相册</span></a>后再将图片另存到电脑上再上传到这里。<br>若仍无法上传图片，可能因为使用的浏览器版本较低，请升级浏览器版本或更换其他浏览器上传！<br>推荐使用IE8以上或360（6.0版以上）或chrome浏览器!</pre>';
	  openHelpDialog2(content);
}

function openHelpDialog2(content) {
	art.dialog({
		title: "帮助",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '450',  
		height: '250',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: true,
	}).show;
	return false;
};

function bjyy2(){
	var content =$('#bjyy1').html();
	openHelpDialog(content);
}
function openHelpDialog(content) {
	art.dialog({
		title: "帮助",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '450',  
		height: '250',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: true,
	}).show;
	return false;
}

var xzmbi=0;
var xzmbc="";
//var mbga1="Default";
var mbga1 = "<?php echo $userpost['style']?>";
//
function xzmb(){
	if(xzmbi==0)
	{
		xzmbc =$('#xzmb').html();
		$('#xzmb').html('');
		xzmbi++;
	}
	openHelpDialogxzmb(xzmbc);
}

var jsTplArr = {
    "Default":"\u6d45\u6c34\u8bed\u884c",
    "Pink":"\u516c\u4e3b\u65e5\u8bb0",
    "White":"\u503e\u57ce\u4e4b\u604b",
    "Huangguan":"\u7d2b\u97f5\u6d9f\u6f2a",
    "Huangguanzise":"\u7e41\u82b1\u4f3c\u9526",
    "Huangguanjinse":"\u79cb\u65e5\u604b\u6b4c",
    "Hanshi":"\u6700\u7f8e\u65f6\u5149",
    "Oushifg":"\u4f73\u671f\u5982\u68a6",
    "Xinxinxiangyin":"\u6d6e\u5f71\u5e74\u534e",
    "Yesido":"\u6d77\u6d0b\u4e4b\u5fc3",
    "Planning":"\u65e7\u65f6\u5fae\u5149",
    "Theonly":"\u82b1\u7530\u559c\u4e8b",
    "Ofingerprint":"\u5927\u57ce\u5c0f\u7231",
    "Rfingerprint":"\u82b1\u597d\u6708\u5706",
    "Bluefingerprint":"\u6c34\u6728\u9752\u534e"
};
function qrxzmb(v)
{
	mbga1=v;
	var list = art.dialog.list; for (var i in list) { list[i].close(); };
	if ( jsTplArr[v] )
	{
		$('#xzdtpl').html('您已选择了：'+jsTplArr[v]);
	}
}

function openHelpDialogxzmb(content) {
	art.dialog({
		title: "帮助",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '450',  
		height: '500',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: true,
	}).show;
	$('#mb_'+mbga1).attr("checked",true);
	return false;
}


function confirmUpload(id){
	var a_x=$.trim($('#x').val());
	
	var a_y=$.trim($('#y').val());
	
	var a_w=$.trim($('#w').val());

	var a_h=$.trim($('#h').val());
	
	
	$.post('<?php echo APP_NAME?>/member/member/setimg',{'a_x':a_x,'a_y':a_y,'a_w':a_w,'a_h':a_h,'m_inv_memo':document.getElementById('target').src},function (data){
	 	if($.trim(data)!='')
		{
			
			$('#isupimg').val($.trim(data));
			$('#m_inv_memo_pre').css('display','block');
			$('#m_inv_memo_pre').attr('src',$.trim(data));
		}	
	})
	
	closeShareDiv(id);
}
function copyImage(){
	if (document.getElementById('m_inv_memo').value != ''){
	document.getElementById('m_inv_memo_pre').style.display = "none";
	}
}

function ajaxFileUpload(){

	$.ajaxFileUpload({
		url:'<?php echo APP_NAME?>/member/member/aupload',                     //需要链接到服务器地址
		secureuri:false,
		fileElementId:'m_inv_pic',                        //文件选择框的id属性
		dataType: 'json',                                 //服务器返回的格式，可以是json
            success: 
		function (data, status) {                         //相当于java中try语句块的用法
			//$('#result').html('添加成功');
			//alert(data.msg);
                        //alert(data.status);
			if (data.status =='-1'){
				alert(data.error);
			}else{
				
				$('#gethtml').html('');
				$('#gethtml').append('<img id="target" style="display: none;"/>');
				document.getElementById('target').style.display = "none";
				document.getElementById('preview2').style.display = "block";
				document.getElementById('target').src = data.msg;
				document.getElementById('preview2').src = data.msg;
				//document.getElementById('m_inv_memo').value = data.msg;
				
				jQuery(function($){

                                        // Create variables (in this scope) to hold the API and image size
					var jcrop_api, boundx, boundy;
				    
					$('#target').Jcrop({
							minSize: [240,227],
							setSelect: [10,10,592,560],
							onChange: updatePreview,
							onSelect: updatePreview,
							onSelect: updateCoords,
							aspectRatio: 1.057142857142857
						},
						function(){
							// Use the API to get the real image size
							var bounds = this.getBounds();
							
							boundx = bounds[0];
							boundy = bounds[1];
							
							// Store the API in the jcrop_api variable
							jcrop_api = this;
						}
					);
					function updateCoords(c){
						$('#x').val(c.x);
						$('#y').val(c.y);
						$('#w').val(c.w);
						$('#h').val(c.h);
					}
					function updatePreview(c){
					
						if (parseInt(c.w) > 0)
						{
							var rx = 240 / c.w;
							var ry = 227 / c.h;
							$('#preview2').css({
								width: Math.round(rx * boundx) + 'px',
								height: Math.round(ry * boundy) + 'px',
								marginLeft: '-' + Math.round(rx * c.x) + 'px',
								marginTop: '-' + Math.round(ry * c.y) + 'px'
							});
							
							
						}
					};
				});
			}
		},
	error: 
		function (data, status) {           //相当于java中catch语句块的用法
			alert(data.error);
		}
	});
}
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
 
 function get_city()
 {
	
	if($.trim($('#m_inv_city').val())!='')
	 {
		 $('#citylist').css('display','block');
		 var url='<?php echo APP_NAME?>/member/member/getcitylist?pinyin='+$.trim($('#m_inv_city').val())+'&n='+Math.random();
		 
		 $.post(url,{'type':'ajax'},function(data)
		 {
			
			 $('#citylist').html(data);
		 })
	 }
 }
 function closecity()
 {
	  $('#citylist').css('display','none');
 }
 function setc(v)
 {
	 $('#m_inv_city').val(v);
	 closecity();
 }
var mp3id='';
var mp3url='';
function _play(url,id)
{
	if(mp3id!='')
	{
		var html2='<span style="cursor:pointer" onClick="_play(\''+mp3url+'\',\''+mp3id+'\')">播放</span>';
		$('#'+mp3id).html(html2);
		if($.browser.msie) { 
		   document.getElementById('emp3').stop();
	    } 
	    $('#pmp3').remove();
	}
	mp3id=id;
	mp3url=url;
	var html1='<span style="cursor:pointer" onClick="_stop(\''+url+'\',\''+id+'\')">停止</span>';
	$('#'+id).html(html1);
	
	var html='<div id="pmp3"><EMBED name="emp3" id="emp3" src="'+url+'" hidden="true" type="audio/mpeg" loop="-1" autostart="true" autoplay="true" loop="true" ></div>';
	$('body').append(html);
}
function _stop(url,id)
{
	
	var html1='<span style="cursor:pointer" onClick="_play(\''+url+'\',\''+id+'\')">播放</span>';
	$('#'+id).html(html1);
	if($.browser.msie) { 
		document.getElementById('emp3').stop();
	} 
	$('#pmp3').remove();	
}
function close_xzmp3(title,url)
{
	$('#xzdmp3').html('您已选择了：'+title);
	$('#bjyy').val(url);
	$('#bjyytitle').val(title);
	//$('.aui_state_lock').remove();
	//$("body div:last-child").remove();
	var list = art.dialog.list; for (var i in list) { list[i].close(); };
}

var sdup=false
function send_up()
{
	if(sdup){return ;}
	
	var m_inv_boy=$.trim($('#m_inv_boy').val());
	var m_inv_girl=$.trim($('#m_inv_girl').val());
	var m_inv_date=$.trim($('#m_inv_date').val());
	var m_inv_time_1=$.trim($('#m_inv_time_1').val());
	var m_inv_time_2=$.trim($('#m_inv_time_2').val());
	var m_inv_city=$.trim($('#m_inv_city').val());
	var m_isqqmap=$.trim($('#m_isqqmap').val());
	var mapX=$.trim($('#mapX').val());
	var mapY=$.trim($('#mapY').val());
	var m_bjyy=$.trim($('#bjyy').val());
	var m_bjyytitle=$.trim($('#bjyytitle').val());
	var m_inv_address=$.trim($('#m_inv_address').val());
	var m_inv_desc=$.trim($('#m_inv_desc').val());
	var isupimg=$.trim($('#isupimg').val());
	//var m_bg =$.trim($('#m_bg').val());
	var m_bg=mbga1;

	var err="";
	if(m_inv_boy=='')
	{
		err+='新郎名字还没填写呢！<br>';	
	}
	if(m_inv_girl=='')
	{
		err+='新娘名字还没填写呢！！<br>';	
	}
	if(m_inv_date==''||m_inv_date=='0000-00-00')
	{
		err+='婚礼举办的日期是哪天呢？<br>';	
	}
	if(m_inv_address=='')
	{
		err+='婚礼举办地点还没填写呢！<br>';	
	}
	else if(m_inv_address.length>24)
	{
			err+='婚礼举办地点最多可输入24个字，只写明城市+道路街区+婚礼地点（如某酒店）即可，';
			err+='地点在地图内标注好后可进行交通路线导航。<br>';	
	}
	if(mapX=='')
	{
		err+='请在地图上标注位置！<br>';	
	}
	if(m_inv_desc=='')
	{
		err+='邀请语还没填写呢！<br>';	
	}
	if($.trim($('#m_inv_memo_pre').attr('src'))=='')
	{
		err+='请上传一张请柬图片哦！<br>';	
	}
	if(m_bg=='')
	{
		err+='请选择模板！<br>';	
	}
	if(err!='')
	{
		msg(err,'');return;
	}
	
	var url='<?php echo APP_NAME?>/member/member/edit';
	var p={
			'm_inv_boy':m_inv_boy,
			'm_inv_girl':m_inv_girl,
			'm_inv_date':m_inv_date,
			'm_inv_time_1':m_inv_time_1,
			'm_inv_time_2':m_inv_time_2,
			'm_isqqmap':m_isqqmap,
			
			'm_inv_city':m_inv_city,
			'm_inv_address':m_inv_address,
			'm_inv_desc':m_inv_desc.replace(/\n/g,'<br>\n'),
			'isupimg':isupimg,
			'mapx':mapX,
			'mapy':mapY,
			'm_bjyy':m_bjyy,
			'm_bjyytitle':m_bjyytitle,
			'm_bg':m_bg,
			'type':'ajax',
			'act':'y'
        };
        sdup=true;
	$.post(url,p,function(data){
			sdup=false;
			//window.location.href='<?php echo APP_NAME?>/member/photo/glist';
                        msg('保存成功','');
	},'json');
}
$(document).ready(function () {
	$('#m_inv_date').datePicker({clickInput:true});
});
</script> 
 </head> 
 <body> 
  <div id="top01"> 
   <div id="topleft">
    <img src="/Public/Member/images/logo02.png" />
   </div> 
   <div id="topright"> 
    <table>
     <tbody>
      <tr> 
       <td><a href="<?php echo APP_NAME?>/member/">首页</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/member/edit" style="font-weight:bold"> [ 请柬 →</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/photo/glist">婚纱照 →</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/send">发布 ] </a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/person/glist">嘉宾</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/msg/glist">留言</a></td> 
      </tr>
     </tbody>
    </table> 
   </div> 
  </div> 
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
          <td width="70" align="right">新郎：</td>
          <td colspan="2" align="left">
           <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td width="28%"><input type="text" id="m_inv_boy" name="m_inv_boy" value="<?php echo $userpost['man']?>" /></td> 
              <td width="7%">新娘：</td> 
              <td width="28%"><input type="text" name="m_inv_girl" id="m_inv_girl" value="<?php echo $userpost['woman']?>" /></td> 
              <td width="37%"><span style="color:#F00">*</span></td> 
             </tr> 
            </tbody>
           </table></td>
         </tr> 
         <tr>
          <td align="right">日期：</td>
          <td colspan="2" align="left">
           <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td width="28%"><input type="text" id="m_inv_date" name="m_inv_date" value="<?php echo $userpost['inv_date']?>" /></td> 
              <td width="7%">时间：</td> 
              <td width="28%">
                  <select name="m_inv_time_1" id="m_inv_time_1"> 
                      <?php for($i=0;$i<=23;$i++):?>
                      <?php $selected = $userpost['inv_time_1']==$i ? 'selected' : ''?>
                      <option value="<?php echo $i?>" <?php echo $selected?>><?php echo $i?> </option>
                      <?php endfor;?>
                  </select> &nbsp;时&nbsp; 
                  <select name="m_inv_time_2" id="m_inv_time_2"> 
                      <?php for($i=0;$i<=59;$i++):?>
                      <?php $selected = $userpost['inv_time_2']==$i ? 'selected' : ''?>
                      <option value="<?php echo str_pad($i,2,'0',STR_PAD_LEFT )?>" <?php echo $selected?>><?php echo str_pad($i,2,'0',STR_PAD_LEFT )?> </option>
                      <?php endfor;?>
                  </select> &nbsp;分 </td> 
              <td width="37%"><span style="color:#F00">*</span></td> 
             </tr> 
            </tbody>
           </table></td>
         </tr> 
         <tr> 
          <td align="right">城市：</td> 
          <td colspan="2" align="left"><input type="text" id="m_inv_city" name="m_inv_city" value="<?php echo $userpost['city']?>" />&nbsp;&nbsp;只写城市名称即可，如“青岛”，而非“青岛市、山东青岛”<br />
           <!--onKeyUp="get_city()" onFocus="get_city()"--> 
           <div id="citylist" style="display:none; background-color:#F6F6F6; position:absolute; padding-top:12px; padding-left:10px; width:143px;"></div> </td> 
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
          <td align="right">邀请语：<br /> &nbsp;&nbsp;</td>
          <td colspan="2" align="left">
           <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td width="66%"><textarea name="m_inv_desc" id="m_inv_desc" cols="55" rows="8"><?php echo $userpost['welocome']?></textarea></td> 
              <td width="12%" valign="top"><a href="http://mp.weixin.qq.com/s?__biz=MzAxMTI4NzYxNg==&mid=202357507&idx=1&sn=6247525e80a010121dc4458fcf521088#rd" target="_blank">[查看示例]</a></td> 
              <td width="22%" valign="top"><span style="color:#F00">*</span></td> 
             </tr> 
            </tbody>
           </table></td>
         </tr> 
         <tr>
          <td align="right">请柬照片：</td>
          <td colspan="2" align="left">
              <input style="width:160px; height:40px;" type="button" value="点击上传封面图片" onclick="openShareDiv('share_div')" />
              <input type="hidden" id="m_inv_memo" name="m_inv_memo" value="<?php echo $userpost['photo']?>" /> 
              <input type="hidden" id="m_isqqmap" name="m_isqqmap" value="1" /> 
              <input type="hidden" id="x" name="a_x" value="" /> 
              <input type="hidden" id="y" name="a_y" value="" /> 
              <input type="hidden" id="w" name="a_w" value="" /> 
              <input type="hidden" id="h" name="a_h" value="" /> 
              <input type="hidden" name="mapX" id="mapX" value="<?php echo $userpost['location_x']?>" /> 
              <input type="hidden" name="mapY" id="mapY" value="<?php echo $userpost['location_y']?>" /> 
              <input type="hidden" id="bjyy" name="m_bjyy" value="<?php echo $userpost['music']?>" /> 
              <input type="hidden" id="bjyytitle" name="m_bjyytitle" value="<?php echo $userpost['musictitle']?>" /> <span style="color:#F00">*</span></td>
         </tr> 
         <tr>
          <td align="right"></td>
          <td colspan="2" align="left"> <input name="isupimg" id="isupimg" type="hidden" value="<?php echo $userpost['photo']?>" /> <img style="display:block;width:480px;" id="m_inv_memo_pre" src="<?php echo $userpost['photo']?>" /></td>
         </tr> 
         <tr> 
          <td align="right">选择模板：</td> 
          <td colspan="2" align="left"><input style="width:160px; height:40px;" type="button" onclick="xzmb()" value="点击选择模板" />&nbsp;&nbsp;<span id="xzdtpl"> 已经选择了:<?php echo $userpost['stylename']?> </span></td> 
         </tr> 
         <tr> 
          <td align="right">背景音乐：</td> 
          <td colspan="2" align="left"><input style="width:160px; height:40px;" type="button" onclick="bjyy2()" value="点击选择背景音乐" />&nbsp;&nbsp;<span id="xzdmp3"> 已经选择了:<?php echo $userpost['musictitle']?> </span></td> 
         </tr> 
         <tr>
          <td align="right">&nbsp;</td> 
          <td colspan="2" align="left"> </td> 
         </tr> 
         <tr>
          <td align="right"></td>
          <td colspan="2" align="left"><input onclick="send_up()" type="image" src="/Public/Member/images/button02.png" /></td>
         </tr> 
         <tr>
          <td height="25" colspan="3" align="right" id="bjyy1" style="display:none"> 
           <div class="yyc"></div> 
           <div class="container" style="overflow:auto"> 
            <br />
            <table cellpadding="0" cellspacing="0" id="musicList"> 
             <tbody>
              <tr class="row">
               <td>不使用背景音乐</td>
               <td id="mp3list_0"> </td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('不使用背景音乐','')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;最浪漫的事</td>
               <td id="mp3list_1"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/1.mp3','mp3list_1')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('最浪漫的事','1')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;诺言</td>
               <td id="mp3list_2"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/2.mp3','mp3list_2')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('诺言','2')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;秘密花园</td>
               <td id="mp3list_3"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/3.mp3','mp3list_3')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('秘密花园','3')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;梦中的婚礼</td>
               <td id="mp3list_4"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/4.mp3','mp3list_4')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('梦中的婚礼','4')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;情非得已</td>
               <td id="mp3list_5"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/5.mp3','mp3list_5')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('情非得已','5')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;遇见</td>
               <td id="mp3list_6"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/6.mp3','mp3list_6')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('遇见','6')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;爱情故事</td>
               <td id="mp3list_7"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/7.mp3','mp3list_7')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('爱情故事','7')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;我们的纪念</td>
               <td id="mp3list_8"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/8.mp3','mp3list_8')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('我们的纪念','8')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Love Song</td>
               <td id="mp3list_9"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/9.mp3','mp3list_9')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('Love Song','9')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;童话</td>
               <td id="mp3list_10"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/10.mp3','mp3list_10')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('童话','10')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;I am yours</td>
               <td id="mp3list_11"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/11.mp3','mp3list_11')">播放</span></td>
               <td> <span style="cursor:pointer" onclick="javascript:close_xzmp3('i am yours','11')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;情书</td>
               <td id="mp3list_12"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/12.mp3','mp3list_12')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('情书','12')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Could This Be Love</td>
               <td id="mp3list_13"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/13.mp3','mp3list_13')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Could This Be Love','13')">选择</span></td>
              </tr> 
              <!----> 
              <tr class="row">
               <td>&middot;Because I Love You</td>
               <td id="mp3list_14"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/14.mp3','mp3list_14')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Because I Love You','14')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Every Moment Of My Life</td>
               <td id="mp3list_15"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/15.mp3','mp3list_15')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Every Moment Of My Life','15')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Fall In Love</td>
               <td id="mp3list_14"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/16.mp3','mp3list_16')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Fall In Love','16')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Heartbeats</td>
               <td id="mp3list_17"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/17.mp3','mp3list_17')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Heartbeats','17')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;I Believe</td>
               <td id="mp3list_18"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/18.mp3','mp3list_18')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('I Believe','18')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;I Will Always Love You</td>
               <td id="mp3list_19"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/19.mp3','mp3list_19')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('I Will Always Love You','19')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Love Paradise</td>
               <td id="mp3list_20"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/20.mp3','mp3list_20')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Love Paradise','20')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Marry You</td>
               <td id="mp3list_21"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/21.mp3','mp3list_21')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Marry You','21')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;My Love</td>
               <td id="mp3list_22"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/22.mp3','mp3list_22')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('My Love','22')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;大城小爱</td>
               <td id="mp3list_23"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/23.mp3','mp3list_23')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('大城小爱','23')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;暖暖</td>
               <td id="mp3list_24"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/24.mp3','mp3list_24')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('暖暖','24')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;神圣婚誓</td>
               <td id="mp3list_25"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/25.mp3','mp3list_25')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('神圣婚誓','25')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;因为爱情</td>
               <td id="mp3list_26"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/26.mp3','mp3list_26')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('因为爱情','26')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;约定</td>
               <td id="mp3list_27"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/27.mp3','mp3list_27')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('约定','27')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;amelie from montmartre</td>
               <td id="mp3list_28"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/28.mp3','mp3list_28')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('amelie from montmartre','28')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Ballade Four Adeline</td>
               <td id="mp3list_29"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/29.mp3','mp3list_29')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Ballade Four Adeline','29')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;D 大调卡农</td>
               <td id="mp3list_30"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/30.mp3','mp3list_30')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('D 大调卡农','30')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;D 大调小步舞曲</td>
               <td id="mp3list_31"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/31.mp3','mp3list_31')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('D 大调小步舞曲','31')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Give Me Your Hand执子之手</td>
               <td id="mp3list_32"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/32.mp3','mp3list_32')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Give Me Your Hand执子之手','32')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;爱的喜悦</td>
               <td id="mp3list_33"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/33.mp3','mp3list_33')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('爱的喜悦','33')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;爱的协奏曲</td>
               <td id="mp3list_34"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/34.mp3','mp3list_34')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('爱的协奏曲','34')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;爱的旋律</td>
               <td id="mp3list_35"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/35.mp3','mp3list_35')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('爱的旋律','35')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Daydream-结婚进行曲</td>
               <td id="mp3list_36"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/36.mp3','mp3list_36')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Daydream-结婚进行曲','36')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;假如爱有天意</td>
               <td id="mp3list_37"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/37.mp3','mp3list_37')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('假如爱有天意','37')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;卡农</td>
               <td id="mp3list_38"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/38.mp3','mp3list_38')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('卡农','38')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;梁祝化蝶</td>
               <td id="mp3list_39"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/39.mp3','mp3list_39')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('梁祝化蝶','39')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;暮光之城(River Flows In You)</td>
               <td id="mp3list_40"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/40.mp3','mp3list_40')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('暮光之城(River Flows In You)','40')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;蒲公英的约定</td>
               <td id="mp3list_41"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/41.mp3','mp3list_41')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('蒲公英的约定','41')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;上帝是女孩</td>
               <td id="mp3list_42"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/42.mp3','mp3list_42')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('上帝是女孩','42')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;天空之城</td>
               <td id="mp3list_43"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/43.mp3','mp3list_43')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('天空之城','43')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;瓦妮莎的微笑</td>
               <td id="mp3list_44"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/44.mp3','mp3list_44')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('瓦妮莎的微笑','44')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;我只在乎你</td>
               <td id="mp3list_45"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/45.mp3','mp3list_45')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('我只在乎你','45')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;婚礼进行曲</td>
               <td id="mp3list_46"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/46.mp3','mp3list_46')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('婚礼进行曲','46')">选择</span></td>
              </tr> 
              <tr class="row" style="display:none">
               <td>&middot;Love Will KeepUs Alive</td>
               <td id="mp3list_47"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/47.mp3','mp3list_47')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Love Will KeepUs Alive','47')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Love Will KeepUs Alive</td>
               <td id="mp3list_48"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/48.mp3','mp3list_48')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Love Will KeepUs Alive','48')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;神秘园之歌</td>
               <td id="mp3list_49"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/49.mp3','mp3list_49')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('神秘园之歌','49')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;献给爱丽丝</td>
               <td id="mp3list_50"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/50.mp3','mp3list_50')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('神秘园之歌','50')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;YouGotMe </td>
               <td id="mp3list_51"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/51.mp3','mp3list_51')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('YouGotMe','51')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;爱很美</td>
               <td id="mp3list_52"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/52.mp3','mp3list_52')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('爱很美','52')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;爱情白皮书</td>
               <td id="mp3list_53"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/53.mp3','mp3list_53')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('爱情白皮书','53')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Beautiful In White</td>
               <td id="mp3list_54"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/54.mp3','mp3list_54')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Beautiful In White','54')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Because You Loved Me</td>
               <td id="mp3list_55"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/55.mp3','mp3list_55')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Because You Loved Me','55')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Free Loop</td>
               <td id="mp3list_56"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/56.mp3','mp3list_56')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Free Loop','56')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;I Stay In Love</td>
               <td id="mp3list_57"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/57.mp3','mp3list_57')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('I Stay In Love','57')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Love Paradise</td>
               <td id="mp3list_58"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/58.mp3','mp3list_58')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Love Paradise','58')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;每个人都会</td>
               <td id="mp3list_59"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/59.mp3','mp3list_59')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('每个人都会','59')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Sweet Dream</td>
               <td id="mp3list_60"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/60.mp3','mp3list_60')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Sweet Dream','60')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;结婚进行曲</td>
               <td id="mp3list_61"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/61.mp3','mp3list_61')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('结婚进行曲','61')">选择</span></td>
              </tr> 
              <tr class="row">
               <td>&middot;Bruno Mars-Marry You</td>
               <td id="mp3list_62"> <span style="cursor:pointer" onclick="_play('http://mp3.jiapai.cc/wxt/62.mp3','mp3list_62')">播放</span> </td>
               <td><span style="cursor:pointer" onclick="javascript:close_xzmp3('Bruno Mars-Marry You','62')">选择</span></td>
              </tr> 
             </tbody>
            </table> 
           </div> 
          </td>
         </tr> 
        </tbody>
       </table> </td>
     </tr> 
    </tbody>
   </table> 
  </div> 
     
     
  <div id="share_div" style="display:none; position:absolute; left: 0px; top: 0px; width: 100%; min-height:800px; height:auto; z-index:1001; background-color:#bbb;"> 
   <table id="mscenter01" cellpadding="10" cellspacing="6" bgcolor="#CCCCCC" width="1000px"> 
    <tbody>
     <tr>
      <td bgcolor="#FFFFFF" align="center" colspan="2">上传照片</td>
     </tr> 
     <tr>
      <td align="center" colspan="2"> <input type="file" name="m_inv_pic" id="m_inv_pic" onchange="ajaxFileUpload()" /><br /><br /> 在此上传喜帖封面照片，照片<span style="color:red">仅支持jpg、png、gif</span>格式，照片大小<span style="color:red">不能超过5M.</span>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="help2();" style="cursor:pointer; color:#03F;">[无法上传图片解决方法]</a> </td>
     </tr> 
     <tr>
      <td align="center" id="gethtml"> <img id="target" style="display:none" /> </td> 
      <td valign="top"> 
       <div style="width:240px;height:227px;overflow:hidden; float:left;">
        <img style="float:left; display:none" id="preview2" />
       </div> <br />
       <input type="button" value="剪裁" onclick="confirmUpload('share_div');" />&nbsp;
       <input type="button" value="关闭" onclick="closeShareDiv('share_div')" /> 
      </td> 
     </tr> 
    </tbody>
   </table> 
   <script>
    	function cgimg(t,v,a)
        {
                if(a==0)
                {

                        $(t).find('img').attr('src',"/Public/Member/images/"+v+".png");
                }else
                {
                        $(t).find('img').attr('src',"/Public/Member/images/"+v+".png");
                }
        }
		
    </script> 
    
   <div id="xzmb" style="display:none;"> 
    <div class="yyc"></div> 
    <div class="container1" style="overflow:auto"> 
     <table width="520" border="0" cellspacing="0" cellpadding="0"> 
      <tbody>
       <tr> 
        <td align="center" onmousemove="cgimg(this,'1',0)" onmouseout="cgimg(this,'A',1)"><img id="mbimg1" src="/Public/Member/images/A.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'2',0)" onmouseout="cgimg(this,'B',1)"><img src="/Public/Member/images/B.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'3',0)" onmouseout="cgimg(this,'C',1)"><img src="/Public/Member/images/C.png" width="120" /></td> 
       </tr> 
       <tr> 
           <td height="35" align="center"><input name="m_bg" onclick="qrxzmb('Default')" id="mb_Default" value="Default" type="radio"  <?php echo $userpost['style']=='Default'?'checked':''?>/> 浅水语行 </td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Pink')" id="mb_Pink" value="Pink" <?php echo $userpost['style']=='Pink'?'checked':''?>/> 公主日记</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('White')" id="mb_White" value="White" <?php echo $userpost['style']=='White'?'checked':''?>/> 倾城之恋</td> 
       </tr> 
       <tr> 
        <td height="35" align="center" onmousemove="cgimg(this,'4',0)" onmouseout="cgimg(this,'D',1)"><img src="/Public/Member/images/D.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'5',0)" onmouseout="cgimg(this,'E',1)"><img src="/Public/Member/images/E.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'6',0)" onmouseout="cgimg(this,'F',1)"><img src="/Public/Member/images/F.png" width="120" /></td> 
       </tr> 
       <tr> 
        <td height="35" align="center"><input type="radio" name="m_bg" id="mb_Huangguan" onclick="qrxzmb('Huangguan')" value="Huangguan" <?php echo $userpost['style']=='Huangguan'?'checked':''?>/> 紫韵涟漪</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Huangguanzise')" id="mb_Huangguanzise" value="Huangguanzise" <?php echo $userpost['style']=='Huangguanzise'?'checked':''?> /> 繁花似锦</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Huangguanjinse')" value="Huangguanjinse" id="mb_Huangguanjinse" <?php echo $userpost['style']=='Huangguanjinse'?'checked':''?>/> 秋日恋歌</td> 
       </tr> 
       <tr> 
        <td height="35" align="center" onmousemove="cgimg(this,'7',0)" onmouseout="cgimg(this,'G',1)"><img src="/Public/Member/images/G.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'8',0)" onmouseout="cgimg(this,'H',1)"><img src="/Public/Member/images/H.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'9',0)" onmouseout="cgimg(this,'I',1)"><img src="/Public/Member/images/I.png" width="120" /></td> 
       </tr> 
       <tr> 
        <td height="35" align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Hanshi')" value="Hanshi" id="mb_Hanshi" <?php echo $userpost['style']=='Hanshi'?'checked':''?>/> 最美时光</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Oushifg')" value="Oushifg" id="mb_Oushifg" <?php echo $userpost['style']=='Oushifg'?'checked':''?>/> 佳期如梦</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Xinxinxiangyin')" value="Xinxinxiangyin" id="mb_Xinxinxiangyin" <?php echo $userpost['style']=='Xinxinxiangyin'?'checked':''?>/> 浮影年华</td> 
       </tr> 
       <!--新添加模板开始--> 
       <tr> 
        <td height="35" align="center" onmousemove="cgimg(this,'10',0)" onmouseout="cgimg(this,'J',1)"><img src="/Public/Member/images/J.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'11',0)" onmouseout="cgimg(this,'K',1)"><img src="/Public/Member/images/K.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'12',0)" onmouseout="cgimg(this,'O',1)"><img src="/Public/Member/images/O.png" width="120" /></td> 
       </tr> 
       <tr> 
        <td height="35" align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Yesido')" value="Yesido" id="mb_Yesido" <?php echo $userpost['style']=='Yesido'?'checked':''?>/> 海洋之心</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Planning')" value="Planning" id="mb_Planning" <?php echo $userpost['style']=='Planning'?'checked':''?>/> 旧时微光</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Theonly')" value="Theonly" id="mb_Theonly" <?php echo $userpost['style']=='Theonly'?'checked':''?>/> 花田喜事</td> 
       </tr> 
       <tr> 
        <td height="35" align="center" onmousemove="cgimg(this,'13',0)" onmouseout="cgimg(this,'M',1)"><img src="/Public/Member/images/M.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'14',0)" onmouseout="cgimg(this,'N',1)"><img src="/Public/Member/images/N.png" width="120" /></td> 
        <td align="center" onmousemove="cgimg(this,'15',0)" onmouseout="cgimg(this,'L',1)"><img src="/Public/Member/images/L.png" width="120" /></td> 
       </tr> 
       <tr> 
        <td height="35" align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Ofingerprint')" value="Ofingerprint" id="mb_Ofingerprint" <?php echo $userpost['style']=='Ofingerprint'?'checked':''?>/> 大城小爱</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Rfingerprint')" value="Rfingerprint" id="mb_Rfingerprint" <?php echo $userpost['style']=='Default'?'Rfingerprint':''?>/> 花好月圆</td> 
        <td align="center"><input type="radio" name="m_bg" onclick="qrxzmb('Bluefingerprint')" value="Bluefingerprint" id="mb_Bluefingerprint" <?php echo $userpost['style']=='Bluefingerprint'?'checked':''?>/> 水木青华</td> 
       </tr> 
       <!--新添加模板结束--> 
      </tbody>
     </table> 
    </div> 
   </div>
  </div> 
     
     
  <div id="logout01">
   <table cellpadding="0" cellspacing="0" id="mscenter01">
    <tbody>
     <tr>
      <td>欢迎您，<?php echo $loginuser['mobile']?></td>
      <td width="6px"></td>
      <td><a href="<?php echo APP_NAME?>/member/index/login?act=y"><img src="/Public/Member/images/logout.png" /></a></td>
      <td width="6px"></td>
      <td><a href="<?php echo APP_NAME?>/member/member/uppwd"><img src="/Public/Member/images/changepwd-246.png" /></a></td>
      <td width="6px"></td>
      <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1307568719&site=qq&menu=yes"><img border="0" src="/Public/Member/images/help1.png" alt="有问题请跟我联系..." title="有问题请跟我联系..." /></a></td>
     </tr>
    </tbody>
   </table>
  </div> 
  <div id="footer02">
   Copyright 2014-2015 WE喜帖
  </div>  
 </body>
</html>