<?PHP

$dbuser = 'root';
$dbpass = '';
$dbname = 'web_survey'; 
$dbhost = 'localhost';
$site_path = 'http://localhost/web_survey';

// $dbuser = 'web-survey';
// $dbpass = '4H3-^JxWy&-%273';
// $dbname = 'web-survey'; 
// $dbhost = 'localhost';
//$site_path = 'http://50.116.49.118/web_survey';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
	printf("Connect failed: %s<br />", $mysqli->connect_error);
	exit();
} 

// Start the session
session_start();


?>