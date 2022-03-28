<?PHP
include('config.php');
  $success_insert = '';
if(isset($_POST['submit_btn'])){
	$resident_name = $_POST['resident_name'] ?? '';
	$resident_address = $_POST['resident_address'] ?? '';
	$location_of_meter = $_POST['location_of_meter'] ?? '';
	$size_of_service = $_POST['size_of_service'] ?? '';
	$material_of_service = $_POST['material_of_service'] ?? '';
	$date_constructed = $_POST['date_constructed'] ?? '';
	
	if (isset($_FILES['photo_upstream_meter'])){
		
		// get details of the uploaded file
		$fileTmpPath = $_FILES['photo_upstream_meter']['tmp_name'];
		$fileName = $_FILES['photo_upstream_meter']['name'];
		$fileSize = $_FILES['photo_upstream_meter']['size'];
		$fileType = $_FILES['photo_upstream_meter']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
	 
		// sanitize file-name
		$newFileName = time() . $fileName . '.' . $fileExtension;
		
		// directory in which the uploaded file will be moved
		$photo_upstream_meter = $newFileName ?? '';
		
	} else {
		$photo_upstream_meter = '';
	}
	
	if (isset($_FILES['photo_meter'])){
		
		// get details of the uploaded file
		$fileTmpPath = $_FILES['photo_meter']['tmp_name'];
		$fileName = $_FILES['photo_meter']['name'];
		$fileSize = $_FILES['photo_meter']['size'];
		$fileType = $_FILES['photo_meter']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
	 
		// sanitize file-name
		$newFileName_m = time() . $fileName . '.' . $fileExtension;
		
		// directory in which the uploaded file will be moved
		
		
		$photo_meter = $newFileName_m ?? '';
		
	} else {
		$photo_meter = '';
	}
	
	
	$insert_sql = "INSERT INTO survey_tbl set resident_name='{$resident_name}', resident_address='{$resident_address}', location_of_meter='{$location_of_meter}', size_of_service='{$size_of_service}', material_of_service='{$material_of_service}', date_constructed='{$date_constructed}', photo_upstream_meter='{$photo_upstream_meter}', photo_meter='{$photo_meter}'";

	if (mysqli_query($mysqli, $insert_sql)) {
		$last_id = $mysqli->insert_id;
		$survey_upload_dir = 'survey_images/survey_'.$last_id; 
		mkdir($survey_upload_dir, 0777, true);  //create directory if not exist
		
		if($photo_meter != ''){
			$fileTmpPath = $_FILES['photo_meter']['tmp_name'];
			$dest_path = $survey_upload_dir . $photo_meter;
			move_uploaded_file($fileTmpPath, $dest_path);
			
		}
		
		if($photo_upstream_meter != ''){
			$fileTmpPath = $_FILES['photo_upstream_meter']['tmp_name'];
			$dest_path = $survey_upload_dir . $photo_upstream_meter;
			move_uploaded_file($fileTmpPath, $dest_path);
			
		}

	  $success_insert = 'yes';
	} else {
	  $success_insert = 'no';
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Survey</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
		
	

		
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
	
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Web Survey Form</h1>
								<div class="return_msg">
									<?php if($success_insert == 'yes'){ ?>
									<div class="text-success text-bold">Your Survey Form has been submitted. Thank you</div>
									<?php } else if($success_insert == 'no') { ?>
									<div class="text-danger">Opps! Something went wrong.</div>
									<?php } ?>
								</div>
                            </div>
                            <form class="user" name="survey_form" method="POST" action="" enctype="multipart/form-data" >
                                <div class="form-group">
									<label for="resident_name">Resident Name</label>
                                    <input type="text" class="form-control form-control-user" id="resident_name" name="resident_name" placeholder="Resident Name" required >
                                </div>
                                <div class="form-group">
									<label for="resident_address">Resident Address</label>
                                    <select class="form-control form-control-user selectpicker" data-live-search="true"  id="resident_address" name="resident_address" required >
										<option value="" selected>----Please Select Address----</option>
										<?php
											$sql_address = "SELECT * FROM address_tbl ORDER BY address ASC";
											$result_set =  $mysqli->query($sql_address);
											if (!empty($result_set->num_rows)) {
												while($row = mysqli_fetch_array($result_set))
												{
												?>
								 
													<option value="<?php echo $row['address']; ?>"><?php echo $row['address']; ?></option>
												<?php
												}
											}
										?>
									</select>
                                </div>
								<div class="form-group">
									<label for="location_of_meter">Location of meter within the building</label>
                                    <input type="text" class="form-control form-control-user" id="location_of_meter" name="location_of_meter" placeholder="Location of meter within the building" required>
                                </div>
								<div class="form-group">
									<label for="size_of_service">Size of the service (inches)</label>
                                    <input type="number" min="0" class="form-control form-control-user" id="size_of_service" name="size_of_service" placeholder="Size of the service (inches) " required>
                                </div>
								<div class="form-group">
									<label for="material_of_service">Material of the service upstream of the meter</label>
									<select class="form-control form-control-user" id="material_of_service" name="material_of_service" required>
										<option value="" selected>--Please Select--</option>
										<option value="m1">Material1</option>
										<option value="m2">Material2</option>
										<option value="m3">Material3</option>
										<option value="m4">Material4</option>
										<option value="m5">Material5</option>
									</select>
                                </div>
								<div class="form-group">
									<label for="date_constructed">Date constructed</label>
									<div class="start_date input-group mb-4">
										<input type="text" class="form-control form-control-user" id="date_constructed" name="date_constructed" placeholder="Date constructed">
										<div class="input-group-append">
										  <span class="fa fa-calendar input-group-text start_date_calendar" aria-hidden="true "></span>
										</div>

									  </div>
									
                                    
                                </div>
								<div class="form-group">
									<label for="photo_upstream_meter">A photo of the service line upstream of the meter</label>
                                    <input type="file" class="form-control form-control-user" id="photo_upstream_meter" name="photo_upstream_meter" placeholder="A photo of the service line upstream of the meter" required >
                                </div>
								<div class="form-group">
									<label for="photo_meter">A photo of the meter</label>
                                    <input type="file" class="form-control form-control-user" id="photo_meter" name="photo_meter" placeholder="A photo of the meter" required>
                                </div>
                                
                                <input type="submit" class="btn btn-primary btn-user btn-block" id="submit_btn" name="submit_btn" value="Submit Survey" >
                                    
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	

		
	<!-- Include Bootstrap Datepicker -->
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
	<script>jQuery("#date_constructed").datepicker({
		format : 'yyyy-mm-dd',
		autoclose : true
	});</script>
	
	
	
	

</body>

</html>
