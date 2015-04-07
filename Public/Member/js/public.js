function numsj()
{
    var Numkey = Math.random();
     return Numkey = Math.round(Numkey*10000);
}
function closemsg(_location)
{
	if(_location!='')
	{
		window.location.href=_location;	
	}
	$('#overlay').css('display','none');
	$('#win').css('display','none');
	$('#overlay').remove();
	$('#win').remove();

}
function pageopen(Page, Width, Height) {
		var iTop = (window.screen.availHeight-30-100)/2;
		var iLeft = (window.screen.availWidth-10-400)/2;
        var str = "Height=" + Height + ",width=" + Width + ",scrolling=auto,top=" + iTop + ",left=" + iLeft;
        window.open(Page, "newwindo", str);
}
function closemsgc()
{
	$('#overlayc').css('display','none');
	$('#winc').css('display','none');
	$('#overlayc').remove();
	$('#winc').remove();
}
function scrollTop(){ 
return window.pageYOffset 
|| document.documentElement && document.documentElement.scrollTop 
|| document.body.scrollTop; 
}

function msg(s,_location)
{
	closemsgc();
      var str='<div id="overlay" style="z-index:1000"></div>';	
        str+='<div id="win" style="z-index:1000; text-align:center">';
	    str+='	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#808080" >';
	    str+='		  <tr>';
		str+='		  		<td height="27" bgcolor="#E1E1E1"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
		str+='		  		  <tr>';
		str+='		  			<td width="3%" align="right"></td>';
		str+='		  			<td width="90%" style="font-size:12px;">提示</td>';
		str+='		  			<td width="7%"><img src="/Public/Admin/images/x.png" alt="关闭" title="关闭" onClick="closemsg(\''+_location+'\')" style="cursor:pointer;"  /></td>';
		str+='		  		  </tr>';
		str+='		  		</table></td>';
		str+='		  		</tr>';
		str+='		  	  <tr>';
		str+='		  		<td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="line-height:24px; margin-top:10px;">';
		str+='		  		  <tr>';
		str+='		  			<td width="100%"><div style="padding:4px; margin:8px;line-height:22px; text-align:left; font-size:12px; color:#FF0000">';
		str+=s;
		str+='		  			  </div></td>';
		str+='		  		  </tr>';
		str+='		  		 <tr>';
		str+='		  		   <td colspan="2">&nbsp;</td>';
		str+='		  		 </tr>';
		str+='		  		</table></td>';
		str+='		  	  </tr>';
		str+='		  	</table>';
		str+='		  	</div>';
		
		
		$("body").append(str);
		
		
		var divh=$("#win").height();
		
		var h=getScrollHeight()+scrollTop();
		var h1=0;
			if(divh<h)
			{
				h1=(getClientHeight()/2+getScrollTop()-(divh/2));
			}
		var w=getScrollscrollWidth();
		var w1=w/2-150;
		
		
		
		$('#overlay').css({'display':'block','height':h+'px'});
		$('#win').css({'display':'block','left':w1+'px','top':h1+'px'})
}
function msgc(s,f,p)
{
	  closemsg('');
      var str='<div id="overlayc" style="z-index:1000"></div>';	
        str+='<div id="winc" style="z-index:1000; text-align:center">';
	    str+='	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#808080" >';
	    str+='		  <tr>';
		str+='		  		<td height="27" bgcolor="#E1E1E1" ><table width="100%" border="0" cellspacing="0" cellpadding="0">';
		str+='		  		  <tr>';
		str+='		  			<td width="3%" align="right"></td>';
		str+='		  			<td width="90%" style="font-size:12px;">提示</td>';
		str+='		  			<td width="7%"><img src="/Public/Admin/images/x.png" alt="关闭" title="关闭" onClick="closemsgc()" style="cursor:pointer;"  /></td>';
		str+='		  		  </tr>';
		str+='		  		</table></td>';
		str+='		  		</tr>';
		str+='		  	  <tr>';
		str+='		  		<td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="line-height:24px; margin-top:10px;">';
		str+='		  		  <tr>';
		str+='		  			<td width="100%"><div style="padding:4px; margin:8px;line-height:22px; text-align:center; font-size:12px; color:#FF0000">';
		str+=s;
		str+=' </div>';
		str+='<div style="padding:4px; margin:8px;line-height:22px; text-align:center; font-size:12px;">';
		
		 str+='<a href="javascript:'+f+'('+p+')">确定</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:closemsgc()">取消</a>';
		
		str+=' </div>';
		str+='</td>';
		str+='		  		  </tr>';
		str+='		  		 <tr>';
		str+='		  		   <td colspan="2">&nbsp;</td>';
		str+='		  		 </tr>';
		str+='		  		</table></td>';
		str+='		  	  </tr>';
		str+='		  	</table>';
		str+='		  	</div>';
		
		
		$("body").append(str);
		
		
		var divh=$("#winc").height();
		
		var h=getScrollHeight();
		var h1=0;
			if(divh<h)
			{
				h1=(getClientHeight()/2+getScrollTop()-(divh/2));
			}
		var w=getScrollscrollWidth();
		var w1=w/2-150;
		
		$('#overlayc').css({'display':'block','height':h+'px'});
		
		
		$('#winc').css({'display':'block','left':w1+'px','top':h1+'px'})
}
function isdigit(s)
{
	var r,re;
	re = /\d*/i; //\d表示数字,*表示匹配多个数字
	r = s.match(re);
	return (r==s)?1:0;
}
function isdate(strDate){
      if(strDate.length>0){
     var reg= /^(\d+)\/(\d{1,2})\/(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;   
       if(!reg.test(strDate)){   
        return true; 
       }
     }
     return false;
}
function isemail(email)
{
	var ereg=/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/ig;
	if(!ereg.test(email)){
		return 0;
	}else{
		return 1;
	}
}
function getScrollscrollWidth()
{
    return Math.max(document.body.scrollWidth,document.documentElement.scrollWidth);
}
function getScrollHeight()
{
    return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
}

function getScrollTop(){
    var scrollTop=0;
    if(document.documentElement&&document.documentElement.scrollTop){
        scrollTop=document.documentElement.scrollTop;
    }else if(document.body){
        scrollTop=document.body.scrollTop;
    }
    return scrollTop;
}
/********************
 * 取窗口可视范围的高度 
 *******************/
function getClientHeight(){
    var clientHeight=0;
    if(document.body.clientHeight&&document.documentElement.clientHeight)
    {
        var clientHeight = (document.body.clientHeight<document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;        
    }else{
        var clientHeight = (document.body.clientHeight>document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;    
    }
    return clientHeight;
}

function printObject(o){
    var out = ''; 
    for (var p in o) { 
        if (!o.hasOwnProperty(p)) 
            out += '(inherited) '; 
        else
            out += p + ': ' + o[p] + '\r\n'; 
    }  
    alert(out);
} 