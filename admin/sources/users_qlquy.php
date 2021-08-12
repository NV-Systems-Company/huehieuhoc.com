<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_count = 0;
$users = array();
$users_qlq_count = 0;
$users_qlq = array();

switch ($code)
{
	case "add":
				add_members_qlquy();
				break;				
	case "del":
				del_members_qlquy();
				break;
	case "order":
				save_order();
				break;
}

list_members_qlquy();
list_members();

function add_members_qlquy()
{
	global $_POST;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	
	$sql_select = "SELECT * FROM user_quanlyquy WHERE id_user = ".$_POST['id_user'];		
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()==0)
	{	
		$sql_insert = "INSERT INTO user_quanlyquy (id_user, chucvu, order_num)
								 VALUES(".$_POST['id_user'].",'".$_POST['chucvu']."',".$_POST['order_num'].")";
		$dbsql->query($sql_insert);	
	}
    $dbsql->close();
}

function del_members_qlquy()
{
	global $_GET;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_delete = "DELETE FROM user_quanlyquy WHERE id_quanlyquy = ".$_GET['id'];
	$dbsql->query($sql_delete);
	$dbsql->close();
}

function list_members_qlquy(){
      global $users_qlq_count,$users_qlq;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT user_quanlyquy.id_quanlyquy, users.last_name AS last_name, users.first_name AS first_name, user_quanlyquy.chucvu AS chucvu, user_quanlyquy.order_num AS order_num
						FROM users INNER JOIN user_quanlyquy 
						ON users.id_user = user_quanlyquy.id_user 
						ORDER BY user_quanlyquy.order_num ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_qlq["id"][$users_qlq_count] = $result["id_quanlyquy"];
			$users_qlq["realname"][$users_qlq_count] = $result["first_name"].' '.$result["last_name"];
			$users_qlq["chucvu"][$users_qlq_count] = $result["chucvu"];
			$users_qlq["order_num"][$users_qlq_count] = $result["order_num"];
			$users_qlq_count++;
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
	// Loai tru nhung mem da la thanh vien quan ly quy
		$sql_select = "SELECT * FROM user_quanlyquy";
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
    $users_qlq_count = isset($_POST["users_qlq_count"]) ? $_POST["users_qlq_count"] : 0;
    if ( $users_qlq_count>0 ){
        for ($i=0;$i<$users_qlq_count;$i++){
            $id_quanlyquy_[$i] = isset($_POST["id_quanlyquy_$i"]) ? $_POST["id_quanlyquy_$i"] : '';
            if ( !empty($id_quanlyquy_[$i]) )
			{
                  $order_num_[$i] = isset($_POST["order_num_$i"]) ? $_POST["order_num_$i"] : '';
                  $sql_update = "UPDATE user_quanlyquy SET order_num= ".$order_num_[$i]." WHERE id_quanlyquy= ".$id_quanlyquy_[$i];
                  $dbsql->query($sql_update);
            }
        }
    }
    //--------------------------------------------------------------
    $dbsql->close();

    $msg = "Ch&#7881;nh s&#7917;a th&#7913; t&#7921; th&agrave;nh c&ocirc;ng !";
    $site = "index.php?fod=ad&act=memqlq&exe=memqlq";
    page_transfer($msg,$site);

    return true;
}
?>