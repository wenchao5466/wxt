<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
  <title>WE喜帖</title> 
  <link href="/Public/Member/css/css.css" rel="stylesheet" type="text/css" /> 
  <script src="/Public/Member/js/jquery-1.4.2.min.js" type="text/javascript"></script> 
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
       <td><a href="<?php echo APP_NAME?>/member/member/edit"> [ 请柬 →</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/photo/glist">婚纱照 →</a></td> 
       <td width="20px"></td>
       <td><a href="<?php echo APP_NAME?>/member/send" style="font-weight:bold">发布 ] </a></td> 
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
      <td bgcolor="#FFFFFF" align="center">发布&amp;保存到微信<span style="color:red"></span></td>
     </tr> 
     <tr>
      <td bgcolor="#ffffff" align="center"> 
       <table cellpadding="6" cellspacing="0"> 
        <tbody>
         <tr>
          <td colspan="2" align="center" valign="top"><strong>我的婚礼二维码</strong></td>
         </tr> 
         <tr>
             <td width="432" align="center"><img src="http://qr.liantu.com/api.php?bg=ffffff&amp;fg=ff0000&amp;gc=222222&amp;el=l&amp;w=238&amp;m=10&amp;text=<?php echo $text?>" alt="QR code" widhtheight="238" /></td> 
          <td width="308" align="center">
           <div onmouseover="javascript:document.getElementById('bcsm').style.display='block';" style="line-height:0px; text-align:left;">
            <img src="/Public/Member/images/baocun.jpg" />
            <br /> 
            <img src="/Public/Member/images/baocunshuoming.jpg" border="0" usemap="#bcsmMap" id="bcsm" style="position:absolute; display:none; margin-left:-435px; width:729px;" /> 
           </div></td> 
         </tr> 
         <tr>
          <td align="center" valign="top"><span style="color:red">二维码图片保存方式：</span><br />鼠标指向二维码图片，点击右键，选择&quot;图片另存为&quot;即可</td> 
          <td align="center" valign="top">&nbsp;</td> 
         </tr> 
         <tr>
          <td colspan="2" align="center"><img src="/Public/Member/images/s1.jpg" /></td>
         </tr> 
         <tr>
          <td colspan="2" align="center"><img src="/Public/Member/images/s2.jpg" /></td>
         </tr> 
         <tr>
          <td colspan="2" align="center"><img src="/Public/Member/images/s3.jpg" /></td>
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
      <td align="center" colspan="2"> <input type="file" name="m_inv_pic" id="m_inv_pic" onchange="ajaxFileUpload()" /><br /> 在此上传喜帖封面照片，照片文件大小<span style="color:red">不能超过800KB，尺寸宽度不要超过600px</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://xiuxiu.web.meitu.com/main.html" target="_blank"><span style="color:red">在线图片处理&gt;&gt;</span></a><br /> 若无法上传图片，可能使用的浏览器版本较低，请升级浏览器版本或更换其他浏览器上传！ </td>
     </tr> 
     <tr>
      <td align="center" id="gethtml"> <img id="target" style="display:none" /> </td> 
      <td valign="top"> 
       <div style="width:240px;height:160px;overflow:hidden; float:left;">
        <img style="float:left; display:none" id="preview2" />
       </div> <br /> <input type="button" value="剪裁" onclick="confirmUpload('share_div');" />&nbsp;<input type="button" value="关闭" onclick="closeShareDiv('share_div')" /> </td> 
     </tr> 
    </tbody>
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
      <td><a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=60da6f751c5f49db2a1b67cddd53780c50cf2fcfbfdf656d"><img border="0" src="/Public/Member/images/help1.png" alt="有问题请跟我联系..." title="有问题请跟我联系..." /></a></td>
     </tr>
    </tbody>
   </table>
  </div>  
  <div id="footer02">
   Copyright 2014-2015 WE喜帖
  </div> 
  <map name="bcsmMap"> <area shape="rect" coords="673,98,727,142" style="cursor:pointer" onclick="javascript:document.getElementById('bcsm').style.display='none';"></area> </map>  
 </body>
</html>