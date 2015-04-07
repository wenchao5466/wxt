<?php
namespace Member\Controller;
use Think\Controller;
class SendController extends Controller {
    
    
    public function index(){
       
        
        $user_id = I('session.user_id',0);
        if(!$user_id){
            redirect(APP_NAME.'/member/index/login');
        }
        
        $model = M();
        $user = $model->query("SELECT * FROM wxt_user WHERE  id=$user_id");
        $this->assign('user',$user[0]);
        
        
        
        $Userpost = M('Userpost')->where("userid=$user_id ")->find();
        if($Userpost){
                  $str = "http://".$_SERVER['HTTP_HOST']."/wxt/xt/?code={$Userpost['code']}";
                  $this->assign('text',  urlencode($str));
         }else{
                  $this->assign('text','');
         }
       
        $this->display(':send');
    }
    
    
     
   
}