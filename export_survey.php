<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

require 'excel_reader/vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$get_survey_data_sql = "SELECT * FROM survey_tbl";
$surveyData = $mysqli->query($get_survey_data_sql);
// $row = mysqli_fetch_assoc($surveyData);
// echo "<pre>"; print_r($row); die('hello');
if (!empty($surveyData->num_rows)) {
	$spreadsheet = new Spreadsheet();
 
	$sheet = $spreadsheet->getActiveSheet(); 
		
	$i = 1;
	while ($row = mysqli_fetch_assoc($surveyData)) {
		$id =  $row['id'] ?? '';
		$resident_name =  $row['resident_name'] ?? '';
		$resident_address = $row['resident_address'] ?? '';
		$location_of_meter = $row['location_of_meter'] ?? '';
		$size_of_service = $row['size_of_service'] ?? '';
		$material_of_service = $row['material_of_service'] ?? '';
		$date_constructed = $row['date_constructed'] ?? '';
		if($row['photo_upstream_meter'] != '' && $row['photo_upstream_meter'] != NULL){
			$photo_upstream_meter = $site_path.'/survey_images/survey_'.$id.'/'.$row['photo_upstream_meter'];
		} else {
			$photo_upstream_meter = '';
		}
		if($row['photo_meter'] != '' && $row['photo_meter'] != NULL){
			$photo_meter = $site_path.'/survey_images/survey_'.$id.'/'.$row['photo_meter'];
		} else {
			$photo_meter = '';
		}
		
		// Set the value of cell A1 
		$sheet->setCellValue('A'.$i, $resident_name); 
		$sheet->setCellValue('B'.$i, $resident_address); 
		$sheet->setCellValue('C'.$i, $location_of_meter); 
		$sheet->setCellValue('D'.$i, $size_of_service); 
		$sheet->setCellValue('E'.$i, $material_of_service); 
		$sheet->setCellValue('F'.$i, $date_constructed); 
		$sheet->setCellValue('G'.$i, $photo_upstream_meter); 
		$sheet->setCellValue('H'.$i, $photo_meter); 
		$i++;
		 
	}
	
	// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);
	   
	// Save .xlsx file to the current directory 
	//$writer->save('survey.xlsx'); 
	$fileName = 'survey.xlsx';
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
}