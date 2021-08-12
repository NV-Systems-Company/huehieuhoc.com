<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : 'none';

$choice = array(
				"none" => "none",
				"lst_hb"  => "list_hocbong",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
	return;
}
?>
