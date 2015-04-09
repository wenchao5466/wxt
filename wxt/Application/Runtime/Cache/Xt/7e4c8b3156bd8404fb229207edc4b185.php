<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WE喜帖</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" type="text/css" href="/Public/Xt/Huangguanjinse/css/css.css?2015061351"/>

</head>
<body id="mbody" >
<div class="splay" onClick="javascript:audio_switch1();" id="splay">
	<div></div>
</div>

<div style="display:none;">
  <audio id="car_audio" autoplay="true" controls loop preload="preload" >
    <source src="http://mp3.jiapai.cc/wxt/<?php echo $userpost['music']?>.mp3" type="audio/mpeg" >
  </audio>
</div>
 <div id="wxdh" style="position:fixed; display:none; bottom:0;  width:100%; max-width:640px;  z-index:1000; background-color:#000;">
 	<div style="overflow:hidden; background-color:#e0bc1c" >
    	<table width="99.9%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="33.3%" style="font-size:0px;"><img onClick="load_yqh(0)" src="/Public/Xt/Huangguanjinse/images/ndh1.jpg" class="full-img ndh1" /></td>
            <td width="33.3%" style="font-size:0px;"><img onClick="load_msg(0)" src="/Public/Xt/Huangguanjinse/images/ndh2_1.jpg" class="full-img ndh2" /></td>
            <td width="33.3%" style="font-size:0px;"><img onClick="load_photo(0)"src="/Public/Xt/Huangguanjinse/images/ndh3_1.jpg" class="full-img ndh3" /></td>
          </tr>
        </table>
    </div>
 	<div class="f22" style=" position:absolute; text-align:center; margin-left:18%; padding-top:3.1%;  padding-bottom:3.2%; width:49%; max-width:312px; color:#E0E0E0; background-color:#2d3132;"><span  onClick="laod_sh();">欢迎使用<?php echo $shop['shop_company']?>→</span></div>
  	 <img src="/Public/Xt/Huangguanjinse/images/wxdh1.jpg" border="0" usemap="#Map" class="full-img" style="width:100%; display:block">
     <map name="Map">
       <area id="b_shouye" shape="rect" coords="2,4,109,64" href="/wxt/xt/?code=<?php echo $code?>">
       <area id="b_fenxiang" shape="rect" coords="469,5,631,65" href="javascript:openShareDiv('share_div')">
     </map>
 </div>
 <div id="share_div" style=" display:none; position:absolute; left: 0px; top: 0px; width: 100%; z-index:9999; background-image:url(/Public/Xt/Huangguanjinse/images/bgcolor4.png); background-repeat:repeat;">
<div style=" position:absolute; top:10px; right:30px; "><img src="/Public/Xt/Huangguanjinse/images/arrow1.png" /></div>
<div style=" position:absolute; top:10px; left:10px;"><a onClick="closeShareDiv('share_div')"><img src="/Public/Xt/Huangguanjinse/images/close.png" /></a></div>
</div>
<div id="loadimg" style="position:fixed; font-size:0px; display:none;  z-index:2;  width:100%; text-align:center">
<img src="/Public/Xt/Huangguanjinse/images/load.gif" class="full-img" style="width:36%;" />
</div>
<div id="loadt" onClick="javascript:$(document).scrollTop(0);" style=" display:none; width:12%; font-size:0px; top:100px;  right:1%; position:fixed; z-index:1000">
	<img src="/Public/Xt/Huangguanjinse/images/rtop.png" class="full-img" />
</div>


</body>

<script src="/Public/Xt/Huangguanjinse/js/jquery-1.8.2.min.js"></script>
<script src="/Public/Xt/Huangguanjinse/js/public.js"></script>
<script>

$.ajaxSetup({  
    async : false  
});

(function($){

$.fn.extend({

insertAtCaret: function(myValue){

var $t=$(this)[0];

if (document.selection) {

this.focus();

sel = document.selection.createRange();

sel.text = myValue;

this.focus();

}

else 

if ($t.selectionStart || $t.selectionStart == '0') {

var startPos = $t.selectionStart;

var endPos = $t.selectionEnd;

var scrollTop = $t.scrollTop;

$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);

this.focus();

$t.selectionStart = startPos + myValue.length;

$t.selectionEnd = startPos + myValue.length;

$t.scrollTop = scrollTop;

}

else {

this.value += myValue;

this.focus();

}

}

}) 

})(jQuery);

$(document).ready(function(e) {
	
				load_index();
				load_wx_map();
		_p();
	
});

function load_h(v)
{
	if(v>0)
	{
		
		 var wh=parseInt($(window).height()*0.75+4);
		 $('#loadh').css({'top':wh+'px','display':'block'});
	}
	else
	{
		 $('#loadh').css({'display':'none'});
	}
}
function load_t(v,wh)
{
	if(v>0)
	{
		wh=parseInt(wh*0.75-$('#loadh').height());
		$('#loadt').css({'display':'block','top':wh+'px'});
	}
	else
	{   
		$('#loadt').css({'display':'none'});
	}
}

var _l=0;
var mbody = document.getElementById('mbody');
	mbody.addEventListener('touchstart', function(event) {
   if(_l==0)
   {
		_l++;_p();
   }
});
function laod_sh()
{
	openload();
	var url='/wxt/xt/index/sh?code=<?php echo $code?>';
	$.get(url,function(data){
		$('#main').remove();openload();
		$('body').prepend(data);
	});	
}
function load_wx_map()
{
	var b=0.10625;
	var pageW=$(document).width();if(pageW>=640){pageW=640;}b=pageW/640;
	$('#b_shouye').attr('coords',parseInt(2*b)+','+parseInt(4*b)+','+parseInt(109*b)+','+parseInt(64*b));
	$('#b_fenxiang').attr('coords',parseInt(469*b)+','+parseInt(5*b)+','+parseInt(631*b)+','+parseInt(65*b));
}

var indexdata='';
function load_index()
{
		seturl();
		load_t(0,0);
	load_h(0); 
	openload();
	$('#main').html('');
	$('#main').remove();
	setTimeout(function(){ys_load_index()},30)
	
}

function loadsy()
{
	var w=$(window).width();
	var h=$(window).height();
	

	
	var syh=$("#shouye").height();
	
	var t=new tclassa("shouye");
	
	$("#shouye").css({"height":h+"px"});
	if(h>syh)
	{
		$("#shouye").css({"height":h+"px"});
		$("#shouye1").css({"height":h+"px"});
		//$("#shouye1").css({"margin-top":parseInt((h-syh)/2)+"px"});
	}
}
var yqhpage=1;
var yqhload=true;
var loadi1=false;
function loadi(v)
{
	if(loadi1)
	{
		return ;	
	}loadi1=true;
		yqhload=true;
		yqhpage=1;
		var url='/wxt/xt/index/yqh?code=<?php echo $code?>';
		 $.get(url,function(data){
			 $('body').append(data);
			 var h=$(window).height();
			 st(h);
		});
	
	
	
}
var h1=0;
function st(h)
{
	if(h>0)
	{
			if(h<=5)
			{
				$("#shouye").css({"margin-top":(h1+Math.abs(h))+"px"});$("#shouye").remove(); $("#wxdh").css({"display":"block"});
				
			}
			else
			{
				h1=h1-5;
				$("#shouye").css({"margin-top":h1+"px"});
				setTimeout(function(){h=h-5;st(h);},1);
			}
	}
	else
	{
		$("#shouye").remove(); $("#wxdh").css({"display":"block"});
	}
}

function ys_load_index()
{
	var url='/wxt/xt/index/ajaxindex?code=<?php echo $code?>';
	$.get(url,function(data){
		openload();
		$('body').prepend(data);
			loadsy();
		});	
}
function laod_c()
{
	$("#dbdh").css({'bottom':'-5%'});
}
function load_dht()
{
	$("#dbdh").css({'bottom':'6.8%'});
}
/**加载留言**/
var msgpage=1;
var msgload=true;
function load_msg(v)
{
	load_h(1);
	if(v>0)
	{
		if(!msgload){return;};
		msgpage++;
		if(msgpage>$('#pagecount').val())
		{
				msgload=false;
				$('#ckgd').html('没有了哦');	 return;
		}
		openload();
		var url='/wxt/xt/index/msg'+'?p='+msgpage+"&code=<?php echo $code?>";
		 $.get(url,function(data){
			  openload();
			 if($.trim(data)!='')
			 {
				$('#loadmsglist').append(data);
				if((msgpage+1)>$('#pagecount').val())
				{
						msgload=false;
						$('#ckgd').html('没有了哦');	 return;
				}
			 }
			 else
			 {
			 	msgload=false;
				$('#ckgd').html('没有了哦');	 
			 }
			
		});
	}
	else
	{
		cgdh(2);
		$(document).scrollTop(0); 
		msgload=true;msgpage=1;
		openload();
		$('#main').html('');
	    $('#main').remove();
		var url='/wxt/xt/index/msg?code=<?php echo $code?>';
		 $.get(url,function(data){
			 openload();
			$('body').prepend(data);
			
		});
	
	}
	
}

/*加载邀请函*/

function load_yqh(v)
{

	load_h(1);
	if(v>0)
	{
		if(!yqhload){return;};
		yqhpage++;
		if(msgpage>$('#pagecount').val())
		{
				yqhload=false;
				$('#ckgd').html('没有了哦');	 return;
		}
		openload();
		var url='/wxt/xt/index/yqh'+'?code=<?php echo $code?>&p='+yqhpage;
		 $.get(url,function(data){
			  openload();
			 if($.trim(data)!='')
			 {
				$('#loadyqhlist').append(data);
				if((yqhpage+1)>$('#pagecount').val())
				{
						yqhload=false;
						$('#ckgd').html('没有了哦');	 return;
				}
			 }
			 else
			 {
			 	yqhload=false;
				$('#ckgd').html('没有了哦');	 
			 }
			
		});
	}
	else
	{
		cgdh(1);
		$(document).scrollTop(0); 
		yqhload=true;yqhpage=1;
		openload();
		$('#main').html('');
	    $('#main').remove();
		var url='/wxt/xt/index/yqh?code=<?php echo $code?>';
		 $.get(url,function(data){
			openload();
			$('body').prepend(data);
		});
	
	}
}

/**
发送祝福
**/
function sendzf(v)
{
	
	var url='/wxt/xt/index/sendzf?code=<?php echo $code?>';
			 var zf_name= $.trim($('#zf_name').val());
			 var zf_msg= $.trim($('#zf_msg').val());
			 var zf_giftid= $.trim($('#zf_giftid').val());
			 if(zf_name=='')
			 {
				 alert('姓名是不可以为空的哦！');return ;
			 }
			 if(zf_msg=='留下你的祝福...'||zf_msg=='')
			 {
				 alert('留言内容是不可以为空的哦！');return ;
			 }
			 openload();
		     var p={
			  'act':'y',
			  'zf_name':zf_name,
			  'zf_giftid':zf_giftid,
			  'zf_msg':zf_msg
		    }
		$.post(url,p,function(data){
			openload();
			if(data.status>0)
			{
				msgpage=1;
				msgload=true;
				load_msg(0)

			}
			else
			{
				alert(data.msg)
			}
			
		},'json');
}
/**
	接受邀请
**/
function sendyqh(v)
{
	if(v==0)
	{
		cgdh(1);
		openload();
	   $('#main').html('');
	   $('#main').remove();
		var url='/wxt/xt/index/sendyqh?code=<?php echo $code?>';
		$.get(url,function(data){
			 openload();
			 $('body').prepend(data);
		});	
	}	
	else
	{
		
		var url='/wxt/xt/index/sendyqh?code=<?php echo $code?>';
			 var yqh_name= $.trim($('#yqh_name').val());
			 var yqh_renshu= $.trim($('#yqh_renshu').val());
			 var yqh_qylx= $.trim($('#yqh_qylx').val());
			 var yqh_mobile= $.trim($('#yqh_mobile').val());
			 var yqh_msg=  $.trim($('#yqh_msg').val());
			 if(yqh_name=='')
			 {
				 alert('姓名是不可以为空的哦！');return ;
			 }
			
		var p={
			  'act':'y',
			  'yqh_name':yqh_name,
			  'yqh_renshu':yqh_renshu,
			  'yqh_qylx':yqh_qylx,
			  'yqh_mobile':yqh_mobile,
			  'yqh_msg':yqh_msg
		    }
			openload();
		$.post(url,p,function(data){
			openload();
			if(data.status>0)
			{
				 yqhpage=1;
				 yqhload=true;
				 load_yqh(0);	
			}
			else
			{
				alert(data.msg)
			}
			
		},'json');
		
	}
}


//礼物
function open_gift(id){
	var code = id % 6;
	var content = '<pre><img src="/Public/Xt/Huangguanjinse/lw/' + code +'.jpg" width="300px"><br/></pre>';
	openHelpDialog(content);
}
//礼物
function openHelpDialog(content) {
	art.dialog({
		title: "礼物",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '300px',  
		height: '300px',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: false,
	}).show;
	return false;
};

/**相册加载相册列表**/
var photopage=1;
var photoload=true;
function load_photo(v)
{
	load_h(1);
	if(v>0)
	{
		if(!photoload){return;};
		photopage++;
		if(photopage>$('#pagecount').val())
		{
				photoload=false;
				$('#ckgd').html('没有了哦');	 return;
		}
		openload();
		var url='/wxt/xt/index/photo'+'/?code=<?php echo $code?>&p='+photopage;
		 $.get(url,function(data){
			  openload();
			 if($.trim(data)!='')
			 {
				$('#loadphotolist').append(data);
				if((photopage+1)>$('#pagecount').val())
				{
						photoload=false;
						$('#ckgd').html('没有了哦');	 return;
				}
			 }
			 else
			 {
			 	photoload=false;
				$('#ckgd').html('没有了哦');	 
			 }
			
		});
	}
	else
	{
		cgdh(3);
		$(document).scrollTop(0); 
		photoload=true;photopage=1;
		openload();
		$('#main').html('');
	    $('#main').remove();
		var url='/wxt/xt/index/photo?code=<?php echo $code?>';
		 $.get(url,function(data){
			 $('#main').remove();openload();
			$('body').prepend(data);
			 
		});
	
	}
}

function photozan(v)
{
	var url='/wxt/xt/index/photozan'+'/?code=<?php echo $code?>&id='+v;
		openload();
		 $.get(url,function(data){
			 if(data.status>0)
			 {
				var z=Number($('#zan_'+v).html());
				    $('#zan_'+v).html(z+1);
			 }
			
			 openload();
		},'json');
}
/******/
var o_bq=0;
function openbq()
{
	
	$('#olw').css({'display':'none'});
	if($('#obq').css('display')=='block')
	{
		$('#obq').css({'display':'none'});return;
	}
	if(o_bq>0)
	{
		$('#obq').css({'display':'block'});	
	}
	else
	{
		var pageW=$(document).width();if(pageW>640){pageW=640;}
		var obj=$('#bqbtu');
		var offset = obj.offset();
	
			var objw=parseInt((pageW-$('#obq').width())/2);
			$('#obq').css({'display':'block'});	
		
		var n=pageW/640;
		$('#biaoqing area').each(function(i){
			var coords=$(this).attr('coords').split(",");
			var ncoords=parseInt(coords[0]*n)+','+parseInt(coords[1]*n)+','+parseInt(coords[2]*n)+','+parseInt(coords[3]*n)
			$(this).attr('coords',ncoords);
		});
	}
	o_bq++;
}
function xzbq(v){
	if($.trim($('#zf_msg').val())=='留下你的祝福...')
	{
		$('#zf_msg').val('');
	}
	$('#zf_msg').css('color','#999999');
	$('#zf_msg').insertAtCaret($.trim(v));
	$('#obq').css({'display':'none'});
}

function openlw()
{
	$('#obq').css({'display':'none'});
	if($('#olw').css('display')=='block')
	{
		$('#olw').css({'display':'none'});return;
	}
	var pageW=$(document).width();if(pageW>640){pageW=640;}
	
	
	var obj=$('#lwbtu');
	var offset = obj.offset();
	var objw=parseInt((pageW-$('#olw').width())/2);
	$('#olw').css({'display':'block'});	
}


function tclassa(id)
{
	
	var te=document.getElementById(id);
	var startX,   //触摸时的坐标
		startY,
		x,      //滑动的距离
		y,
		aboveY=0;       //设一个全局变量记录上一次内部块滑动的位置
		var touchSatrta=function(e){        //触摸
			var touch=e.touches[0];
			startY = touch.pageY;       //刚触摸时的坐标
			startX = touch.pageX;        //刚触摸时的坐标
		}
		var touchMovea=function (e){        //滑动
			var touch = e.touches[0];
			y = touch.pageY - startY;       //滑动的距离
			x = touch.pageX - startX;       //滑动的距离
			
			if(y>2 || y<-2) 
			{
				var s=2;
				if(touch.pageY<startY)
				{
					s=1;
					loadi(0);
				}
			}
		}
		var touchEnda=function (e){     //手指离开屏幕
			
		}
		te.addEventListener('touchstart', touchSatrta,false);
		te.addEventListener('touchmove', touchMovea,false);
		te.addEventListener('touchend', touchEnda,false);
}


function getdht1()
{
	/*var pageW=$(document).width();if(pageW>640){pageW=640;}
	var pageH=$(document).height();
	var pageWinH=$(window).height();
	if(pageWinH>pageH)
	{
		pageH=pageWinH;
	}
	var dhH=parseInt(pageW/16);
	var dhCH=parseInt(pageW/4.923076923076923); //导航条
	var wxdhH=parseInt(pageW/9.411764705882353); //微信导航条
	$('#dbdh').css({'top':pageH-dhH+'px','margin-bottom':wxdhH+'px','height':dhH+'px','display':'block'});*/
}


/*
	** 声音功能的控制
	*/
var	audio_switch_btn= true,			//声音开关控制值
	audio_btn		= true,			//声音播放完毕
	audio_loop		= true,		//声音循环
	audioTime		= null,         //声音播放延时
	audioTimeT		= null,			//记录上次播放时间
	audio_interval	= null,			//声音循环控制器
	audio_start		= null,			//声音加载完毕
	audio_stop		= null,			//声音是否在停止
	mousedown		= null;			//PC鼠标控制鼠标按下获取值
	
/*
** 声音功能
*/
	//关闭声音
	function audio_close(){
		if(audio_btn&&audio_loop){
			audio_btn =false;
			audioTime = Number($("#car_audio")[0].duration-$("#car_audio")[0].currentTime)*1000;	
			if(audioTime<0){ audioTime=0; }
			if(audio_start){
				if(isNaN(audioTime)){
					audioTime = audioTimeT;
				}else{
					audioTime > audioTimeT ? audioTime = audioTime: audioTime = audioTimeT;
				}
			};
			if(!isNaN(audioTime)&&audioTime!=0){
				audio_btn =false;		
				setTimeout(
					function(){	
						$("#car_audio")[0].pause();
						$("#car_audio")[0].currentTime = 0;
						audio_btn = true;
						audio_start = true;	
						if(!isNaN(audioTime)&&audioTime>audioTimeT) audioTimeT = audioTime;
					},audioTime);
			}else{
				audio_interval = setInterval(function(){
					if(!isNaN($("#car_audio")[0].duration)){
						if($("#car_audio")[0].currentTime !=0 && $("#car_audio")[0].duration!=0 && $("#car_audio")[0].duration==$("#car_audio")[0].currentTime){
							$("#car_audio")[0].currentTime = 0;	
							$("#car_audio")[0].pause();
							clearInterval(audio_interval);
							audio_btn = true;
							audio_start = true;
							if(!isNaN(audioTime)&&audioTime>audioTimeT) audioTimeT = audioTime;
						}
					}
				},20)	
			}
		}
	}
	
	//页面声音播放

		function audio_switch1(){
		
			if($("#car_audio")==undefined){
				return;
			}
			if(audio_switch_btn){
				
				//关闭声音
				$("#car_audio")[0].pause();
				audio_switch_btn = false;
				//$("#car_audio")[0].currentTime = 0;alert(6);
				document.getElementById('splay').style.backgroundPosition='0px 0px';
		       
			}
			//开启声音
			else{
				audio_switch_btn = true;
				$("#car_audio")[0].play();
				document.getElementById('splay').style.backgroundPosition='-39px 0px';
		       
			}
			
		}
function _p()
{
	$("#car_audio")[0].play();	
}

function cgdh(v)
{
	$(".ndh1").attr('src',"/Public/Xt/Huangguanjinse/images/ndh1_1.jpg");
	$(".ndh2").attr('src',"/Public/Xt/Huangguanjinse/images/ndh2_1.jpg");
	$(".ndh3").attr('src',"/Public/Xt/Huangguanjinse/images/ndh3_1.jpg");
	$(".ndh"+v).attr('src',"/Public/Xt/Huangguanjinse/images/ndh"+v+".jpg");
}


var contentModel = {
    "img_url": "<?php echo $sharelogo?>", 
    "img_width": "", 
    "img_height": "", 
    "link": "<?php echo $shareurl?>", 
    "desc": "<?php echo $userpost['man']?>&<?php echo $userpost['woman']?>的婚礼",
    "title": "<?php echo $userpost['man']?>&<?php echo $userpost['woman']?>的婚礼",
    "src": "诚挚邀请您来参加我们的婚礼，点击可签收邀请函、留祝福和欣赏甜蜜婚纱照◢" 
};
//实验muin
var muinObj = {"allUser":1};

 function openload()
 {
		if($('#loadimg').css('display')=='none')
		{
				var wh=$(window).height();
				var lh=$('#loadimg').height();
				var ch=parseInt(wh/2-lh/2);
				$('#loadimg').css({'top':ch+'px','display':'block'});	
		}
		else
		{
			$('#loadimg').css({'display':'none'});	
		}	 
 }$(window).bind('hashchange', function(i) {
window.location.href=window.location.href;
});
function seturl()
{
	var iurl=window.location.href;
	if(iurl.indexOf('#')>-1)
	{
		iurl=iurl.split('#');
		iurl=iurl[0]+'#'+parseInt(Math.random()*10);
	}
	else
	{
		iurl+='#1';
	}
	history.pushState({},'',iurl);
}
 
</script>
<script language="JavaScript" src="http://mat1.gtimg.com/www/js/newsapp/wechat/wechat20130619_min.js" type="text/javascript" charset="utf-8"></script>
<script>
function onBridgeReady(){
     document.addEventListener('WeixinJSBridgeReady', function onBridgeReady()     
{  WeixinJSBridge.call('hideToolbar');
 }); WeixinJSBridge.call('showOptionMenu');
}

if (typeof WeixinJSBridge == "undefined"){
    if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
}else{
    onBridgeReady();
}

</script>
 
</html>