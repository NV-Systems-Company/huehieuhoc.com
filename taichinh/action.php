<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : "idx";

$choice = array(
                "idx"        => "index",
				"lst_thu"    => "list_tienthu",
				"lst_chi"    => "list_tienchi",
				"tk"    	 => "tongket",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
}

?>
