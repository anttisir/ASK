<?php
session_start();
require_once('config.php');
require_once ('Kysely.php');
	
	if(isset($_POST['aika']) && isset($_POST['kysymys']) && isset($_SESSION['user_id']) && isset($_POST['target']) && sizeof($_POST['ans_opt']) > 1) {
	
		//storing form data
		foreach ($_POST['ans_opt'] as $k) { if (strlen($k) > 0) { $answer_options[] = $k; }}
		$duration 		= $_POST['aika'];
		$question 		= $_POST['kysymys'];
		$creator 		= $_SESSION['user_id'];
		$target 		= $_POST['target'];
		
		//ugly way of parsing the seconds...
		$temp = explode(":", $duration);
		$sekunnit = 0;
		$sekunnit += $temp[0] * 60;
		$sekunnit += $temp[1];
		
		$sql = "insert into Poll (target, question, creator, createTime, endTime, active, duration) values (?, ?, ?, NOW(), DATE_ADD(NOW(), INTERVAL ? SECOND), 1, ?)"; 
			
		$query = new Kysely($sql, array($target, $question, $creator, $sekunnit, $sekunnit));
		$result = $query->getResult();
		
		$s = $query->wasSuccess();
		$lastID = $query->getLastID();
		
		$i = 1;
		foreach($answer_options as $value) {
			$sql = "INSERT INTO Answer (P_ID, qText, amount, orderNo) VALUES (?, ?, 0, ?)";
			$q = new Kysely($sql, array($lastID, $value, $i));
			$i++;
		}

		if ($s > 0) {
			echo "success";
		}
		
	}
?>