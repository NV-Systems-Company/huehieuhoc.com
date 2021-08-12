<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : 'none';

$choice = array(
				"none" => "none",
				"home"  => "home_news",
				"item"	=> "view_item_news",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
	return;
}
?>
