<?php
namespace Xt\Controller;
use Think\Controller;
class RegController extends Controller {
    
    
    public function index(){
        
        
        if(isset($_COOKIE['wxthlgjreg'])){
            $wxthlgjreg = $_COOKIE['wxthlgjreg'];
            $user = M('User')->where("mobile='$wxthlgjreg'")->find();
            
            $this->assign('user',$user);
            $this->assign('title','新用户注册');
            $this->display('reged');
        }else{
        
            $this->display('reging');
        }
    }
    
    
    public function add(){
        
        if (IS_POST){
             $mobile = I('post.mobile','','htmlspecialchars');
             $pwd = substr($mobile, -4);
             
             if(!validateMobile($mobile)){
                  $data['status']  = 0;
                  $data['msg'] = '请输入正确的注册手机号';
                  $this->ajaxReturn($data);
             }
             
            
             $model = M();
             $user = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='normal' and  
                                        mobile='$mobile'");
             if($user){
                 $data['status']  = 0;
                 $data['msg'] = '该手机号已注册过';
                 $this->ajaxReturn($data);
             }else{
                 $model->execute("insert into wxt_user set  
                                    type='normal' ,  
                                    mobile='$mobile' , 
                                    password='$pwd',
                                    status=1 
                                    "
                 );
                 
                 setcookie('wxthlgjreg', $mobile,time()+(60*60*24*365),'/');
                 
                 
                 $data['status']  = 1;
                 $data['msg'] = '注册成功';
                 $this->ajaxReturn($data);
             }
            
        }
    }
    
    
    public function lpk(){
        if(isset($_COOKIE['wxthlgjreg'])){
            $wxthlgjreg = $_COOKIE['wxthlgjreg'];
            $user = M('User')->where("mobile='$wxthlgjreg'")->find();
            
            $this->assign('user',$user);
            $this->assign('title','礼品卡注册');
            $this->display('reged');
        }else{
            $this->display('reginglpk');
        }
    }
}