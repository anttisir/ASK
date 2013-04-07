<?php
session_start();
require_once('config.php');
require_once('Kysely.php');

	$sql = 'SELECT name, pwd, U_ID FROM User WHERE name = ? AND pwd = ?';
	
	$is_ajax = $_REQUEST['is_ajax'];
	if(isset($is_ajax) && $is_ajax) {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		
		$pwd = hash('sha256', $password);
		
		$query = new Kysely($sql, array($username, $pwd));
		$result = $query->getResult();
		if (sizeof($result) > 0) {
			if ($result[0]['name'] == $username && $result[0]['pwd'] == $pwd) {
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $result[0]['U_ID'];
				echo 'success';
			} 
		}	
	}
	
?>