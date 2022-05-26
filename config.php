<?PHP
$dbuser = 'root';
$dbpass = '';
$dbname = 'web_survey'; 
$dbhost = 'localhost';
$site_path = 'http://localhost/web_survey';

// $dbuser = 'drainlineguard_survey';
// $dbpass = 'Staple@123321';
// $dbname = 'drainlineguard_survey'; 
// $dbhost = 'localhost';
// $site_path = 'https://drainlineguard.com/survey/';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
	printf("Connect failed: %s<br />", $mysqli->connect_error);
	exit();
} 

// Start the session
session_start();


?>