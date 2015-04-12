<?php

namespace Wedding\Controller;

use Org\Util\Date;

use Wedding\Controller\BaseController;

class IndexController extends BaseController {
	private $loginuser;
	
	public function __construct(){
		parent::__construct();
		$this->_options = C('weichat');
	
	}
	
	
	public function index() {
		// $this->_checklogin ();
		$Model = M ( 'Userpost' );
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		if($Userpost['inv_time_1']){
			$Userpost['date_time'] = implode(':', array($Userpost['inv_time_1'], $Userpost['inv_time_2']));
		}else{
			$Userpost['date_time'] = '';
		}
		
		if($Userpost['inv_date']){
			$value = $Userpost['inv_date'];
			list($year,$month,$day) = explode('/', $value);
			$inv_date = $year . '年' . $month . '月' . $day . '日';
			$Userpost['inv_date'] = $inv_date;
		}else{
			$Userpost['inv_date'] = '';
		}
		
// 		var_dump($Userpost);die;
		$openid = session ( 'openid' );
		
		$style = array (
				"Default" => "浅水语行",
				"Pink" => "公主日记",
				"White" => "倾城之恋",
				"Huangguan" => "紫韵涟漪",
				"Huangguanzise" => "繁花似锦",
				"Huangguanjinse" => "秋日恋歌",
				"Hanshi" => "最美时光",
				"Oushifg" => "佳期如梦",
				"Xinxinxiangyin" => "浮影年华",
				"Yesido" => "海洋之心",
				"Planning" => "旧时微光",
				"Theonly" => "花田喜事",
				"Ofingerprint" => "大城小爱",
				"Rfingerprint" => "花好月圆",
				"Bluefingerprint" => "水木青华",
				"Huiyijuhui" => "会议聚会" 
		);
		$Userpost ['stylename'] = array_key_exists ( $Userpost ['style'], $style ) ? $style [$Userpost ['style']] : '';
// 		$Userpost['date_time'] = $userpost['inv_date'].' '.$userpost['inv_time_1'].':'.$userpost['inv_time_2'];
// 		if($userpost['inv_date'] == "" && $userpost['inv_time_1']=="" && $userpost['inv_time_2'] == "")
// 			$Userpost['date_time'] = "";
		$this->assign ( 'userpost', $Userpost );
		
		$this->display ( ':index' );
	}
	public function aupload() {
		$this->_checklogin ();
		
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 3145728;
		// $upload->savePath = './Public/Uploads/';
		$upload->saveName = array (
				'uniqid',
				'' 
		);
		$upload->exts = array (
				'jpg',
				'gif',
				'png',
				'jpeg' 
		);
		$upload->autoSub = true;
		$upload->subName = array (
				'date',
				'Ymd' 
		);
		
		// 上传单个文件
		$info = $upload->uploadOne ( $_FILES ['m_inv_pic'] );
		if (! $info) { // 上传错误提示错误信息
			$data ['status'] = '-1';
			$data ['error'] = $upload->getError ();
			// $this->ajaxReturn($data);
			echo json_encode ( $data );
		} else { // 上传成功 获取上传文件信息
			$data ['status'] = "1";
			$data ['msg'] = "/Uploads/" . $info ['savepath'] . $info ['savename'];
			// $this->ajaxReturn($data);
			echo json_encode ( $data );
		}
	}
	public function setimg() {
		$this->_checklogin ();
		
		$a_x = I ( 'post.a_x', '0', 'htmlspecialchars' );
		$a_y = I ( 'post.a_y', '0', 'htmlspecialchars' );
		$a_w = I ( 'post.a_w', '250', 'htmlspecialchars' );
		$a_h = I ( 'post.a_h', '236', 'htmlspecialchars' );
		$m_inv_memo = I ( 'post.m_inv_memo', '', 'htmlspecialchars' );
		// $m_inv_memo = "http://weixitie.com/Uploads/20150104/54a8f0c5919c1.png";
		
		$path = $m_inv_memo;
		if (strstr ( $url, 'http' ) === false) {
			$path = str_replace ( "http://" . $_SERVER ['HTTP_HOST'] . "/", "../", $path );
		} else {
			$path = ".." . $path;
		}
		$realpath = realpath ( $path );
		// echo $realpath.'<br/>';
		
		$pathinfo = pathinfo ( $realpath );
		$file_name = $pathinfo ['dirname'] . '/crop_' . $pathinfo ['basename'];
		$m_inv_memo = str_replace ( $pathinfo ['basename'], 'crop_' . $pathinfo ['basename'], $m_inv_memo );
		
		$image = new \Think\Image ();
		$image->open ( $realpath );
		$image->crop ( $a_w, $a_h, $a_x, $a_y )->save ( $file_name );
		
		echo $m_inv_memo;
	}
	public function selectMusic() {
		// $this->_checklogin();
		$Model = M ( 'Userpost' );
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		$Userpost ['music'] = I ( 'id' );
		$Userpost ['musictitle'] = I ( 'name' );
		$Model->where ( $where )->save ( $Userpost );
		redirect ( APP_NAME . '/wedding/' );
	}
	public function selectTemplate() {
		// $this->_checklogin();
		$Model = M ( 'Userpost' );
		$where = "userid=$this->userid";
// 		print_r($_GET);die;
		$Userpost = $Model->where ( $where )->find ();
		$Userpost ['style'] = I ( 'style' );
		$Model->where ( $where )->save ( $Userpost );
		redirect ( APP_NAME . '/wedding/' );
	}
	public function viewComment() {
		$this->_checklogin ();
	}
	public function template() {
		$templates = $this->getTemplate();
		$this->assign ( 'templates', $templates );
		$this->display ( ':template' );
	}
	public function music() {
		$music = $this->getMusic ();
		$this->assign ( 'musics', $music );
		$this->display ( ':music' );
	}
	public function test() {
		echo 'test todo';
	}
	
	public function address(){
		$Model = M ( 'Userpost' );
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
// 				print_r($_GET);die;
		//手动输入地址后保存
		if(I('name')){
			$name = I('name');
			$Userpost['location'] = I("name");
			echo $Model->save($Userpost);
		}
		if($Userpost['location']){
			$name = $Userpost['location'];
		}else{
			$name = '北京市';
		}
		
		
		
		$this->assign('address',$name);
		$this->assign('userpost',$userpost);
		$this->display(":address");
	}
	
	public function inputAddress(){
		$Model = M ('Userpost');
		$where = "userid=$this->userid";
		//print_r($_GET);die;
		$Userpost = $Model->where ( $where )->find ();
		$this->display(":input_address");
	}
	
	public function saveAddress(){

		$Model = M ( 'Userpost' );
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		
		$m_isqqmap = I('m_isqqmap');
		$m_inv_address = I('m_inv_address');
		$mapx = I('mapX');
		$mapy = I('mapY');
		
		
		$Userpost['userid'] = $this->userid;
		$Userpost['location'] = $m_inv_address;
		$Userpost['location_x'] = $mapx;
		$Userpost['location_y'] = $mapy;
//		var_dump($Userpost);
		$result = $Model->where($where)->save($Userpost);
		if($result){
			echo json_encode(array('code'=>100,'msg'=>'保存成功'));die;
		}else{
			echo json_encode(array('code'=>101,'msg'=>'保存失败'));die;
		}
		//redirect ( APP_NAME . '/wedding/' );
	}
	
	public function save(){
		$Model = M('Userpost');
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		if (IS_POST){
			if(I('key') == 'man'){
				$Userpost['man'] = I('value');
			}else if(I('key') == 'woman'){
				$Userpost['woman'] = I('value');
			}else if(I('key') == 'welcome'){
				$m_inv_desc = I('value');
				$Userpost ['welocome'] = $m_inv_desc;
			}
			$Userpost['update_time'] = time(); 
			$Model->save($Userpost);
            $data = array('code'=>100,'msg'=>'保存成功');
            $this->ajaxReturn($data);
        }
	}
	
	public function saveTime(){
		$Model = M('Userpost');
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		if(IS_POST){
			$wedding_time = I('wedding_time');
			//var_dump($wedding_time);
 		//echo $wedding_time.date('hh:ss',$wedding_time);die;
 			$times = explode(':', $wedding_time);
			$Userpost['inv_time_1'] = $times[0];
			$Userpost['inv_time_2'] = $times[1];
			$Userpost['update_time'] = time();
            $Model->save($Userpost);
            $data = array('code'=>100,'msg'=>'保存成功');
            $this->ajaxReturn($data);
		}
	}
	public function saveDate(){
		$Model = M('Userpost');
		$where = "userid=$this->userid";
		$Userpost = $Model->where ( $where )->find ();
		if(IS_POST){
			$wedding_date = I('wedding_date');
			$Userpost['inv_date'] = $wedding_date;//date('Y/m/d',$wedding_date);
			$Userpost['update_time'] = time();
            $Model->save($Userpost);
            $data = array('code'=>100,'msg'=>'保存成功');
            $this->ajaxReturn($data);
			
		}
		
	}
	
	public function getTemplate() {
		return array (
				array (
						'id' => "Default",
						'url' => '/Public/Member/images/A.png',
						'name' => '浅水语行' 
				),
				array (
						'id' => "Pink",
						'url' => '/Public/Member/images/B.png',
						'name' => '公主日记' 
				),
				array (
						'id' => "Pink",
						'url' => '/Public/Member/images/C.png',
						'name' => '倾城之恋' 
				),
				array (
						'id' => "Huangguan",
						'url' => '/Public/Member/images/D.png',
						'name' => '紫韵涟漪' 
				),
				array (
						'id' => "Huangguanzise",
						'url' => '/Public/Member/images/E.png',
						'name' => '繁花似锦' 
				),
				array (
						'id' => "Huangguanjinse",
						'url' => '/Public/Member/images/F.png',
						'name' => '秋日恋歌' 
				),
				array (
						'id' => "Hanshi",
						'url' => '/Public/Member/images/G.png',
						'name' => '最美时光' 
				),
				array (
						'id' => "Oushifg",
						'url' => '/Public/Member/images/H.png',
						'name' => '佳期如梦' 
				),
				array (
						'id' => "Xinxinxiangyin",
						'url' => '/Public/Member/images/I.png',
						'name' => '浮影年华' 
				),
				array (
						'id' => "Yesido",
						'url' => '/Public/Member/images/J.png',
						'name' => '海洋之心' 
				),
				array (
						'id' => "Planning",
						'url' => '/Public/Member/images/K.png',
						'name' => '旧时微光' 
				),
				array (
						'id' => "Theonly",
						'url' => '/Public/Member/images/O.png',
						'name' => '花田喜事' 
				),
				
				array (
						'id' => "Ofingerprint",
						'url' => '/Public/Member/images/M.png',
						'name' => '大城小爱' 
				),
				array (
						'id' => "Rfingerprint",
						'url' => '/Public/Member/images/N.png',
						'name' => '花好月圆' 
				),
				array (
						'id' => "Bluefingerprint",
						'url' => '/Public/Member/images/L.png',
						'name' => '水木青华' 
				) 
		);
	}
	public function getMusic() {
		return array (
				array (
						'id' => 1,
						'url' => 'http://mp3.jiapai.cc/wxt/1.mp3',
						'name' => '最浪漫的事' 
				),
				array (
						'id' => 2,
						'url' => 'http://mp3.jiapai.cc/wxt/2.mp3',
						'name' => '诺言' 
				),
				array (
						'id' => 3,
						'url' => 'http://mp3.jiapai.cc/wxt/3.mp3',
						'name' => '秘密花园' 
				),
				array (
						'id' => 4,
						'url' => 'http://mp3.jiapai.cc/wxt/4.mp3',
						'name' => '梦中的婚礼' 
				),
				array (
						'id' => 5,
						'url' => 'http://mp3.jiapai.cc/wxt/5.mp3',
						'name' => '情非得已' 
				),
				array (
						'id' => 6,
						'url' => 'http://mp3.jiapai.cc/wxt/6.mp3',
						'name' => '遇见' 
				),
				array (
						'id' => 7,
						'url' => 'http://mp3.jiapai.cc/wxt/7.mp3',
						'name' => '爱情故事' 
				),
				array (
						'id' => 8,
						'url' => 'http://mp3.jiapai.cc/wxt/8.mp3',
						'name' => '我们的纪念' 
				),
				array (
						'id' => 9,
						'url' => 'http://mp3.jiapai.cc/wxt/9.mp3',
						'name' => 'Love Song' 
				),
				array (
						'id' => 10,
						'url' => 'http://mp3.jiapai.cc/wxt/10.mp3',
						'name' => '童话' 
				),
				array (
						'id' => 11,
						'url' => 'http://mp3.jiapai.cc/wxt/11.mp3',
						'name' => 'I am yours' 
				),
				array (
						'id' => 12,
						'url' => 'http://mp3.jiapai.cc/wxt/12.mp3',
						'name' => '情书' 
				),
				array (
						'id' => 13,
						'url' => 'http://mp3.jiapai.cc/wxt/13.mp3',
						'name' => 'Could This Be Love' 
				),
				array (
						'id' => 14,
						'url' => 'http://mp3.jiapai.cc/wxt/14.mp3',
						'name' => 'Because I Love You' 
				),
				array (
						'id' => 15,
						'url' => 'http://mp3.jiapai.cc/wxt/15.mp3',
						'name' => 'Every Moment Of My Life' 
				),
				array (
						'id' => 16,
						'url' => 'http://mp3.jiapai.cc/wxt/16.mp3',
						'name' => 'Fall In Love' 
				),
				array (
						'id' => 17,
						'url' => 'http://mp3.jiapai.cc/wxt/17.mp3',
						'name' => 'Heartbeats' 
				),
				array (
						'id' => 18,
						'url' => 'http://mp3.jiapai.cc/wxt/18.mp3',
						'name' => 'I Believe' 
				),
				array (
						'id' => 19,
						'url' => 'http://mp3.jiapai.cc/wxt/19.mp3',
						'name' => 'I Will Always Love You' 
				),
				array (
						'id' => 20,
						'url' => 'http://mp3.jiapai.cc/wxt/20.mp3',
						'name' => 'Love Paradise' 
				),
				array (
						'id' => 21,
						'url' => 'http://mp3.jiapai.cc/wxt/21.mp3',
						'name' => 'Marry You' 
				),
				array (
						'id' => 22,
						'url' => 'http://mp3.jiapai.cc/wxt/22.mp3',
						'name' => 'My Love' 
				),
				array (
						'id' => 23,
						'url' => 'http://mp3.jiapai.cc/wxt/23.mp3',
						'name' => '大城小爱' 
				),
				array (
						'id' => 24,
						'url' => 'http://mp3.jiapai.cc/wxt/24.mp3',
						'name' => '暖暖' 
				),
				array (
						'id' => 25,
						'url' => 'http://mp3.jiapai.cc/wxt/25.mp3',
						'name' => '神圣婚誓' 
				),
				array (
						'id' => 26,
						'url' => 'http://mp3.jiapai.cc/wxt/26.mp3',
						'name' => '因为爱情' 
				),
				array (
						'id' => 27,
						'url' => 'http://mp3.jiapai.cc/wxt/27.mp3',
						'name' => '约定' 
				),
				array (
						'id' => 28,
						'url' => 'http://mp3.jiapai.cc/wxt/28.mp3',
						'name' => 'amelie from montmartre' 
				),
				array (
						'id' => 29,
						'url' => 'http://mp3.jiapai.cc/wxt/29.mp3',
						'name' => 'Ballade Four Adeline' 
				),
				array (
						'id' => 30,
						'url' => 'http://mp3.jiapai.cc/wxt/30.mp3',
						'name' => 'D 大调卡农' 
				),
				array (
						'id' => 31,
						'url' => 'http://mp3.jiapai.cc/wxt/31.mp3',
						'name' => 'D 大调小步舞曲' 
				),
				array (
						'id' => 32,
						'url' => 'http://mp3.jiapai.cc/wxt/32.mp3',
						'name' => 'Give Me Your Hand执子之手' 
				),
				array (
						'id' => 33,
						'url' => 'http://mp3.jiapai.cc/wxt/33.mp3',
						'name' => '爱的喜悦' 
				),
				array (
						'id' => 34,
						'url' => 'http://mp3.jiapai.cc/wxt/34.mp3',
						'name' => '爱的协奏曲' 
				),
				array (
						'id' => 35,
						'url' => 'http://mp3.jiapai.cc/wxt/35.mp3',
						'name' => '爱的旋律' 
				),
				array (
						'id' => 36,
						'url' => 'http://mp3.jiapai.cc/wxt/36.mp3',
						'name' => '结婚进行曲' 
				),
				array (
						'id' => 37,
						'url' => 'http://mp3.jiapai.cc/wxt/37.mp3',
						'name' => '假如爱有天意' 
				),
				array (
						'id' => 38,
						'url' => 'http://mp3.jiapai.cc/wxt/38.mp3',
						'name' => '卡农' 
				),
				array (
						'id' => 39,
						'url' => 'http://mp3.jiapai.cc/wxt/39.mp3',
						'name' => '梁祝化蝶' 
				),
				array (
						'id' => 40,
						'url' => 'http://mp3.jiapai.cc/wxt/40.mp3',
						'name' => '暮光之城' 
				),
				array (
						'id' => 41,
						'url' => 'http://mp3.jiapai.cc/wxt/41.mp3',
						'name' => '蒲公英的约定' 
				),
				array (
						'id' => 42,
						'url' => 'http://mp3.jiapai.cc/wxt/42.mp3',
						'name' => '上帝是女孩' 
				),
				array (
						'id' => 43,
						'url' => 'http://mp3.jiapai.cc/wxt/43.mp3',
						'name' => '天空之城' 
				),
				array (
						'id' => 44,
						'url' => 'http://mp3.jiapai.cc/wxt/44.mp3',
						'name' => '瓦妮莎的微笑' 
				),
				array (
						'id' => 45,
						'url' => 'http://mp3.jiapai.cc/wxt/45.mp3',
						'name' => '我只在乎你' 
				),
				array (
						'id' => 46,
						'url' => 'http://mp3.jiapai.cc/wxt/46.mp3',
						'name' => '婚礼进行曲' 
				),
				array (
						'id' => 47,
						'url' => 'http://mp3.jiapai.cc/wxt/47.mp3',
						'name' => 'Love Will KeepUs Alive' 
				),
				array (
						'id' => 48,
						'url' => 'http://mp3.jiapai.cc/wxt/48.mp3',
						'name' => 'Love Will KeepUs Alive' 
				),
				array (
						'id' => 49,
						'url' => 'http://mp3.jiapai.cc/wxt/49.mp3',
						'name' => '神秘园之歌' 
				),
				array (
						'id' => 50,
						'url' => 'http://mp3.jiapai.cc/wxt/50.mp3',
						'name' => '献给爱丽丝' 
				),
				array (
						'id' => 51,
						'url' => 'http://mp3.jiapai.cc/wxt/51.mp3',
						'name' => 'YouGotMe' 
				),
				array (
						'id' => 52,
						'url' => 'http://mp3.jiapai.cc/wxt/52.mp3',
						'name' => '爱很美' 
				),
				array (
						'id' => 53,
						'url' => 'http://mp3.jiapai.cc/wxt/53.mp3',
						'name' => '爱情白皮书' 
				),
				array (
						'id' => 54,
						'url' => 'http://mp3.jiapai.cc/wxt/54.mp3',
						'name' => 'Beautiful In White' 
				),
				array (
						'id' => 55,
						'url' => 'http://mp3.jiapai.cc/wxt/55.mp3',
						'name' => 'Because You Loved Me' 
				),
				array (
						'id' => 56,
						'url' => 'http://mp3.jiapai.cc/wxt/56.mp3',
						'name' => 'Free Loop' 
				),
				array (
						'id' => 57,
						'url' => 'http://mp3.jiapai.cc/wxt/57.mp3',
						'name' => 'I Stay In Love' 
				),
				array (
						'id' => 58,
						'url' => 'http://mp3.jiapai.cc/wxt/58.mp3',
						'name' => 'Love Paradise' 
				),
				array (
						'id' => 59,
						'url' => 'http://mp3.jiapai.cc/wxt/59.mp3',
						'name' => '每个人都会' 
				),
				array (
						'id' => 60,
						'url' => 'http://mp3.jiapai.cc/wxt/60.mp3',
						'name' => 'Sweet Dream' 
				),
				array (
						'id' => 61,
						'url' => 'http://mp3.jiapai.cc/wxt/61.mp3',
						'name' => '结婚进行曲' 
				),
				array (
						'id' => 62,
						'url' => 'http://mp3.jiapai.cc/wxt/62.mp3',
						'name' => 'Bruno Mars-Marry You' 
				) 
		);
	}
}