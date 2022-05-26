<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

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
									<h3 class="m-0 font-weight-bold text-primary">Survey View</h3>
								</div>
							</div>
							
                        </div>
                        <div class="card-body">
								
							<div class="card mb-4">
								<div class="card-header">
									Resident First Name
								</div>
								<div class="card-body"><?php echo $survey_row['resident_f_name'] ?? '' ; ?>
								</div>
							</div>
							<?php echo $survey_row['resident_l_name'] ?? '' ; ?>
							<?php echo $survey_row['resident_address'] ?? '' ; ?>
							<?php echo $survey_row['size_of_service'] ?? '' ; ?>
							<?php echo $survey_row['material_of_service'] ?? '' ; ?>
							<?php echo $survey_row['location_of_meter'] ?? '' ; ?>
							<?php echo $survey_row['photo_upstream_meter'] ; ?>
							<?php echo $survey_row['photo_meter'] ; ?>
							<?php echo $survey_row['date_constructed'] ; ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?PHP
include('admin_footer.php');
?>          