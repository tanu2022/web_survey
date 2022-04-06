<?PHP
include('config.php');

  $success_insert = '';
if(isset($_POST['submit_btn'])){
	$resident_f_name = $_POST['resident_f_name'] ?? '';
	$resident_l_name = $_POST['resident_l_name'] ?? '';
	$resident_address = $_POST['resident_address'] ?? '';
	$location_of_meter = $_POST['location_of_meter'] ?? '';
	$size_of_service = $_POST['size_of_service'] ?? '';
	$material_of_service = $_POST['material_of_service'] ?? '';
	$date_constructed = date('Y-m-d',strtotime($_POST['date_constructed'])) ?? '';
	
	$insert_sql = "INSERT INTO survey_tbl set resident_f_name='{$resident_f_name}', resident_l_name='{$resident_l_name}', resident_address='{$resident_address}', location_of_meter='{$location_of_meter}', size_of_service='{$size_of_service}', material_of_service='{$material_of_service}', date_constructed='{$date_constructed}'";

	if (mysqli_query($mysqli, $insert_sql)) {
		$last_id = $mysqli->insert_id;
		$survey_upload_dir = 'survey_images/survey_'.$last_id; 
		mkdir($survey_upload_dir, 0777, true);  //create directory if not exist
		
		
		$photo_meter = array_filter($_FILES['photo_meter']['name']); 
		if(!empty($photo_meter)){ 
			foreach($_FILES['photo_meter']['name'] as $key=>$val){ 
				// File upload path 
				$fileName = basename($_FILES['photo_meter']['name'][$key]); 
				$targetFilePath = $survey_upload_dir .'/meter_'.time().'_'. $fileName; 
				
				move_uploaded_file($_FILES["photo_meter"]["tmp_name"][$key], $targetFilePath);	
			} 
		}
		
		$photo_upstream_meter = array_filter($_FILES['photo_upstream_meter']['name']); 
		if(!empty($photo_upstream_meter)){ 
			foreach($_FILES['photo_upstream_meter']['name'] as $key=>$val){ 
				// File upload path 
				$fileName_up = basename($_FILES['photo_upstream_meter']['name'][$key]); 
				$targetFilePath_up = $survey_upload_dir .'/upstream_'.time().'_'. $fileName_up; 
				
				move_uploaded_file($_FILES["photo_upstream_meter"]["tmp_name"][$key], $targetFilePath_up);	
			} 
		}
		
	  $success_insert = 'yes';
	  $_SESSION['success_msg'] = "Your Survey Form has been submitted. Thank you";
	  header('Location: survey_result.php?id='.$last_id);
	} else {
	  $success_insert = 'no';
	}
	
}

include('header.php');
?>
<div class="logo-section" style="width: 100%; background-color: #fff; margin: 2px 0 17px 0; padding: 10px;">
    	<img src="img/dark_logo.png" alt="logo.png" class="logo-icon d-flex m-auto" style="width: 160px;">   </div>

    

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg mb-5 mt-2">
            <div class="card-body p-0 web-servey">

                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                    <div class="col-lg-12">
                    	<h1 class="h4 text-gray-900 mb-4 form-heading">Web Survey Form</h1>
                        <div class="p-4">
                            <div class="text-center">
                                
								<div class="return_msg">
									<?php if($success_insert == 'yes'){ ?>
									<div class="text-success text-bold">Your Survey Form has been submitted. Thank you</div>
									<?php } else if($success_insert == 'no') { ?>
									<div class="text-danger">Opps! Something went wrong.</div>
									<?php } ?>
								</div>
                            </div>
                            <form class="user" name="survey_form" method="POST" action="" enctype="multipart/form-data" autocomplete="off" >
                                <div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="resident_f_name">Resident First Name</label>
										<input type="text" class="form-control form-control-user" id="resident_f_name" name="resident_f_name" placeholder="Resident First Name" required >
									</div>
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="resident_l_name">Resident Last Name</label>
										<input type="text" class="form-control form-control-user" id="resident_l_name" name="resident_l_name" placeholder="Resident Last Name" required >
									</div>
									
                                </div>
								<div class="form-group row">
									
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="resident_address">Resident Address</label>
										<select class="form-control p-0 m-0 selectpicker" data-live-search="true"  id="resident_address" name="resident_address" required >
										<option value="" selected>-- Please Select --</option>
										<?php
										$sql_address = "SELECT * FROM address_tbl ORDER BY id ASC";
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
									<div class="col-sm-6">
										<label for="size_of_service">Size of the service (inches)</label>
										<input type="number" min="0" class="form-control form-control-user" id="size_of_service" name="size_of_service" placeholder="Size of the service (inches) " required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="material_of_service">Material of the service upstream of the meter</label>
										<select class="form-control p-0 m-0 selectpicker" id="material_of_service" name="material_of_service" required>
											<option value="" selected>-- Please Select --</option>
											<?php
											$sql_address = "SELECT * FROM material_drop_tbl ORDER BY id ASC";
											$result_set =  $mysqli->query($sql_address);
											if (!empty($result_set->num_rows)) {
											while($row = mysqli_fetch_array($result_set))
												{
											?>

															<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
														<?php
														}
													}
												?>
										</select>
									</div>
									<div class="col-sm-6">
										<label for="location_of_meter">Location of meter within the building</label>
										<select class="form-control p-0 m-0 selectpicker"  id="location_of_meter" name="location_of_meter" required >
										<option value="" selected>-- Please Select --</option>
										<?php
										$sql_address = "SELECT * FROM location_drop_tbl ORDER BY id ASC";
										$result_set =  $mysqli->query($sql_address);
										if (!empty($result_set->num_rows)) {
										while($row = mysqli_fetch_array($result_set))
											{
										?>

														<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
													<?php
													}
												}
											?>
										</select>
									</div>
                                </div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="photo_upstream_meter">A photo of the service line upstream of the meter</label>
										<input type="file" class="form-control form-control-user" name="photo_upstream_meter[]" multiple required >
									</div>
									<div class="col-sm-6">
										<label for="photo_meter">A photo of the meter</label>
										<input type="file" class="form-control form-control-user" name="photo_meter[]" multiple required>
									</div>
                                </div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<label for="date_constructed">Date constructed</label>
										<div class="start_date input-group mb-4">
											<input type="text" class="form-control form-control-user" id="date_constructed" name="date_constructed" placeholder="Date constructed">
											<div class="input-group-append">
											  <span class="fa fa-calendar input-group-text start_date_calendar" aria-hidden="true "></span>
											</div>

										</div>
									</div>
                                </div>
                                
                                <input type="submit" class="btn btn-primary btn-user btn-block" id="submit_btn" name="submit_btn" value="Submit Survey" >
                                    
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
    

<?php
	include('footer.php');
?>