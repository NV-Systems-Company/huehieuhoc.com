<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : "idx";

$choice = array(
                "idx"        => "index",
                "reg"        => "register",
				"xndl"       => "xacnhan_dieule",
				"login"      => "login",
				"infomem"    => "info_members",
				"infmy"    	 => "info_myself",
				
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
}

?>
