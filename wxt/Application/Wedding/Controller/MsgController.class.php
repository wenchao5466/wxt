<?php
namespace Wedding\Controller;
use Think\Controller;
class MsgController extends BaseController {
    
    private $pagesize = 10;
    
    public function glist(){
        
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
            $count = 0;
            $this->assign('page','');
        }
        $this->assign('mssages',$Messages);
        $this->assign('count',$count);
        $this->display(':comments');
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