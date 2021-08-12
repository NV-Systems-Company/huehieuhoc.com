<?php 
$exe   = isset($_GET["exe"])  ? $_GET["exe"]  : 'none';
$execute = array(
                "none"        => '',
				"lstmem"      => "list_members",
				"editmem"     => "edit_members",
				"memslp"      => "users_sanglap",
				"memcv"       => "users_covan",
				"memqlq"      => "users_qlquy",
				"memks"      => "users_kiemsoat",
				"memdh"      => "users_dieuhanh",
				"memad"      => "users_admin",
				"memupfi"    => "users_updatefinance",
				"memuphb"    => "users_updatehocbong",
				"memupnw"    => "users_updatenews",
				//-----------------------------------------
				"up_dh"      => "update_donghanh",
				"edit_dh"    => "edit_donghanh",
				"uh"		 => "ungho",
				//----------------------------------------
				"qc"    	 => "quangcao",
				
				//--Tai chinh ---------------------------
				"tiente"  	=> "tiente",
				"thuchi"  	=> "thuchi",
				"tk_tc"   	=> "tongket_taichinh",
				
				//--tintuc -----------------------------
				"news"  	=> "news",
				
				//--thongbao--------------------
				"tb"  		=> "thongbao",
				//-hocbong--------------------
				"hb"  		=> "hocbong",
				//--anh hoat dong--------------------
				"hd"  		=> "hoatdong",
);

if ( !isset($execute[$exe]) ) $exe = 'none';

if (($_SESSION["login"] == "logined")&&($execute[$exe] != ''))
{	
	//quyen thanh vien
	if ( $exe=='news')
	{
		require($foder[$fod]."sources/".$execute[$exe].".php");
		return;
	}	
	//Quyen admin   			   
	if ($_SESSION["right_admin"]==1)
	{
		require($foder[$fod]."sources/".$execute[$exe].".php");
		return;
	}
	
	//quyen cap nhat tai chanh
	if ( ( $_SESSION["right_update_finance"]==1)&&(
		 ( $exe=='tiente')||($exe=='thuchi')||($exe=='tk_tc') ) )
	{
		require($foder[$fod]."sources/".$execute[$exe].".php");
		return;
	}

	//quyen cap nhat tin tuc
	if ( ( $_SESSION["right_update_news"]==1)&&
		 ( $exe=='hd') )
	{
		require($foder[$fod]."sources/".$execute[$exe].".php");
		return;
	}
	
	//quyen cap nhat hoc bong
	if ( ( $_SESSION["right_update_hocbong"]==1)&&
		 ( $exe=='hb') )
	{
		require($foder[$fod]."sources/".$execute[$exe].".php");
		return;
	}
	//---------------
}

?>
