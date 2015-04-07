<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <title>WE喜帖</title> 
  <link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
  <link href="/Public/Shop/css/css.css" rel="stylesheet" type="text/css" /> 
 </head> 
 <body> 
  <div id="mscenter02">
   <img src="/Public/Shop/images/logo03.png" />
  </div> 
  <div id="bigfont">
   WE喜帖管理后台，商家账号共 <?php echo $shopcount?> 个
  
  </div> 
  <div id="buttons03"> 
   <table cellpadding="0" cellspacing="0" id="mscenter01">
    <tbody>
     <tr> 
      <td><a href="/wxt/admin/shop/glist"><img src="/Public/Shop/images/button_account.png" /></a></td> 
      <td width="20px"></td>
      <td><a href="/wxt/admin/account/glist"><img src="/Public/Shop/images/button_history.png" /></a></td> 
     </tr>
    </tbody>
   </table> 
  </div> 
  <div id="logout01">
   <table cellpadding="0" cellspacing="0" id="mscenter01">
    <tbody>
     <tr>
      <td>欢迎您，管理员</td>
      <td width="6px"></td>
      <td><a href="/wxt/admin/index/login?act=y"><img src="/Public/Shop/images/logout.png" /></a></td>
      <td width="6px"></td>
      <td><a href="/wxt/" target="_blank"><img src="/Public/Shop/images/zhizuo.png" /></a></td>
     </tr>
    </tbody>
   </table>
  </div> 
  <div id="footer02">
   Copyright 2014-2015 WE喜帖
  </div>  
 </body>
</html>