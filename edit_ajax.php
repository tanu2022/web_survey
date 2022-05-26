<?PHP
include('config.php');

$m_name = $_REQUEST['myData'] ?? '';
$m_id = $_REQUEST['myDataId'] ?? '';

if($_REQUEST['action'] == 'material'){
	$update_sql = "UPDATE material_drop_tbl set name='{$m_name}' WHERE id='{$m_id}' ";	
} else {
	$update_sql = "UPDATE location_drop_tbl set name='{$m_name}' WHERE id='{$m_id}' ";	
}
if (mysqli_query($mysqli, $update_sql)) {
	echo json_encode($updated = 'yes');  
} else {
	echo json_encode($updated = 'no'); 
}
?>