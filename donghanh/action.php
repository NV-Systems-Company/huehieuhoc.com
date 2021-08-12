<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : 'idx';

$choice = array(
                "idx"        => "index",
				"lst_dh"     => "list_donghanh",				
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
}
?>
