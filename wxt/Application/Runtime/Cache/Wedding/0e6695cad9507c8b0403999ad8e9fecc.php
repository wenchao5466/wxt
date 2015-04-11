<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
<title>查看留言</title>
<meta charset='utf-8'>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Expires" CONTENT="-1">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">

<link rel="stylesheet" href="/public/Wedding/css/pages.css" />
<script src="/public/Wedding/js/require.js" data-main="/Public/Wedding/js/main"></script>
<script type="text/javascript" src="/Public/Wedding/js/jq.js"></script>
<script type="text/javascript">
	var sd = false;
	/*
	function del(v, id) {
		if (v == 0) {
			if (confirm('您确定要删除吗?')) {
				if (sd) {
					return;
				}
				sd = true;
				$.post("/wxt/Wedding/msg/del", {
					'id' : id,
					'type' : 'ajax'
				}, function(data) {
					if (data.status > 0) {
						window.location.href = window.location.href;
					} else {
						sd = false;
						//alert(data.msg, '');
					}
				}, 'json');
			}
		}
	}
	*/

	
	function showPage(is_init){
		
		var page = $("#page").val();//当前页码
		var prev_page = $("#prev_page").val();//前一页
		var next_page = $("#next_page").val();//后一页
		var total_current = $("#total_page").val();//总页数
		
		if(page >= total_current){
			return false;
		}else{
		
			$.get("<?php echo APP_NAME?>/wedding/msg/glist/p/"+page+"/page/"+page+"/prev_page/"+prev_page+"/next_page/"+next_page,function(result){
					console.log(result);
					//window.location.href=window.location.href;
						var data = result.list;
						var html = '';
						for(var i in data){
							html += '<div class="ckly_ta d_tb row100 bor_no">';
							html += '	<div class="ckly_ta_l d_tb_c">';
							html += '		<font>'+data[i].name+'</font><br><em>'+data[i].description+'</em><br>';
							html += '		<var>'+data[i].create_time+'</var>';
							html += '	</div>';
							html += '	<div class="ckly_ta_r d_tb_c">';
							html += '		<a onclick="del(0,62)" href="javascript:void(0)"><img alt="" src="/public/Wedding/img/delet.png"></a>';
							html += '	</div>';
							html += '</div>';
						}
						
						if(is_init == 1){
							$("#messages").html(html);
						}else{
							$("#messages").append(html);
						}
						
						$("#page").val(result.page);
						$("#prev_page").val(result.prev_page);
						$("#next_page").val(result.next_page);
						$("#total_page").val(result.total_page);
						
					return true;
			},'json');
		}
	}
	
$(function(){
	showPage(1);
	$("#show_more").click(function(){
		showPage(2);
	});
});
</script>
</head>
<body>
	<div class="bod_cent">
		<div class="ckly">
			<section class="ckly_top c4c">
				共收到<font class='d_ib'>
					<?php echo $count ?>
				</font>条祝福
			</section>
			<div class="ckly_t bg_fff">
				<div class="ckly_ta d_tb row100 bor_no" id="messages">
					

				</div>
			</div>

			<div class="yyjb_cont_b t_al_c" id="show_more">(点击)上拉查看更多...</div>
			<input type="hidden" name="page" id="page" value="1"/>
			<input type="hidden" name="prev_page" id="prev_page" value="1"/>
			<input type="hidden" name="next_page" id="next_page" value="2"/>
			<input type="hidden" name="total_page" id="total_page" value="<?php echo ($total_page); ?>"/>
		</div>

	</div>
</body>
</html>