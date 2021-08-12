<?php 
if (!isset($exe))
	$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'none';
$execute = array(
                "none" => 'home',
				"no_r" => "message",
				"intro" => "gioithieu",
				"no_exe" => "no_exe"
);
	
if ( !isset($execute[$exe]) ) $exe = "none";

if ($execute[$exe] != '')
{	
	require($foder[$fod]."sources/".$execute[$exe].".php");
}
?>
