var dataForWeixin={
    appId:"",
    img:share_img,
    url:share_url,
    title:share_title,
    desc:"",
    fakeid:"",
};
var dataForWeixin_peng={
    appId:"",
    img:share_img,
    url:share_url,
    title:"微喜帖",
    desc:share_title,
    fakeid:"",
};

//begin reset share url exists temp param
var _parseParams =  (typeof (parseParams) != "undefined" && typeof (parseParams) == "function") ? parseParams : function(str){
    if( !str ) return {};

    var arr = str.split('&'), obj = {}, item = '';
    for( var i=0,l=arr.length; i<l; i++ ){
        item = arr[i].split('=');
        obj[item[0]] = item[1];
    }
    return obj;
};

var dataForWeixin_params = _parseParams( dataForWeixin.url );
if(typeof (dataForWeixin_params['temp']) === "undefined" ){
      dataForWeixin.url =  dataForWeixin.url.indexOf('?') < 0 ? dataForWeixin.url+'?temp=' + (new Date()).valueOf() : dataForWeixin.url+'&temp=' + (new Date()).valueOf();
}
//logger.debug('dataForWeixin.url:', dataForWeixin.url);

var dataForWeixin_peng_params = _parseParams( dataForWeixin_peng.url );
if(typeof (dataForWeixin_peng_params['temp']) === "undefined" ){
      dataForWeixin_peng.url =  dataForWeixin_peng.url.indexOf('?') < 0 ? dataForWeixin_peng.url+'?temp=' + (new Date()).valueOf() : dataForWeixin_peng.url+'&temp=' + (new Date()).valueOf();
}
//logger.debug('dataForWeixin_peng.url:', dataForWeixin_peng.url);
//end reset share url exists temp param


$(function(){
		var onBridgeReady=function(){
		// 分享到朋友圈;
		WeixinJSBridge.on('menu:share:timeline', function(argv){
			WeixinJSBridge.invoke('shareTimeline',{
				"img_url":dataForWeixin.img,
				"img_width":"120",
				"img_height":"120",
				"link":dataForWeixin.url,
				"desc":dataForWeixin.desc,
				"title":dataForWeixin.title
				}, function(res){

				});
			});

		//分享到好友
		WeixinJSBridge.on('menu:share:appmessage', function(argv){
			WeixinJSBridge.invoke('sendAppMessage',{
				"appid":dataForWeixin_peng.appId,
				"img_url":dataForWeixin_peng.img,
				"img_width":"120",
				"img_height":"120",
				"link":dataForWeixin_peng.url,
				"desc":dataForWeixin_peng.desc,
				"title":dataForWeixin_peng.title
			}, function(res){

			});
		});
		}
		if(document.addEventListener){
			document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
		}else if(document.attachEvent){
			document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
			document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
		}
});