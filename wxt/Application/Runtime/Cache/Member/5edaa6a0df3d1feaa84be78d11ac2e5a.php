<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>WE喜帖</title>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<link href="/Public/Shop/css/css.css" rel="stylesheet" type="text/css" />
</head>
  
<body>
  <div id="mscenter02"><img src="/Public/Member/images/logo01.png" /></div>
  <div id="bigfont">简单三步，轻松制作自己的WE喜帖:</div>
  <div id="buttons01">
    <table cellpadding="0" cellspacing="0" id="mscenter01"><tr><td><a href="<?php echo APP_NAME?>/member/member/edit"><img src="/Public/Member/images/button_invite.png" /></a></td><td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/photo/glist"><img src="/Public/Member/images/button_pic.png" /></a></td><td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/send"><img src="/Public/Member/images/button_sent.png" /></a></td></tr></table>
  </div>
  <div id="buttons02">
    <table cellpadding="0" cellspacing="0" id="mscenter01"><tr><td><a href="<?php echo APP_NAME?>/member/person/glist"><img src="/Public/Member/images/button_person.png" /></a></td><td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/msg/glist"><img src="/Public/Member/images/button_message.png" /></a></td></tr></table>
</div>
  <div id="logout01">
   <table cellpadding="0" cellspacing="0" id="mscenter01">
    <tbody>
     <tr>
      <td>欢迎您，<?php echo $user['mobile']?></td>
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