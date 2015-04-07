<?php
namespace Wedding\Controller;
use Think\Controller;
use Common\ORG\Wechat;
class BaseController extends Controller {
	public function __initialize(){
		$action = ACTION_NAME;
		$controller = CONTROLLER_NAME;
		//如果没有Session和Cookie
		if(!cookie('user_message')  && !session('user_message')){
			$weObj = new Wechat($this->_options);
			// 		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
			$result = $weObj->getOauthAccessToken();
			//如果是从微信返回的页面
			if($result && $result['refresh_token']){
				$a = $this->_getParam('a');
				$c = $this->_getParam('c');
				$weObj->getOauthRefreshToken($result['refresh_token']);
				$user_message = $weObj->getOauthUserinfo($result['access_token'],$result['openid']);
				session('user_message',$user_message);
				var_dump(session('user_message'));
				$user_item = M('user')->where(array('open'=>$result['openid']))->find();
				if(!$user_item){
					$user_item['open'] = $result['openid'];
					$user_id = M('user')->save($user_item);
			
					cookie('user_id',$user_id);
					session('user_id',$user_id);
				}else{
					session('user_id',$user_item['id']);
					cookie('user_id',$user_item['id']);
				}
				session('user_message',$user_message);
				echo 'ffffffffff';die;
				$this->redirect("/wxt/wedding/$c/$a");
			}else{
				$this->jump($action,$controller);
			}
		}
	}
	public function jump($action,$controller){
		$weObj = new Wechat($this->_options);
		$callback = C('WEB_HOST')."/wxt/wedding/?a=$action&c=$controller";
		$jump_url = $weObj->getOauthRedirect($callback,1);
		header("location: $jump_url");
	}
}