<?php 
$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'none';
$execute = array(
                "none"        => '',
				"dstv"        => "danhsachthanhvien",
				"tvsl"        => "thanhviensanglap",
				"hdcv"        => "hoidongcovan",
				"hdqlq"       => "hoidongquanlyquy",
				"bks"         => "bankiemsoat",
				"bdh"         => "bandieuhanh",
);

if ( !isset($execute[$exe]) ) $exe = 'none';

if ($execute[$exe] != '')
{
	require($foder[$fod]."sources/".$execute[$exe].".php");
}
?>
