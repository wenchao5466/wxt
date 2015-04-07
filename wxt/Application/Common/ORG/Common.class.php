<?php

/**
 * 
 * 一些公共的方法
 */

namespace Common\ORG;
use Model\LogModel;
Class Common{
public static function  getRunTime()
{
	G('action_end');	
	return G('action_begin','action_end',6);
	
}

	/**
	 * 
	 * 发送邮件功能
	 * @param String $address 要发送邮件的邮箱地址
	 * @param String $title 发送的Title
	 * @param String $message 要发送的内容
	 * @param String $fromname 邮件发自某处的内容
	 * @param String $ccList 要抄送某人的邮箱地址
	 * @return boolean
	 */
	public static function  SendMail($address,$title,$message,$fromname='NONE',$ccList=null,$replay_to=""){
		
		/* 
		$mail= new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet=C('MAIL_CHARSET');
		$mail->AddAddress($mailAddress);
		$mail->AddReplyTo($user['email'], $user['name']);
		$mail->Body=$mailContent;
		$mail->From= C('MAIL_ADDRESS');
		$mail->FromName='周报系统提醒';
		$mail->Subject=$mailTitle;
		$mail->Host=C('MAIL_SMTP');
		$mail->SMTPAuth=C('MAIL_AUTH');
		$mail->Username=C('MAIL_LOGINNAME');
		$mail->Password=C('MAIL_PASSWORD');
		$mail->IsHTML(C('MAIL_HTML'));
		if($ccAddressList){
			foreach($ccAddressList as $cc){
				$mail->AddCC($cc);
			}
		}
		$result = $mail->Send();
		 */
		
		
		$mail= new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet="UTF-8";
		$mail->Encoding = "base64";
		$mail->CharSet=C('MAIL_CHARSET');
		if(is_array($address)){
			foreach($address as $a){
				$mail->AddAddress($a);
			}
		}else{
			$mail->AddAddress($address);
		}
		
		if($replay_to){
			$mail->AddReplyTo($replay_to[0],$replay_to[1]);
		}
		$mail->Body=$message;
		$mail->From= C('MAIL_ADDRESS');
		$mail->FromName=$fromname;
		$mail->Subject=$title;
		$mail->Host=C('MAIL_SMTP');
		$mail->SMTPAuth=C('MAIL_AUTH');
		$mail->Username=C('MAIL_LOGINNAME');
		$mail->Password=C('MAIL_PASSWORD');
		$mail->IsHTML(C('MAIL_HTML'));
		if($ccList){
			foreach($ccList as $cc){
				$mail->AddCC($cc);
			}
		}
		
// 		$mail->IsHTML(C('MAIL_HTML'));
		return($mail->Send());
	}
	
	
	/**
	 * 
	 * 获取这个星期的星期一的日期
	 * @parm int $timestamp ，某个星期的某一个时间戳，默认为当前时间
	 * @parm bool is_return_timestamp ,是否返回时间戳，否则返回时间格式
	 * @return 
	 */
	public static function  this_monday($timestamp=0,$is_return_timestamp=true){
		static $cache ;
		$id = $timestamp.$is_return_timestamp;
		if(!isset($cache[$id])){
			if(!$timestamp) $timestamp = time();
			$monday_date = date('Y-m-d', $timestamp-86400*date('w',$timestamp)+(date('w',$timestamp)>0?86400:-/*6*86400*/518400));
			if($is_return_timestamp){
				$cache[$id] = strtotime($monday_date);
			}else{
				$cache[$id] = $monday_date;
			}
		}
		return $cache[$id];
	
	}

	/**
	 * 
	 * 获取这个星期的星期天的日期
	 * @param int $timestamp
	 * @param bool $is_return_timestamp
	 * @return Ambigous <>
	 */
	public static function  this_sunday($timestamp=0,$is_return_timestamp=true){
		static $cache ;
		$id = $timestamp.$is_return_timestamp;
		if(!isset($cache[$id])){
			if(!$timestamp) $timestamp = time();
			$sunday = this_monday($timestamp) + /*6*86400*/518400;
			if($is_return_timestamp){
				$cache[$id] = $sunday;
			}else{
				$cache[$id] = date('Y-m-d',$sunday);
			}
		}
		return $cache[$id];
	}

	
	/**
	 * 
	 * 获取上周一的日期
	 * @param int $timestamp ，某个星期的某一个时间戳，默认为当前时间
	 * @param bool $is_return_timestamp ,是否返回时间戳，否则返回时间格式
	 * @return Ambigous <>
	 */
	public static function  last_monday($timestamp=0,$is_return_timestamp=true){
		static $cache ;
		$id = $timestamp.$is_return_timestamp;
		if(!isset($cache[$id])){
			if(!$timestamp) $timestamp = time();
			$thismonday = this_monday($timestamp) - /*7*86400*/604800;
			if($is_return_timestamp){
				$cache[$id] = $thismonday;
			}else{
				$cache[$id] = date('Y-m-d',$thismonday);
			}
		}
		return $cache[$id];
	}
	
	/**
	 * 
	 * 获取上个星期天的日期
	 * @param int $timestamp ，某个星期的某一个时间戳，默认为当前时间
	 * @param bool $is_return_timestamp ,是否返回时间戳，否则返回时间格式
	 * @return Ambigous <>
	 */
	
	public static function  last_sunday($timestamp=0,$is_return_timestamp=true){
		static $cache ;
		$id = $timestamp.$is_return_timestamp;
		if(!isset($cache[$id])){
			if(!$timestamp) $timestamp = time();
			$thissunday = this_sunday($timestamp) - /*7*86400*/604800;
			if($is_return_timestamp){
				$cache[$id] = $thissunday;
			}else{
				$cache[$id] = date('Y-m-d',$thissunday);
			}
		}
		return $cache[$id];
	
	}
	
	public static function  createdRand($length=10){
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
		$randString = '';
		for($i = 0;$i<$length;$i++){
			$randString .=$pattern[rand(0, 61)];
		}
// 		echo $randString;
		return $randString;
	}
	
	/**
	 * 生成验证码
	 */
	public static function  verify($length=4, $mode=1, $type='png', $width=48, $height=22, $verifyName='verify'){
		import('ORG.Util.Image');
		Image::buildImageVerify($length,$mode,$type,$width,$height,$verifyName);
	}
	
	/**
	*
	* 处理Json字符串里边的中文
	* @param String $json
	* @return String
	*/
	public static function  formatJsonString($a=false){
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a)) {
			if (is_float($a)) {
				// Always use "." for floats.
				return floatval(str_replace(",", ".", strval($a)));
			}
	
			if (is_string($a)) {
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			} else {
				return $a;
			}
		}
	
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
			if (key($a) !== $i) {
				$isList = false;
				break;
			}
		}
	
		$result = array();
		if ($isList) {
			foreach ($a as $v) $result[] = formatJsonString($v);
			return '[' . join(',', $result) . ']';
		} else {
			foreach ($a as $k => $v) $result[] = formatJsonString($k).':'.formatJsonString($v);
			return '{' . join(',', $result) . '}';
		}
	}
	
	public static function  mcryptEncode($str){	
		$crypt = new Cryptrc4();
		$passkey = C("PASS_KEY");
		$crypt->setKey($passkey);
		return $crypt->encrypt($str);	
	}

	public static function  mcryptDecode($str){
		$crypt = new Cryptrc4();
		$passkey = C("PASS_KEY");
		$crypt->setKey($passkey);
		return $crypt->decrypt($str);
	}
	
	public static function  createCodeImg($url){
		//$dir = intval($doc_id/1000);
        $fileName = md5($url).'.jpg';//暂时不做目录打散
        $content = $url;
		$tempDir = $_SERVER['DOCUMENT_ROOT'].'/Uploads/code/';
		$filePath = $tempDir.$fileName;
		$file_url = '/Uploads/code/'.$fileName;
		if ( !file_exists( $tempDir ) ) {
			mkdir( $tempDir , 0777 );
		}
		$ecc = 'H'; // L-smallest, M, Q, H-best
		$size = 10; // 1-50
		// generating
		if (!file_exists($filePath)) {
			QRcode::png($content, $filePath, $ecc, $size, 2);
		}
		return $file_url;
		
	}
	
	public static function  httpcurl($url,$data,$method='get'){
		// 		Yii::import('ext.HttpClient');
		$httpClient = new HttpClient();
		$httpClient->setUrl($url);
		if($data){
			$httpClient->setData($data);
		}
		if (stripos('https', $url) !== false) {
			$result = $httpClient->request($method, true);
		} else {
			$result = $httpClient->request($method);
		}
// 		$result = json_decode($result,true);
		return $result;
	}
	
	
	public static function  getIP(){
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
// 			echo 'dddddd';
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		}else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
// 			echo 'aaaaaaaaaa';
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else if(!empty($_SERVER["REMOTE_ADDR"])){
// 			echo 'dddddddddffffff';
			$cip = $_SERVER["REMOTE_ADDR"];
		}else{
			$cip = "无法获取！";
		}
		return $cip;
	}
	
	/**
	 * This is the write logfile
	 * @param string $logs 要记录的log信息
	 * @param string $url log文件的位置
	 * @param string $filename log文件的名称
	 * return null
	 */
	public static function logfile($logs=NULL,$url='',$filename='')
	{
		$getinfo = print_r($_REQUEST, true);
		$svrinfo = print_r($_SERVER, true);
		$now = date("Y-m-d H:i:s");
		if($logs){
			if(is_array($logs)||is_object($logs))
			{
				$msg=print_r($logs,true);
			}else{
				$msg=$logs;
			}
		}else{
			$msg='';
		}
		$msg="[#LOG#]:".$msg;
		if(empty($url))
		{
			$path = RUNTIME_PATH.'/logs/'.date("Ymd").'/';
		}
		else
		{
			$path = RUNTIME_PATH.'/logs/'.date("Ymd").'/'.$url;
		}
//		echo $path;die;
		if(file_exists($path)==false)
		mkdir($path,0777,true);
		if(empty($filename))
		$filename = date('m-d');
		error_log( "\n-------------------\n$now \n[REQUEST]\n $getinfo \n$msg", 3,"$path/$filename.log");
	}
	public static function log($logs){
		$log_model = new LogModel();
		$info['content'] = $logs;
		$log_model->addInfo($info);
	}
	
	public static function getUrl(){
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	
	}
	
}
	