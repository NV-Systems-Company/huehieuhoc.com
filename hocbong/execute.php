<?php 
$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'news';
$execute = array(
				"w_hb"  	=> "w_hocbong",
);
if ( !isset($execute[$exe]) ) $exe = 'none';
if ($execute[$exe] != '')
{
	require($foder[$fod]."sources/".$execute[$exe].".php");
}
?>