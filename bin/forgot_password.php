<?php
require_once dirname(__FILE__)  . './db.php';
header("Content-Type: text/html; charset=UTF-8");

//return 1 if successful, 0 otherwise

$user = $_POST['u'];

$sql2 = "SELECT name FROM User WHERE name = '$user';";
$data = mysql_query($sql2) or die(mysql_error());
$info = mysql_fetch_array($data);

//luodaan uusi salasana
function uusPassu($length = 8) {
    $password = "";
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
    $maxlength = strlen($possible);
    if ($length > $maxlength) {
      $length = $maxlength;
    }
    $i = 0; 
    while ($i < $length) { 
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);  
      if (!strstr($password, $char)) { 
        $password .= $char;
        $i++;
      }
    }
    return $password;
  }
  
 //update the database accordingly
 function changePassword($user, $pwd) {
		$pwd = hash('sha256', $pwd);
		$sql = "UPDATE User SET pwd = '$pwd' WHERE name = '$user';";
		$data = mysql_query($sql) or die(mysql_error());
 }


if($info['name'] == $user && strlen($user) > 0) {
	$passu = uusPassu();
	changePassword($user, $passu);
	$to = $user;
	$subject = 'Qtool - Uusi salasana';
	$message = 'Uusi salasanasi on: ' . $passu;
	$headers = 'From: webmaster@sirkia.info' . "\r\n" .
    'Reply-To: webmaster@sirkia.info' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message);
	echo "1";
} else {
	echo "0";
}



?>