<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="ahtml">
<head>
	<title>制作—上传婚纱照</title>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="Expires" CONTENT="-1">           
	<meta http-equiv="Cache-Control" CONTENT="no-cache">           
	<meta http-equiv="Pragma" CONTENT="no-cache">
	
	<link rel="stylesheet" href="/Public/Wedding/css/pages.css?t=123a2a" />
	<link rel="stylesheet" href="/Public/Wedding/css/jquery.fileupload.css">
	<link rel="stylesheet" href="/Public/Wedding/css/bootstrap.min.css">

</head>
<body>
<div class="bod_cent">
	<div class="zz_schsz">
		<section class="cklytop c4c">我们的婚纱照，已传<font class='d_ib d_iba'><?php echo ($pic_count); ?></font>张，还可传<font class='d_ib d_ibb'>{20-$pic_count}</font>张</section>
		<div class="emp5"></div>


    <!-- The global progress bar -->

    <!-- The container for the uploaded files -->



		<!-- <table class="zz_mb">
			<tr>
				<td>
					
				</td>
				<td>
					<img src="img/add_img1.jpg" alt="">
				</td>
				<td>
					<img src="img/add_img2.jpg" alt="">
				</td>
			</tr>
			<tr>
				<td>
					<img src="img/add_img3.jpg" alt="">
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
		</table> -->

 <div id="progress" class="progress" style="width:90%;margin:1rem auto">
        <div class="progress-bar progress-bar-success"></div>
 </div>
   

    <div id="files" class="files clearfix">
        <div><img src="/Public/Wedding/img/add_icona.jpg" alt="" class="add_icon" style="width:100px;height:100px;"></div>
        <?php foreach($userphotos as $userphoto):?>
        <div style="width: 33%;">
        	<p>
        		<img alt="img" src="<?php echo $userphoto['url']?>" style="width:100px;height:100px;">
        		<br><em data-id='<?php echo $userphoto['id']?>'></em>
        		
        	</p>
        </div>
        <?php endforeach;?>
    </div>
    <br/>

 <br/>
<span class="btn btn-success fileinput-button" style="position:absolute;left:-999px">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Add files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple >
    </span>

	</div>
</div>
<style>
#files{width:100%;}
    #files div{float:left;width:33%;vertical-align:top;text-align:center;position:relative;}
    #files div em{display:inline-block;width:2.6rem;height:2.6rem;position:absolute;right:-.6rem;top:-.6rem;font-weight:bold;color:#3a98b3;background:url(/Public/Wedding/img/delet.png) 0 0 no-repeat;background-size:100% 100%;}
</style>
<script src="/Public/Wedding/upload_js/	js/jq.js"></script>
<script src="/Public/Wedding/upload_js/js/vendor/jquery.ui.widget.js"></script>
<script src="/Public/Wedding/upload_js/js/load-image.all.js"></script>
<script src="/Public/Wedding/upload_js/js/jquery.iframe-transport.js"></script>
<script src="/Public/Wedding/upload_js/js/jquery.fileupload.js"></script>
<script src="/Public/Wedding/upload_js/js/jquery.fileupload-process.js"></script>
<script src="/Public/Wedding/upload_js/js/jquery.fileupload-image.js"></script>
<script src="/Public/Wedding/upload_js/js/jquery.fileupload-validate.js"></script>
<script><!--
	$(function () {
    $('.add_icon').bind('click',function(){
        $('#fileupload').click();
    })

    // alert($('#files em'))

    function textNum(){
        $('.d_iba').text($('#files div').length -1)
        $('.d_ibb').text(20 - $('#files div').length + 1)
        $('#progress .progress-bar').css({'width':0});
    }
    textNum()

    $('#files em').live('click',function(ev){
            ev.preventDefault();
			var id = $(this).attr("data-id");
			del(0, id, $(this));
            //'timestamp' :  '<?php echo $timestamp;?>',
			//'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
    })
    var sd=false;
    function del(v,id,ducument){
        alert(id);
		if(v==0){
			 confirm('您确定要删除吗?','del',"'1','"+id+"'");return;
		}
		
		if(sd){
			return false;	
		}
		sd=true;
		$.post("<?php echo APP_NAME?>/wedding/photo/del",{'id':id,'type':'ajax'},function(data){
				console.log(data);
				//window.location.href=window.location.href;
				$(ducument).parents('div').eq(0).fadeOut(function(){
	                $(this).remove();
	                textNum()
	            });
				return true;
		},'json');
			
	}
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo APP_NAME?>/wedding/photo/upphoto',
    //var url = '/php',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                /*
                $this.off('click').text('删除').on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                */
                $this.remove();
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        console.log(data);
        
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append($('<em/>'));
            if (!index) {
                node.append('<br>').append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
            textNum();
        });
    }).on('fileuploadprocessalways', function (e, data) {
        $('#progress .progress-bar').css({'width':0});
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('上传')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {

        $('#files div').each(function(){
            $(this).css({
                width:'33%'
            })
            var aw = $(this).width();
            // console.log($(this).find('canvas').css(''))
            
        })

        console.log($('#progress div').length)
        
        
        
        $.each(data.result.files, function (index, file) {
            alert(file);
            console.log(file);
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
--></script>
</body>
</html>