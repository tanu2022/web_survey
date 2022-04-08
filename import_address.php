<?PHP
include('config.php');

//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}

require 'excel_reader/vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$success_insert = '';
if (isset($_POST["import"])) {
	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file']['tmp_name']);
	 
	$sheet = $spreadsheet->getActiveSheet();
	 
	// Store data from the activeSheet to the varibale in the form of Array
	//$data = array(1,$sheet->toArray(null,true,true,true)); 
	$data = $sheet->toArray(); 
	 // echo "<pre>"; print_r($data);
// die;
	$sheetCount = count($data);
	
	if($sheetCount > 0){
		foreach($data as $rowData){
			$address = "";
			if (isset($rowData[0])) {
				$address = mysqli_real_escape_string($mysqli, $rowData[0]);
			}
			
			if (! empty($address)) {
				$insert_sql = "INSERT INTO address_tbl set address='{$address}'";

				if (mysqli_query($mysqli, $insert_sql)) {
					$success_insert = "yes";
				} else {
					$success_insert = "no";
				}
			}
		}
	}
			

	
}
// Display the sheet content 


include('admin_header.php');
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800">Survey Data</h1>-->
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">Import Excel</h3>
                        </div>
                        <div class="card-body">
							<form action="" method="post"
								name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
								<div class="main-cover">
									<label>Choose Excel	File</label> 
									<input type="file" name="file" id="file" accept=".xls,.xlsx" required>
									<button type="submit" id="submit" name="import"	class="btn-submit">Import</button>
								</div>
							
							</form>
							<div class="return_msg">
									<?php if($success_insert == 'yes'){ ?>
									<div class="mb-4 value-data">Excel Data Imported Successfully.</div>
									<?php } else if($success_insert == 'no') { ?>
									<div class="mb-4 value-data-danger">Opps! Something went wrong.</div>
									<?php } ?>
								</div>
						</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Resident Address</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
										<?php
											$SQLSELECT = "SELECT * FROM address_tbl ORDER BY id ASC";
											$result_set =  $mysqli->query($SQLSELECT);
											if (!empty($result_set->num_rows)) {
												while($row = mysqli_fetch_array($result_set))
												{
												?>
								 
													<tr>
														<td><?php echo $row['address']; ?></td>
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