<?php 

$act   = isset($_GET["act"])  ? $_GET["act"]  : "idx";

$choice = array(
                "idx"         => "index",
				"dl"      	  => "dieule",
                "qd2384"      => "qdthanhlap",
				"qd2385"      => "qdcongnhan",
				"qd2386"      => "qdpheduyet",
				"dean"        => "dean",
				"deanbd"      => "deanbandau",
				"deans1"      => "deansualan1",
				"deans2"      => "deansualan2",
				"deans3"      => "deansualan3",
				"deans4"      => "deansualan4",
				"deans5"      => "deansualan5",
				"deans6"      => "deansualan6",
				"deans7"      => "deansualan7",
				"deans8"      => "deansualan8",
				
				"dstv"        => "danhsachthanhvien",
				"tvsl"        => "thanhviensanglap",
				"hdcv"        => "hoidongcovan",
				"hdqlq"       => "hoidongquanlyquy",
				"bks"         => "bankiemsoat",
				"bdh"         => "bandieuhanh",
				
				"dxd"         => "dangxaydung",
);

if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	$fod = "home";
}
?>
