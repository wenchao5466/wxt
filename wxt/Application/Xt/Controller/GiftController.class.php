<?php
namespace Xt\Controller;
use Think\Controller;
class GiftController extends Controller {
    
    
    public function index(){
        
        $id = I('get.id','','htmlspecialchars');
        if(!$id){
            $this->error('操作失败，请联系管理员');
        }
        
        $message = M('Message')->find($id);
        if(!$message){
            $this->error('操作失败，请联系管理员');
        }
        
        
        $photo = $message['photo'];
        switch ($photo) {
            case '6':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/5.jpg';
                break;
            case '5':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/4.jpg';
                break;
            case '4':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/3.jpg';
                break;
            case '3':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/2.jpg';
                break;
            case '2':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/0.jpg';
                break;
            case '1':
                $message['img'] = 'http://'. $_SERVER['HTTP_HOST'].'/Public/Xt/Default/lw/1.jpg';
                break;
            default:
                break;
        }
        
        $this->assign('message',$message);
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->assign('shareurl',$url);
        $this->display("index");
    }
    
    
     
    public function setzan(){
            
        $id = I('get.id','','htmlspecialchars');
        
        
        if($_SESSION['IsMZOp'.$id] == 'true'){
            $data['status']  = -1;
            $data['msg'] = "激动的心情可以理解，但也要保持好的心态哦！";
            $this->ajaxReturn($data);
        }else{
            $currMessage = M('Message')->find($id);
            M('Message')->where("id=$id")->save(array(
                'zcount'=>$currMessage['zcount']+1
            ));

            $_SESSION['IsMZOp'.$id] = 'true';
            $data['status']  = 1;
            $data['msg'] = "保存成功";
            $this->ajaxReturn($data);
        }
        
        
    }
}