<?php if (!defined('THINK_PATH')) exit();?><html>
 <head></head>
 <body>
  <div id="shouye" style="overflow:hidden; background-color:#8d7408"> 
   <div id="shouye1" class="ibg"> 
    <div class="ibg1" style="background-image: url(<?php echo $userpost['photo']?>); width:39%; margin:0 auto; margin-top:60%;"> 
     <img src="/Public/Xt/Huangguanjinse/images/ibg2.png" id="ibg2" class="half-img" /> 
    </div> 
    <div class="ma xm"> 
     <ul> 
      <li class="l f50"><?php echo $userpost['man']?></li> 
      <li class="c f50">&amp;</li> 
      <li class="r f50"><?php echo $userpost['woman']?></li> 
     </ul> 
    </div> 
    <div class="ma cy f36">
      诚挚邀请 
    </div> 
    <div class="ma rq f24">
      <?php echo $userpost['inv_date']?>&nbsp;<?php echo $userpost['inv_time_1']?>时<?php echo $userpost['inv_time_2']?>分
     <br /> 
    </div> 
    <div class="ma wz f24"> 
     <span> <a href="<?php echo $map?>"><img class="half-img" src="/Public/Xt/Huangguanjinse/images/i_wz.png" /></a> </span> 
     <a href="<?php echo $map?>"><span style="color:#01bcbb"><span style="color:#FFF"><?php echo $userpost['city']?>·<?php echo $userpost['location']?> &gt; </span></span></a> 
    </div> 
    <div style="padding:0 45% 0 45%; margin-top:5%;">
     <img class="half-img" src="/Public/Xt/Huangguanjinse/images/jt.png" />
    </div> 
   </div> 
  </div>
 </body>
</html>