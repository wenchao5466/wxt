require.config({
	baseUrl: '/Public/Wedding',
	 paths:{
	 	zepto:'js/zepto',
	 	jquery:'date/jquery-1.9.1',
	 	datejs:'date/date',
	 	iscroll:'date/iscroll'
	 }
})

require(['zepto','datejs','iscroll'],function(){

	$('#endTime').date({theme:"datetime"});
	// alert($("#yearwrapper ul li"))

	// 设置字体
	var fontsize=Math.round($('.bod_cent').width()/32) + "px";
	$('.ahtml').css({fontSize:fontsize});
	// console.log(fontsize)

	//遮罩
	$('.mask').click(function(){
		$(this).fadeOut();
	})

	// 音乐
	$('.them_mus').click(function(){
		if($(this).hasClass('rotate_a')){
			$(this).removeClass('rotate_a');
			$(this).find('em').removeClass('dis_no');
			document.getElementById('music_a').pause();

		}
		else{
			$(this).find('em').addClass('dis_no')
			$(this).addClass('rotate_a');
			document.getElementById('music_a').play();
		}
	})

	// 应邀嘉宾下拉
	$('.yyjb_cont .yyjb_cont_b').click(function(){
		$('.yyjb_cont_a').find('.yyjb_cont_t').eq(0).clone().appendTo($('.yyjb_cont_a'))
	})

	// 查看留言删除
	$('.ckly_t .ckly_ta_r a').bind('click',function(){
		$(this).parents('.ckly_ta').fadeOut('normal',function(){
			$(this).remove();
			$('.ckly_t .ckly_ta').eq(0).addClass('bor_no')
		});

	})

	$('.ckly .yyjb_cont_b').click(function(){
		alert(0)
		$('.ckly_t').find('.ckly_ta').eq(0).clone().appendTo($('.ckly_t'));
		$('.ckly_t').find('.ckly_ta').eq(-1).addClass('bor_t1')
	})

	// 制作 选择音乐
	$('.zz_xzyy_ta .control').click(function(){
		// console.log($(this).parents('.zz_xzyy_ta').find('font').attr('data-url'));
		if($(this).attr('name') == 'pause'){
			$('.zz_xzyy_t .control').each(function(){
				$(this).attr('name','pause');
			})
			$('.zz_xzyy_t .control img').each(function(){
				$(this).attr('src','img/stop.png');
			})
			var this_music = $(this).parents('.zz_xzyy_ta').find('font').attr('data-url');
			document.getElementById('music_a').setAttribute('src',this_music);
			document.getElementById('music_a').play();
			$(this).attr('name','play');
			$(this).find('img').attr('src','img/play.png');
		}else{
			document.getElementById('music_a').pause();
			$(this).attr('name','pause');
			$(this).find('img').attr('src','img/stop.png');
		}
	})

	$('.zz_xzyy_t .select').click(function(){
		if($(this).attr('name') == 'check'){
			$('.zz_xzyy_t .select').each(function(){
				$(this).text('选择');
				$(this).attr('name','check');
				$(this).addClass('btn2')
			})
			$(this).text('已选择');
			$(this).attr('name','checked');
			$(this).removeClass('btn2')
		}else{
			$(this).text('选择');
			$(this).attr('name','check');
			$(this).addClass('btn2')
		}
	})

	$('.zz_xzyy .btn1').click(function(){
		$('.select').each(function(){
			if($(this).attr('name') == 'checked'){
				alert($(this).parents('.zz_xzyy_ta').find('font').text());
				window.location.href="首页a.html"
				return false;
			}
		})
			
		
	})
	$('.btn1_mb').click(function(){
		$('.zz_mb td').each(function(){
			if($(this).find('em').attr('name') == 'aa'){
				alert($(this).find('span').text());
				window.location.href="首页a.html"
				return false;
			}
		})
			
		
	})

	// 制作 模版选择
	$('.zz_mb td').click(function(){
		$('.theme_checked').each(function(){
			$(this).hide();
			$(this).attr('name','')
		})
		$(this).find('.theme_checked').fadeIn();
		$(this).find('.theme_checked').attr('name','aa')
	}) 
	// 制作 上传婚纱照
	$('.zz_schsz .add_icon').click(function(){
		alert('未做的图片上传功能')
	})

	// 地点输入
	$('.zz_ddsr_text').css({
		height:$('.zz_ddsr').height() - $('.zz_ddsr .map_img1').height() - $('.zz_ddsr .emp60').height()
	})

	// 首页
	$(function(){
		var a = null;
		$('.index_cent .mytxt').focus(function(){
			if($(this).find('em')){
				a = $(this).find('em').clone();
			}
			$(this).empty()
		})

		$('.index_cent .mytxt').blur(function(){
			
			if($(this).text().length == 0){
				$(this).append(a)
			}
		})

		$('.section1').each(function(){
				$(this).css({
					lineHeight:$('.section1').height()+'px'
				})
		})

		$('.section3a').css({
			height:$('.section3a').width()+'px'
		})
	})


	$(function(){
		
        $('.section3').click(function(){
        	$('#filea').click();
        })
	})

})

