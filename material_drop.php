<?PHP
include('config.php');

$success_login = '';
//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}
$user_id = $_SESSION["ID"];

if(isset($_POST['submit_btn'])){
	$m_drp_val = $_POST['m_drp_val'] ?? '';
	
	$insert_sql = "INSERT INTO material_drop_tbl set name='{$m_drp_val}'";

	if (mysqli_query($mysqli, $insert_sql)) {
	  $success_login = 'yes';
	  $message = "Value added successfully";
	  header('Location: material_drop.php?upd=success');
	} else {
	  $success_login = 'no';
	  $message = "Opps! Something went wrong";
	}
	
}

if(isset($_GET['del_id']) && $_GET['del_id'] != '' ){
	$delete_id = $_GET['del_id'];
	$del_sql = "DELETE FROM material_drop_tbl WHERE id='{$delete_id}'";
	if (mysqli_query($mysqli, $del_sql)) {
	  $success_login = 'yes';
	  $message = "Value deleted successfully";
	  header('Location: material_drop.php?delete=success');
	} else {
	  $success_login = 'no';
	  $message = "Opps! Something went wrong";
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
									<h3 class="m-0 font-weight-bold text-primary">Material Dropdown Values</h3>
								</div>
								
							</div>
                        </div>
                        <div class="card-body">
							<div class="text-center p-4">
								<div class="return_msg">
									<?php if($success_login == 'yes' ){ ?>
									<div class="bg-success mb-4"><?php echo $message; ?></div>
									<?php } else if($success_login == 'no') { ?>
									<div class="bg-danger mb-4"><?php echo $message; ?></div>
									<?php } else if(isset($_GET['upd']) && $_GET['upd'] == 'success') { ?>
									<div class="bg-success mb-4"><?php echo "Value added successfully"; ?></div>
									<?php } else if(isset($_GET['delete']) && $_GET['delete'] == 'success') { ?>
									<div class="bg-success mb-4"><?php echo "Value deleted successfully"; ?></div>
									<?php } ?>
									
									
									
								</div>
							</div>
                            <form class="user" method="POST" action="" >
								<div class="form-group">
									<label for="f_name">Enter Material Drop Value</label>
									<input type="text" class="form-control form-control-user" id="m_drp_val" name="m_drp_val" required placeholder="Enter Material Drop Value...."  >
								</div>
								
							  
								<input type="submit" id="submit_btn" name="submit_btn" value="SUBMIT" class="btn btn-primary btn-user btn-block">
								   
								
							</form>
                        </div>
						
						<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Material Dropdown Values</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
										<?php
											$SQLSELECT = "SELECT * FROM material_drop_tbl ORDER BY id DESC";
											$result_set =  $mysqli->query($SQLSELECT);
											if (!empty($result_set->num_rows)) {
												while($row = mysqli_fetch_array($result_set))
												{
												?>
													<tr>
														<td><?php echo $row['name']; ?></td>
														<td>
															<a class="nav-link" href="#" title="EDIT">
																<i class="fas fa-fw fa-edit"></i>
															</a>
															<a class="nav-link" href="material_drop.php?del_id=<?php echo $row['id']; ?>" title="DELETE" onclick="return confirm('Are you sure?')">
																<i class="fas fa-fw fa-trash"></i>
															</a>
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