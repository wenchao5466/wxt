<?php

namespace Wedding\Controller;

use Wedding\Controller\BaseController;

class GuestController extends BaseController {
	private $pagesize = 5;
	
	public function glist(){
		$current_page = I('page');
		$prev_page = I('prev_page');
		$next_page = I('next_page');
	
		$Guest = M('Guest');
		$Userpost = M('Userpost')->where("userid=$this->userid")->find();
	
		$where = "postid={$Userpost['id']}";
		$count = $Guest->where($where)->count();
		if($Userpost && $count){
	
			$Page    = new \Think\Page($count,  $this->pagesize);
	
			$Guests = $Guest->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach ($Guests as $key=>$g){
				$num = 0;
				$desc = $g['description'];
				preg_match('/\d+/',$desc,$arr);
				$num = (int)$arr[0];
				preg_match("/(.*)（/isU",$desc,$matches);
				$str = $matches[1];
				$Guests[$key]['str'] = $str;
				$Guests[$key]['num'] = $num;
			}
			$Page->show();
			$result['list'] = $Guests;
			$result['page'] = $current_page + 1;
			$result['prev_page'] = $prev_page + 1;
			$result['next_page'] = $next_page + 1;
			$result['total_page'] = $Page->totalPages;
			$result['man'] = $man;
			$result['men'] = $men;
			
			$this->ajaxReturn($result);
			 
		}else{
			$Msg_list = array();
			$count = 0;
			$data = array('total_page'=>0);
	
			$this->ajaxReturn($data);
		}
	
	
	
	}
	public function index() {
		
		$Guest = M ( 'Guest' );
		$Userpost = M ( 'Userpost' )->where ( "userid=$this->userid " )->find ();
		if ($Userpost) {
			$where = "postid={$Userpost['id']} ";
			$count = $Guest->where ( $where )->count ();
			$Page = new \Think\Page ( $count, $this->pagesize );
			$Guests = $Guest->where ( $where )->order ( 'create_time desc' )->select ();
			$man = 0; 
			$men = 0;
			foreach ($Guests as  $guest){
				$desc = $guest['description'];
				preg_match('/男/',$desc,$regs);
				if($regs){
					preg_match('/\d+/',$desc,$arr);
					$man = $man + (int)$arr[0];
				} else {
					preg_match('/\d+/',$desc,$arr);
					$men = $men + (int)$arr[0];
				}
			}
			$this->assign ( 'page', $Page->show () );
			$this->assign ( 'total_page', $Page->totalPages);
			$this->assign ( 'man', $man );
			$this->assign ( 'men', $men );
		} else {
			$Guests = array ();
			$this->assign ( 'page', '' );
			$this->assign ( 'count', 0 );
			$this->assign ( 'man', 0 );
			$this->assign ( 'men', 0 );
		}
		
		$this->assign ( 'guests', $Guests );
		$this->assign ( 'count', $man+$men );
		$this->display ( ':guest_glist' );
	}
}