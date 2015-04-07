<?php
namespace Member\Controller;
use Think\Controller;
class MemberController extends Controller {
    
    
    private $userid=0;
    private $loginuser;
   
    
    private function _checklogin(){
       
       
        $this->userid = I('session.user_id',0);
        if(!$this->userid){
            redirect(APP_NAME.'/member/index/login');
        }
        
        $User = M('User');
        $this->loginuser = $User->where("id=$this->userid ")->find();
        $this->assign('loginuser',$this->loginuser);
         
    }
    
    public function edit(){
       
       $this->_checklogin();

       $Model = M('Userpost');
       $where = "userid=$this->userid ";
       $Userpost = $Model->where($where)->find();
       
       
      if (IS_POST){
        
            $m_inv_boy = I('post.m_inv_boy','','htmlspecialchars');
            $m_inv_girl = I('post.m_inv_girl','','htmlspecialchars');
            $m_inv_date = I('post.m_inv_date','','htmlspecialchars');
            $m_inv_time_1 = I('post.m_inv_time_1','','htmlspecialchars');
            $m_inv_time_2 = I('post.m_inv_time_2','','htmlspecialchars');
            $m_isqqmap = I('post.m_isqqmap','','htmlspecialchars');

            $m_inv_city = I('post.m_inv_city','','htmlspecialchars');
            $m_inv_address = I('post.m_inv_address','','htmlspecialchars');
            $m_inv_desc = I('post.m_inv_desc','','htmlspecialchars');
            $isupimg = I('post.isupimg','','htmlspecialchars');
            $mapx = I('post.mapx','','htmlspecialchars');
            $mapy = I('post.mapy','','htmlspecialchars');
            $m_bjyy = I('post.m_bjyy','','htmlspecialchars');
            $m_bjyytitle = I('post.m_bjyytitle','','htmlspecialchars');
            $m_bg = I('post.m_bg','','htmlspecialchars');

                     
            $data['userid'] = $this->userid ;
            $data['man'] = $m_inv_boy;
            $data['woman'] = $m_inv_girl;
            $data['inv_date'] = $m_inv_date;
            $data['inv_time_1'] = $m_inv_time_1;
            $data['inv_time_2'] = $m_inv_time_2;
            $data['city'] = $m_inv_city;
            $data['location'] = $m_inv_address;
            $data['location_x'] = $mapx;
            $data['location_y'] = $mapy;
            $data['welocome'] = str_replace(array('&lt;','&gt;'),array('<','>'),$m_inv_desc) ;
            $data['photo'] =  str_replace("http://".$_SERVER['HTTP_HOST'], "", $isupimg) ;
            $data['style'] = $m_bg;
            $data['music'] =  $m_bjyy ; //$m_bjyy ? "http://mp3.jiapai.cc/wxt/$m_bjyy.mp3" : "";
            $data['musictitle'] = $m_bjyytitle;
            
            if($Userpost){
                   $Model->where($where)->save($data); 
            }else{
                   $data['code'] = generation_guid_string();
                   $Model->add($data);
            }
            
            $data['status']  = 1;
            $data['msg'] = "修改成功";
            $this->ajaxReturn($data);
        }
         
        $style = array(
            "Default"=>"浅水语行",
            "Pink"=>"公主日记",
            "White"=>"倾城之恋",
            "Huangguan"=>"紫韵涟漪",
            "Huangguanzise"=>"繁花似锦",
            "Huangguanjinse"=>"秋日恋歌",
            "Hanshi"=>"最美时光",
            "Oushifg"=>"佳期如梦",
            "Xinxinxiangyin"=>"浮影年华",
            "Yesido"=>"海洋之心",
            "Planning"=>"旧时微光",
            "Theonly"=>"花田喜事",
            "Ofingerprint"=>"大城小爱",
            "Rfingerprint"=>"花好月圆",
            "Bluefingerprint"=>"水木青华",
			"Huiyijuhui"=>"会议聚会"
        );
        $Userpost['stylename'] = array_key_exists($Userpost['style'], $style) ? $style[$Userpost['style']] : '';
        $this->assign('userpost',$Userpost);
        $this->display(':member_edit');
    }
    
    public function aupload(){
        $this->_checklogin();
       
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize = 3145728;
        //$upload->savePath = './Public/Uploads/';
        $upload->saveName = array('uniqid','');
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub  = true;
        $upload->subName  = array('date','Ymd');
                
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['m_inv_pic']);
        if(!$info) {// 上传错误提示错误信息
            $data['status']  = '-1';
            $data['error'] =$upload->getError();
            //$this->ajaxReturn($data);
            echo json_encode($data); 
        }else{// 上传成功 获取上传文件信息
            $data['status']  = "1";
            $data['msg'] = "/Uploads/".$info['savepath'].$info['savename'];
            //$this->ajaxReturn($data);
            echo json_encode($data); 
        }        	
    	 
    }
    
    
    public function setimg(){
        
       $this->_checklogin();

        
       $a_x = I('post.a_x','0','htmlspecialchars');
       $a_y = I('post.a_y','0','htmlspecialchars');
       $a_w = I('post.a_w','250','htmlspecialchars');
       $a_h = I('post.a_h','236','htmlspecialchars');
       $m_inv_memo = I('post.m_inv_memo','','htmlspecialchars');
       //$m_inv_memo = "http://weixitie.com/Uploads/20150104/54a8f0c5919c1.png";
       
       
        $path = $m_inv_memo;
        if (strstr($url,'http') === false){
            $path = str_replace("http://".$_SERVER['HTTP_HOST']."/", "../", $path);
        }else{
            $path = "..".$path;
        }
        $realpath = realpath($path);
        //echo $realpath.'<br/>';
        
       
        $pathinfo = pathinfo($realpath);
        $file_name = $pathinfo['dirname'].'/crop_'.$pathinfo['basename'];
        $m_inv_memo = str_replace($pathinfo['basename'], 'crop_'.$pathinfo['basename'], $m_inv_memo);
         
       
        $image = new \Think\Image(); 
        $image->open($realpath);
        $image->crop($a_w, $a_h,$a_x,$a_y)->save($file_name);

        echo $m_inv_memo;
    } 
    
    
    public function uppwd(){
        
        $this->_checklogin();
        
        if (IS_POST){
            $oldpwd = I('post.oldpwd','','htmlspecialchars');
            $ckpwd = I('post.ckpwd','','htmlspecialchars');
            $newpwd = I('post.newpwd','','htmlspecialchars');
            
            
            if($oldpwd!=$this->loginuser['password']){
                $data['status'] = -1;
                $data['msg'] = '保存失败：原密码没有输入正确';
                $this->ajaxReturn($data);
            }
            
            if($newpwd!=$ckpwd){
                $data['status'] = -1;
                $data['msg'] = '保存失败：确认密码没有输入正确';
                $this->ajaxReturn($data);
            }
            
            $data['password'] = $newpwd;
            
            
            M('User')->where("id=$this->userid")->save($data); 
            $data['status'] = 1;
            $data['msg'] = '保存成功';
            $this->ajaxReturn($data);
        }
         
        $this->display(':member_uppwd');
    }
     
   
}