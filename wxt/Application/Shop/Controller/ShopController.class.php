<?php
namespace Shop\Controller;
use Think\Controller;
class ShopController extends Controller {
    
    private $shopid=0;
    


    private function _checklogin(){
        $this->shopid = I('session.shop_id',0);
        if(!$this->shopid){
            redirect(APP_NAME.'/shop/index/login');
        }
        
        
    }


    public function setting(){
        
        $this->_checklogin();
        
        $User = M('User');
        $loginuser = $User->where("id=$this->shopid")->find();
        
        if (IS_POST){
            $ori_pwd = I('post.ori_pwd','','htmlspecialchars');
            $pwd = I('post.new_pwd','','htmlspecialchars');
            $shop_logo = I('post.shop_logo','','htmlspecialchars');
            $shop_company = I('post.s_company','','htmlspecialchars');
            $shop_link = I('post.s_link','','htmlspecialchars');
            $shop_tel = I('post.s_tel','','htmlspecialchars');
            $shop_memo_link = I('post.s_memo_link','','htmlspecialchars');
            $shop_guanzhu = I('post.s_guanzhu','','htmlspecialchars');
            $shop_ad_link = I('post.ad_link','','htmlspecialchars');
            $shop_ad_pic = I('post.ad_pic','','htmlspecialchars');
            
            $data['password'] = $pwd;
            if($shop_logo) $data['shop_logo'] = $shop_logo;
            $data['shop_company'] = $shop_company;
            $data['shop_link'] = $shop_link;
            $data['shop_tel'] = $shop_tel;
            $data['shop_memo_link'] = $shop_memo_link;
            $data['shop_guanzhu'] = $shop_guanzhu;
            $data['shop_ad_link'] = $shop_ad_link;
            if($shop_ad_pic) $data['shop_ad_pic'] = $shop_ad_pic;
            
            if($ori_pwd!=$loginuser['password']){
                $data['msg'] = '保存失败：原密码没有输入正确';
                $this->ajaxReturn($data);
            }
            
            $User->where("id=$this->shopid")->save($data); 
            $data['msg'] = '保存成功';
            $this->ajaxReturn($data);
        }
        
        
        $this->assign('loginuser',$loginuser);
        $this->display(':shop_setting');
    }
    
    
    
     public function upload(){
        $this->_checklogin();
       
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize = 3145728;
        //$upload->savePath = './Public/Uploads/';
        $upload->saveName = array('uniqid','');
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub  = true;
        $upload->subName  = array('date','Ymd');
                
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['myfile']);
        if(!$info) {// 上传错误提示错误信息
            $data['status']  = '-1';
            $data['msg'] =$upload->getError();
            $this->ajaxReturn($data);
        }else{// 上传成功 获取上传文件信息
            $data['status']  = "1";
            $data['msg'] = '上传成功';
            $data['url'] = "/Uploads/".$info['savepath'].$info['savename'];
            $this->ajaxReturn($data);
        
        }        	
    	 
    }
   
}