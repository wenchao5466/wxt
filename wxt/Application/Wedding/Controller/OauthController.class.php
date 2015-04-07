<?php
/**
 * 第三方网页授权登录
 * @author guomumin <aaron8573@gmail.com>
 * @url /?app=api&ctl=oauth
 * @version 1.0
 * @date 2014-12-15
 */
namespace Wedding\Controller;

use Wedding\BaseController;

class OauthController extends BaseController
{
	/**
	 * 
	 * @var 微信授权获取code地址
	 */
	private $v_code_url = 'https://open.weixin.qq.com/connect/qrconnect';
	
	/**
	 * 
	 * @var 微信授权获取access_token地址
	 */
	private $v_oauth_url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
	
	/**
	 * 
	 * @var 获取用户信息
	 */
	private $v_userinfo_url = 'https://api.weixin.qq.com/sns/userinfo';
	
	/**
	 * 
	 * @var 微信登录
	 */
	const WEIXIN = 'weixin';
	
	/**
	 * 
	 * @var 微信appid
	 */
	const WEIXIN_APPID = 'wx5f98bc23815489a3';
	
	/**
	 * 
	 * @var 微信AppSecret
	 */
	const WEIXIN_APPSECRET = '88221fdc7ac069119e1939751d3cef7b';
	
	/**
	 * 登录页
	 */
	public function actionIndex()
	{
		//登录方式
		$type = trim(strip_tags($this->getQuery('type')));
		
		//参数错误
		if (empty($type))
		{
			echo 'error: 10400';
			exit();
		}
		
		//用于以后其他登录做扩展
		switch ($type)
		{
			//微信登录
			case self::WEIXIN:
				$this->_weixinLogin();
				break;
		
				//其他方式
			default:
				break;
		}
		
	}
	
	/**
	 * 微信登录
	 * @url /?app=api&ctl=oauth&type=weixin
	 */
	private function _weixinLogin()
	{
		//返回code
		$code = trim(strip_tags($this->getQuery('code')));
		$state = trim(strip_tags($this->getQuery('state')));
		
		if ($code)
		{
			/*
			if ($state != $_SESSION['randNum'])
			{
				//非本网站请求
				echo 'error: 10403';
				exit();
			}
			*/
			
			unset($_SESSION['randNum']);
			
			$param = array();
			$param['appid'] = self::WEIXIN_APPID;
			$param['secret'] = self::WEIXIN_APPSECRET;
			$param['code'] = $code;
			$param['grant_type'] = 'authorization_code';
			$query = http_build_query($param);
			
			$url = $this->v_oauth_url.'?'.$query;
			
			//获取access_token
			$result = $this->_httpGet($url);
			
			if ($result)
			{
				
				$rs_arr = json_decode($result, true);
				
				if (isset($rs_arr['errcode']))
				{
					echo 'error: '.$rs_arr['errcode'].' '.$rs_arr['errmsg'];
					exit();
				}
				
				$repairer_info = Repaireroauth::model()->fetchRowByOpenid($rs_arr['openid']);
				
				if ($repairer_info)
				{
					$id = $repairer_info['id'];
					Repaireroauth::model()->update($id, $rs_arr);
				}
				else
				{
					$id = Repaireroauth::model()->save($rs_arr);
				}
				
				$userInfoUrl = $this->v_userinfo_url.'?access_token='.$rs_arr['access_token'].'&openid='.$rs_arr['openid'];
				
				//获取用户信息
				$user_info = $this->_httpGet($userInfoUrl);
				
				if ($user_info)
				{
					$user_info_arr = json_decode($user_info, true);
					
					if (isset($user_info_arr['errcode']))
					{
						echo 'error: '.$user_info_arr['errcode'].' '.$user_info_arr['errmsg'];
						exit();
					}
					
					if (empty($user_info_arr['privilege']))
					{
						$privilege = '';
					}
					else
					{
						$privilege = '';
						$i=1;
						foreach ($user_info_arr['privilege'] as $k=>$v)
						{
							$privilege .= ($i==1) ? '' : '|';
							$privilege .= $v;
							$i++;
						}
					}
					
					$user_info_arr['privilege'] = $privilege;
					
					if( Repaireroauth::model()->update($id, $user_info_arr) )
					{
						$url = url('home', 'oauthlogin', array('app'=>'cp', 'repairer'=>$id));
						echo $url;
						header("Location:".$url);
					}
					else
					{
						//保存用户信息失败
						echo 'error: 10410';
						exit();
					}
				}else{
					//获取用户信息失败
					echo 'error: 10409';
					exit();
				}
			}
			else 
			{
				//授权失败
				echo 'error: 10408';
				exit();
			}
		}
		else
		{
			//$url = url('oauth', 'index', array('app'=>'api', 'type'=>self::WEIXIN));
			$url = 'http://www.viniu.com.cn/oauth/'.self::WEIXIN;
			
			$randNum = $this->_randNum();
			$_SESSION['randNum'] = $randNum;
			
			
			$param = array();
			$param['appid'] = self::WEIXIN_APPID;
			$param['redirect_uri'] = $url;
			$param['response_type'] = 'code';
			$param['scope'] = 'snsapi_login';
			$param['state'] = $randNum;
			$query = http_build_query($param, '', '&');
			
			header("Location:".$this->v_code_url.'?'.$query);
		}
	}
	
	/*
	 * 获取access_token
	 */
	private function _httpGet($url)
	{
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE)
		{
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
		}
		
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200)
		{
			return $sContent;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * 生成随机数
	 * @param 默认8位 $length
	 * @return string
	 */
	private function _randNum($length = 8)
	{
		$str = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$result = '';
		$max = strlen($str) - 1;
		mt_srand((double)microtime() * 1000000);
		for($i = 0;$i < $length;$i ++){
			$result .= $str[mt_rand(0, $max)];
		}
		return $result;
	}
}