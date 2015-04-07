<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
    
     
    private $pagesize = 10;


    private function _checklogin(){
        $admin_id = I('session.admin_id',0);
        if(!$admin_id){
            redirect(APP_NAME.'/admin/index/login');
        }
    }

    public function glist(){
        
        $this->_checklogin();
        
        $User = M('User');
        $where = "type='shop'";
        $count   = $User->where($where)->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $shops = $User->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('shops',$shops);
        $this->assign('page',$Page->show());
        $this->display(':shops');
    }
    
    
    
    public function add(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $email = I('post.email','','htmlspecialchars');
             $pwd = I('post.newpwd','','htmlspecialchars');
             $shop_giftcard = I('post.shop_giftcard','','htmlspecialchars');
             
            
             $model = M();
             $user = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='shop' and  
                                        email='$email'");
             if($user){
                 $data['status']  = 0;
                 $data['msg'] = 'email已存在';
                 $this->ajaxReturn($data);
             }else{
                 $model->execute("insert into wxt_user set  
                                    type='shop' ,  
                                    email='$email' , 
                                    password='$pwd',
                                    shop_giftcard='$shop_giftcard'
                                    "
                 );
                 $data['status']  = 1;
                 $data['msg'] = '创建成功';
                 $data['url'] = 'http://'. $_SERVER['HTTP_HOST'].APP_NAME.'/admin/shop/glist?';
                 $this->ajaxReturn($data);
             }
            
        }else{
        
            $this->display(':shop_add');
        }
    }
    
    
    public function edit(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $pwd = I('post.newpwd','','htmlspecialchars');
             $shop_giftcard = I('post.shop_giftcard','','htmlspecialchars');
            
             $model = M();
             $model->execute("update wxt_user set 
                                        password='$pwd' , 
                                        shop_giftcard='$shop_giftcard'
                                        where id=$id"
             );
              
             
            $data['status']  = 1;
            $data['msg'] = '修改成功';
            $this->ajaxReturn($data);
             
            
        }else{
            $id = I('get.id',0);
            if($id){
                $model = M();
                $users = $model->query("SELECT * FROM wxt_user WHERE id=$id");
                $this->assign('user',$users[0]);
                $this->assign('url', isset($_SERVER['HTTP_REFERER']) ?  $_SERVER['HTTP_REFERER'] : 'http://'. $_SERVER['HTTP_HOST'].APP_NAME.'/admin/shop/glist?'); 
                $this->display(':shop_edit');
            }else{
                $this->error('操作失败，请联系管理员');
            }
        }
    }
    
    
     public function setstatus(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $shopid = $id;
            
             $model = M();
             $description = "";
             $yue = $model->query("select yue from wxt_shopxhmx where shop_id=$shopid order by time desc limit 1");
             $yue = $yue ? $yue[0]['yue'] : 0;
             $yue = $yue + 1000;
             $model->execute("insert wxt_shopxhmx set  
                          shop_id=$shopid , 
                          description='$description',
                          ruzhang=1000,    
                          chuzhang=0,
                          yue=$yue"
             );
             
             
             $model->execute("update wxt_user set 
                                    status='1' 
                                    where id=$id"
             );
             
            $data['status']  = 1;
            $data['msg'] = "开通成功";
            $this->ajaxReturn($data);
        }
    }
    
    
    public function del(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $model = M();
             $users = $model->query("delete from wxt_user WHERE id=$id");
             $data['status']  = 1;
             $data['msg'] = "删除成功";
             $this->ajaxReturn($data);
        }
    }
    
    
    public function disablestatus(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             
            
             $model = M();
             $model->execute("update wxt_user set 
                                    status='0' 
                                    where id=$id"
             );
             
            $data['status']  = 1;
            $data['msg'] = "禁用成功";
            $this->ajaxReturn($data);
        }
    }
   
}