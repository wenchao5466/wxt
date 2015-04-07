<?php
namespace Home\Controller;
use Think\Controller;
class  WeddingController extends Controller {
    
    private $pagesize = 10;
    
    public function index(){
        $this->display(':wedding');
    }
    
    
    public function ajaxgetcontent(){
        
        $Userpost = M('Userpost');
        $where = "isshow=1";
        $count   = $Userpost->where($where)->count();
        $Page    = new \Think\Page($count,  $this->pagesize);
        $Userposts = $Userpost->where($where)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        foreach ($Userposts as &$item) {
             $item['m_inv_boy'] = $item['man'];
             $item['m_inv_girl'] = $item['woman'];
             $item['m_inv_date'] = $item['inv_date'];
             $item['m_code'] = $item['code'];
             
             $image = new \Think\Image(); 
             $item['p_link'] = str_replace("/crop_", "/",   $item['photo']);
             $path = "..".$item['p_link'];
             $realpath = realpath($path);
             $image->open($realpath);
             $item['p_height'] = $image->height();
             $item['p_width'] = $image->width();
             
             $xt_url = "http://".$_SERVER['HTTP_HOST']."/wxt/xt/?code=".$item['code'];
             $item['viewcode'] =  "http://qr.liantu.com/api.php?bg=ffffff&fg=ff0000&gc=222222&el=l&w=280&m=10&text=".  urlencode($xt_url);
        }
        
        $this->ajaxReturn($Userposts);
        
    }
    
}