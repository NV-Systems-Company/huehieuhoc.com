<?php
$code   = isset($_GET["code"])  ? $_GET["code"]  : '';

$users_count = 0;
$users = array();
$users_updatehb_count = 0;
$users_updatehb = array();

switch ($code)
{
	case "add":
				add_members_updatehocbong();
				break;				
	case "del":
				del_members_updatehocbong();
				break;
}

list_members_updatehocbong();
list_members();

function add_members_updatehocbong()
{
	global $_POST;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();

	$sql_select = "SELECT * FROM user_updatehocbong WHERE id_user = ".$_POST['id_user'];		
	$dbsql->query($sql_select);
	if ($dbsql->num_rows()==0)
	{
		$sql_insert = "INSERT INTO user_updatehocbong (id_user)
								 VALUES(".$_POST['id_user'].")";
		$dbsql->query($sql_insert);	
	}
    $dbsql->close();
}

function del_members_updatehocbong()
{
	global $_GET;
	
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
	$sql_delete = "DELETE FROM user_updatehocbong WHERE id_user = ".$_GET['id'];
	$dbsql->query($sql_delete);
	$dbsql->close();
}

function list_members_updatehocbong(){
      global $users_updatehb_count,$users_updatehb;

     $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
     //--------------------------------------------------------------
	 $sql_select = "SELECT users.id_user, users.last_name AS last_name, users.first_name AS first_name
						FROM users INNER JOIN user_updatehocbong 
						ON users.id_user = user_updatehocbong.id_user 
						ORDER BY users.last_name ASC";	 
     $sql_query = $dbsql->query($sql_select);
     $rows = $dbsql->num_rows($sql_query);
     if ($rows>0)
     {
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_updatehb["id"][$users_updatehb_count] = $result["id_user"];
			$users_updatehb["realname"][$users_updatehb_count] = $result["first_name"].' '.$result["last_name"];
			$users_updatehb_count++;
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
	// Loai tru nhung mem da la thanh vien updatefinance
		$sql_select = "SELECT * FROM user_updatehocbong";
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
?>