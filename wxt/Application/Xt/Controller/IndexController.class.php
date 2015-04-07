<?php
namespace Xt\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function index(){
        var_dump(1111111111);die;
        $code = I('get.code','','htmlspecialchars');
        
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $User = M('User')->where("id={$Userpost['userid']}")->find();
        $Shop = M('User')->where("id={$User['shopid']}")->find();
        
        
        if($_SESSION['IsForwardOp'.$code] != 'true'){
            M('User')->where("id={$User['id']}")->save(array(
                'forwardcount'=>$User['forwardcount']+1
            ));

            $_SESSION['IsForwardOp'.$code] = 'true';
        }
         M('User')->where("id={$User['id']}")->save(array(
            'viewcount'=>$User['viewcount']+1
        ));
        
        $this->assign('code',$code);
        $this->assign('shop',$Shop);
        $this->assign('userpost',$Userpost);
        
         
        $this->display(":xt_{$Userpost['style']}");
    }
    
    
    public function ajaxindex(){
        $code = I('get.code','','htmlspecialchars');
        
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $map = "http://map.wap.qq.com/x/index.jsp?welcomeChange=1&sid=AeMkyDSu2CCw-hCGoG0CftBM&welcomeClose=1&hideAdvert=hide&type=infowindow&open=1&address=时间： {$Userpost['inv_time_1']}:{$Userpost['inv_time_2']}&name={$Userpost['city']}·{$Userpost['location']}&referer=weixinmp_profile&g_ut=3&Y={$Userpost['location_y']}&X={$Userpost['location_x']}&Z=16";

        $this->assign('userpost',$Userpost);
        $this->assign('map',  $map);
        
        
        $this->display(":xt_{$Userpost['style']}Ajax");
    }
    
    public function sh(){
        $code = I('get.code','','htmlspecialchars');
        
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $User = M('User')->where("id={$Userpost['userid']}")->find();
        $Shop = M('User')->where("id={$User['shopid']}")->find();
        
         $this->assign('shop',$Shop);
         
         $this->display(':xt_'.$Userpost['style'].'AjaxSh');
    }
    
    
    public function msg(){
        $code = I('get.code','','htmlspecialchars');
        $p = I('get.p','','htmlspecialchars');
        
        if($p){
            
        }
        
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $Messages = M('Message')->where("postid={$Userpost['id']}")->order('create_time desc')->select();
        
        
        $this->assign('userpost',$Userpost);
        $this->assign('messages',$Messages);
        
        
        $this->display(':xt_'.$Userpost['style'].'AjaxMsg');
    }
    
    public function sendzf(){
        
        $code = I('get.code','','htmlspecialchars');
        $Userpost = M('Userpost')->where("code='$code'")->find();
        
        
        $zf_name = I('post.zf_name','','htmlspecialchars');
        $zf_msg = I('post.zf_msg','','htmlspecialchars');
        $zf_giftid = I('post.zf_giftid','','htmlspecialchars');
        
        M('Message')->add(array(
            'postid'=>$Userpost['id'],
            'name'=>$zf_name,
            'photo'=>$zf_giftid,
            'description'=>$zf_msg,
        ));
        
        $data['status']  = 1;
        $data['msg'] = "保存成功";
        $this->ajaxReturn($data);
    }
    
     public function yqh(){
        $code = I('get.code','','htmlspecialchars');
        $p = I('get.p','','htmlspecialchars');
        
        if($p){
            
        }
        
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $Guests = M('Guest')->where("postid={$Userpost['id']}")->order('create_time desc')->select();
        $map = "http://map.wap.qq.com/x/index.jsp?welcomeChange=1&sid=AeMkyDSu2CCw-hCGoG0CftBM&welcomeClose=1&hideAdvert=hide&type=infowindow&open=1&address=时间： {$Userpost['inv_time_1']}:{$Userpost['inv_time_2']}&name={$Userpost['city']}·{$Userpost['location']}&referer=weixinmp_profile&g_ut=3&Y={$Userpost['location_y']}&X={$Userpost['location_x']}&Z=16";

        
        $this->assign('userpost',$Userpost);
        $this->assign('guests',$Guests);
        $this->assign('map',  $map);
        $this->display(':xt_'.$Userpost['style'].'AjaxYqh');
    }
    
    
    public function  sendyqh(){
        $code = I('get.code','','htmlspecialchars');
        $Userpost = M('Userpost')->where("code='$code'")->find();
        
         if(IS_POST){
              $yqh_name = I('post.yqh_name','','htmlspecialchars');
              $yqh_renshu = I('post.yqh_renshu','','htmlspecialchars');
              $yqh_qylx = I('post.yqh_qylx','','htmlspecialchars');
             
              M('Guest')->add(array(
                'postid'=>$Userpost['id'],
                'name'=>$yqh_name,
                'description'=>"$yqh_qylx （共{$yqh_renshu}人参加）",
            ));

            $data['status']  = 1;
            $data['msg'] = "保存成功";
            $this->ajaxReturn($data);
         }
        
           $this->display(':xt_'.$Userpost['style'].'AjaxSendYqh');
         //$this->display(':xt_DefaultAjaxSendYqh');
    }
    
    
    public function photo(){
        $code = I('get.code','','htmlspecialchars');
        $Userpost = M('Userpost')->where("code='$code'")->find();
        $Userphotos = M('Userphotos')->where("userid={$Userpost['userid']}")->select();
        $UserVideophoto= M('Userphotos')->where("userid={$Userpost['userid']} and type='video'")->find();
        
        
        $this->assign('userpost',$Userpost);
        $this->assign('userphotos',$Userphotos);
        $this->assign('userVideophoto',$UserVideophoto?htmlspecialchars_decode($UserVideophoto["url"]):'');
        
        $this->display(':xt_'.$Userpost['style'].'Ajaxphoto');
    }
    
    
    public function photozan(){
        $code = I('get.code','','htmlspecialchars');
        $id = I('get.id','','htmlspecialchars');
        
        
        if($_SESSION['IsPZOp'.$id] == 'true'){
            $data['status']  = -1;
            $data['msg'] = "激动的心情可以理解，但也要保持好的心态哦！";
            $this->ajaxReturn($data);
        }else{
            $currUserphoto = M('Userphotos')->where("id=$id")->find();
            M('Userphotos')->where("id=$id")->save(array(
                'zcount'=>$currUserphoto['zcount']+1
            ));

            $_SESSION['IsPZOp'.$id] = 'true';
            $data['status']  = 1;
            $data['msg'] = "保存成功";
            $this->ajaxReturn($data);
        }
        
        
    }
    
}