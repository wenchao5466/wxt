<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>WE喜帖</title>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<link href="/Public/Member/css/css.css" rel="stylesheet" type="text/css" />
<link href="/Public/Member/css/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/Member/js/jquery-1.4.2.min.js"></script>
<script src="/Public/Member/js/public.js"></script>
<script>
	function ck()
	{
		if($("#Filedata").val()=="")
		{
			msg("请选择要上传的文件","");
			return false;	
		}
		return true;
	}
</script>
</head>
<body>
  <div id="top01">
    <div id="topleft"><img src="/Public/Member/images/logo02.png" /></div>
    <div id="topright">
		<table><tr>
<td><a href="<?php echo APP_NAME?>/member/" >首页</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/member/edit"   > [ 请柬 →</a></td>
<td width="20px" ></td><td><a href="<?php echo APP_NAME?>/member/photo/glist"   >婚纱照 →</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/send"   >发布 ] </a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/person/glist"   >嘉宾</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/msg/glist"   >留言</a></td>

</tr></table>
    </div>
  </div>
  <div id="content01">
    <table id="mscenter01" cellpadding="10" cellspacing="6" bgcolor="#CCCCCC" width="800px">
      <tr>
        <td bgcolor="#FFFFFF" align="center">婚纱照上传</td>
      </tr>
      <tr>
        <td bgcolor="#ffffff">
            <table width="600" cellpadding="6" cellspacing="0"  >
                <form name="form1" onSubmit="return ck();" enctype="multipart/form-data" method="post" action="">
                    
                          <tr>
                            <td colspan="2" align="center"><span style="color:#F00"><?php echo $msg?></span></td>
                          </tr>
                          
         	          <tr>
                            <td width="70" align="right" >&nbsp;</td>
                            <td align="left">
                              <input type="file" name="Filedata" id="Filedata">&nbsp;&nbsp;
                              <input type="submit" name="button" id="button" value="提交">           
                              <input name="act" type="hidden" value="1"> </tr>
                          <tr >
                            <td align="right" >&nbsp;</td>
                            <td align="left">                     
                          </tr>
                          <tr >
                            <td align="right" >&nbsp;</td>
                            <td align="left"><a href="<?php echo APP_NAME?>/member/photo/glist"><span style="color:#03F">返回相册列表</span></a>          </tr> 
                </form>   
            </table></td>
        </tr>
   
    </table>
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
  <div id="footer02">Copyright 2014-2015 WE喜帖</div>
</body>
</html>