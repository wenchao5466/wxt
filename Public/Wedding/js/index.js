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
	$.post("/wxt/wedding/index/save",{'key':key,'value':value,'type':'ajax'},function(data){
			console.log(data);
			//window.location.href=window.location.href;
			
			return true;
	},'json');
}



$(function(){
	$("#woman, #man, #welcome").change(function(){
		save(this);
	});
	
	
	/* var opt = {
    preset: 'date', //日期
    theme: 'jqm', //皮肤样式
    display: 'bottom', //显示方式 
    mode: 'clickpick', //日期选择模式
    dateFormat: 'yy-mm-dd', // 日期格式
    setText: '确定', //确认按钮名称
    cancelText: '取消',//取消按钮名籍我
    dateOrder: 'yymmdd', //面板中日期排列格式
    dayText: '日', monthText: '月', yearText: '年', //面板中年月日文字
    endYear:2020 //结束年份
}; */

//$('#wedding_date').mobiscroll(opt);

$('#wedding_date').mobiscroll().calendar({
	 theme: 'mobiscroll',
	 preset: 'date', //日期
	 dateFormat: 'yy年mm月dd日', // 日期格式
	 setText: '确定', //确认按钮名称
	 cancelText: '取消',//取消按钮名籍我
	 lang: 'zh',
	 display: 'bottom',
	 controls: ['calendar'],
	 dayText: '日', monthText: '月', yearText: '年', //面板中年月日文字
	 buttons: [],
	 closeOnSelect: true,
	 invalid: ['w0', 'w6', '5/1', '12/24', '12/25']
	});
	$('#wedding_date').change(function(){
	var value = $('#wedding_date').val();
	value = value.replace('年','/').replace('月','/').replace('日','');
	$.post("/wxt/wedding/index/saveDate",{'wedding_date':value,'type':'ajax'},function(data){
	    console.log(data);
	    //window.location.href=window.location.href;
	    return true;
	},'json');
	});
	$('#wedding_time').mobiscroll().calendar({
	theme: 'mobiscroll',
	lang: 'zh',
	display: 'bottom', 
	controls: ['time'],
	mode: 'mixed'
	});
	
	$('#wedding_time').change(function(){
	var value = $('#wedding_time').val();
	$.post("/wxt/wedding/index/saveTime",{'wedding_time':value,'type':'ajax'},function(data){
	    console.log(data);
	    //window.location.href=window.location.href;
	    return true;
	},'json');
	});
	
	
});