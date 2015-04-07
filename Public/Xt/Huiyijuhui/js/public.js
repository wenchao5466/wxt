/********************
 * 取窗口滚动条高度 
 ******************/
function getScrollTop(){
    var scrollTop=0;
    if(document.documentElement&&document.documentElement.scrollTop){
        scrollTop=document.documentElement.scrollTop;
    }else if(document.body){
        scrollTop=document.body.scrollTop;
    }
    return scrollTop;
}
/********************
 * 取窗口可视范围的高度 
 *******************/
function getClientHeight(){
    var clientHeight=0;
    if(document.body.clientHeight&&document.documentElement.clientHeight)
    {
        var clientHeight = (document.body.clientHeight<document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;        
    }else{
        var clientHeight = (document.body.clientHeight>document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;    
    }
    return clientHeight;
}
/********************
 * 取文档内容实际高度 
 *******************/
function getScrollHeight(){
    return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
}

function openShareDiv(id){
	$(document).scrollTop(0); 
	//document.getElementById(id).style.top = getScrollTop() + "px";
	document.getElementById(id).style.height = getScrollHeight() + "px";
	//document.body.style.overflow = "hidden";
	document.getElementById(id).style.display = "block";
	
}
function closeShareDiv(id){
	document.body.style.overflow = "auto";
	
	document.getElementById(id).style.display = "none";
	$(document).scrollTop(600); 
}

function touch(id,f,g)
{		
		
		var te;
		if(g=='id')
		{
			te=document.getElementById(id);	
		}
		else
		{
			te=document.getElementsByName(id)[0];	
			
		}
		
		if(!te){return;}
		
		var startX,//触摸时的坐标
			startY,
			x, //滑动的距离
			y,
			aboveY=0; //设一个全局变量记录上一次内部块滑动的位置
			function touchSatrt(e){//触摸
				load_dht();
				var touch=e.touches[0];
				startY = touch.pageY; //刚触摸时的坐标
				startX = touch.pageX; //刚触摸时的坐标
			}
			
			function touchMove(e){//滑动
				var touch = e.touches[0];
				y = touch.pageY - startY;//滑动的距离
				x = touch.pageX - startX;//滑动的距离
				
				if(y>2 || y<-2) 
				{
					var s=2;
					if(touch.pageY<startY)
					{
						s=1;
					}
					else if(touch.pageY > startY)
					{
						
					}
					
				
				}
			}
			function touchEnd(e){//手指离开屏幕
				
			}
			
			te.addEventListener('touchstart', touchSatrt,false);
			te.addEventListener('touchmove', touchMove,false);
			te.addEventListener('touchend', touchEnd,false);
			
}