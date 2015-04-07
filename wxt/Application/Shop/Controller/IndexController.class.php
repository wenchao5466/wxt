<?php
namespace Shop\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function index(){
       
       
        $shop_id = I('session.shop_id',0);
        if(!$shop_id){
            redirect(APP_NAME.'/shop/index/login');
        }
        
        $model = M();
        $shop = $model->query("SELECT * FROM wxt_user WHERE  id=$shop_id");
        $yue = $model->query("select  yue from wxt_shopxhmx where shop_id=$shop_id order by time desc limit 1");
        $this->assign('shop',$shop[0]);
        $this->assign('yue',$yue[0]['yue']);
        $this->display(':index');
    }
    
    
    public function login(){
        
        session('shop_id',null); 
        $this->display(':login');
    }
    
    
    public function check(){
        
        if (IS_POST){
             $email = I('post.email','','htmlspecialchars');
             $pwd = I('post.pwd','','htmlspecialchars');
             
             $model = M();
             $shop = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='shop' and  
                                        email='$email' and 
                                        password='$pwd' and  
                                        status = 1");
         
             if($shop){
                 session('shop_id',$shop[0]['id']);  
                 redirect(APP_NAME.'/shop/index');
             }else{
                 $this->assign('error','用户不存在或密码不正确！');
             }
        }
       
        $this->display(':login');
    }
    
   
}