<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : "idx";

$choice = array(
                "idx"        => "index",
				"lst_uh"  => "list_ungho",
				
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
}

?>
