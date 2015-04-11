<?php
namespace Member\Controller;
use Think\Controller;
class MsgController extends Controller {
    
    private $userid=0;
    private $pagesize = 1;
    
    private function _checklogin(){
       
       
        $this->userid = I('session.user_id',0);
        if(!$this->userid){
            redirect(APP_NAME.'/member/index/login');
        }
        
        $User = M('User');
        $loginuser = $User->where("id=$this->userid ")->find();
        $this->assign('loginuser',$loginuser);
         
    }
    
    
    public function glist(){
        
        $this->_checklogin();
        
        $Message = M('Message');
        $Userpost = M('Userpost')->where("userid=$this->userid ")->find();
        if($Userpost){
            $where = "postid={$Userpost['id']} ";
            $count   = $Message->where($where)->count();
            $Page    = new \Think\Page($count,  $this->pagesize);
            $Messages = $Message->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$Page->show());
        }else{
            $Messages = array();
            $this->assign('page','');
        }
        
        $this->assign('mssages',$Messages);
       
        
        $this->display(':msg_glist');
    }
    
   
    
    
    public function del(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $model = M();
             $users = $model->query("delete from wxt_message WHERE id=$id");
             $data['status']  = 1;
             $data['msg'] = "删除成功";
             $this->ajaxReturn($data);
        }
    }
    
    
     
    
}