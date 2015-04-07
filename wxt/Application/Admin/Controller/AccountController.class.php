<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends Controller {
    
    private $pagesize = 10;


     private function _checklogin(){
        $admin_id = I('session.admin_id',0);
        if(!$admin_id){
            redirect(APP_NAME.'/admin/index/login');
        }
    }


    public function glist(){
        
        $this->_checklogin();
        
        $Shopxhmx = M('Shopxhmx');
        $where = "ruzhang<>0";
        $count   = $Shopxhmx->where($where)->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $shopxhmxs = $Shopxhmx->where($where)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
         foreach ($shopxhmxs as &$shopxhmx) {
            $shop = M('User')->find($shopxhmx['shop_id']);
            $shopxhmx['shop_email'] = $shop['email'];
        }
        $this->assign('shopxhmxs',$shopxhmxs);
        $this->assign('page',$Page->show());
        $this->display(':account_xhmxs');
    }
    
    
     public function history(){
        
        $this->_checklogin();
        $id = I('get.id',0);
        if($id){
            $Shopxhmx = M('Shopxhmx');
            $where = "shop_id=$id and chuzhang>0";
            $count   = $Shopxhmx->where($where)->count();
            $Page    = new \Think\Page($count,  $this->pagesize);
            $shopxhmxs = $Shopxhmx->where($where)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $shop = M('User')->find($id);
            
            $this->assign('shopxhmxs',$shopxhmxs);
            $this->assign('page',$Page->show());
            $this->assign('id',$id);
            $this->assign('shop_email',$shop['email']);
            $this->display(':account_historyxhmxs');
            
        }else{
            $this->error('操作失败，请联系管理员');
        }
    }
     
    
    public function add(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $email = I('post.email','','htmlspecialchars');
             $ruzhang= I('post.ruzhang','','htmlspecialchars');
             
             if(!is_numeric($ruzhang)){
                 $data['status']  = 0;
                 $data['msg'] = '请正确填写商户入账';
                 $this->ajaxReturn($data);
             }
             
            
             $model = M();
             $user = $model->query("SELECT * FROM wxt_user WHERE 
                                        type='shop' and  
                                        email='$email'");
             if(!$user){
                 $data['status']  = 0;
                 $data['msg'] = '商户不存在';
                 $this->ajaxReturn($data);
             }else{
                 
                $model = M();
                $shopid = $user[0]['id'];
                $description = "";
                $yue = $model->query("select yue from wxt_shopxhmx where shop_id=$shopid order by time desc limit 1");
                $yue = $yue ? $yue[0]['yue'] : 0;
                $yue = $yue + $ruzhang;
                $model->execute("insert wxt_shopxhmx set  
                             shop_id=$shopid , 
                             description='$description',
                             ruzhang=$ruzhang,    
                             chuzhang=0,
                             yue=$yue"
                );
                 
                 
                 $data['status']  = 1;
                 $data['msg'] = '创建成功';
                 $data['url'] = 'http://'. $_SERVER['HTTP_HOST'].APP_NAME.'/admin/account/glist?';
                 $this->ajaxReturn($data);
             }
            
        }else{
        
            $this->display(':account_add');
        }
    }
   
}