<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

$get_survey_data_sql = "SELECT * FROM survey_tbl ORDER BY id DESC";
$surveyData = $mysqli->query($get_survey_data_sql);
// $row = mysqli_fetch_assoc($surveyData);
// echo "<pre>"; print_r($row); die('hello');

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
									<h3 class="m-0 font-weight-bold text-primary">Survey Data</h3>
								</div>
								<?php if (!empty($surveyData->num_rows)) { ?>
								<div class="col-md-6 text-right">
									<a href="export_survey.php" class="btn btn-primary">EXPORT SURVEY DATA</a>
								</div>
								<?php } ?>
							</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Resident Name</th>
                                            <th>Resident Address</th>
                                            <th>Location of meter within the building</th>
                                            <th>Size of the service (inches)</th>
                                            <th>Material of the service upstream of the meter</th>
                                            <th>Date constructed</th>
                                            <th>A photo of the service line upstream of the meter</th>
                                            <th>A photo of the meter</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
										<?php
											if (!empty($surveyData->num_rows)) {
												while ($row = mysqli_fetch_assoc($surveyData)) {
												//$row = mysqli_fetch_assoc($surveyData);
												//echo "<pre>"; print_r($row); //die('--hii');
												?>
												<tr>
													<td><?php echo $row['resident_name'] ?? ''; ?></td>
													<td><?php echo $row['resident_address'] ?? ''; ?></td>
													<td><?php echo $row['location_of_meter'] ?? ''; ?></td>
													<td><?php echo $row['size_of_service'] ?? ''; ?></td>
													<td><?php echo $row['material_of_service'] ?? ''; ?></td>
													<td><?php echo ($row['date_constructed'] == '' || $row['date_constructed'] == '0000-00-00' ) ? '' : $row['date_constructed']; ?></td>
													<td>
														<?php if($row['photo_upstream_meter'] != '' && $row['photo_upstream_meter'] != NULL){ ?>
														<img src="survey_images/survey_<?php echo $row['id'].'/'.$row['photo_upstream_meter']; ?>" width="100px" height="100px" >
														<?php } ?>
													</td>
													<td>
														<?php if($row['photo_meter'] != '' && $row['photo_meter'] != NULL){ ?>
														<img src="survey_images/survey_<?php echo $row['id'].'/'.$row['photo_meter']; ?>" width="100px" height="100px" >
														<?php } ?>
													</td>
												</tr>
												
												<?php
												}
											}
										?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?PHP
include('admin_footer.php');
?>          