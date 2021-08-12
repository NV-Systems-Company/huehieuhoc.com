<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_count = 0;
$users = array();
$users_dh_count = 0;
$users_dh = array();

switch ($code)
{
	case "add":
				add_members_dieuhanh();
				break;				
	case "del":
				del_members_dieuhanh();
				break;
	case "order":
				save_order();
				break;
}

list_members_dieuhanh();
list_members();

function add_members_dieuhanh()
{
	global $_POST;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();

	$sql_select = "SELECT * FROM user_dieuhanh WHERE id_user = ".$_POST['id_user'];		
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()==0)
	{
		$sql_insert = "INSERT INTO user_dieuhanh (id_user, chucvu, order_num)
								 VALUES(".$_POST['id_user'].",'".$_POST['chucvu']."',".$_POST['order_num'].")";
		$dbsql->query($sql_insert);	
	}
    $dbsql->close();
}

function del_members_dieuhanh()
{
	global $_GET;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_delete = "DELETE FROM user_dieuhanh WHERE id_dieuhanh = ".$_GET['id'];
	$dbsql->query($sql_delete);
	$dbsql->close();
}

function list_members_dieuhanh(){
      global $users_dh_count,$users_dh;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT user_dieuhanh.id_dieuhanh, users.last_name AS last_name, users.first_name AS first_name, user_dieuhanh.chucvu AS chucvu, user_dieuhanh.order_num AS order_num
						FROM users INNER JOIN user_dieuhanh 
						ON users.id_user = user_dieuhanh.id_user 
						ORDER BY user_dieuhanh.order_num ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_dh["id"][$users_dh_count] = $result["id_dieuhanh"];
			$users_dh["realname"][$users_dh_count] = $result["first_name"].' '.$result["last_name"];
			$users_dh["chucvu"][$users_dh_count] = $result["chucvu"];
			$users_dh["order_num"][$users_dh_count] = $result["order_num"];
			$users_dh_count++;
		}
     }
     //--------------------------------------------------------------
     $dbsql->close();
}

function list_members(){
      global $users_count,$users;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();

	$sql_selectmem = "SELECT * FROM users WHERE id_user<>-1 ";
	// Loai tru nhung mem da la thanh vien dieuhanh
		$sql_select = "SELECT * FROM user_dieuhanh";
		$sql_query = $dbsql->query($sql_select);
		$rows = $dbsql->num_rows($sql_query);
		if ($rows>0)
		{
			while ($result = $dbsql->fetch_array($sql_query))
			{
				$sql_selectmem .= " AND id_user<>".$result["id_user"]." ";
			}
		}
	//------------------
	$sql_selectmem .= " ORDER BY last_name ASC";
	
	$sql_query = $dbsql->query($sql_selectmem);
    $rows = $dbsql->num_rows($sql_query);
    if ($rows>0)
	{
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users["id"][$users_count] = $result["id_user"];
	        $users["realname"][$users_count] = $result["first_name"].' '.$result["last_name"];
			$users_count++;
		}
	}
     $dbsql->close();
}

function save_order()
{
	global $_POST;

    $dbsql = new db_mysql;
    $dbsql->connect();
    $dbsql->selectdb();
	
    //--------------------------------------------------------------
    $users_dh_count = isset($_POST["users_dh_count"]) ? $_POST["users_dh_count"] : 0;
    if ( $users_dh_count>0 ){
        for ($i=0;$i<$users_dh_count;$i++){
            $id_dieuhanh_[$i] = isset($_POST["id_dieuhanh_$i"]) ? $_POST["id_dieuhanh_$i"] : '';
            if ( !empty($id_dieuhanh_[$i]) )
			{
                  $order_num_[$i] = isset($_POST["order_num_$i"]) ? $_POST["order_num_$i"] : '';
                  $sql_update = "UPDATE user_dieuhanh SET order_num= ".$order_num_[$i]." WHERE id_dieuhanh= ".$id_dieuhanh_[$i];
                  $dbsql->query($sql_update);
            }
        }
    }
    //--------------------------------------------------------------
    $dbsql->close();

    $msg = "Ch&#7881;nh s&#7917;a th&#7913; t&#7921; th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=memdh&exe=memdh";
    page_transfer($msg,$site);

    return true;
}
?>