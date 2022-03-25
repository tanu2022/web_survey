<?PHP

// $dbuser = 'root';
// $dbpass = '';
// $dbname = 'web_survey'; 
// $dbhost = 'localhost';

$dbuser = 'web-survey';
$dbpass = '4H3-^JxWy&-%273';
$dbname = 'web-survey'; 
$dbhost = 'localhost';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
	printf("Connect failed: %s<br />", $mysqli->connect_error);
	exit();
} 



?>