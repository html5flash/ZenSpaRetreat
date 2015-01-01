<?php 
class configClass
{
		var $hostname="";
		var  $username="";
		var $password="";
		var  $dbname="";
		
		function configClass()
		{
			$this->hostname=HOSTNAME;
			$this->username=USERNAME;
			$this->password=PASSWORD;
			$this->dbname=DBNAME;
		}
		function selectQuery_two($tablename1,$tablename2,$fields1,$fields2,$where,$order,$start,$limit)
		{
		
		if(count($fields1)>1)
		$fields1=implode(",",$fields1);
		else
		$fields1=$fields1;
		if(count($fields2)>1)
		$fields2=implode(",",$fields2);
		else
		$fields2=$fields2;
		$query=DBSELECT.$fields1.','.$fields2.DBFROM.$tablename1.','.$tablename2;
		if($where!="")
		$query.=DBWHR.$where;
		if($order!="")
		$query.=DB_ORDER.$order;
		if($limit!="")
		{
			if($start=="")
			$start=0;
			$query.=DB_LMT.$start.",".$limit;
		}
		//echo $query;exit;
		return $query;
		}
		
		function configConnection()
		{
			$con=mysql_connect($this->hostname,$this->username,$this->password);
			$connection=mysql_select_db($this->dbname,$con);
			if(!$connection) echo "fail".mysql_error();
		}
		function executeQuery($query){
			$result = mysql_query($query);
			$insert_id = mysql_insert_id();
			$update_id = mysql_affected_rows();
			$queryresult = array(LASTID=>$insert_id, Result=>$result, UpdatedRes=>$update_id);
			//print_r($queryresult); exit;
			return $queryresult;
		}
		function executeQueryString($query){
			$result = mysql_query($query);
		}
		function insertRecord($tablename,$fieldnames)
		{
			$val=array();
			foreach($fieldnames as $k=>$values)
			{  
				if(is_numeric($values))
				$values=$values;
				elseif(is_null($values))
				$values="''";
				else
				$values="'".$values."'";
				$val[]=$k."=".$values.",";
			}
			 $str=rtrim(implode($val),',');
			  $query=DBIN.$tablename.DBSET.$str;
			 //echo $query;
			$res =configClass::executeQuery($query);
			return $res['LASTID'];
		}
		
		function updateRecord($tablename,$fieldnames,$where,$ids)
		{
		if(is_array($ids)){
		$field_ids=implode(",",$ids);
		}else{
		$field_ids=$ids;
		}
		$val=array();
		foreach($fieldnames as $k=>$values)
		{  
			if(is_numeric($values))
			$values=$values;
			elseif(is_null($values))
			$values="''";
			else
			$values="'".$values."'";
			$val[]=$k."=".$values.",";
		}
		$str=rtrim(implode($val),',');
		$query=DBUP.$tablename.DBSET.$str;
		if($where!="")
		$query.=' '.DBWHR.$where." IN('".$field_ids."')";
		$res = configClass::executeQuery($query);
		return $res['Result'];
		}
		
		function deleteRecord($tablename,$where,$ids){
		if(is_array($ids)){
		$field_ids=implode(",",$ids);
		}else{
		$field_ids=$ids;
		}
		$query=DBDEL.DBFROM.$tablename;
		if($where!="")
		$query.=DBWHR.$where." IN('".$field_ids."')";
		$res = configClass::executeQuery($query);
		return $res['UpdatedRes'];
		}
		
		function headerRedirect($con)
		{
		  header(HEAD_LTN.$con);
		}
		
		function selectQuery($tablename,$fields,$where,$order,$start,$limit)
		{
		if(count($fields)>1)
		$fields=implode(",",$fields);
		else
		$fields=$fields;
		$query=DBSELECT.$fields.DBFROM.$tablename;
		if($where!="")
		$query.=DBWHR.$where;
		if($order!="")
		$query.=DB_ORDER.$order;
		if($limit!="")
		{
			if($start=="")
			$start=0;
			$query.=DB_LMT.$start.",".$limit;
		}
		return $query;
		}
		
		function create_image_byoriginal($srcpath,$dir,$width,$height)
	   {
		if(!is_dir($dir)) { mkdir($dir); }
	
		if(!empty($srcpath))
		{
			$target_path = $srcpath;

			$slashpos = strrpos($target_path,"/");
			
			$filename = substr($target_path,$slashpos+1);

			$extension = substr($filename,strrpos($filename,".") +1);
		
			$imgdir = $dir."/";
			
			if($extension == 'jpg' || $extension == 'JPG')
			{
				$src_img = imagecreatefromjpeg($target_path);
			}
			if($extension == 'gif' || $extension == 'GIF')
			{
				$src_img = imagecreatefromgif($target_path);
			}
			if($extension == 'png' || $extension == 'PNG')
			{
				$src_img = imagecreatefrompng($target_path);
			}
			if($extension == 'jpeg' || $extension == 'jpeg')
			{
				$src_img = imagecreatefromjpeg($target_path);
			}

			$size = getimagesize($target_path);
			$old_x = $size[0];
			$old_y = $size[1];
	
			$dst_img = imagecreatetruecolor($width,$height);
		
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$width,$height,$old_x,$old_y);
			
			if(($extension == 'jpg') || ($extension == 'JPG')){
					$upimg = imagejpeg($dst_img, $imgdir.$filename,90);
			}else if(($extension == 'gif') || ($extension == 'GIF')){
					$upimg = imagegif($dst_img, $imgdir.$filename,90);
			}else if(($extension == 'png') || ($extension == 'PNG')){
					$upimg = imagepng($dst_img, $imgdir.$filename,1);
			}else if(($extension == 'jpeg')|| ($extension == 'JPEG')){
					$upimg = imagejpeg($dst_img, $imgdir.$filename,90);
			}
			$imageparameter = array(status=>$upimg,filename=>$filename);
		 }
		 else
		 {
		 	$imageparameter = array(status=>1,filename=>'');
		 }
		return $imageparameter;
	}
		
		/*function freeimageUploadcomncode($jnt,$imagename,$path,$hdnimage)
		{
		if($_FILES[$imagename]['name']!="") {
		$ext=explode(".",$_FILES[$imagename]['name']);
		$name=$jnt.'_'.time().uniqid().'.'.$ext[1];
		move_uploaded_file($_FILES[$imagename]['tmp_name'],$path.$name);
		if(file_exists($path.$hdnimage)) @unlink($path.$hdnimage);	
		}
		else {
		$name = $hdnimage;
		}
		return $name;
		}
		
		function imageCommonUnlink($path,$imagename)
		{
			if(file_exists($path.$imagename))@unlink($path.$imagename);
		}*/
		
		function freeimageUploadcomncode($jnt,$imagename,$path,$thumb_path,$hdnimage,$width,$height)
		{
			if($_FILES[$imagename]['name']!="") 
			{
				if($width!="")
				$thumb_newwidth=$width;
				else
				$thumb_newwidth=150;
				if($height!="")
				$thumb_newheight=$height;
				else
				$thumb_newheight=150;
				$ext=explode(".",$_FILES[$imagename]['name']);
				$name=$jnt.'_'.time().uniqid().'.'.$ext[1];
				move_uploaded_file($_FILES[$imagename]['tmp_name'],$path.$name);
				configClass::create_image_byoriginal($path.$name,$thumb_path, $thumb_newwidth, $thumb_newheight);
				if(file_exists($thumb_path.$hdnimage) && file_exists($path.$hdnimage)){ 
					configClass::imageCommonUnlink($path,$thumb_path,$hdnimage);
				}
				if(file_exists($thumb_path.$hdnimage) && !file_exists($path.$hdnimage)){ 
					configClass::imageCommonUnlink('',$thumb_path,$hdnimage);
				}
				if(!file_exists($thumb_path.$hdnimage) && file_exists($path.$hdnimage)){ 
					configClass::imageCommonUnlink($path,'',$hdnimage);
				}
			}
			else 
			{
				$name = $hdnimage;
			}
		return $name;
		}
		
		function imageCommonUnlink($path,$thumb_path,$imagename)
		{
				if(file_exists($path.$imagename)) @unlink($path.$imagename);
				if(file_exists($thumb_path.$imagename)) @unlink($thumb_path.$imagename);
		}
		

		/*function queryUid($query) {
			$result = @mysql_query($query);
			$insert_id = mysql_insert_id();
			$update_id = mysql_affected_rows();
			$queryresult = array(ID=>$insert_id, Result=>$result, UpdateRes=>$update_id);
			return $queryresult;		
		}*/
		function getRow($query)
		{
			$res=mysql_query($query); 
			$values=@mysql_fetch_object($res);  
			return $values;
		}
		
		function getAllRows($query)
		{
			$values=array();
			$res=mysql_query($query); 
			while($rows=@mysql_fetch_object($res)) {
				$values[]=$rows;
			}
			return $values;
		} 
		
		function getCount($query)
		{
			$res=@mysql_query($query); 
			$cnt=@mysql_num_rows($res);  
			return $cnt;
		}
		
		
		function passwordEncrypt($str)
		{
			return base64_encode(base64_encode($str));
		}

		function passwordDecrypt($str)
		{
			return base64_decode(base64_decode($str));
		}
	
function generateRandomString($length)
  {
    $password = "";
    $possible = "12346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
    $maxlength = strlen($possible);
    if ($length > $maxlength) {
      $length = $maxlength;
    }
    $i = 0; 
    while ($i < $length) { 
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
      if (!strstr($password, $char)) { 
        $password .= $char;
        $i++;
      }
    }
	return $password;
    //return $password.time();
  }	
		
function random_code()
{
	$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
	$rand = '';
	
	for($i = 0;$i <= 10;$i++) {
		$num = rand() % 61;
		$tmp = substr($string, $num, 1);
		$rand = $rand.$tmp;
	}
	return time().rand(1,time()).$rand.$salt;
}

		
		function paginavigation($start,$limit,$total,$filePath,$otherParams) 
		{
			$allPages = ceil($total/$limit);
			
			$currentPage = floor($start/$limit) + 1;
			$hrefclass="infocus";
			$pagination = "";
			
			if ($allPages>10)
			{
				$maxPages = ($allPages>9) ? 9 : $allPages;
				
				if ($allPages>9) 
				{
					if ($currentPage>=1&&$currentPage<=$allPages) 
					{
						$pagination .= ($currentPage>4) ? " ... " : " ";
			
						$minPages = ($currentPage>4) ? $currentPage : 5;
						$maxPages = ($currentPage<$allPages-4) ? $currentPage : $allPages - 4;
			
						for($i=$minPages-4; $i<$maxPages+5; $i++) 
						{
						   $pagination .= ($i == $currentPage) 	? "<a href=\"".$filePath."&start=".(($i-1)*$limit).$otherParams."\" class='focus'>&nbsp;&nbsp;".$i."&nbsp;</a>" : "<a href=\"".$filePath."&start=".(($i-1)*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;".$i."&nbsp;</a>";
						}
						$pagination .= ($currentPage<$allPages-4) ? " ... " : " ";
					} 
					else
					{
			
						$pagination .= " ... ";
					}
				}
			} 
			else 
			{
				for($i=1; $i<$allPages+1; $i++)
				{
					$pagination .= ($i==$currentPage) ? "<a href=\"".$filePath."&start=".(($i-1)*$limit).$otherParams."\" class='focus'>&nbsp;".$i."&nbsp;</a>" : "&nbsp;<a href=\"".$filePath."&start=".(($i-1)*$limit).$otherParams."\" class='".$hrefclass."'>".$i."</a>";
				}
			}
			if ($currentPage>1) 
				$previous = "<a href=\"".$filePath."&start=".(($currentPage-2)*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;&lt;&lt;</a>";
			
			echo $previous;
				
			echo $pagination;
			
			if ($currentPage<$allPages) 
				$next = "<a href=\"".$filePath."&start=".($currentPage*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;&gt;&gt;</a>";
			
			echo $next;
		}
		
		function paginavigation_FrontEnd($start,$limit,$total,$filePath,$otherParams) 
		{
			$allPages = ceil($total/$limit);
			
			$currentPage = floor($start/$limit) + 1;
			$hrefclass="infocus";
			$pagination = "";
			
			if ($allPages>10)
			{
				$maxPages = ($allPages>9) ? 9 : $allPages;
				
				if ($allPages>9) 
				{
					if ($currentPage>=1&&$currentPage<=$allPages) 
					{
						$pagination .= ($currentPage>4) ? " ... " : " ";
			
						$minPages = ($currentPage>4) ? $currentPage : 5;
						$maxPages = ($currentPage<$allPages-4) ? $currentPage : $allPages - 4;
			
						for($i=$minPages-4; $i<$maxPages+5; $i++) 
						{
						   $pagination .= ($i == $currentPage) 	? "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='focus'>&nbsp;&nbsp;".$i."&nbsp;</a>" : "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;".$i."&nbsp;</a>";
						}
						$pagination .= ($currentPage<$allPages-4) ? " ... " : " ";
					} 
					else
					{
			
						$pagination .= " ... ";
					}
				}
			} 
			else 
			{
				for($i=1; $i<$allPages+1; $i++)
				{
					$pagination .= ($i==$currentPage) ? "<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='focus'>&nbsp;".$i."&nbsp;</a>" : "&nbsp;<a href=\"".$filePath."?start=".(($i-1)*$limit).$otherParams."\" class='".$hrefclass."'>".$i."</a>";
				}
			}
			if ($currentPage>1) 
				$previous = "<a href=\"".$filePath."?start=".(($currentPage-2)*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;&lt;&lt;</a>";
			
			echo $previous;
				
			echo $pagination;
			
			if ($currentPage<$allPages) 
				$next = "<a href=\"".$filePath."?start=".($currentPage*$limit).$otherParams."\" class='".$hrefclass."'>&nbsp;&gt;&gt;</a>";
			
			echo $next;
		}
		
		function url_EncodingStr($str){
		return urlencode($str);
		}
		function url_DecodingStr($str){
		return urldecode($str);
		}
		
		function remove_special_symbols($string)
		{
		//Array of special charecters you want to replace
		//$special = array('^','>','<','`','~','\'','"','\\','_','!','@','#','$','%','&','*','(',')','=','+','{','}','[',']','.',',','/','?','|','-',':',';',' '); //here you can add as many char. you want
		$special = array('^','>','<','`','~','\'','"','\\','_','!','@','#','$','%','&','*','(',')','=','+','{','}','[',']','.',',','/','?','|',':',';',' '); //here you can add as many char. you want
		
		return strtolower(str_replace($special,'-',$string));
		}
}
?>