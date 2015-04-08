<?php
namespace Wedding\Controller;
use Think\Controller;
use Common\ORG\Wechat;
class BaseController extends Controller {
	private $_options;
	public function _initialize(){
		$this->_options = C('weichat');
		$action = ACTION_NAME;
		$controller = CONTROLLER_NAME;
		echo 'fffffff';die;
		//如果没有Session和Cookie
		/* if($_SERVER['SERVER_NAME'] == 'www.wxt.com'){
			session('user_id',100);
		}else if($_SERVER['SERVER_NAME'] == 'lc.webchat.com'){
			session('user_id',100);
		} */
		
		if(!cookie('user_id')  && !session('user_id')){
// if(1){
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
					$user_item['openid'] = $result['openid'];
					$user_item['type'] = 'weixin';
					$user_id = M('user')->save($user_item);
					$model = M();
					$model->execute("insert into wxt_user set type='weixin',openid='".$result['openid']."',status=1 ");
					cookie('user_id',$user_id);
					session('user_id',$user_id);
				}else{
					session('user_id',$user_item['id']);
					cookie('user_id',$user_item['id']);
				}
				session('user_message',$user_message);
				cookie('user_message',$user_message);
				$url = C('WEB_HOST')."/wxt/wedding";
				header("location: $jump_url");
			}else{
				$this->jump($action,$controller);
			}
		}
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
