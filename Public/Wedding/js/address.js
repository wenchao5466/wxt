
jQuery.extend({
	saveAddress:function (url) {
		$.ajax({ 
			url: url, 
			data: $(this).serialize(),
			dataType:'json',
			success: function(msg){
				console.log(msg);
			}}
		);
	}
});