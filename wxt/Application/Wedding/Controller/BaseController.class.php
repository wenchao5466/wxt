<?php
namespace Wedding\Controller;
use Think\Controller;
use Common\ORG\Wechat;
class BaseController extends Controller {
	protected $_options;
	protected $userid;
	public function _initialize(){
		$code = generation_guid_string();
		$this->_options = C('weichat');
		$action = ACTION_NAME;
		$controller = CONTROLLER_NAME;
		//如果没有Session和Cookie
		if($_SERVER['SERVER_NAME'] == 'www.wxt.com'){
			session('user_id',110);
		}else if($_SERVER['SERVER_NAME'] == 'lc.webchat.com'){
			session('user_id',110);
		}else if($_SERVER['SERVER_NAME'] == 'lc.wxt.com'){
			session('user_id',110);
		}else if($_SERVER['SERVER_NAME'] == '123.57.68.39'){
			session('user_id',110);
		}
		if(!cookie('user_id')  && !session('user_id')){
			$weObj = new Wechat($this->_options);
			// 		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
			$result = $weObj->getOauthAccessToken();
			//如果是从微信返回的页面
			if($result && $result['refresh_token']){
				$weObj->getOauthRefreshToken($result['refresh_token']);
				$user_message = $weObj->getOauthUserinfo($result['access_token'],$result['openid']);
				session('user_message',$user_message);
				$user_item = M('user')->where(array('openid'=>$result['openid']))->find();
				if(!$user_item){
					$model = M();
					$model->execute("insert into wxt_user set type='weixin',openid='".$result['openid']."',status=1 ");
					
					$user_info = M('user')->where(array('openid'=>$result['openid']))->find();
					$code = generation_guid_string();
					$model->execute("insert into wxt_userpost set userid=".$user_info['id']." , code='".$code."'");
						
					cookie('user_id',$user_info['id']);
					session('user_id',$user_info['id']);
				}else{
					session('user_id',$user_item['id']);
					cookie('user_id',$user_item['id']);
					$model = M();
					$post_info = M('userpost')->where(array('userid'=>$user_item['id']))->find();
					if(!$post_info){
						$code = generation_guid_string();
						$model->execute("insert into wxt_userpost set userid=".$user_info['id'].", code='".$code."'");
					}	
				}
				session('user_message',$user_message);
				cookie('user_message',$user_message);
				$url = C('WEB_HOST')."/wxt/wedding";
				header("location: $jump_url");
			}else{
				$this->jump($action,$controller);
			}
		}
		$this->_checklogin();
	}
	
	private function _checklogin() {
		$this->userid = I ( 'session.user_id', 0 );
		if (! $this->userid) {
			redirect ( APP_NAME . '/member/index/login' );
		}
	
		$User = M ( 'User' );
		$this->loginuser = $User->where ( "id=$this->userid " )->find ();
		$this->assign ( 'loginuser', $this->loginuser );
	}
	protected function _getParam($name) {
		if (IS_POST){
			return I("post.$name");
		}else if(IS_GET){
			return I("get.$name");
		}else{
			return '';
		}
	}
	public function jump(){
		$weObj = new Wechat($this->_options);
		$callback = C('WEB_HOST')."/wxt/wedding/index/index";
		$jump_url = $weObj->getOauthRedirect($callback,1);
		header("location: $jump_url");
	}
}
