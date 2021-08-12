<?php 
$act   = isset($_GET["act"])  ? $_GET["act"]  : 'idx';
$choice = array(
                "idx"        => "index",
				"none"        => "none",
				"no"		  => "message",
				"lstmem"     => "list_members",
				"notmem"     => "list_notmembers",
				"editmem"    => "edit_members",
				"memslp"     => "users_sanglap",
				"memcv"      => "users_covan",
				"memqlq"     => "users_qlquy",
				"memks"      => "users_kiemsoat",
				"memdh"      => "users_dieuhanh",
				"memad"      => "users_admin",
				"memupfi"    => "users_updatefinance",
				"memuphb"   =>  "users_updatehocbong",
				"memupnw"    => "users_updatenews",
				//---------------Bao tro-----------------------
				"up_dh"      => "update_donghanh",
				"edit_dh"    => "edit_donghanh",
				
				"lst_uh"     => "list_ungho",
				"add_uh"	 => "add_ungho",
				"edit_uh"	 => "edit_item_ungho",
				//--------------Quang cao -------------------------
				"add_qc"	 => "add_quangcao",
				"man_qc"	 => "manage_quangcao",
				"edit_qc"	 => "edit_quangcao",
				//----------Tai Chinh--------------------
				"idx_taich"  => "index_taichanh",
				"dm_tiente"  => "danhmuctien",
				"edit_tt"  	 => "edit_tiente",
				"lst_thu"    => "list_tienthu",
				"lst_chi"    => "list_tienchi",
				"add_thu"    => "add_tienthu",
				"add_chi"    => "add_tienchi",
				"edit_thu"   => "edit_tienthu",
				"edit_chi"   => "edit_tienchi",
				"tk_tc"   	 => "tongket_taichinh",
				//----------Tin tuc--------------------
				"cats_news"  => "list_cats_news",
				"add_news"   => "add_news",
				"edit_news"  => "edit_news",
				"try_view"   => "try_view_news",
				"view_news"  => "view_news",
				"lst_news"   => "list_news",
				//----------thongbao--------------------
				"lst_tb"  => "list_thongbao",
				"add_tb"  => "add_thongbao",
				"edit_tb"  => "edit_thongbao",
				//----------anh hoat dong--------------------
				"lst_hd"  => "list_hoatdong",
				"add_hd"  => "add_hoatdong",
				"edit_hd" => "edit_hoatdong",
				"up_hd"   => "upload_img_hoatdong",
				//----------hocbong--------------------
				"lst_hb"  => "list_hocbong",
				"add_hb"  => "add_hocbong",
				"edit_hb"  => "edit_hocbong",
				
);


if ( !isset($choice[$act]) ) 
{
	$act = "idx";
	return;
}

if ($_SESSION["login"] == "logined")
{
	//---Quyen thanh vien thi duoc dang tin
	if ($act=='add_news') return;
	
	//--Quyen Admin
	if ($_SESSION["right_admin"]==1) return;
	
	//Quyen cap nhat tai chinh
	if ($_SESSION["right_update_finance"]==1 &&
	   ( $act=='idx_taich'||
	   	 $act=='dm_tiente'||
	     $act=='edit_tt'  ||
		 $act=='lst_thu'  ||
	     $act=='lst_chi'  ||
		 $act=='add_thu'  ||
	     $act=='add_chi'  ||
		 $act=='edit_thu' ||
	     $act=='edit_chi' ||
		 $act=='tk_tc' ) ) return;
		 
	//Quyen duyet tin tuc
	if ($_SESSION["right_update_news"]==1 &&
	   ( $act=='edit_news'||
	   	 $act=='view_news'||
	     $act=='lst_news' ||
		 $act=='try_view' ||
		 $act=="lst_hd"||
		 $act=="add_hd"||
		 $act=="edit_hd"||
		 $act=="up_hd" ) ) return;
		 
	//Quyen duyet cap nhat hoc bong
	if ($_SESSION["right_update_hocbong"]==1 &&
	   ( $act=='lst_hb'||
	   	 $act=='add_hb'||
	     $act=='edit_hb') ) return;
}
$fod='home';
$act = "no";
$exe = "no_r";
?>