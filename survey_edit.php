<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

$success_insert = '';
if(isset($_GET['s_id']) && $_GET['s_id'] != '') {
	$get_survey_row_sql = "SELECT * FROM survey_tbl WHERE id = '".$_GET['s_id']."' ";
	$surveyRowData = $mysqli->query($get_survey_row_sql);
	if (!empty($surveyRowData->num_rows)) {
		$survey_row = mysqli_fetch_assoc($surveyRowData);
		//echo "<pre>"; print_r($row); die('--hii');
	}
} else {
	header('Location: tables.php');
}
if(isset($_POST['submit_btn'])){

	$resident_f_name = $_POST['resident_f_name'];

	$resident_l_name = $_POST['resident_l_name'];

	$resident_address = $_POST['resident_address'];

	$location_of_meter = $_POST['location_of_meter'];

	$size_of_service = $_POST['size_of_service'];

	$material_of_service = $_POST['material_of_service'];

	$date_constructed = $_POST['date_constructed'] ? date('Y-m-d',strtotime($_POST['date_constructed'])) : '';

	$last_img_id = $_POST['survey_id'] ?? '';

	

	if($last_img_id != ''){

		$insert_sql = "UPDATE survey_tbl set resident_f_name='{$resident_f_name}', resident_l_name='{$resident_l_name}', resident_address='{$resident_address}', location_of_meter='{$location_of_meter}', size_of_service='{$size_of_service}', material_of_service='{$material_of_service}', date_constructed='{$date_constructed}' WHERE id='{$last_img_id}'";

	} 
	
	if (mysqli_query($mysqli, $insert_sql)) {

	  $success_insert = 'yes';
	  
	  $_SESSION['success_msg'] = "Survey Data updated successfully.";
		
	  header('Location: '.$_SERVER['REQUEST_URI']);
	  //header('Location: survey_result.php?id='.$last_img_id);

	} else {

	  $success_insert = 'no';

	}

}

include('admin_header.php');
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800">Survey Data</h1>-->
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
							<div class="row">
								<div class="col-md-6">
									<h3 class="m-0 font-weight-bold text-primary">Edit Web Survey Form</h3>
								</div>
								<div class="text-success text-bold"><?php echo $success_insert; ?></div>
							</div>
							
							<div class="row">

										<?php if(isset($_SESSION['success_msg']) && $_SESSION['success_msg'] != ''){ ?>

										<div class="col-md-12 text-muted text-center py-3"><?php echo $_SESSION['success_msg']; ?></div>

										<?php } else if($success_insert == 'no') { ?>

										<div class="text-danger">Opps! Something went wrong.</div>

										<?php } ?>

							</div>
							
							
                        </div>
                        <div class="card-body">
                            <form class="user" name="survey_form" method="POST" action="" enctype="multipart/form-data" autocomplete="off" >

								<input type="hidden" name="survey_id" id="survey_id" value="<?php echo $survey_row['id']; ?>" > 

                                <div class="form-group row">

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="resident_f_name">Resident First Name<span class="required_field"> *</span></label>

										<input type="text" class="form-control form-control-user" id="resident_f_name" name="resident_f_name" value="<?php echo $survey_row['resident_f_name'] ?? '' ; ?>" placeholder="Resident First Name" required >

									</div>

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="resident_l_name">Resident Last Name<span class="required_field"> *</span></label>

										<input type="text" class="form-control form-control-user" id="resident_l_name" name="resident_l_name" value="<?php echo $survey_row['resident_l_name'] ?? '' ; ?>" placeholder="Resident Last Name" required >

									</div>

									

                                </div>

								<div class="form-group row">

									

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="resident_address">Resident Address<span class="required_field"> *</span></label>

										<select class="form-control p-0 m-0 selectpicker" data-live-search="true"  id="resident_address" name="resident_address" required >

										<option value="" selected>-- Please Select --</option>

										<?php

										$sql_address = "SELECT * FROM address_tbl ORDER BY id ASC";

										$result_set =  $mysqli->query($sql_address);

										if (!empty($result_set->num_rows)) {

										while($row = mysqli_fetch_array($result_set))

											{

										?>
														<option value="<?php echo $row['address']; ?>" <?php if(isset($survey_row['resident_address']) && $survey_row['resident_address'] == $row['address'] ){ echo 'selected'; } ?> ><?php echo $row['address']; ?></option>

													<?php

													}

												}

											?>

										</select>

									</div>

									<div class="col-sm-6">

										<label for="size_of_service">Size of the service (inches)<span class="required_field"> *</span></label>

										<input type="number" min="0" class="form-control form-control-user" id="size_of_service" name="size_of_service" step="any" value="<?php echo $survey_row['size_of_service'] ?? '' ; ?>" placeholder="Size of the service (inches) " required>

									</div>

								</div>

								<div class="form-group row">

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="material_of_service">Material of the pipe entering the house:<span class="required_field"> *</span></label>

										<select class="form-control p-0 m-0 selectpicker" id="material_of_service" name="material_of_service" required>

											<option value="" selected>-- Please Select --</option>

											<?php

											$sql_address = "SELECT * FROM material_drop_tbl ORDER BY id ASC";

											$result_set =  $mysqli->query($sql_address);

											if (!empty($result_set->num_rows)) {

											while($row = mysqli_fetch_array($result_set))

												{

											?>
												<option value="<?php echo $row['name']; ?>" <?php if(isset($survey_row['material_of_service']) && $survey_row['material_of_service'] == $row['name']){ echo 'selected'; } ?> ><?php echo $row['name']; ?></option>

														<?php

														}

													}

												?>

										</select>

									</div>

									<div class="col-sm-6">

										<label for="location_of_meter">Location of meter within the building<span class="required_field"> *</span></label>

										<select class="form-control p-0 m-0 selectpicker"  id="location_of_meter" name="location_of_meter" required >

										<option value="" selected>-- Please Select --</option>

										<?php

										$sql_address = "SELECT * FROM location_drop_tbl ORDER BY id ASC";

										$result_set =  $mysqli->query($sql_address);

										if (!empty($result_set->num_rows)) {

										while($row = mysqli_fetch_array($result_set))

											{

										?>



														<option value="<?php echo $row['name']; ?>" <?php if(isset($survey_row['location_of_meter']) && $survey_row['location_of_meter'] == $row['name']){ echo 'selected'; } ?> ><?php echo $row['name']; ?></option>

													<?php

													}

												}

											?>

										</select>

									</div>

                                </div>

								<div class="form-group row">

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="photo_upstream_meter">A photo of the service line between the meter and the outside wall<span class="required_field"> *</span></label>

										<!--<input type="file" class="form-control form-control-user" name="photo_upstream_meter[]" multiple required >-->

										<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">

											<div id="drag_upload_file">

												<p>Drop file(s) here</p>

												<p>or</p>

												<p><input type="button" value="Select File(s)" onclick="file_explorer();" /></p>

												<input type="file" id="selectfile" name="file" multiple  />

											</div>

										</div>

										<div id="img_str_up"><?php echo $survey_row['photo_upstream_meter'] ; ?></div>

									</div>

									<div class="col-sm-6">

										<label for="photo_meter">A photo of the meter<span class="required_field"> *</span></label>

										<!--<input type="file" class="form-control form-control-user" name="photo_meter[]" multiple required>-->

										<div id="drop_file_zone2" ondrop="upload_file2(event)" ondragover="return false">

											<div id="drag_upload_file2">

												<p>Drop file(s) here </p>

												<p>or</p>

												<p><input type="button" value="Select File(s)" onclick="file_explorer2();" /></p>

												<input type="file" id="selectfile2" name="file2" multiple  />

											</div>

										</div>

										<div id="img_str"><?php echo $survey_row['photo_meter'] ; ?></div>

									</div>

                                </div>

								<div class="form-group row">

									<div class="col-sm-6 mb-3 mb-sm-0">

										<label for="date_constructed">Date Plumbing Installed</label>

										<div class="start_date input-group mb-4">

											<input type="date" class="form-control form-control-user" id="date_constructed" name="date_constructed" value="<?php echo $survey_row['date_constructed'] ; ?>" placeholder="Date constructed" >

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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?PHP
include('admin_footer.php');
?>          