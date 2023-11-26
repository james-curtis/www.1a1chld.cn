<?php
error_reporting(E_ALL & ~ E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
function DelImg($cengci,$src,$no){
	  @unlink($cengci.$src);
	  return $cengci.$src;
}

function DelPhoto($fullpath1,$fullpath2,$fullpath3){
	  @unlink($fullpath1);
	  @unlink($fullpath2);
	  @unlink($fullpath3);
}
function DelFile($fullpath){
	  @unlink($fullpath);
}
function SaveBase64($fullpath,$base64){
	  $img = base64_decode($base64);
	  file_put_contents($fullpath, $img);
}
function NewSort($table1,$field1)
    {
		  $mydb=$GLOBALS["mydb"];
		  $sql="select max(" . $field1 . ")+1 as maxSort from " .$table1;
		  $rs=$mydb->myQuery($sql);
		  while($row=mysql_fetch_array($rs)){
		  $str_ = $row["maxSort"];
		  }
		  if(trim($str_)==""){
		  $str_="1";
		  }
		  return $str_;
}
function UpdateImageState($photos,$state_){
    $mydb=$GLOBALS["mydb"];
	$arr=explode("#",trim($photos));
	for($i=0;$i<count($arr);$i++){
		if(trim($arr[$i])!=""){
			$image=$arr[$i];
		    $sql="update ".DB_QZ."images set state=".$state_." where image='".$image."'";//更新图片使用状态
		    $mydb->query($sql_);
		}
	}
}

function GetFirstValue($sql){
	  return intval("1");
}
function CheckSql($str){
	$str=trim($str);
	//$str = preg_replace("/[\r\n]+/", '<br/>', $str);
	//$str = str_ireplace("\n\r","[rn]",$str);
	$str = str_ireplace("[script]","script",$str);
	$str = str_ireplace("script","[script]",$str);
	$str = str_ireplace("and","&#97;nd",$str);
	$str = str_ireplace("execute","&#101;xecute",$str);
	$str = str_ireplace("update","&#117;pdate",$str);
	$str = str_ireplace("count","&#99;ount",$str);
	$str = str_ireplace("mid","&#109;id",$str);
	$str = str_ireplace("master","&#109;aster",$str);
	$str = str_ireplace("truncate","&#116;runcate",$str);
	$str = str_ireplace("char","&#99;har",$str);
	$str = str_ireplace("create","&#99;reate",$str);
	$str = str_ireplace("delete","&#100;elete",$str);
	$str = str_ireplace("insert","&#105;nsert",$str);
	$str = str_ireplace("or","&#111;r",$str);
	$str = str_ireplace("'","&#39;",$str);
	$str = str_ireplace("\"","&#34;",$str);
	//$str = str_ireplace("%20","",$str);
	//$str = str_ireplace(" ","",$str);
	$str = str_ireplace("(","&#40;",$str);
	$str = str_ireplace(")","&#41;",$str);
	$str = str_ireplace("*","&#42;",$str);
	//$str = str_ireplace("+","&#43;",$str);
	$str = str_ireplace(",","&#44;",$str);
	//$str = str_ireplace("-","&#45;",$str);
	//$str = str_ireplace("<","&#60;",$str);
	//$str = str_ireplace("=","&#61;",$str);
	//$str = str_ireplace(">","&#62;",$str);
	//$str = str_ireplace("&quot","",$str);
	$str = str_ireplace("#yu#","&",$str);
	$str = str_ireplace("#cxc#","&",$str);
	$str = str_ireplace("#jia#","+",$str);
	$str = str_ireplace("`","&#96;",$str);
	return $str;
}
function IsMyWeb(){
$youUrl=strtolower($_SERVER['HTTP_REFERER']);
$myUrl=strtolower("http://".$_SERVER['HTTP_HOST']."/");
 if(substr($youUrl,0,strlen($myUrl))==$myUrl){
	 return 1;
 }else{
	 return 0;
 }
}
function NewSmall($big_fullpath,$new_fullpath,$w,$h){//生成小图
                    $imginfo= getimagesize($big_fullpath);
					$bilv=$imginfo[0]/$imginfo[1];//长高比
					$arr=explode("/",end($imginfo));
					$ext=$arr[1];
    				$maxwidth=$_width=$w;
					 $_height=$_width/$bilv;
				    if($GLOBALS["g_is_jiequ"]==1){
				        $maxheight=$h;
				    }else{
				        $maxheight=$_height;
				    }
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
					ImageJpeg($newim,$new_fullpath,85);	
			
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
function UpImg($file,$cengci,$dir1,$dir2,$dir3,$w1,$w2){
		$size=$file['size'];
		$filename=$file["tmp_name"];//文件名
		$newfilesize = $file['size'];//文件大小
		$exts=explode("/",$file['type']); 
		$fileext=$exts[1];
		$pinfo=pathinfo($file["name"]);//文件信息数组
		$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	

		//$ext=$fileext=strtolower($pinfo["extension"]);//转为小写
		$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
		$arr=explode("/",end($infos));
		$ext=$fileext=strtolower($arr[1]);//获取真实的文件后缀
		 
		$oldwidth=$infos[0];
		$oldheight=$infos[1];
		$bilv=($oldwidth/$oldheight);
        $bilv=round($bilv, 6);
		

		$w1=$w1; //小图宽度
		$h1=$w1/$bilv;
		$w2=$w2;  //中图宽度
		$h2=$w2/$bilv;
		$pathstr="";
		if (in_array($fileext,$fileTypes)){
			$bilv=round($bilv, 6);
			$newname=date("YmdHis").$rannum;
			//$newname=str_ireplace(".".$ext,"",$filename);
			$bilv=round($bilv, 6);
			$newname=date("YmdHis").$rannum;
			//$newname=str_ireplace(".".$ext,"",$filename);
			$name=basename($file["tmp_name"]);
            //$newid=addimages($name,$src,$color);
			$newid=1;
			$newname=$newname."_".$newid."_".$bilv;        //名称格式：数字+images表id+图片宽高比率 例214111111_2_0.2.jpg

			
			//$filename=$file["name"];

			

			if($dir1==$dir2&&$dir2==$dir3){
				$small_src=$dir1.$newname.".".$ext;
				$mid_src=$dir2.$newname.".".$ext.".".$ext;
				$big_src=$dir3.$newname.".".$ext.".".$ext.".".$ext;
			}else{
				$small_src=$dir1.$newname.".".$ext;
				$mid_src=$dir2.$newname.".".$ext;
				$big_src=$dir3.$newname.".".$ext;
			}
			
			
			
			$small_fullpath=$cengci.$small_src; //小图路径
			$mid_fullpath=$cengci.$mid_src; //中图路径
			$big_fullpath=$cengci.$big_src; //大图路径

			if(move_uploaded_file($file['tmp_name'],$big_fullpath)){
                    $imginfo= getimagesize($big_fullpath); 
					//print_r($imginfo); 
					$arr=explode("/",end($imginfo));
					$shiji_ext=$arr[1];
				  if(trim($shiji_ext)=="png"){
					$thisim = imagecreatefrompng($big_fullpath);
				  }else if(trim($shiji_ext)=="gif"){
					$thisim = imagecreatefromgif($big_fullpath);
				  }else if(trim($shiji_ext)=="bmp"){
					$thisim =imagecreatefromwbmp($big_fullpath); 
				  }else if(trim($shiji_ext)=="jpg"){
					$thisim =imagecreatefromjpeg($big_fullpath); 
				  }else{
					$thisim = imagecreatefromjpeg($big_fullpath);	
				  }	
				  $oldwidth= imagesx($thisim);
				  $oldheight=imagesy($thisim);
				   if($GLOBALS["is_small"]==1){
				     $maxwidth=$_width=$w1;
				     $maxheight=$h1;
				     $_height=$_width/$bilv;
				     SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$small_fullpath);//小图
				   }
				   if($GLOBALS["is_mid"]==1){
					 $maxwidth=$_width=$w2;
					 $maxheight=$h2;
					 $_height=$_width/$bilv;
					 SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$mid_fullpath);//中图
				   }
				  $input_type=trim($_REQUEST["input_type"]);
				  $pathstr=$big_src;

				  if($input_type=="小图"){
					  $pathstr=$small_src;
				  }
				  if($input_type=="中图"){
					  $pathstr=$mid_src;
				  }
				  $color = imagecolorat($thisim,1,1);
				  $color=dechex($color);//转为16进制
                  $src=$pathstr;
				  //updateimages($src,$color,$newid);
				  //echo $pathstr;
			}
		}
		return $pathstr;
}
function addimages($name,$src,$color){
		
		 $data["addtime"]=trim(date("Y-m-d H:i:s"));
		 $data["name"]=$name;
		 $data["state"]=0;//0表示未被使用
		 $data["image"]=$src;
		 $data["imagergb"]=$color;
		 $ss_id=$_REQUEST["ss_id"];
		 $data["ss_id"]=$_REQUEST["ss_id"];
         $newid=$GLOBALS["mydb"]->add(DB_QZ."images",$data);//添加到images表里
		 if($ss_id!=""){
		 if(trim($_SESSION["ids_".$ss_id])==""){
			  $_SESSION["ids_".$ss_id]=$newid;
		 }else{
			  $_SESSION["ids_".$ss_id]=$_SESSION["ids_".$ss_id].",".$newid;
		 }
		 }
		 	
		return $newid;
}
function updateimages($src,$color,$id){
		 $data["image"]=$src;
		 $data["imagergb"]=$color;
         $GLOBALS["mydb"]->update(DB_QZ."images",$data," id='".$id."'");
}
function DeleteDir($dir)//删除文件夹及文件夹下的文件
{
   $dh = opendir($dir);
   while ($file = readdir($dh))
   {
      if ($file != "." && $file != "..")
      {
         $fullpath = $dir . "/" . $file;
         if (!is_dir($fullpath))
         {
            unlink($fullpath);
         } else
         {
            DeleteDir($fullpath);
         }
      }
   }
   closedir($dh);
   if (rmdir($dir))
   {
      return true;
   } else
   {
      return false;
   }
}
function NewRand($median_){
	  $str_="";
	  $minno="";
	  $maxno="";
	  if(is_numeric($median_)){
			for($i_=0;$i_<$median_;$i_++){
			   $f=rand(0,9);
			   if($f==0){$f=1;}
			   $str_.=$f;
			}
	  }
	  return $str_;
}
function img_add_shuiyin($cengci,$oldpath,$newpath,$opt,$fontpath="../../../../include/font/msyh.ttf"){
		$dst_path = $oldpath;
		//创建图片的实例
		$x=0;
		$y=0;
		if(is_numeric($opt["x"])){$x=$opt["x"];}
		if(is_numeric($opt["y"])){$y=$opt["y"];}
		
		if($opt["type"]=="text"&&$opt["text"]!=""){
			 $dst = imagecreatefromstring(file_get_contents($dst_path));
			//打上文字
			 $font = $fontpath;//字体
			 $fontsize=12;
			 $rgb=hex2rgb("#666666");
			 if(isset($opt["color"])&&trim($opt["color"])!=""){
			   $rgb=hex2rgb($opt["color"]);
			 }
			 if(is_numeric($opt["size"])){$fontsize=$opt["size"];}
			// var_dump($rgb);
			 $imagecolor = imagecolorallocate($dst, $rgb["r"], $rgb["g"], $rgb["b"]);//字体颜色
			 imagefttext($dst, $fontsize, 0, $x, $y+$fontsize, $imagecolor, $font, $opt["text"]);
			 imagejpeg($dst, $newpath, 95); //输出到目标文件
			 imagedestroy($dst); //销毁内存数据流

		}
		if($opt["type"]=="img"&&$opt["src"]!=""&&is_file($cengci.$opt["src"])){
						$src_path = $cengci.$opt["src"];
						//创建图片的实例
						$dst = imagecreatefromstring(file_get_contents($dst_path));
						$src = imagecreatefromstring(file_get_contents($src_path));
						//获取水印图片的宽高
						list($src_w, $src_h) = getimagesize($src_path);
						//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
						//imagecopymerge($dst, $src, 10, 10, 0, 0, $src_w, $src_h, 50);
						//如果水印图片本身带透明色，则使用imagecopy方法
						
						imagecopy($dst, $src, $x, $y, 0, 0, $src_w, $src_h);
						imagejpeg($dst, $newpath, 95); //输出到目标文
						imagedestroy($dst); //销毁内存数据流
						imagedestroy($src); //销毁内存数据流
						
		}
}
function pdf_add_shuiyin($cengci,$oldpath,$newpath,$opt){

					   $x=0;
					   $y=0;
					   $w=0;
					   $h=0;
					   $fontsize=12;
					   $text=date('Y-m-d');
					    $link="";
						$type="text";
						$src="";
                      // var_dump($pdfconf);
						if(is_numeric($opt["size"])){$fontsize=$opt["size"];}
						if(is_numeric($opt["x"])){$x=$opt["x"];}
						if(is_numeric($opt["y"])){$y=$opt["y"];}
						if(trim($opt["text"])!=""){$text=$opt["text"];}
						if(trim($opt["link"])!=""){$link=$opt["link"];}
						if(trim($opt["type"])!=""){$type=$opt["type"];}
						if(trim($opt["src"])!=""){$src=$opt["src"];}
						if($type=="text"&&$text==""){
						 return false;
						}
						if($type=="img"){
							 if($src==""){
							   return false;
							 }else if(!is_file($cengci.$src)){
							   return false;
							 }
						}
						//echo "../../../../".$src;
						//exit();
						require_once($cengci.'include/pdf/fpdf/fpdf.php');
						require_once($cengci.'include/pdf/fpdi/fpdi.php');
						
						//word_watermark
						$pdf = new FPDI();
						// get the page count
			
						$pageCount = $pdf->setSourceFile($oldpath);
						// iterate through all pages
						for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++)
						{
							// import a page
							$templateId = $pdf->importPage($pageNo);
						 
							// get the size of the imported page
							$size = $pdf->getTemplateSize($templateId);
						 
							// create a page (landscape or portrait depending on the imported page size)
							if ($size['w'] > $size['h']) $pdf->AddPage('L', array($size['w'], $size['h']));
							else $pdf->AddPage('P', array($size['w'], $size['h']));
							// use the imported page
							
							$pdf->useTemplate($templateId);
							 if($type=="img"){
							      $img_info = getimagesize($cengci.$src);
								  $w=$img_info[0];
								  $h=$img_info[1];
								  
								  $pdf->image($cengci.$src, $x, $y, $w,$h,"",$link);
		
							 }else{
								  $pdf->SetFont('Arial','B',$fontsize);
							// sign with current date
								  $pdf->SetXY($x, $y); // you should keep testing untill you find out correct x,y values
								  $pdf->Write(7, $text);
							 }
							 //
						 
						}
						$pdf->Output($newpath);
}
/**
 * 十六进制 转 RGB
 */
function hex2rgb($hexColor) {
	$color = str_replace('#', '', $hexColor);
	if (strlen($color) > 3) {
		$rgb = array(
			'r' => hexdec(substr($color, 0, 2)),
			'g' => hexdec(substr($color, 2, 2)),
			'b' => hexdec(substr($color, 4, 2))
		);
	} else {
		$color = $hexColor;
		$r = substr($color, 0, 1) . substr($color, 0, 1);
		$g = substr($color, 1, 1) . substr($color, 1, 1);
		$b = substr($color, 2, 1) . substr($color, 2, 1);
		$rgb = array(
			'r' => hexdec($r),
			'g' => hexdec($g),
			'b' => hexdec($b)
		);
	}
	return $rgb;
}
?>