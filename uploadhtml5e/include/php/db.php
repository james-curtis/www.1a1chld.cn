<?php
class db
{
	public $connStr="";
	public $updateStr="";
	public $db_host="";
	public $db_name="";
	public $db_user="";
	public $db_password="";
	public $qz="";//表前缀
	public $config=array ();

	function __construct($db_host="",$db_name="",$db_user="",$db_password="",$table_qz=""){
		$this->db_host=$db_host;
		$this->db_name=$db_name;
		$this->db_user=$db_user;
		$this->db_password=$db_password;
		$this->qz=$table_qz;
		//mysql_query("SET GLOBAL group_concat_max_len=102400;");
		$this->conn=@mysql_connect($this->db_host,$this->db_user,$this->db_password);//连接数据库
		$this->myconnStr();
		mysql_query("set names utf8");//有的空间不允许设编码
	}

	function getvalue($sql_,$nulltext_=""){
		   if(stripos($sql_,"limit")===false){
			     $rs=$this->query($sql_." limit 0,1");
		   }else{
				  $rs=$this->query($sql_."");
		   }
			$str0_="";
			while($row=mysql_fetch_array($rs)){
			$str0_="".$row[0]."";
			}
			if($str0_==""){
			$str0_=$nulltext_;
			}
			return $str0_;
	}
	function myconnStr()
	{
		//mysql_query("set names utf8");
		if(!$this->conn){
		  header("Content-Type: text/html; charset=UTF-8");
		  echo "数据库连接不上";
		  exit();
		}
		$myDB=@mysql_select_db($this->db_name,$this->conn);
	    if(!$myDB)
	    {
		 header("Content-Type: text/html; charset=UTF-8");
	     echo "数据库选择错误：不存在".$this->db_name."数据库";
	     exit();
	    }
		return $this->conn;
	}
	
	function getrowcount($sql){
		$rs=mysql_query($sql);

		return mysql_num_rows($rs);

	}
	function query($sql)
	{
			$arr=explode("[query]",$sql);
			$len=sizeof($arr);
			for($i=0;$i<$len;$i++){
			$arr[$i]=trim($arr[$i]);
			// echo $arr[$i];
			if($arr[$i]!=""){
		
				 $rs=mysql_query($arr[$i],$this->myconnStr());
				 if(!$rs)
				 {
					header("Content-Type: text/html; charset=UTF-8");
					echo mysql_error();
					die("执行失败!".$arr[$i]);
				  //exit();
				}	
			}
			}
			//echo "执行成功!"	.$sql;
			return $rs;
	}
	function getrow($sql_){
	        $this->sql=$sql_;
			$rs=$this->query($sql_);
			$row=mysql_fetch_array($rs);
			return $row;
	}
	function selectone($tablename,$where,$field="*")
	{
	   global $Web,$W;
	   $wherestr="";
	   if(is_array($where)){
	     foreach($where as $key=>$val){
		    if($wherestr!=""){
			   $wherestr.=" and `$key`='".$val."'";
			}else{
			   $wherestr.=" where `$key`='".$val."'";
			}
		 }
	   }else{
	      $wherestr=$where;
		  if(strpos($wherestr,"where")===false){
		    $wherestr=" where ".$wherestr;
		  }
	   }
	   $rs=$this->query("select {$field} from ".DB_QZ.$tablename." ".$wherestr." limit 0,1");
	   $row=mysql_fetch_array($rs);
	   if(is_array($row)){
			foreach($row as $key=>$val){
			   $row[$key]=$this->unchecksql($val);
			}
		}
	   $site=$Web["siteurl"];
	   if($Web["siteurl"]==""){
	   $site=$W["site"];
	   }
	   if(isset($row["content"])){
          $row["content"]= str_ireplace("src=\"file/","src=\"".$Web["siteurl"]."file/",$row["content"]);
	   }
	   return $row; 
	}
	////////////////////////
	function editsql($myarr,$table){
	$rs_table_desc=mysql_query("DESCRIBE fs_product_class",$this->myconnStr());
	while($rs_table_desc_row=mysql_fetch_array($rs_table_desc)){
		$myField[]=$rs_table_desc_row['Field'];
		$myType[]=$rs_table_desc_row['Type'];
		$myNull[]=$rs_table_desc_row['Null'];
		$myKey[]=$rs_table_desc_row['Key'];
		$myDefault[]=$rs_table_desc_row['Default'];
		$myExtra[]=$rs_table_desc_row['Extra'];	  
	}
	$_updateStr="";
	$myi=1;
	foreach($myarr as $key1 => $val1){
	    $isBool=0;
		for($i=0;$i<count($myField);$i++){
		if($myField[$i]==$key1){
			  $isBool=1;
			  $p='';
		      $typeName=explode("(",$myType[$i]);
			 if($typeName[0]=="int"||$typeName[0]=="smallint"||$typeName[0]=="mediumint"){
			 $p="";
			 }else if($typeName[0]=="bigint"||$typeName[0]=="float"||$typeName[0]=="double"||$typeName[0]

=="decimal"){
			 $p="";
			 }else if($typeName[0]=="varchar"||$typeName[0]=="tinytext"||$typeName[0]=="tinyblob"||$typeName[0]

=="blob"){
			 $p="'";
			 }else if($typeName[0]=="mediumtext"||$typeName[0]=="longtext"||$typeName[0]=="longblob"){
			 $p="'";
			 }else{
			 $p="";
			 }
			 if(count($myarr)==$myi){
			  $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.' ';
			  }else{
			   $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.', ';
			  }
	          $this->updateStr="updata fs_product_class set ".$_updateStr; 
			  break;
	      }
	    }
		$myi=$myi+1;	
		if($isBool==0)
		{
		 echo "'".$table."'表不存在'".$key1."'字段!";
		 exit();
		}
		
    }	
}
   function add($tablename,$data){
		            $sql_columns="SHOW COLUMNS FROM ".$tablename." ";
					$rs_columns=$this->query($sql_columns);
					$filedstr="";
					while($row=mysql_fetch_array($rs_columns)){
	                  $filedstr.="`".$row['Field']."`,";
					}
					foreach($data as $key=>$val){
						if(stripos($filedstr,"`".$key."`")===false){
						  unset($data[$key]);
						}else{
						      if($key!="id"){
							  if(stripos($data[$key],"src=\"")!==false){
								 $val= str_ireplace("src=\"".$Web["siteurl"]."file/","src=\"file/",$val);
							  }
							  $filednames.="`".$key."`,";
							  $filedvalues.="'".$this->checksql($val)."',";
							  }
						}
					}
					$filednames = substr($filednames,0,strlen($filednames)-1); 
					$filedvalues = substr($filedvalues,0,strlen($filedvalues)-1); 
					$this->sql="insert into ".$tablename."(".$filednames.") values(".$filedvalues.")";
					$this->query($this->sql);
					
					return mysql_insert_id();

   }
   function update($tablename,$data,$where){
    global $Web;
		            $sql_columns="SHOW COLUMNS FROM ".$tablename." ";
					$rs_columns=$this->query($sql_columns);
					$filedstr="";
					while($row=mysql_fetch_array($rs_columns)){
	                  $filedstr.="`".$row['Field']."`,";
					}
					foreach($data as $key=>$val){
						if(stripos($data[$key],"src=\"")!==false){
							  $val= str_ireplace("src=\"".$Web["siteurl"]."file/","src=\"file/",$val);
							 // echo($val);
							 
						}
						if(stripos($filedstr,"`".$key."`")===false){
						       unset($data[$key]);
						}else{
						     if($key!="id"){
							  $setsql.="`".$key."`"."='".$this->checksql($val)."',";
							  }
						}
					}
					$filednames = substr($filednames,0,strlen($filednames)-1); 
					$setsql = substr($setsql,0,strlen($setsql)-1); 
					$this->sql="update ".$tablename." set ".$setsql." where ".$where;

					$this->query($this->sql);
   }
 function checksql($str){

		$str=trim($str);
        global $mgl_array;
	    if(is_array($mgl_array)){
		    if(in_array($str,$mgl_array)){
			  return $str;
			}
		}
		//$str = preg_replace("/[\r\n]+/", '<br/>', $str);
		//$str = str_ireplace("\n\r","[rn]",$str);
		$str = str_ireplace("script","&#115;cript",$str);
		$str = str_ireplace("iframe","&#105;frame",$str);
		$str = str_ireplace("and","&#97;nd",$str);
		$str = str_ireplace("execute","&#101;xecute",$str);
		$str = str_ireplace("update","&#117;pdate",$str);
		$str = str_ireplace("count","&#99;ount",$str);
		$str = str_ireplace("mid","&#109;id",$str);
		$str = str_ireplace("master","&#109;aster",$str);
		$str = str_ireplace("truncate","&#116;runcate",$str);
		
		//$str = str_ireplace("char","&#99;har",$str);
		$str = str_ireplace("create","&#99;reate",$str);
		$str = str_ireplace("delete","&#100;elete",$str);
		$str = str_ireplace("insert","&#105;nsert",$str);
		$str = str_ireplace("drop","&#116;rop",$str);
		//$str = str_ireplace("or","&#111;r",$str);
		$str = str_ireplace("'","&#39;",$str);
		//$str = str_ireplace("\"","&#34;",$str);
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
		//$str = str_ireplace("#yu#","&",$str);
		//$str = str_ireplace("#cxc#","&",$str);
		$str = str_ireplace("+","#jia#",$str);
		$str = str_ireplace("`","&#96;",$str);
		//$str =get_str($str,"data-scayt_word=\"","\"");
		return $str;
 }
	function unchecksql($str){
			$str=trim($str);
			//$str = str_ireplace("&#115;cript","script",$str);
			$str = str_ireplace("&#97;nd","and",$str);
			$str = str_ireplace("&#101;xecute","execute",$str);
			$str = str_ireplace("&#117;pdate","update",$str);
			$str = str_ireplace("&#99;ount","count",$str);
			$str = str_ireplace("&#109;id","mid",$str);
			$str = str_ireplace("&#109;aster","master",$str);
			$str = str_ireplace("&#116;runcate","truncate",$str);
			$str = str_ireplace("&#99;har","char",$str);
			$str = str_ireplace("&#99;reate","create",$str);
			$str = str_ireplace("&#100;elete","delete",$str);
			$str = str_ireplace("&#105;nsert","insert",$str);
			$str = str_ireplace("&#116;rop","drop",$str);
			$str = str_ireplace("&#111;","or",$str);
			$str = str_ireplace("&#39;","'",$str);
			$str = str_ireplace("&#34;","\"",$str);
			$str = str_ireplace("%20","",$str);
			//$str = str_ireplace(" ","",$str);
			$str = str_ireplace("&#40;","(",$str);
			$str = str_ireplace("&#41;",")",$str);
			$str = str_ireplace("&#42;","*",$str);
			$str = str_ireplace("&#43;","+",$str);
			$str = str_ireplace("&#44;",",",$str);
			
			$str = str_ireplace("&#60;","<",$str);
			$str = str_ireplace("&#61;","=",$str);
			$str = str_ireplace("&#62;",">",$str);
			//$str = str_ireplace("","&quot",$str);
			$str = str_ireplace("#yu#","&",$str);
			$str = str_ireplace("#cxc#","&",$str);
			$str = str_ireplace("&#96;","`",$str);
			$str = str_ireplace("#jia#","+",$str);
			$str = str_ireplace("&#96;","`",$str);
			$str = str_ireplace("&#45;","-",$str);
			
			//$str =$this->clearHtml($str);
			return $str;
	}  

}
?>