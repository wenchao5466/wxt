<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>WE喜帖</title>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<link href="/Public/Shop/css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function checkForm(){
	if (document.getElementById('pwd').value == '' || document.getElementById('mobile').value == ''){
		document.getElementById('error').innerHTML = "请填写手机号和密码";
		document.getElementById('m_mobile').focus();
		return false;
	}else{
		return true;
	}
}
function tz()
{
	window.location.href='<?php echo APP_NAME?>/shop';	
}
function close_o()
{
		document.getElementById('erweima').style.display='none';
		document.getElementById('erweima1').style.display='none';
}
function open_o(v)
{
	    if(v==1)
		{
			document.getElementById('erweima1').style.display='none';
			document.getElementById('erweima').style.display='block';
		}
		else
		{
			document.getElementById('erweima').style.display='none';
			document.getElementById('erweima1').style.display='block';
			
		}
}
</script>

</head>
<body>
  <div id="mscenter"><img src="/Public/Member/images/logo01.png" /></div>
  <div id="mscenter">
	<form action="<?php echo APP_NAME?>/member/index/check" method="post" onsubmit="return checkForm();">
    <table cellpadding="0" width="591" cellspacing="10" bgcolor="#FFFFFF" id="mscenter01">
	  <tr><td align="left"><span id="error" style="color:red"><?php echo $error;?></span></td></tr>
	  <tr><td width="200px" align="left">手机号：</td><td width="200px" align="left">密码：</td><td></td></tr>
      <tr><td align="left"><input type="text" width="100%" name="mobile" id="mobile" /></td><td align="left"><input type="password" name="pwd" width="100%" id="pwd"  /></td><td><input type="image" src="/Public/Member/images/button01.png" /></td></tr>
      
    </table>
	<input type="hidden" name="act" value="login">
	</form>
  </div>
  <div style="margin-top:20px;">
  <table width="591" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td height="35" align="center" bgcolor="#FFFFFF"><input style="width:150px; height:40px; margin:10px;" onClick="open_o(1)" type="submit" name="button" id="button" value="新用户注册"></td>
    <td align="center" bgcolor="#FFFFFF"><input style="width:150px; height:40px;margin:10px;" onClick="open_o(2)" type="submit" name="button2" id="button2" value="礼品卡注册
"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><img src="/Public/Member/images/ewm.jpg" usemap="#erweimaMap" id="erweima" style="margin-bottom:10px; display:none">
    <img src="/Public/Member/images/ewm1.jpg" usemap="#erweimaMap1" id="erweima1" style="margin-bottom:10px; display:none">
    </td>
    </tr>
</table>

</div>
  <div id="footer01">Copyright 2014-2015 WE喜帖 &nbsp;&nbsp;<a style="color:#666666" href="<?php echo APP_NAME?>/shop">[商户后台]</a></div>

<map name="erweimaMap">
  <area shape="rect" coords="564,2,582,16" href="javascript:close_o();">
</map>
<map name="erweimaMap1">
  <area shape="rect" coords="564,2,582,16" href="javascript:close_o();">
</map>
</body>


<!--<div style="display: none">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F333da89737d725c5f86eb4194bcd8d91' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>-->


</html>