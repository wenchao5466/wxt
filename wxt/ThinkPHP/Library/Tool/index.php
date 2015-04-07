<?php

 $path =  dirname(dirname(dirname(dirname(__FILE__)))); 
 $path .= "/Application/Xt/View";
 
 echo $path;
 
 deldir($path);
 
 echo '<br/>done.';
 
 
 
function deldir($dir) {

  //先删除目录下的文件：

  $dh=opendir($dir);

  while ($file=readdir($dh)) {

    if($file!="." && $file!="..") {

      $fullpath=$dir."/".$file;

      if(!is_dir($fullpath)) {

          echo "<br/>delete file $fullpath.";
          
          unlink($fullpath);

      } else {

          deldir($fullpath);

      }

    }

  }

 

  closedir($dh);

  //删除当前文件夹：

  /*if(rmdir($dir)) {

    return true;

  } else {

    return false;

  }*/
  
  return true;

}

