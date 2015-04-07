<?php
namespace Shop\Controller;
use Think\Controller;
class AccountController extends Controller {
    
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
        
        $Shopxhmx = M('Shopxhmx');
        $where = "shop_id=$this->shopid";
        $count   = $Shopxhmx->where($where)->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $shopxhmxs = $Shopxhmx->where($where)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('shopxhmxs',$shopxhmxs);
        $this->assign('page',$Page->show());
        $this->display(':account_xhmxs');
    }
    
    
    
     
   
}