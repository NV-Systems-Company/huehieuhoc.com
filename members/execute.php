<?php 
$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'none';
$execute = array(
                "none"        => '',
                "reg"         => "register",
				"login"       => "login",
				"logout"       => "logout",
				
				"infomem"    => "info_members",
				"infmy"    	 => "info_myself",
);

if ( !isset($execute[$exe]) ) $exe = 'none';

if ($execute[$exe] != '')
{
	require($foder[$fod]."sources/".$execute[$exe].".php");
}
?>
