<?php
// News Lister 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2016
// Check http://www.netartmedia.net/newslister for demos and information
// Released under the MIT license
?><?php
$output_dir = "uploads/";
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
 
	if(!is_array($_FILES["myfile"]["name"])) 
	{
	
 	 	$fileName = $_FILES["myfile"]["name"];
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    	$ret[]= $fileName;
		
	}
	else  
	{
	
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
		$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;
	  }
	
	}
    echo json_encode($ret);
 }
 ?>