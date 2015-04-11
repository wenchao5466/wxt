function save (url,form) {
	$.ajax({
       url: url,
       data: $("#"+form).serialize(),
       dataType:'json',
       success: function(result){
			/*if(result.code == 100){
				alert('保存成功');
				window.location.href='/wxt/wedding/index';
			}else{
				alert('保存失败，请重新尝试。');
			}*/
			window.location.href='/wxt/wedding/index';
       }
   });
}



function save(document){
	var key = $(document).attr('data-key');
	var value = $(document).val();
	$.post("<?php echo APP_NAME?>/wedding/index/save",{key:value,'type':'ajax'},function(data){
			console.log(data);
			//window.location.href=window.location.href;
			
			return true;
	},'json');
}


function saveTime(document){
	var key = $(document).attr('data-key');
	var value = $(document).val();
	$.post("<?php echo APP_NAME?>/wedding/index/saveTime",{'wedding_time':value,'type':'ajax'},function(data){
		console.log(data);
		//window.location.href=window.location.href;
		return true;
	},'json');
	
}


$(function(){
	$("#woman, #man, #m_inv_desc").blur(function(){
		save(this);
	});
});