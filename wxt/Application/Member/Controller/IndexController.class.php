<?php
namespace Member\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function index(){
       
        $user_id = I('session.user_id',0);
        if(!$user_id){
            redirect(APP_NAME.'/member/index/login');
        }
        
        $model = M();
        $user = $model->query("SELECT * FROM  wxt_user WHERE  id=$user_id");
        $this->assign('user',$user[0]);
        $this->display(':index');
    }
    
    
    public function login(){
        
        session('user_id',null); 
        $this->display(':login');
    }
    
    
    public function check(){
        
        if (IS_POST){
             $mobile = I('post.mobile','','htmlspecialchars');
             $pwd = I('post.pwd','','htmlspecialchars');
             
             $model = M();
             $user = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='normal' and  
                                        mobile='$mobile' and 
                                        password='$pwd' and  
                                        status = 1");
         
             if($user){
                 session('user_id',$user[0]['id']);  
                 redirect(APP_NAME.'/member/index');
             }else{
                 $this->assign('error','用户不存在或密码不正确！');
             }
        }
       
        $this->display(':login');
    }
    
   
}