<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function index(){
       
       
        $admin_id = I('session.admin_id',0);
        if(!$admin_id){
            redirect(APP_NAME.'/admin/index/login');
        }
        
       $User = M('User');
       $shopcount   = $User->where("type='shop'")->count();
        
       $this->assign('shopcount',$shopcount);
       $this->display(':index');
    }
    
    
    public function login(){
        
        session('admin_id',null); 
        $this->display(':login');
    }
    
    
    public function check(){
        
        if (IS_POST){
             $username = I('post.username','','htmlspecialchars');
             $pwd = I('post.pwd','','htmlspecialchars');
         
             if( $username==C("ADMIN_NAME") && $pwd==C("ADMIN_PWD")){
                 session('admin_id',1);  
                 redirect(APP_NAME.'/admin/index');
             }else{
                 $this->assign('error','用户不存在或密码不正确！');
             }
        }
       
        $this->display(':login');
    }
    
   
}