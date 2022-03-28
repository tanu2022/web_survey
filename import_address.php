<?PHP
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
include('config.php');
require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads_xls/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new PhpSpreadsheet\src\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 0; $i <= $sheetCount; $i ++) {
            $name = "";
            if (isset($spreadSheetAry[$i][0])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $description = "";
            if (isset($spreadSheetAry[$i][1])) {
                $description = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            if (! empty($name)) {
                $query = "insert into address_tbl(name) values(?)";
                $paramType = "ss";
                $paramArray = array(
                    $name
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($conn, $query);

                if (! empty($insertId)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
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
                            <h3 class="m-0 font-weight-bold text-primary">Survey Data</h3>
                        </div>
                        <div class="card-body">
							<form action="" method="post"
								name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
								<div>
									<label>Choose Excel
										File</label> <input type="file" name="file"
										id="file" accept=".xls,.xlsx">
									<button type="submit" id="submit" name="import"
										class="btn-submit">Import</button>
							
								</div>
							
							</form>
						</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Resident Address</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Resident Address</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											$SQLSELECT = "SELECT * FROM address_tbl ORDER BY 'id' DESC";
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