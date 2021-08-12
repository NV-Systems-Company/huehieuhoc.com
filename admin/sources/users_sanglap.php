<?php
//$act   = isset($act)  ? $act  : '';
$users_count = 0;
$users = array();

$users_sanglap_count = 0;
$users_sanglap = array();

$submit   = isset($_POST["submit"])  ? $_POST["submit"]   : '';
if ($submit==">>") 
{
	add_member_sanglap();
}

if ($submit=="<<") 
{
	delete_member_sanglap();
}

list_members();
list_members_sanglap();

function list_members(){
      global $users_count,$users;
	
	$users_count = 0;
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
    
	$sql_selectmem = "SELECT * FROM users WHERE approve=1 AND id_user<>-1 ";
	// Loai tru nhung mem da la thanh vien sang lap
		$sql_select = "SELECT * FROM user_sanglap";
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
	
     //--------------------------------------------------------------
     $dbsql->close();
}

function list_members_sanglap(){
      global $users_sanglap_count,$users_sanglap;
	
	$users_sanglap_count = 0;
	$dbsql = new db_mysql;
	$dbsql->connect();
	$dbsql->selectdb();
     //--------------------------------------------------------------
	$sql_selectmemsl = "SELECT users.id_user, users.last_name AS last_name, users.first_name AS first_name 
						FROM users INNER JOIN user_sanglap 
						ON users.id_user = user_sanglap.id_user 
						WHERE users.approve=1 ORDER BY users.last_name ASC";
	//-------
	
	$sql_query = $dbsql->query($sql_selectmemsl);
    $rows = $dbsql->num_rows($sql_query);
    if ($rows>0)
	{
		while ($result = $dbsql->fetch_array($sql_query))
		{
			$users_sanglap["id"][$users_sanglap_count] = $result["id_user"];
	        $users_sanglap["realname"][$users_sanglap_count] = $result["first_name"].' '.$result["last_name"];
			$users_sanglap_count++;
		}
	}
	
     //--------------------------------------------------------------
     $dbsql->close();
}

function add_member_sanglap()
{
	 global $_POST;
     $id_members = array();
	 
     $members = isset($_POST["id_members"]) ? $_POST["id_members"] : '';
     if (is_array($members)) $id_members = $members;
     else $id_members[0] = $members;
	 
	 $members_count = 0;
     while (list($key,$value) = each($id_members))
	 {
	 	if ($value!=0)
        {
			$members_count = 1;
          	break;
		}
     }
	 
	 $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
	 
	 if ($members_count>0)
     {
     	 reset($id_members);
	     while (list($key,$value) = each($id_members))
		 {
			$sql_select = "SELECT * FROM user_sanglap WHERE id_user = $value";		
			$dbsql->query($sql_select);
			if ($dbsql->num_rows()==0)
			{
				$sql_insert = "INSERT INTO user_sanglap(id_user) VALUES($value)";
				$dbsql->query($sql_insert);
			}
	     }
     }
	 $dbsql->close();
}

function delete_member_sanglap()
{
	 global $_POST;
     $id_members = array();
	 
     $members = isset($_POST["id_members_sl"]) ? $_POST["id_members_sl"] : '';
     if (is_array($members)) $id_members = $members;
     else $id_members[0] = $members;
	 
	 $members_count = 0;
     while (list($key,$value) = each($id_members))
	 {
	 	if ($value!=0)
        {
			$members_count = 1;
          	break;
		}
     }
	 
	 $dbsql = new db_mysql;
     $dbsql->connect();
     $dbsql->selectdb();
	 
	 if ($members_count>0)
     {
     	 reset($id_members);
	     while (list($key,$value) = each($id_members))
		 {
		 	$sql_delete = "DELETE FROM user_sanglap WHERE id_user = $value";
			$dbsql->query($sql_delete);
	     }
     }
	 $dbsql->close();
}
?>