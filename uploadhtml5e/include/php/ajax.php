<?php session_start();?>
<?php
//include("../../../function/db_config.php");
 //header("Access-Control-Allow-Methods:OPTIONS,POST,GET");
 header("Access-Control-Allow-Origin:*");

 
 include("config.php");
 include("func.php");

ob_clean();

$act=$_REQUEST["act"];
//if(IsMyWeb()==0){
//	echo "非法提交"; //不是通过本网站提交
//	exit();
//}
/*删除图片*/

if($act==""){
  $act="up";
}

$cengci=$g_cengci;

delfolder($cengci."tmp/",24*60*4);//删除过期垃圾文件,超过4天的


if($act=="del"){
   del($cengci);
   echo "del success";
}
if($act=="up"){

  up($cengci);
}
if($act=="autosave"){
    autosave($cengci);
	echo "save success";
}
if($act=="getsave"){
   getsave($cengci);
}

if($act=="save_base64"){
    save_base64($cengci);
}
function save_base64($cengci){
         global  $g_dir4;//图文件夹
        $base64=trim($_REQUEST["base64"]);
  		$base64=str_ireplace("[jh]","+",$base64);
		$arr=explode(";base64,",$base64);
		if(count($arr)>1){
		  $base64=$arr[1];
		}
		$ext=trim($_REQUEST["ext"]);
		$is_upload=false;
		if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
		 $is_upload=true;
		}
		if($is_upload==false){
		   echo ("{status:\"error\",msg:\"后端不允许上传.".$ext."文件\"}");
		   exit();
		}
		
		$time=time();
		$newname ="img".date("YmdHis", $time)."sj".NewRand(4);
		if(isset($_POST["newname"])){
		$newname=trim($_POST["newname"]);
		}
		$bigsrc=$g_dir4.$newname.".".$ext;
		$big_fullpath=$cengci.$bigsrc;
		if($base64!=""){
		  SaveBase64($big_fullpath,$base64);
		  echo("{status:\"success\",path:\"".$bigsrc."\"}");
		}
		exit();
}
function up($cengci){
		//php
		//TODO:
		global  $g_is_jiequ;
		global  $g_dirtou;//头文件夹要
		global  $g_dir1;//小图文件夹
		global  $g_dir2;//中图文件夹
		global  $g_dir3;//大图文件夹
		global  $g_dir4;//图文件夹
		global  $g_dir_audio; //视频文件夹
		global  $g_dir_other; //文件夹
		global  $g_w1; //小图宽
		global  $g_w2; //中图宽
		global  $g_h1; //小图高
		global  $g_h2; //中图高
		global  $g_fenge;
		global  $g_is_yuanming;
	
		$size = $_REQUEST["size"];
		$end = $_REQUEST["end"];
		$beg = $_REQUEST["beg"];
		$title=trim($_REQUEST["title"]);
		$isyuanming= $_POST["isyuanming"];
		$title =urldecode($title);
		$file=$_FILES["file"];
		$tmpid=trim($_REQUEST["tmpid"]);
		$value=trim($_REQUEST["value"]);
		$value=str_ireplace("[jh]","+",$value);
		$index=trim($_REQUEST["index"]);
		$ext=trim($_REQUEST["ext"]);
	    $num=intval($_REQUEST["num"]);
		$isduandianxuchuan=trim($_REQUEST["isduandianxuchuan"]);
		if(trim($_REQUEST["index"])!=""){
		    $index=intval($_REQUEST["index"]);
			$total=intval($_REQUEST["total"]);
		}else{
		  if(trim($_REQUEST["chunk"])!=""){
		     $index=intval($_REQUEST["chunk"])+1;
		     $total=intval($_REQUEST["chunks"]);
		   }else{
		     $index=1;
		     $total=1;
		   }
		}

		$filename=trim($_REQUEST["filename"]);
		$audio_ext_str="flv,3gp,mp4,rmvb,mov,avi,m4v,m3u8";
		$extstr="bmp,jpg,png,gif,jpeg,doc,docx,xls,xlsx,rar,zip,zp,pdf,txt,flv,3gp,mp4,rmvb,mov,avi,m4v,m3u8";
		$audio_exts=explode(",",$audio_ext_str);
		
		$exts=explode(",",$extstr);
		$isupload=true;
		if(!in_array(strtolower($ext),$exts)){
			  $isupload=false;
		}
		if(!$isupload){
		     echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
			 exit();
		}
		$isnewsmall=trim($_REQUEST["isnewsmall"]);
		if($title!=""){$tmpid=md5($title);}
		
		$tmpdir=$cengci."tmp/".$tmpid."/";

        CreateDir($tmpdir); 
		$ismid=0;
		$issmall=0;
		if($isnewsmall==1){
		   $issmall=1;
		   $ismid=0;
		}
	
        $tmp_index_full =  $tmpdir.$index.".tmp";
		 $data=trim($_REQUEST["data"]);
		 if(trim($_POST["data"])!=""){ //以base64 编辑发过来的
			$data =  $_POST["data"];
			$data=str_ireplace("[jh]","+",$data);
			if(substr($data, 0, 37) == "data:application/octet-stream;base64,"){
				$data = substr($data, 37);
			}
			$tx="data:;base64,";
			if(substr($data, 0, strlen($tx)) == $tx){
				$data = substr($data, strlen($tx));
			}
			$data = base64_decode($data);
			if (!$handle = fopen($tmp_index_full, 'a')) {//不能打开文件
				 echo "Cannot open file ($tmp_index_full)";
				 exit;
			}
			if (fwrite($handle, $data) === FALSE) { //不能写入文件
				echo "Cannot write to file ($tmp_index_full)";
				exit;
			}
			fclose($handle);
		 }else{
		   if (!empty($_FILES)) { //以文件形式发过来的
						  $file=$_FILES["file"];
						   if(!is_file($tmp_index_full)){
						           move_uploaded_file($file["tmp_name"],$tmp_index_full);
						  }else{
						       if($index!=$total){
						         echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"已存在\"}";
								 exit;
							  }
						  }
		   }else{       //以二进制流
						if (!$out = @fopen($tmp_index_full, "wb")) {
							die('{"error" : {"code": 102, "message": "Cannot open file"}}');
						}
		
						if (!$in = @fopen("php://input", "rb")) {
							die('{"error" : {"code": 101, "message": "Failed to open input stream."}}');
						}
						
						while ($buff = fread($in, 4096)) {
							fwrite($out, $buff);
						}
						@fclose($out);
						@fclose($in);
		   }
	   }
	   
	   if($index!=$total){
	    echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"$index分段上传成功\"}";
		exit();
	   }
	   $isbool=1;
	   for($i=1;$i<=$total;$i++){
		  $tmp_path = $tmpdir.$i.".tmp";
		  if (!file_exists($tmp_path)) {
			$isbool=0;
		  }
	   }
		
//		if($beg == 0){
//			$filename = tempnam("tmp", "FOO");//tempnam函数生成一个FOO开头的唯一的文件名
//			$_SESSION["filename"] = $filename;
//		}else{
//			$filename = $_SESSION["filename"];
//		}


		if($isbool==1){
			//unset($_SESSION["filename"]);
			//chmod($filename, 0755);
			$uploadfile=$tmpdir.$tmpid.".bao";				
			if(is_file($uploadfile)){
				 @unlink($uploadfile);
			}
			 $datastr="";
			 $fo = fopen($uploadfile,"a");
			 for($i=1;$i<=$total;$i++){
			    $tmp_path = $tmpdir.$i.".tmp";
			    $datastr =file_get_contents($tmp_path);
				//file_put_contents("test.txt", "This is another something.", FILE_APPEND)
				fwrite($fo,$datastr);//写入文件中
				@unlink($tmp_path);
			 }
           
			fclose($fo);
			 for($i=1;$i<=$total;$i++){
			    $tmp_path = $tmpdir.$i.".tmp";
				@unlink($tmp_path);
			 }
			
			$time=time();
			$date=date("Y-m-d H:i:s",$time);
			
			if($isyuanming==""){
			   $isyuanming=$g_is_yuanming;
			}
			if($isyuanming==1){
				$newname=trim($title);
				$newname = str_ireplace(" ","",$newname);//去掉空格
				$newname = str_ireplace(".".$ext,"",$newname);//去掉空格
			}else{
			    if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
			      $newname ="image".date("YmdHis", $time)."sj".NewRand(4);
				}else{
				  $newname ="file".date("YmdHis", $time)."sj".NewRand(4);
				}
			}
			$g_dir1.=date("Ymd",$time)."/";
			$g_dir2.=date("Ymd",$time)."/";
			$g_dir3.=date("Ymd",$time)."/";
			$g_dir4.=date("Ymd",$time)."/";
			$g_dir_other.=date("Ymd",$time)."/";
			$g_dir_audio.=date("Ymd",$time)."/";
			if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
					if($issmall==1){
						if($g_dir1==$g_dir2&&$g_dir2==$g_dir3){
							$small_src=$g_dir1.$newname.".".$ext;//小图
							$mid_src=$g_dir2.$newname.".".$ext.".".$ext;//中图
							$big_src=$g_dir3.$newname.".".$ext.".".$ext.".".$ext;//大图/原图
						}else{
							$small_src=$g_dir1.$newname.".".$ext;
							$mid_src=$g_dir2.$newname.".".$ext;
							$big_src=$g_dir3.$newname.".".$ext;
						}
	
						CreateDir($cengci.$g_dir1);
						CreateDir($cengci.$g_dir2);
						CreateDir($cengci.$g_dir3);
						
						if($issmall!=1){
						 $small_src=$big_src;
						}
						if($ismid!=1){
						   $mid_src=$big_src;
						}
						
						$small_fullpath=$cengci.$small_src;
						$mid_fullpath=$cengci.$mid_src;
						$big_fullpath=$cengci.$big_src;
						if($isyuanming==1){
						   $small_fullpath=iconv("UTF-8","GB2312",$small_fullpath);
						   $mid_fullpath=iconv("UTF-8","GB2312",$mid_fullpath);
						   $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
						}
						//rename($filename, $big_fullpath);//保存
						 copy($uploadfile,$big_fullpath);
						 @unlink($uploadfile);
						if($issmall==1){
							   NewSmall($big_fullpath,$small_fullpath,$g_w1,$g_h1);
						}
						if($ismid==1){
							   NewSmall($big_fullpath,$mid_fullpath,$g_w2,$g_h2);
						}
					}else{
						      $newnamepath=$_REQUEST["newnamepath"];
						        $pos=stripos($newnamepath,$g_dirtou."/");
		                        if($pos!==false &&($pos==0||$pos==1)){
									  $ext="gif";
									  $big_src=$newnamepath.".".$ext;
									   if(is_file($cengci.$big_src)){
										  @unlink($cengci.$big_src);  
									   }
									 CreateDir($cengci.dirname($big_src));
									
								}else{
									  $big_src=$g_dir4.$newname.".".$ext;
						              CreateDir($cengci.$g_dir4);
								}
					     
						 $big_fullpath=$cengci.$big_src;
						  $small_src=$big_src;
						  $mid_src=$big_src;
						 if($isyuanming==1){
						   $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
						 }
					   	 copy($uploadfile,$big_fullpath);
						 @unlink($uploadfile);
					}
					$status="success";
			}else{
						        $newname=md5($newname);
						        $newnamepath=$_REQUEST["newnamepath"];
						        $pos=stripos($newnamepath,$g_dirtou."/");
		                        if($pos!==false &&($pos==0||$pos==1)){
									
									  $big_src=$newnamepath.".".$ext;
									   if(is_file($cengci.$big_src)){
										  @unlink($cengci.$big_src);  
									   }
									 CreateDir($cengci.dirname($big_src));
								}else{
									if(in_array(strtolower($ext),$audio_exts)){
										 CreateDir($cengci.$g_dir_audio);
										 $big_src=$g_dir_audio.$newname.".".$ext;
				
									}else{
										 CreateDir($cengci.$g_dir_other);
										 $big_src=$g_dir_other.$newname.".".$ext;
									}
								}
						
						$big_fullpath=$cengci.$big_src;
						$small_src=$big_src;
						if($isyuanming==1){ 
						//rename($filename, iconv("UTF-8","GB2312",$big_fullpath));//保存
						    $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
						     copy($uploadfile,$big_fullpath);
					        @unlink($uploadfile);
						}else{
							copy($uploadfile,$big_fullpath);
					         @unlink($uploadfile);
						}
						$status="success";

			}
			//$big_path 大图路径
			//$mid_src 中图路径
			//$small_src 小图路径
			@rmdir($tmpdir);


			echo ("{\"status\":\"".$status."\",\"filepath\":\"".$small_src."\",\"small_src\":\"".$small_src."\",\"title\":\"".$title."\",\"ext\":\"".$ext."\",\"cengci\":\"{$cengci}\",\"date\":\"{$date}\",\"tmpid\":\"{$tmpid}\",\"row\":{\"src\":\"{$small_src}\",\"md5\":\"".md5($small_src)."\",\"name\":\"{$title}\",\"size\":\"".@filesize($big_fullpath)."\",\"ida\":\"4545\"}}");
		}else{
		    echo ("{\"status\":\"dengdai\",\"beg\":\"".$beg."\",\"end\":\"".$end."\"}");
		}
		
		exit();
}

function del($cengci){
		global  $g_dirtou;//头文件夹要
   $path=trim($_POST["path"]);
   if($path==""){
	   $path=trim($_POST["src"]);
   };
   $arr=explode("#",$path);
   echo  $path;
   for($i=0;$i<count($arr);$i++){
           $filepath=$arr[$i];
		   $pos=strpos($filepath,$g_dirtou."/");
		   if($filepath!=""&&$pos!==false&&($pos==0||$pos==1)){
				$arr=explode(".",$filepath);
				echo  $path;
				$ext=".".end($arr);
				$filepath=iconv('UTF-8', 'GB2312',$filepath);
				  if(file_exists($cengci.$filepath)){
					   if(filemtime_cz($cengci.$path)){
						 @unlink($cengci.$filepath);
						 $dellist[]=$filepath;
					   }
				  }
				if(strpos($filepath,"/s50/")!==false||strpos($filepath,"/s100/")!==false){
				  $bigpath=str_replace("/s50/","/s100/",$filepath);
				  $path=str_replace("/s100/","/s100/",$bigpath);
				  $path=str_replace("//","/",$bigpath);
				   if(file_exists($cengci.$path)){
					    if(filemtime_cz($cengci.$path)){
						  @unlink($cengci.$path);
						  $dellist[]=$path;
						}
				   }
				  $path=str_replace("/s100/","/s50/",$bigpath);
				  $path=str_replace("//","/",$bigpath);
				   if(file_exists($cengci.$path)){
					    if(filemtime_cz($cengci.$path)){
					       @unlink($cengci.$path);
					       $dellist[]=$path;
						}
				   }
		
				  $path=str_replace("/s100/","/s80/",$bigpath);
				  $path=str_replace("//","/",$bigpath);
				   if(file_exists($cengci.$path)){
					    if(filemtime_cz($cengci.$path)){
					   @unlink($cengci.$path);
					   $dellist[]=$path;
						}
				   }
				}else if(strpos($filepath,"_s50")!==false||strpos($filepath,"_s100")!==false){
					  $bigpath=str_replace("_s50","_s100",$filepath);
					  $path=str_replace("_s100","_s100",$bigpath);
					  $path=str_replace("//","/",$bigpath);
					   if(file_exists($cengci.$path)){
						    if(filemtime_cz($cengci.$path)){
							  @unlink($cengci.$path);
							  $dellist[]=$path;
							}
					   }
					  $path=str_replace("_s100","_s50",$bigpath);
					  $path=str_replace("//","/",$bigpath);
					   if(file_exists($cengci.$path)){
						    if(filemtime_cz($cengci.$path)){
						  @unlink($cengci.$path);
						  $dellist[]=$path;
							}
					   }
					  $path=str_replace("_s100","_s80",$bigpath);
					  $path=str_replace("//","/",$bigpath);
					   if(file_exists($cengci.$path)){
						    if(filemtime_cz($cengci.$path)){
						   @unlink($cengci.$path);
						   $dellist[]=$path;
							}
					   }
				}else{
				 $path=str_replace($ext.$ext.$ext,$ext,$filepath);
				 $path=str_replace("//","/",$bigpath);
				  if(file_exists($cengci.$path)){
					    if(filemtime_cz($cengci.$path)){
					    @unlink($cengci.$path);
					  $dellist[]=$path;
						}
				  }
				  if(file_exists($cengci.$path.$ext)){
					  if(filemtime_cz($cengci.$path.$ext)){
					    @unlink($cengci.$path.$ext);
					    $dellist[]=$path.$ext;
					  }
				  }
				  if(file_exists($cengci.$path.$ext.$ext)){
					    if(filemtime_cz($cengci.$path.$ext.$ext)){
					@unlink($cengci.$path.$ext.$ext);
					$dellist[]=$path.$ext.$ext;
						}
				  }
				}
				echo "del:";
				echo json_encode($dellist);
			}
	}
	exit();
}
function  filemtime_cz($fullpath){
	  if(is_file($fullpath)){
	        $cz=time()-filemtime($fullpath);
			if($cz<60*60*1){
				 return true;
			}
	  }
	   return false;
}
function  autosave($cengci){
			$content="";
			$mykey="";  
			$key=trim($_POST["key"]);
				$content=trim($_POST["content"]);
				$mykey=trim($_POST["mykey"]);
				if($key!="" && $content!=""){
					 $my_path = $cengci."tmp/key/".$key."/".$mykey.".txt";  //保存路径
					 CreateDir($cengci."tmp/key/".$key."/");
					 save_file($my_path,$content,"utf-8");
				}
   }
function getsave($cengci){
			$key="";
			$jsonstr="";
			$str = "";
			$index1=0;   
			$key=trim($_POST["key"]);
			if ($key!=""){
				 $pathstr="";
			
				 $pathstr=get_files($cengci."tmp/key/".$key."/");
				// exit();
				 $paths=explode("[g]",$pathstr);
				 $jsonstr="";
				 $index1=0;
				 //echo(pathstr);
				 for($i=0 ;$i<count($paths);$i++){
					 if($paths[$i]!=""){
					   $str =read_file($paths[$i],"utf-8");
					  if($str!=""){
						  if($jsonstr!=""){
							$jsonstr=$jsonstr.",".$str."";
						  }else{
							  $jsonstr=$str;
						   }
						  }
					  }
					  }

			 }
	  $jsonstr="[".$jsonstr."]";
	  echo($jsonstr);
}
function get_files($c_path){
             $paths="";
			 $index=0;
			if(is_dir($c_path)){
			// header("Content-type: text/html; charset=gb2312"); 
			    $handler = opendir($c_path);//当前目录中的文件夹下的文件
				while( ($filename = readdir($handler)) !== false ) {
					  if($filename != "." && $filename != ".."){
						  if(is_file($c_path.$filename)){
							  if($paths!=""){
								$paths= $paths."[g]".$c_path.$filename;
							  }else{
								$paths=$c_path.$filename;
							  }
						  }
					  }
				};
		       closedir($handler);
		  }  
           return $paths;
}
function read_file($path_full,$charset){
	  $str = "";
	  if(is_file($path_full)){
	     $str = file_get_contents($path_full);
	  }
	 return $str;
	   
}
function save_file($path_full,$content, $charset)
{
	 $p =$path_full;
	 $isbool=true;
	 if(!$path_full||!$content){
		 return false;
	  }
	 if(is_file($path_full)){ 
	    unlink($path_full); 
	 }

	 CreateDir(dirname($path_full));
	  
	 if ($fp = fopen($path_full, "w")) {
		 if (@fwrite($fp, $content)) {
			 fclose($fp);
			 $isbool=true;
		 } else {
			 fclose($fp);
			 $isbool=false;
		 } 
	 } 

	 return isbool;
}
function delfolder($c_path, $m) //删除超过几分钟的文件夹
{
            $paths="";
			$folder_Names=""; 
			if(is_dir($c_path)){
			// header("Content-type: text/html; charset=gb2312"); 
			    $handler = opendir($c_path);//当前目录中的文件夹下的文件
				while( ($filename = readdir($handler)) !== false ) {
					  if($filename != "." && $filename != ".."){
						  if(is_dir($c_path.$filename)){
						     $dir_path=$c_path.$filename;
						      // $dir_path=iconv('UTF-8', 'GB2312',$dir_path);
								$gqTime=(filectime($dir_path)+($m*60));
								$time=time();
								$cz=$time-($gqTime);
                              if($cz>0){
							  if($paths!=""){
								 $paths= $paths."[g]".$dir_path;
							  }else{
								 $paths=$dir_path;
							  }
							  }
						  }
					  }
				};
		       closedir($handler);
		  }  
	 $arr=explode("[g]",$paths);
	 for($i=0;$i<count($arr);$i++){
	      if($arr[$i]!=""){
          if(is_dir($arr[$i])){
			   removeDir($arr[$i]);
		   }
		  }
	 };
	 return $paths;
}

// 说明： 删除非空目录的解决方案
// http://www.manongjc.com
//https://blog.csdn.net/wuxiaopeng_1986/article/details/52842770
function removeDir($dirName) 
{ 
    if(! is_dir($dirName)) 
    { 
        return false; 
    } 
    $handle = @opendir($dirName); 
    while(($file = @readdir($handle)) !== false) 
    { 
        if($file != '.' && $file != '..') 
        { 
            $dir = $dirName . '/' . $file; 
            is_dir($dir) ? removeDir($dir) : @unlink($dir); 
        } 
    } 
    closedir($handle); 
      
    return @rmdir($dirName);  //rmdir只能删除空文件夹
} 

function SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,$x,$y,$newimagepath){
		$newim = imagecreatetruecolor($maxwidth, $maxheight);
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
		ImageJpeg($newim,$newimagepath,85);
}


//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

