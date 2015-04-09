<?php

namespace Wedding\Controller;

use Wedding\Controller\BaseController;

class GuestController extends BaseController {
	private $pagesize = 10;
	
	public function glist() {
		
		$Guest = M ( 'Guest' );
		$Userpost = M ( 'Userpost' )->where ( "userid=$this->userid " )->find ();
		if ($Userpost) {
			$where = "postid={$Userpost['id']} ";
			$count = $Guest->where ( $where )->count ();
			$Page = new \Think\Page ( $count, $this->pagesize );
			$Guests = $Guest->where ( $where )->order ( 'create_time desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
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
		$this->assign ( 'count', $count );
		$this->display ( ':guest_glist' );
	}
	public function del() {
		$this->_checklogin ();
		
		if (IS_POST) {
			$id = I ( 'post.id', '', 'htmlspecialchars' );
			$model = M ();
			$users = $model->query ( "delete from wxt_guest WHERE id=$id" );
			$data ['status'] = 1;
			$data ['msg'] = "删除成功";
			$this->ajaxReturn ( $data );
		}
	}
}