<?php
namespace Shop\Controller;
use Think\Controller;
class MemberController extends Controller {
    
    private $shopid=0;
    private $pagesize = 10;


    private function _checklogin(){
        $this->shopid = I('session.shop_id',0);
        if(!$this->shopid){
            redirect(APP_NAME.'/shop/index/login');
        }
        
        $User = M('User');
        $loginuser = $User->where("id=$this->shopid ")->find();
        $this->assign('loginuser',$loginuser);
    }

    public function glist(){
        
        $this->_checklogin();
        
        $User = M('User');
        $where = "type='normal' and  shopid=$this->shopid";
        $count   = $User->where($where)->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $users = $User->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($users as &$user) {
             $userpost = M('Userpost')->where("userid={$user['id']}")->find();
             if($userpost){
                 $user['man'] = $userpost['man'];
                 $user['woman'] = $userpost['woman'];
             }
        }
        $this->assign('users',$users);
        $this->assign('page',$Page->show());
        $this->display(':members');
    }
    
    
    
    public function add(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $mobile = I('post.mobile','','htmlspecialchars');
             $pwd = I('post.newpwd','','htmlspecialchars');
             $man = I('post.boy','','htmlspecialchars');
             $woman = I('post.girl','','htmlspecialchars');
             $shopid = $this->shopid;
            
             $model = M();
             $user = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='normal' and  
                                        mobile='$mobile' and 
                                        shopid=$shopid");
             if($user){
                 $data['status']  = 0;
                 $data['msg'] = '手机号已存在';
                 $this->ajaxReturn($data);
             }else{
                
                 /*  余额用完可以新建，但不能开通，普通用户无法登陆
                 $yue = $model->query("select yue from wxt_shopxhmx where shop_id=$shopid order by time desc limit 1");
                 $yue = $yue ? $yue[0]['yue'] : 0;
                 if($yue<=0){
                    $data['status']  = 0;
                    $data['msg'] = '您创建新账号的数量已用完，请联系公司人员进行解决，我们会在数日内与您取得联系并解决！';
                    $this->ajaxReturn($data);
                 }
                 */
                 
                 $model->execute("insert into wxt_user set  
                                    type='normal' ,  
                                    mobile='$mobile' , 
                                    password='$pwd',
                                    man='$man' ,
                                    woman='$woman' ,    
                                    shopid=$shopid"
                 );
                 $data['status']  = 1;
                 $data['msg'] = '创建成功';
                 $data['url'] = 'http://'. $_SERVER['HTTP_HOST'].APP_NAME.'/shop/member/glist?';
                 $this->ajaxReturn($data);
             }
            
        }else{
        
            $this->display(':member_add');
        }
    }
    
    
    public function edit(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $pwd = I('post.newpwd','','htmlspecialchars');
             $man = I('post.boy','','htmlspecialchars');
             $woman = I('post.girl','','htmlspecialchars');
             $shopid = $this->shopid;
            
             $model = M();
             $model->execute("update wxt_user set 
                                        password='$pwd' ,  
                                        man='$man' ,
                                        woman='$woman' 
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
                $this->assign('url', isset($_SERVER['HTTP_REFERER']) ?  $_SERVER['HTTP_REFERER'] : 'http://'. $_SERVER['HTTP_HOST'].APP_NAME.'/shop/member/glist?'); 
                $this->display(':member_edit');
            }else{
                $this->error('操作失败，请联系管理员');
            }
        }
    }
    
    
     public function setstatus(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $shopid = $this->shopid;
            
             $model = M();
             $users = $model->query("SELECT * FROM wxt_user WHERE id=$id");
             $description = $users[0]['mobile']."开通账户";
             
             #验证开通普通用户的余额是否充足
             $yue = $model->query("select yue from wxt_shopxhmx where shop_id=$shopid order by time desc limit 1");
             $yue = $yue ? $yue[0]['yue'] : 0;
             if($yue<=0){
                $data['status']  = 0;
                $data['msg'] = '您创建新账号的数量已用完，请联系公司人员进行解决，我们会在数日内与您取得联系并解决！';
                $this->ajaxReturn($data);
             }
             
             $yue = $model->query("select yue-1 as yue from wxt_shopxhmx where shop_id=$shopid order by time desc limit 1");
             $yue = $yue[0]['yue'];
             
             $model->execute("insert wxt_shopxhmx set  
                          shop_id=$shopid , 
                          description='$description',
                          ruzhang=0,    
                          chuzhang=1,
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
   
}