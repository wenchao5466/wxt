<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
	<title>查看留言</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	
	<link rel="stylesheet" href="/public/Wedding/css/pages.css" />
	<script src="/public/Wedding/js/require.js" data-main="/public/Wedding/js/main"></script>
	<script type="text/javascript" src="/Public/Wedding/js/jq.js"></script>
	<script type="text/javascript" src="/Public/Wedding/js/public.js"></script>
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
			$.post("/wxt/Wedding/msg/del",{'id':id,'type':'ajax'},function(data){
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
<div class="bod_cent">
	<div class="ckly">
		<section class="ckly_top c4c">共收到<font class='d_ib'>3</font>条祝福</section>
		<div class="ckly_t bg_fff">

			<div class="ckly_ta d_tb row100 bor_no">
				<div class="ckly_ta_l d_tb_c">
					<font>阿朵1</font><br/>
					<em>你终于娶了呀！</em><br/>
					<var>2015-1-25 17:58:39</var>
				</div>
				<div class="ckly_ta_r d_tb_c">
					<a href="javascript:void(0)"><img src="/public/Wedding/images/delet.png" alt=""></a>
				</div>
			</div>
			<div class="ckly_ta d_tb row100">
				<div class="ckly_ta_l d_tb_c">
					<font>阿朵2</font><br/>
					<em>你终于娶了呀！</em><br/>
					<var>2015-1-25 17:58:39</var>
				</div>
				<div class="ckly_ta_r d_tb_c">
					<a href="javascript:void(0)"><img src="/public/Wedding/images/delet.png" alt=""></a>
				</div>
			</div>
			<div class="ckly_ta d_tb row100">
				<div class="ckly_ta_l d_tb_c">
					<font>阿朵3</font><br/>
					<em>你终于娶了呀！</em><br/>
					<var>2015-1-25 17:58:39</var>
				</div>
				<div class="ckly_ta_r d_tb_c">
					<a href="javascript:void(0)"><img src="/public/Wedding/images/delet.png" alt=""></a>
				</div>
			</div>
			<div class="ckly_ta d_tb row100">
				<div class="ckly_ta_l d_tb_c">
					<font>阿朵4</font><br/>
					<em>你终于娶了呀！</em><br/>
					<var>2015-1-25 17:58:39</var>
				</div>
				<div class="ckly_ta_r d_tb_c">
					<a href="javascript:void(0)"><img src="/public/Wedding/images/delet.png" alt=""></a>
				</div>
			</div>

		</div>

		<div class="yyjb_cont_b t_al_c">
			(点击)上拉查看更多...
		</div>
	</div>
	
</div>
</body>
</html>