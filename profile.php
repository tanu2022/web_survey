<?PHP
include('config.php');

$success_login = '';
//check if user id not exist then redirect to login page
	if(!(isset($_SESSION["ID"]) && $_SESSION["ID"] != '')){
		header('Location: login.php');
	}
$user_id = $_SESSION["ID"];
$get_user_data_sql = "SELECT * FROM users WHERE id='{$user_id}' ";
$userData = $mysqli->query($get_user_data_sql);
if (!empty($userData->num_rows)) {
	$row = mysqli_fetch_assoc($userData);
}
// echo "<pre>"; print_r($row); die('hello');

if(isset($_POST['submit_btn'])){
	$update_sql = '';
	$f_name = trim($_POST['f_name']) ?? '';
	$l_name = trim($_POST['l_name']) ?? '';
	$email = trim($_POST['email']) ?? '';
	$password = trim($_POST['password']);
	$c_password = trim($_POST['c_password']);
	
	if($password != '' && $c_password != '' ){
		if($password == $c_password){
			$pass = md5($password);
			$update_sql = "UPDATE users set f_name='{$f_name}', l_name='{$l_name}', email='{$email}', password='{$pass}' WHERE id='{$user_id}' ";
		} else {
			$success_login = 'no';
			$message = "Both password should be same";
		}
	} else {
		$update_sql = "UPDATE users set f_name='{$f_name}', l_name='{$l_name}', email='{$email}' WHERE id='{$user_id}' ";
	}
	
	
	
	if($update_sql != ''){
		if (mysqli_query($mysqli, $update_sql)) {
			$success_login = 'yes';
			$message = "User data updated successfully";
			header('Location: profile.php?upd=success');
		} else {
			$success_login = 'no';
			$message = "Opps! Something went wrong";
		}
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
									<h3 class="m-0 font-weight-bold text-primary">Update Profile</h3>
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
									<div class="bg-success mb-4"><?php echo "User data updated successfully"; ?></div>
									<?php } ?>
									
									
								</div>
							</div>
                            <form class="user profile_user" method="POST" action="" >
								<div class="form-group p-form">
									<label for="f_name">First Name</label>
									<input type="text" class="form-control form-control-user" id="f_name" name="f_name" required placeholder="First Name" value="<?php echo $row['f_name'] ?? ''; ?>" >
								</div>
								<div class="form-group p-form">
									<label for="l_name">Last Name</label>
									<input type="text" class="form-control form-control-user" id="l_name" name="l_name" required placeholder="Last Name" value="<?php echo $row['l_name'] ?? ''; ?>" >
								</div>
								<div class="form-group p-form">
									<label for="email">Email Address</label>
									<input type="email" class="form-control form-control-user"
										id="email" name="email" required placeholder="Enter Email Address" value="<?php echo $row['email'] ?? ''; ?>">
								</div>
								<div class="form-group p-form">
									<label for="password">Password</label>
									<input type="password" class="form-control form-control-user"
										id="password" name="password" placeholder="Password">
								</div>
								<div class="form-group p-form">
									<label for="c_password">Confirm Password</label>
									<input type="password" class="form-control form-control-user"
										id="c_password" name="c_password" placeholder="Confirm Password">
								</div>
							  <div class="form-group p-form">
								<input type="submit" id="profile_btn" name="submit_btn" value="UPDATE" class="btn btn-primary btn-user btn-block">
								   </div>
								
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