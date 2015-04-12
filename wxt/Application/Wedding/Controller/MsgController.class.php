<?php
namespace Wedding\Controller;
use Think\Controller;
class MsgController extends BaseController {
    
    private $pagesize = 5;
    
    public function index(){
    	
    	$Userpost = M('Userpost')->where("userid=$this->userid ")->find();
    	$where = "postid={$Userpost['id']} ";
    	$Message = M('Message');
        $count = $Message->where($where)->count();
        $Page = new \Think\Page($count,  $this->pagesize);
        $Page->show();
        
        $this->assign('total_page',$Page->totalPages);
        $this->assign('count',$count);
    	$this->display(':comments');
    }
    public function glist(){
        $current_page = I('page');
        $prev_page = I('prev_page');
        $next_page = I('next_page');
        
        $Message = M('Message');
        $Userpost = M('Userpost')->where("userid=$this->userid")->find();
        
        $where = "postid={$Userpost['id']}";
        $count = $Message->where($where)->count();
        if($Userpost && $count){
            
            $Page    = new \Think\Page($count,  $this->pagesize);
            
            $Msg_list = $Message->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $Page->show();
//            print_r($Page);die;
            $result['list'] = $Msg_list;
	        $result['page'] = $current_page + 1;
	        $result['prev_page'] = $prev_page + 1;
	        $result['next_page'] = $next_page + 1;
	        $result['total_page'] = $Page->totalPages;
	        
	        $this->ajaxReturn($result);
	        
        }else{
            $Msg_list = array();
            $count = 0;
            $data = array('total_page'=>0);
            
            $this->ajaxReturn();
        }
        
        
    
}
    
    public function del(){
        if (IS_POST){
             $id = I('id');
             $model = M();
             $users = $model->query("delete from wxt_message WHERE id=$id");
             $data['status']  = 1;
             $data['msg'] = "删除成功";
             $this->ajaxReturn($data);
        }
    }
}