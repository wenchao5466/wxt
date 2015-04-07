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
<script src="/Public/Member/js/jquery.uploadify.min.js"></script>
<script src="/Public/Member/js/jquery.artDialog.js?skin=idialog"></script>
<script type="text/javascript" src="/Public/Member/js/public.js"></script>
<script>
function help1(){
	var content = '<pre>视频添加方式：<br/><br/>1、点击<a href="http://v.qq.com/boke/upload.html" target="_blank">http://v.qq.com/boke/upload.html</a>上传视频<br/><br/>2、视频上传并审核好后打开视频，在视频播放页面的"分享"中展开，选择复制"通用代码"<br/><br/><img src="/Public/Member/images/v.jpg"><br/><br/>3、将复制的通用代码粘贴到本后台的文本框中即可完成<br/></pre>';
	openHelpDialog(content);
}
function help2(){
	var content = '<pre>若照片超过5MB，<br><br>';
		content += '1.可使用';
		content += '<a href="http://xiuxiu.web.meitu.com/main.html" target="_blank"><span style="color:#03F;">美图秀秀WEB版</span></a>';
		content += '调整大小后在上传，<br>';
		content += '2.可上传到<a href="http://rc.qzone.qq.com/photo/" target="_blank"><span style="color:#03F;">QQ空间相册</span></a>后再将图片另存到电脑上再上传到这里。</pre>';
	  openHelpDialog2(content);
}
function openHelpDialog(content) {
	art.dialog({
		title: "帮助",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '450',  
		height: '250',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: true,
	}).show;
	return false;
};

function openHelpDialog2(content) {
	art.dialog({
		title: "帮助",
		fixed: true,  
		resize: false,  
		drag: false,  
		lock: true,  
		width: '450',  
		height: '250',  
		opacity:0.5,  
		padding: 0,  
		zIndex:200000000,  
		content:content,  
		close: true,
	}).show;
	return false;
};

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
		$.post("<?php echo APP_NAME?>/member/photo/del",{'id':id,'type':'ajax'},function(data){
			
				
				window.location.href=window.location.href;
			
		},'json');
			
	}
	function _sort(v,id)
	{
		$.post("<?php echo APP_NAME?>/member/photo/psort",{'id':id,'type':'ajax','v':v},function(data){
			
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
	function upvideo()
	{
		$.post("<?php echo APP_NAME?>/member/photo/upvideo",{'type':'ajax','video':$.trim($('#video_url').val())},function(data){
			
			if(data.status>0)
			{
				//window.location.href='<?php echo APP_NAME?>/member/send';	
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
<td><a href="<?php echo APP_NAME?>/member/" >首页</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/member/edit"   > [ 请柬 →</a></td>
<td width="20px" ></td><td><a href="<?php echo APP_NAME?>/member/photo/glist"  style="font-weight:bold" >婚纱照 →</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/send"   >发布 ] </a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/person/glist"   >嘉宾</a></td>
<td width="20px"></td><td><a href="<?php echo APP_NAME?>/member/msg/glist"   >留言</a></td>

</tr></table>
    </div>
  </div>
  <div id="content01">
    <table id="mscenter01" cellpadding="10" cellspacing="6" bgcolor="#CCCCCC" width="800px">
      <tr>
        <td bgcolor="#FFFFFF" align="center">婚纱照&视频上传</td>
      </tr>
      <tr>
        <td bgcolor="#ffffff"><table cellpadding="6" cellspacing="0"  >
          <tr >
            <td rowspan="2" align="right" ><strong>添加婚纱照：</strong></td>
            <td align="left"><div id="queue"></div>
              <div id="file_upload"></div>
              <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' :  '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '/Public/Member/js/uploadify.swf',
				'uploader' : '<?php echo APP_NAME?>/member/photo/upphoto',
				'buttonText':'上传图片'
			});
			
		});
	  </script>
              <div id="file_upload-queue"  class="uploadify-queue"></div>
              <div id="imglist" style="display:none">
                <input name="input" onClick="javascript:window.location.href=window.location.href;" type="button" value="上传完成后，点这里显示上传的图片！">
              </div>
            <td rowspan="2">    
          </tr>
          <tr >
            <td align="left">按住ctrl点选图片一次可批量上传8张，批量上传若遇到问题，请选择&nbsp;&nbsp;<a href="<?php echo APP_NAME?>/Member/Photo/sup/"  style="cursor:pointer; color:#03F;">[普通上传]</a><br>
<span>照片仅支持jpg png gif 格式   单张照片文件大小不能超过5MB  总共可上传30张</span>&nbsp;&nbsp;<a onClick="help2();" style="cursor:pointer; color:#03F;">[解决方法]</a>    
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#ffffff" align="center"><table cellpadding="6" cellspacing="0" >
           
          <?php foreach($userphotos as $userphoto):?>
          <tr>
            <td width="35%"align="center" style="border-bottom:dashed 1px #ccc">
                <a href="<?php echo $userphoto['url']?>" target="_blank"><img src="<?php echo $userphoto['url']?>" height="100px"></a>
            </td>
            <td width="20%" align="center" style="border-bottom:dashed 1px #ccc"><?php echo $userphoto['create_time']?></td>
            <td width="20%" align="center" style="border-bottom:dashed 1px #ccc">
                <a href='javascript:_sort(1,<?php echo $userphoto["sort"]?>)'><img src='/Public/Member/images/sort-up.png'></a>&nbsp;&nbsp;&nbsp;
                <a href='javascript:_sort(0,<?php echo $userphoto["sort"]?>)'><img src='/Public/Member/images/sort-down.png'></a>
            </td>
            <td width="25%" align="center" style="border-bottom:dashed 1px #ccc"><a href="javascript:del(0,<?php echo $userphoto['id']?>)">删</a></td>
          </tr>
          <?php endforeach;?>
          
           <tr>
            <td colspan="4" align="center">
                <div class="page">
                    <div>    
                        <?php echo $page?>
                    </div>
                </div>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><table cellpadding="6" cellspacing="0"  >
          <tr>
          
              <td align="right"><strong>添加视频：&nbsp;&nbsp;</strong></td>
              <td> 添加腾讯视频播放页“分享”中的通用代码 ：(仅支持<a href="http://v.qq.com/boke/upload.html" target="_blank">腾讯视频</a>）&nbsp;<a onclick="help1()" >操作方式：<img src="/Public/Member/images/wen.png" width="15px"></a><br/>
                <br/>
                <textarea name="video_url" id="video_url" style="background-color:#eee; border:1px solid #ccc;" rows="3" cols="50" ><?php echo $video?></textarea>
               
              <td>    
            
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input onClick="upvideo()" type="image" src="/Public/Member/images/button02.png" />                      
            <td>          
          </tr>
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