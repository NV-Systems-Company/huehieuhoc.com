<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : "idx";

$choice = array(
                "idx"       => "index",
				"intro"		=> "gioithieu",
				"google"	=> "groupgoogle",
);

if ( !isset($choice[$act]) ) $act = "idx";
?>
