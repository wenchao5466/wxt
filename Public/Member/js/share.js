/********************
 * ȡ���ڹ������߶� 
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
 * ȡ���ڿ��ӷ�Χ�ĸ߶� 
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
 * ȡ�ĵ�����ʵ�ʸ߶� 
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