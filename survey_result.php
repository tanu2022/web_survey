<?PHP
include('config.php');

if(isset($_GET['id']) && $_GET['id'] != '' ){
	$res_id = $_GET['id'];
} else {
	$res_id = '';
}

$get_survey_data_sql = "SELECT * FROM survey_tbl WHERE id = '{$res_id}' ";
$surveyData = $mysqli->query($get_survey_data_sql);
// $row = mysqli_fetch_assoc($surveyData);
// echo "<pre>"; print_r($row); die('hello');

include('header.php');
?>					<div class="logo-section" style="width: 100%; background-color: #fff; margin: 2px 0 17px 0; padding: 10px;">
    	<img src="img/dark_logo.png" alt="logo.png" class="logo-icon d-flex m-auto" style="width: 160px;">   </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800">Survey Data</h1>-->
                    

                    <!-- DataTales Example -->
                    <div class="card shadow my-5">
                        <div class="card-header py-3">
							<div class="row">
								<div class="col-md-4">
									<h3 class="m-0 font-weight-bold text-primary">Survey Result</h3>
								</div>
								<div class="col-md-4">
								
								</div>
								<div class="col-md-4 text-right">
									<a href="index.php" class="btn btn-primary">GO BACK</a>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<h6 class="m-0 font-weight-bold text-primary">
								<div class="return_msg">
									<?php if(isset($_SESSION['success_msg']) && $_SESSION['success_msg'] != ''){ ?>
									<div class="text-success text-bold"><?php echo $_SESSION['success_msg']; ?></div>
									<?php }  ?>
									
								</div>
							</h6>
							<ul>
								<?php
									if (!empty($surveyData->num_rows)) {
										while ($row = mysqli_fetch_assoc($surveyData)) {
										//$row = mysqli_fetch_assoc($surveyData);
										//echo "<pre>"; print_r($row); //die('--hii');
										?>
										<li>Resident First Name : <?php echo $row['resident_f_name'] ?? ''; ?></li>
										<li>Resident Last Name : <?php echo ' '.$row['resident_l_name'] ?? ''; ?></li>
										<li>Resident Address : <?php echo $row['resident_address'] ?? ''; ?></li>
										<li>Location of meter within the building : <?php echo $row['location_of_meter'] ?? ''; ?></li>
										<li>Size of the service (inches) : <?php echo $row['size_of_service'] ?? ''; ?></li>
										<li>Material of the service upstream of the meter : <?php echo $row['material_of_service'] ?? ''; ?></li>
										<li>Date constructed : <?php echo ($row['date_constructed'] == '' || $row['date_constructed'] == '0000-00-00' ) ? '' : date('m/d/Y',strtotime($row['date_constructed'])); ?></li>
										<li>A photo of the service line upstream of the meter : ---------</li>
										<li>A photo of the meter : ----------</li>
										
										<?php
										}
									}
								?>
								
							</ul>
							
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

 <?PHP
include('footer.php');
?>          