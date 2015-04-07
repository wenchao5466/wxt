<?php
namespace Wedding\Controller;
use Think\Controller;
use Common\ORG\Wechat;

class WeichatController extends Controller {
	
	private $_options;
	
	public function __construct(){
		parent::__construct();
		$this->_options = C('weichat');
		
	}
	
	
	public function index(){
		
		$weObj = new Wechat($this->_options);
		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
		$type = $weObj->getRev()->getRevType();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:
				$message = $this->_getReplyContent($weObj->getRevContent());
				if(!$message){
					$message = "hello, I'm wechat";
				}
					$weObj->text($message)->reply();
					exit;
					break;
			case Wechat::EVENT_MENU_CLICK:
				$content = $this->_getReplyContent();
					$weObj->text("hello, I'm wechat")->reply();
					exit;
					break;
			case Wechat::MSGTYPE_EVENT:
				$event = $weObj->getRevEvent();
				if($event['event'] == Wechat::EVENT_SUBSCRIBE){
					$message = $this->subscribe();
					$weObj->text($message)->reply();
				}else if($event['event'] == Wechat::EVENT_MENU_CLICK){
					$message = $this->_getReplyContent($event['key']);
// 					print_r($message);die;
					$result = $weObj->text($message)->reply();
				}
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
					$weObj->text("help info")->reply();
		}
	}
	
	
	public function showlog(){
		$id = $this->_getParam('id');
		$log_model =  new LogModel();
		$log_item = $log_model->getById($id);
		print_r(unserialize($log_item['content']));
	}
	public function subscribe(){
		$reply_model = new ReplyModel();
		$reply_item = $reply_model->getByKeyword('[欢迎关注]');
		if($reply_item){
			$message = $reply_item['message'];
		}else{
			$message = '';
		}
		return $message;
	}
	private function _getReplyContent($keyword){
		$reply_model = new ReplyModel();
		$reply_item = $reply_model->getByKeyword($keyword);
		return $reply_item['message'];
	}
	
	public function waring(){
		$weObj = new Wechat($this->_options);
		$rev_data = $weObj->getRev()->getRevData();
	}
	public function weiquan(){
	
		$weObj = new Wechat($this->_options);
		print_r($weObj);die;
//		print_r($weObj);die;
		$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
		$rev_data = $weObj->getRev()->getRevData();
		$data = array(
			'openid' => trim($rev_data['OpenId']),
			'appid' => trim($rev_data['AppId']),
			'timestamp' => trim($rev_data['TimeStamp']),
			'msgtype' => trim($rev_data['MsgType']),
			'feedbackid' => trim($rev_data['FeedBackId']),
			'transid' => trim($rev_data['TransId']),
			'reason' => trim($rev_data['Reason']),
			'solution' => trim($rev_data['Solution']),
			'extinfo' => trim($rev_data['ExtInfo']),
			'appsignature' => trim($rev_data['AppSignature']),
			'signmethod' => trim($rev_data['SignMethod'])
		);		
	}
    
    
}