<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : 'none';

$choice = array(
				"ct"  => "contact",
				"msg"  => "message",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
	return;
}
?>
