<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

require 'excel_reader/vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$get_survey_data_sql = "SELECT * FROM survey_tbl WHERE resident_f_name IS NOT NULL ORDER BY id DESC";
$surveyData = $mysqli->query($get_survey_data_sql);
// $row = mysqli_fetch_assoc($surveyData);
// echo "<pre>"; print_r($row); die('hello');
if (!empty($surveyData->num_rows)) {
	$spreadsheet = new Spreadsheet();
 
	$sheet = $spreadsheet->getActiveSheet(); 
	
	$sheet->setCellValue('A1', 'Resident first name'); 
	$sheet->setCellValue('B1', 'Resident last name'); 
	$sheet->setCellValue('C1', 'Resident Address'); 
	$sheet->setCellValue('D1', 'Location of meter within the building'); 
	$sheet->setCellValue('E1', 'Size of the service (inches)'); 
	$sheet->setCellValue('F1', 'Material of the service upstream of the meter'); 
	$sheet->setCellValue('G1', 'Date constructed'); 
	$sheet->setCellValue('H1', 'A photo of the service line upstream of the meter'); 
	$sheet->setCellValue('I1', 'A photo of the meter'); 
	$sheet->setCellValue('J1', 'Survey images folder name'); 
	
	$i = 2;
	while ($row = mysqli_fetch_assoc($surveyData)) {
		$id =  $row['id'] ?? '';
		$resident_f_name =  $row['resident_f_name'] ?? '';
		$resident_l_name =  $row['resident_l_name'] ?? '';
		$resident_address = $row['resident_address'] ?? '';
		$location_of_meter = $row['location_of_meter'] ?? '';
		$size_of_service = $row['size_of_service'] ?? '';
		$material_of_service = $row['material_of_service'] ?? '';
		$date_constructed = $row['date_constructed'] ?? '';
		if($row['photo_upstream_meter'] != '' && $row['photo_upstream_meter'] != NULL){
			$photo_upstream_meter = $row['photo_upstream_meter'];
		} else {
			$photo_upstream_meter = '';
		}
		if($row['photo_meter'] != '' && $row['photo_meter'] != NULL){
			$photo_meter = $row['photo_meter'];
		} else {
			$photo_meter = '';
		}
		
		// Set the value of cell A1 
		$sheet->setCellValue('A'.$i, $resident_f_name); 
		$sheet->setCellValue('B'.$i, $resident_l_name); 
		$sheet->setCellValue('C'.$i, $resident_address); 
		$sheet->setCellValue('D'.$i, $location_of_meter); 
		$sheet->setCellValue('E'.$i, $size_of_service); 
		$sheet->setCellValue('F'.$i, $material_of_service); 
		$sheet->setCellValue('G'.$i, $date_constructed); 
		$sheet->setCellValue('H'.$i, $photo_upstream_meter); 
		$sheet->setCellValue('I'.$i, $photo_meter); 
		$sheet->setCellValue('J'.$i, 'survey_'.$i); 
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