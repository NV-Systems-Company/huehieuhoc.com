<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : 'none';

$choice = array(
				"none" => "none",
				"lst_tb"  => "list_thongbao",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
	return;
}
?>
