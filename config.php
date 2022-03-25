<?PHP

$dbuser = 'root';
$dbpass = '';
$dbname = 'web_survey'; 
$dbhost = 'localhost';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
	printf("Connect failed: %s<br />", $mysqli->connect_error);
	exit();
} 



?>