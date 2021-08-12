<?php 
$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'news';
$execute = array(
				"w_tb"  	=> "w_thongbao",
);
if ( !isset($execute[$exe]) ) $exe = 'none';
if ($execute[$exe] != '')
{
	require($foder[$fod]."sources/".$execute[$exe].".php");
}
?>