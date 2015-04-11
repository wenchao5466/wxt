<?php
namespace Wedding\Controller;
use Wedding\Controller\BaseController;
class SendController extends BaseController{
    
    public function index(){
        $user = M('user')->where("userid=$this->userid")->find();
        $this->assign('user',$user);
        
        
        $Userpost = M('Userpost')->where("userid=$this->userid")->find();
        
        if($Userpost){
                  $str = "http://".$_SERVER['HTTP_HOST']."/wxt/xt/?code={$Userpost['code']}";
                  $this->assign('text',  urlencode($str));
                  $this->assign('url',  $str);
         }else{
                  $this->assign('text','');
         }
       
        $this->display(':send');
    }
    
    
     
   
}