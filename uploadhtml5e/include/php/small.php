<?php
error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
date_default_timezone_set('PRC');//设成北京时间
function NewSmall($big_fullpath,$new_fullpath,$w){//生成小图
                    $imginfo= getimagesize($big_fullpath);
					$bilv=$imginfo[0]/$imginfo[1];//长高比
					$arr=explode("/",end($imginfo));
					$ext=$arr[1];
    				$maxwidth=$_width=$w;
					$_height=$_width/$bilv;
					$maxheight=$_height;
					if(trim($ext)=="png"){
					  $thisim = imagecreatefrompng($big_fullpath);
					  
					}else if(trim($ext)=="gif"){
					  $thisim = imagecreatefromgif($big_fullpath);
		
					}else if(trim($ext)=="bmp"){
					  $thisim =imagecreatefromwbmp($big_fullpath); 
		
					}else if(trim($ext)=="jpg"){
					  $thisim =imagecreatefromjpeg($big_fullpath);
		
					}else if(trim($ext)=="jpeg"){
					  $thisim =imagecreatefromjpeg($big_fullpath); 
		
					}else{
					echo $big_fullpath;
					  $thisim = imagecreatefromjpeg($big_fullpath);	
					}
					$x=0;
					$y=0;
					if(function_exists("imagecopyresampled")){
						$newim = imagecreatetruecolor($maxwidth, $maxheight);
						$red = imagecolorallocate($newim, 255, 255, 255);
						imagefill($newim, 0, 0, $red);
						imagecopyresampled($newim, $thisim, $x, $y, 0, 0, $_width,
						$_height, imagesx($thisim), imagesy($thisim));
					}else{
						$newim = imagecreate($maxwidth, $maxheight);
						imagecopyresized($newim, $thisim, $x, $y, 0, 0, $_width,
						$_height, imagesx($thisim), imagesy($thisim));
					}
					ImageJpeg($newim,$new_fullpath,95);
}
function CreateDir($dir){
		       $arr=explode("/",$dir);
			   $dir1="";
			   for($j=0;$j<count($arr);$j++){
			      if($arr[$j]!=""){
					  $dir1.=$arr[$j]."/";
					  $folder=$dir1;
					  if(!is_dir($folder)&&$arr[$j]!="./"&&$arr[$j]!="../"&&$arr[$j]!="/"){
							   mkdir($folder,0777);
					   }
				   }
		
			   }  
}
function IsImg($src){
        $arr=explode(".",$src);
		$is_bool=false;
		if(count($arr)>1){
		   $ext=strtolower($arr[count($arr)-1]);
		  if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
		      $is_bool=true;
		   }
		}
		return $is_bool;
}
function showImg($img){
  $info = getimagesize($img);
  $imgExt = image_type_to_extension($info[2], false); //获取文件后缀
  $fun = "imagecreatefrom{$imgExt}";
  $imgInfo = $fun($img);         //1.由文件或 URL 创建一个新图象。如:imagecreatefrompng ( string $filename )
 $mime = $info['mime'];

  header('Content-Type:'.$mime);
  $quality = 90;
  if($imgExt == 'png') $quality = 9;   //输出质量,JPEG格式(0-100),PNG格式(0-9)
  $getImgInfo = "image{$imgExt}";
  $getImgInfo($imgInfo, null, $quality); //2.将图像输出到浏览器或文件。如: imagepng ( resource $image )
  imagedestroy($imgInfo);
}

$path=$_GET["path"];
$cengci="";
$big_path=$path;
$big_fullpath=$cengci.$big_path;
if(is_file($big_fullpath)){
  if(IsImg($big_fullpath)){
	  $arr=explode(".",$src);
	  $ext=$arr[count($arr)-1];
	  $small_path=str_replace(".".$ext,"_small.".$ext,$big_path);
	  if(!is_file($small_fullpath)){
		  $small_fullpath=$cengci.$small_path;
		  NewSmall($big_fullpath,$small_fullpath,200); //生成小图
		  showImg($small_fullpath);
	  }else{
	      showImg($small_fullpath);
	  } 
  }
}else{
   showImg("more.jpg");
}
?>