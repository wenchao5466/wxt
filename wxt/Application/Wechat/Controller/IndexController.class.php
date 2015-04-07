<?php
namespace Wechat\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    private $appid = '';
    private $appsecret = '';
    
    
    function __construct(){
       parent::__construct();
                
       
       $this->appid = 'wx9a082ec7b27da7f3';
       $this->appsecret = '40c54a18499dc3e5fdee93bd923c2cf3';
                
    }
    
    public function index(){
        $request = I('request.'); ;
                
        
        $wechatObj = new \Wechat\Common\Wechat(); 
        if($wechatObj->valid()){
            //todo perfect
            $RX_TYPE = $wechatObj->get_message_type();
            $postObj = $wechatObj->postObj;
            
            switch($RX_TYPE){
                
                case "text":
                    $resultStr = $wechatObj->handleText($postObj);
                    break;
                case "image":
                    $resultStr = $wechatObj->handleImage($postObj);
                    break;
                case "voice":
                    $resultStr = $wechatObj->handleVoice($postObj);
                    break;
                case "video":
                    $resultStr = $wechatObj->handleVideo($postObj);
                    break;
                case "location":
                    $resultStr = $wechatObj->handleLocation($postObj);
                    break;
                case "link":
                    $resultStr = $wechatObj->handleLink($postObj);
                    break;
                 case "event":
                    $resultStr = $wechatObj->handleEvent($postObj);
                    break;
                default:
                    $resultStr = '';
                    break;
            }    
            
            echo $resultStr; 
                
            exit;
        }else{
            echo "验证消息真实性失败.可能招到非接口服务器的恶意请求";
        }
        
    }
    
    
                
    
    
}