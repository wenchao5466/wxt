<?php
namespace Member\Controller;
use Think\Controller;
class PhotoController extends Controller {
    
    private $userid=0;
    private $pagesize = 10;
    
    private function _checklogin(){
       
       
        $this->userid = I('session.user_id',0);
        if(!$this->userid){
            redirect(APP_NAME.'/member/index/login');
        }
        
        $User = M('User');
        $loginuser = $User->where("id=$this->userid ")->find();
        $this->assign('loginuser',$loginuser);
         
    }
    
    
    public function glist(){
        
        $this->_checklogin();
        
        $Userphoto = M('Userphotos');
        $where = "userid=$this->userid ";
        $count   = $Userphoto->where($where."and type='image'")->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $Userphotos = $Userphoto->where($where."and type='image'")->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('userphotos',$Userphotos);
        $this->assign('page',$Page->show());
        
        $videoUserphoto = $Userphoto->where($where."and type='video'")->limit('1')->find();
        $this->assign('video',$videoUserphoto['url']);
        
        $this->display(':photo_glist');
    }
    
    public function upphoto(){
        
        $this->_checklogin();
        
        //$targetFolder = '/Uploads'; // Relative to the root

        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
                /*
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];

                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);

                if (in_array($fileParts['extension'],$fileTypes)) {
                        move_uploaded_file($tempFile,$targetFile);
                        echo '1';
                } else {
                        echo 'Invalid file type.';
                }
                */
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;
                //$upload->savePath = './Public/Uploads/';
                $upload->saveName = array('uniqid','');
                $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
                $upload->autoSub  = true;
                $upload->subName  = array('date','Ymd');
                
                //
                $Userphoto = M('Userphotos');
                $where = "userid=$this->userid ";
                $count   = $Userphoto->where($where)->count();
                if($count>10){
                    $data['status']  = '-1';
                    $data['msg'] ='总共可上传30张,已超过不能上传';
                    $this->ajaxReturn($data);
                }

                // 上传单个文件 
                $info   =   $upload->uploadOne($_FILES['Filedata']);
                if(!$info) {// 上传错误提示错误信息
                    $data['status']  = '-1';
                    $data['msg'] =$upload->getError();
                    $this->ajaxReturn($data);
                }else{// 上传成功 获取上传文件信息
                    $data['status']  = "1";
                    $data['msg'] = '上传成功';
                    $data['url'] = "/Uploads/".$info['savepath'].$info['savename'];
                    
                 
                    $maxUserphoto = $Userphoto->where($where)->order('sort desc')->limit('1')->find();
                    $Userphoto->add(array(
                        'userid'=> $this->userid,
                        'url' => $data['url'],
                        'type' =>'image',
                        'sort' => $maxUserphoto['sort']+1
                    ));
                    
                    $this->ajaxReturn($data);

                }        	
        }
    }
     
    
    public function del(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $model = M();
             $users = $model->query("delete from wxt_userphotos WHERE id=$id");
             $data['status']  = 1;
             $data['msg'] = "删除成功";
             $this->ajaxReturn($data);
        }
    }
    
    
    public function psort(){
        $this->_checklogin();
        
        if (IS_POST){
             $id = I('post.id','','htmlspecialchars');
             $v = I('post.v','','htmlspecialchars');
             
             $model = M();
             $Userphoto = M('Userphotos');
             $currUserphoto = $Userphoto->where("userid=$this->userid and sort=$id")->find();
             
             if($v){//上
                 
                  $beforeid = $currUserphoto['sort']-1;
                  $beforeUserphoto = $Userphoto->where("userid=$this->userid and sort=$beforeid")->find();
                  if($beforeUserphoto){
                      
                      $model->execute("update wxt_userphotos set 
                                            sort=sort+1
                                            where id={$beforeUserphoto['id']}"
                      );
                      $model->execute("update wxt_userphotos set 
                                            sort=sort-1
                                            where id={$currUserphoto['id']}"
                      );
                  }
                  
             }else{//下
                 
                  $nextid = $currUserphoto['sort']+1;
                  $nextUserphoto = $Userphoto->where("userid=$this->userid and sort=$nextid")->find();
                  if($nextUserphoto){
                      $model->execute("update wxt_userphotos set 
                                            sort=sort-1
                                            where id={$nextUserphoto['id']}"
                      );
                      $model->execute("update wxt_userphotos set 
                                            sort=sort+1
                                            where id={$currUserphoto['id']}"
                      );
                  }
             }
             
            
             
             $data['status']  = 1;
             $data['msg'] = "排序成功";
             $this->ajaxReturn($data);
        }
    }
 
    public function sup(){
        
        $this->_checklogin();
        
        if(IS_POST){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;
                //$upload->savePath = './Public/Uploads/';
                $upload->savePath = '../Uploads/';
                $upload->saveName = array('uniqid','');
                $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
                $upload->autoSub  = true;
                $upload->subName  = array('date','Ymd');
                
                //
                $Userphoto = M('Userphotos');
                $where = "userid=$this->userid ";
                $count   = $Userphoto->where($where)->count();
                if($count>10){
                    $data['msg'] ='总共可上传30张,已超过不能上传';
                }else{
                    // 上传单个文件 
                    $info   =   $upload->uploadOne($_FILES['Filedata']);
                    if(!$info) {// 上传错误提示错误信息
                        $data['msg'] =$upload->getError();

                    }else{// 上传成功 获取上传文件信息
                        $data['msg'] = '上传成功';
                        $data['url'] = "/Uploads/".$info['savepath'].$info['savename'];
                        $maxUserphoto = $Userphoto->where($where)->order('sort desc')->limit('1')->find();
                        $Userphoto->add(array(
                            'userid'=> $this->userid,
                            'url' => $data['url'],
                            'type' =>'image',
                            'sort' => $maxUserphoto['sort']+1
                        ));

                    }
                }
        }
        
        $this->assign('msg',$data['msg']);
        $this->display(':photo_sup');
    }
    
    
    public function upvideo(){
        
        $this->_checklogin();
        
        if (IS_POST){
             $video = I('post.video','','htmlspecialchars');
             
             $Userphoto = M('Userphotos');
             $where = "userid=$this->userid ";
             $videoUserphoto = $Userphoto->where($where."and type='video'")->limit('1')->find();
             if($videoUserphoto){
                    $Userphoto->where('id='.$videoUserphoto['id'])->save(array(
                        'url' => $video,
                    )); 
             }else{
                   $maxUserphoto = $Userphoto->where($where)->order('sort desc')->limit('1')->find();
                   $Userphoto->add(array(
                                   'userid'=> $this->userid,
                                   'url' => $video,
                                   'type' =>'video',
                                   'sort' => $maxUserphoto['sort']+1
                               ));
             }
             
             $data['status']  = 1;
             $data['msg'] = "视频保存成功";
             $this->ajaxReturn($data);
        }
    }
    
}