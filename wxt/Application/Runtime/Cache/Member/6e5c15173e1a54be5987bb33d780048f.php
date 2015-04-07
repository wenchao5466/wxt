<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>WE喜帖</title>
<link rel="shortcut icon" href="/Public/Home/favicon.ico" type="image/x-icon" />
<link href="/Public/Member/css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/Member/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/Public/Member/js/public.js"></script>
<script>


	var sd=false;
	function del(v,id)
	{
		if(v==0)
		{
			 msgc('您确定要删除吗?','del',"'1','"+id+"'");return;
		}
		if(sd)
		{
			return ;	
		}
		sd=true;
		
		$.post("/wxt/member/person/del",{'id':id,'type':'ajax'},function(data){
			if(data.status>0)
			{
				window.location.href=window.location.href;
			}
			else
			{
				sd=false;
				msg(data.msg,'');	
			}
		},'json');
			
	}
</script>
</head>
<body>
  <div id="top01">
    <div id="topleft"><img src="/Public/Member/images/logo02.png" /></div>
    <div id="topright">
		<table><tr>
<td><a href="/member/" >首页</a></td>
<td width="20px"></td><td><a href="/wxt/member/member/edit"   > [ 请柬 →</a></td>
<td width="20px" ></td><td><a href="/wxt/member/photo/glist"   >婚纱照 →</a></td>
<td width="20px"></td><td><a href="/wxt/member/send"   >发布 ] </a></td>
<td width="20px"></td><td><a href="/wxt/member/person/glist"  style="font-weight:bold" >嘉宾</a></td>
<td width="20px"></td><td><a href="/wxt/member/msg/glist"   >留言</a></td>

</tr></table>
    </div>
  </div>
  <div id="content01">
    <table id="mscenter01" cellpadding="10" cellspacing="6" bgcolor="#CCCCCC" width="800px">
      <tr>
        <td bgcolor="#FFFFFF" align="center">查看嘉宾<span style="color:red"></span></td>
      </tr>
      <tr>
        <td bgcolor="#ffffff" align="center">
            <table cellpadding="6" cellspacing="0">
                
                <?php foreach($guests as $guest):?>
                <tr>
                   <td width="20%" align="center" style="border-bottom:dashed 1px #ccc"><?php echo $guest['name']?></td>
                   <td width="20%" align="center" style="border-bottom:dashed 1px #ccc"><?php echo $guest['id']?></td>
                   <td width="20%" align="center" style="border-bottom:dashed 1px #ccc"></td>
                   <td style="border-bottom:dashed 1px #ccc"><?php echo $guest['description']?></td>
                   <td style="border-bottom:dashed 1px #ccc"><a style="cursor:pointer" onClick="del(0,<?php echo $guest['id']?>)">删</a></td>
                 </tr>
                 <?php endforeach;?>

                 <tr>
                   <td colspan="5" align="center"><div class="page"><div> <?php echo $page?>   </div></div></td>
                 </tr>
           </table>
        </td>
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