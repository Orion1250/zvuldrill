<?php

if(@isset($_GET['file']) && file_exists($_GET['file']))
{
	$file = $_GET['file'];
	$filename = realpath($file);
	$fileinfo = pathinfo($file);
	$goodexts = array('txt','doc','xls','ppt');
	if(!in_array($fileinfo['extension'],$goodexts)){
		die("<meta charset='utf-8' />别想下载其它文件");
	};
	$date = date("Ymd-H:i:m");
	Header( "Content-type:  application/octet-stream "); 
	Header( "Accept-Ranges:  bytes "); 
	Header( "Accept-Length: " .filesize($filename));
	Header( "Content-Disposition:  attachment;  filename= {$date}.{$fileinfo['extension']}"); 
	echo file_get_contents($filename);
}
else{
	echo "<meta charset='utf-8' />";
	echo "<h1>没有指定要下载的文件</h1>";
}