<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>WE喜帖</title>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<link href="/Public/Shop/css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function checkForm(){
	if (document.getElementById('pwd').value == '' || document.getElementById('username').value == ''){
		document.getElementById('error').innerHTML = "请填写用户名和密码";
		document.getElementById('username').focus();
		return false;
	}else{
		return true;
	}
}
</script>

</head>
<body>
  <div id="mscenter"><img src="/Public/Shop/images/logo03.png" /></div>
  <div id="mscenter">
	<form action="/wxt/admin/index/check" method="post" onsubmit="return checkForm();">
    <table cellpadding="0" cellspacing="10" bgcolor="#FFFFFF" id="mscenter01">
	  <tr><td align="left"><span id="error" style="color:red"><?php echo $error?></span></td></tr>
	  <tr><td width="200px" align="left">用户名：</td><td width="200px" align="left">密码：</td><td></td></tr>
      <tr><td align="left"><input type="text" width="100%" name="username" id="username" /></td><td align="left"><input type="password" name="pwd" width="100%" id="pwd"  /></td><td><input type="image" src="/Public/Shop/images/button01.png" /></td></tr>
      
    </table>
	<input type="hidden" name="act" value="login">
	</form>
  </div>
  <div id="footer01">Copyright 2014-2015 WE喜帖</div>
</body>
</html>