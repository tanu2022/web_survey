<?php
include('config.php');
// echo "<pre>"; print_r($_POST);
// echo "<pre>"; print_r($_FILES); die('--hiii');

$respose = array();
$is_file = array_filter($_FILES['file']['name']);
if(!empty($is_file)){
	$last_img_id = $_POST['survey_id'] ?? '';
	$is_box = $_POST['box'] ?? '';
	
	if($is_box == 'box1'){
		$column_name = 'photo_upstream_meter';
	} else {
		$column_name = 'photo_meter';
	}
	
	if($last_img_id == ''){
		$insert_sql = "INSERT INTO survey_tbl set {$column_name}='insert-start'";
		mysqli_query($mysqli, $insert_sql);
		$last_img_id = $mysqli->insert_id;
	}
	
	$survey_folder_path = 'survey_images/survey_'.$last_img_id;
	if (!file_exists($survey_folder_path)) {
		mkdir($survey_folder_path, 0777);
	}
	
	$photo_meter_arr = array();
	
	foreach ($_FILES['file']['name'] as $key=>$val) {
		$filename = $_FILES['file']['name'][$key];
		
		if ($pos = strrpos($filename, '.')) {
			   $name = substr($filename, 0, $pos);
			   $ext = substr($filename, $pos);
		} else {
			   $name = $filename;
		}

		$newpath = $survey_folder_path.'/'.$filename;
		$tmp_name = $filename;
		$uniq_no = 0;
		while (file_exists($newpath)) {
			   $tmp_name = $name .'_'. $uniq_no . $ext;
			   $newpath = $survey_folder_path.'/'.$tmp_name;
			   $uniq_no++;
		 }
	 
		move_uploaded_file($_FILES['file']['tmp_name'][$key], $newpath);
		$photo_meter_arr[] = $tmp_name;
	}
	 		
	$photo_meter_str = '';
	
	$get_inserted_img = "SELECT {$column_name} FROM survey_tbl WHERE id='$last_img_id' ";
	$imageData = $mysqli->query($get_inserted_img);
	$row = mysqli_fetch_assoc($imageData);
	
	if($row[$column_name] != '' && $row[$column_name] != 'insert-start'){
		$photo_meter_arr[] = $row[$column_name];
	}
	$photo_meter_str = implode(', ', $photo_meter_arr );
	
	$insert_sql = "UPDATE survey_tbl set {$column_name}='{$photo_meter_str}' WHERE id='{$last_img_id}' ";
	mysqli_query($mysqli, $insert_sql);
	
	$last_id = $last_img_id;
	
	
	
	$respose = array('last_id'=> $last_id,'img_name_str'=>$photo_meter_str);
	
	echo json_encode($respose);		
	die;
	
}
