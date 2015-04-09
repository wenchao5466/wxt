<?php
namespace Wechat\Common;


//define your token
define("TOKEN", "wxtwxapitoken");
//$wechatObj = new wechatCallbackapi();
//$wechatObj->valid();
class Wechat
{
    public $postStr = '';
    public $postObj = '';
    
    //接入 或 验证
    public function valid(){
        
        //valid signature , option
        /*这是第一次用这片段进行验证接入，之后的可以直接返回验证消息真实性
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }*/
        
        return $this->checkSignature();
    }

            
            
		
    private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        //logs('接入',"tmpStr:{$tmpStr}  signature:{$signature}");
        if( $tmpStr == $signature ){
                return true;
        }else{
                return false;
        }
    }
    
            
    
    public function get_message_type(){
        $this->postStr = $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        
        if (!empty($postStr)){
            
            $this->postObj = $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            
            /*switch($RX_TYPE){
                
                case "text":
                    $resultStr = $this->handleText($postObj);
                    break;
                case "event":
                    $resultStr = $this->handleEvent($postObj);
                    break;
                default:
                    $resultStr = "Unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;*/
            return $RX_TYPE;
        }else{
            echo "";
            exit;
        }
    }
    
            
   public function handleEvent($object){
         
        switch ($object->Event)
        {
            case "subscribe":
                //$contentStr = " “欢迎关注";
                //$resultStr = $this->responseText($object, $contentStr);
                //$resultStr = $this->responseNews($object);
                break;
            case "SCAN":
                $contentStr = "扫描 ".$object->EventKey;
                $resultStr = $this->responseText($object, $contentStr);
                $resultStr = "";
                break;
            case "CLICK":
                $contentStr = "Click Event: ".$object->EventKey;
                $resultStr = "";
                break;
            default :
                $contentStr = "Unknow Event: ".$object->Event;
                $resultStr = "";
                break;
        }
        return $resultStr;
    }
    
    public function handleText($postObj){
        
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";             
        if(!empty( $keyword ))
        {
            $resultStr = "";
            
            /*
            $contentStrArr = array(
                '1'=>"",
                '2'=>"",
                '3'=>"",
                '4'=>"",
            );
            if (array_key_exists($keyword, $contentStrArr)) {
                $msgType = "text";
                $contentStr = $contentStrArr[$keyword];
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            }
            elseif($keyword=='5'){
                $msgType = "news";
                $resultStr = $this->responseNews($postObj);
            }
            elseif($keyword=='urlmark'){
                $msgType = "text";
                $resultStr = $this->responseText($postObj, '<a href="">【xxxx】</a> ');
            }
            else{
                $resultStr = '';
            }
            */
            
            if(validateMobile($keyword)){
                  $user = M('User')->where("mobile='$keyword'")->find();
                  $post = M('Userpost')->where("userid={$user['id']}")->find();
                  if($post){
                      $articles = array(
                            array(
                                 'title'=>"{$post['man']}&{$post['woman']}婚礼喜帖",
                                 'description'=>"时间：{$post['inv_date']}"."\n".
                                                "地址：{$post['location']} "."\n".
                                                "注意：长按此处在弹出菜单选择转发即可分享给好友",
                                 'picurl'=>"http://182.92.179.231{$post['photo']}",
                                 'url'=>"http://182.92.179.231/wxt/xt/?code=8c4afcbd3150c175d2531c67e44d1455#1"
                            )
                      );
                     $resultStr = $this->responseNews($postObj,$articles);
                  }
             }
            
            //echo $resultStr;
            //$resultStr = '';
            return $resultStr;
        }else{
            //echo "Input something...";
            return "";
        }
    }
    
            
    
    public function handleImage($postObj){
        $resultStr = '';
        return $resultStr;
    }
    
    public function handleVoice($postObj){
        $resultStr = '';
        return $resultStr;
    }
    
    public function handleVideo($postObj){
        $resultStr = '';
        return $resultStr;
    }
    
    public function handleLocation($postObj){
        $resultStr = '';
        return $resultStr;
    }
    
    public function handleLink($postObj){
        $resultStr = '';
        return $resultStr;
    }
    
    public function responseText($object, $content, $flag=0){
        
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }
    
    public function responseNews($object, $articles=array()){
        
        
        foreach ($articles as $key => $item) 
        {
            $itemStr = "<item>
                        <Title><![CDATA[%s]]></Title> 
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>
                        ";
            $articlesStr .= sprintf($itemStr, $item['title'], $item['description'], $item['picurl'], $item['url']);
        }
        
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%d</ArticleCount>
                    <Articles>
                    %s
                    </Articles>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), count($articles),$articlesStr);
        return $resultStr;
    }
    
}

?>
