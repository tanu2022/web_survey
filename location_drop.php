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
	
	$insert_sql = "INSERT INTO location_drop_tbl set name='{$m_drp_val}'";

	if (mysqli_query($mysqli, $insert_sql)) {
	  $success_login = 'yes';
	  $message = "Value added successfully";
	  header('Location: location_drop.php?upd=success');
	} else {
	  $success_login = 'no';
	  $message = "Opps! Something went wrong";
	}
	
}

if(isset($_GET['del_id']) && $_GET['del_id'] != '' ){
	$delete_id = $_GET['del_id'];
	$del_sql = "DELETE FROM location_drop_tbl WHERE id='{$delete_id}'";
	if (mysqli_query($mysqli, $del_sql)) {
	  $success_login = 'yes';
	  $message = "Value deleted successfully";
	  header('Location: location_drop.php?delete=success');
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
									<h3 class="m-0 font-weight-bold text-primary">Location Dropdown Values</h3>
								</div>
								
							</div>
                        </div>
                        <div class="card-body">
							<div class="text-center p-4">
								<div class="return_msg">
									<?php if($success_login == 'yes' ){ ?>
									<div class="mb-4 value-data"><?php echo $message; ?></div>
									<?php } else if($success_login == 'no') { ?>
									<div class="mb-4 value-data-danger"><?php echo $message; ?></div>
									<?php } else if(isset($_GET['upd']) && $_GET['upd'] == 'success') { ?>
						<div class="mb-4 value-data"><?php echo "Value added successfully"; ?></div>
							<?php } else if(isset($_GET['delete']) && $_GET['delete'] == 'success') { ?>
							
						<div class="mb-4 value-data"><?php echo "Value deleted successfully"; ?></div>
									<?php } ?>
									
									
									
								</div>
							</div>
                            <form class="user material_user" method="POST" action="" >
								<div class="form-group ml-form-group">
									<label for="f_name">Enter Location Dropdown Value</label>
									<input type="text" class="form-control form-control-user1" id="m_drp_val" name="m_drp_val" required placeholder="Enter Material Drop Value...."  >
								</div>
								
							  
								<input type="submit" id="submit_btn" class="ml_submit" name="submit_btn" value="SUBMIT" class="btn btn-primary btn-user btn-block">
								   
								
							</form>
                        </div>
						
						<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:73%;">Location Dropdown Values</th>
                                            <th style="width:27%;">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
										<?php
											$SQLSELECT = "SELECT * FROM location_drop_tbl ORDER BY id DESC";
											$result_set =  $mysqli->query($SQLSELECT);
											if (!empty($result_set->num_rows)) {
												while($row = mysqli_fetch_array($result_set))
												{
												?>
													<tr>
														<td>
															<input type="hidden" class="before_edit" name="old_m_name" id="old_m_name_<?php echo $row['id']; ?>" value="<?php echo $row['name']; ?>" readonly >
															<input type="text" class="before_edit" name="m_name" id="m_name_<?php echo $row['id']; ?>" value="<?php echo $row['name']; ?>" readonly >
															
															<span class="text-success" id="success_msg_<?php echo $row['id']; ?>" style="display:none">Value updated successfully</span>
															
															<span class="text-danger fw-bold" id="err_msg_<?php echo $row['id']; ?>" style="display:none">Please fill out this field !</span>
															
															<span class="act_btn" id="act_btn_<?php echo $row['id']; ?>">
																<button class="btn-save" onclick="save_edit(<?php echo $row['id']; ?>)">Save</button>
																<button class="btn-cancel" onclick="cancel_edit(<?php echo $row['id']; ?>)">Cancel</button>
															</span>
														</td>
														<td>
															<a class="nav-link" href="javascript:;" onclick="edit_fun('<?php echo $row['id']; ?>')" class="edit_icon" title="EDIT">
																<i class="fas fa-fw fa-edit"></i>
															</a>
															<a class="nav-link" href="location_drop.php?del_id=<?php echo $row['id']; ?>" title="DELETE" onclick="return confirm('Are you sure?')">
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

 <?PHP include('admin_footer.php'); ?> 
<style type="text/css">
	.act_btn{ display:none;}
</style>

<script type="text/javascript">
	function edit_fun($row_id){
		$('#m_name_'+$row_id).removeClass('before_edit');
		$('#m_name_'+$row_id).addClass('after_edit');
		$('#m_name_'+$row_id).attr("readonly", false);
		$('#act_btn_' + $row_id).show();
		// alert($row_id)
	}
	
	function save_edit($row_id){
		var m_name = $('#m_name_'+$row_id).val();
		if(m_name != ''){
			$.ajax({
				url: "edit_ajax.php",

				type: "POST",
				dataType:'json', // add json datatype to get json
				data: ({"myData":m_name,"myDataId":$row_id, "action":"location"}),
				success: function(data){
					if(data == 'yes'){
						$('#m_name_'+$row_id).addClass('before_edit');
						$('#m_name_'+$row_id).removeClass('after_edit');
						$('#m_name_'+$row_id).attr("readonly", true);
						$('#act_btn_' + $row_id).hide();
						$('#success_msg_'+$row_id).css('display','block');
					} else {
						$('#err_msg_'+$row_id).html('Opps! Something went wrong');
						$('#err_msg_'+$row_id).css('display','block');
					}
				}
			});
		} else {
			$('#err_msg_'+$row_id).css('display','block');
			$('#m_name_'+$row_id).css('border','1px solid red');
		}
	}	
	
	function cancel_edit($row_id){
		var value = $('#m_name_'+$row_id).val();
		var value_old = $('#old_m_name_'+$row_id).val();
		if(value == ''){
			$('#m_name_'+$row_id).val(value_old);
		} else {
			$('#m_name_'+$row_id).val(value);			
		}
		$('#m_name_'+$row_id).addClass('before_edit');
		$('#m_name_'+$row_id).removeClass('after_edit');
		$('#m_name_'+$row_id).attr("readonly", true);
		$('#act_btn_' + $row_id).hide();
		
	}
</script>         