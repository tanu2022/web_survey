<?php
include('config.php');

$success_login = '';

if(isset($_POST['submit_btn'])){
	$pass = $_POST['n_pass'];
	$c_pass = $_POST['c_pass'];
	if($pass == $c_pass){
		/*$insert_sql = "INSERT INTO survey_tbl set resident_f_name='{$resident_f_name}', resident_l_name='{$resident_l_name}', resident_address='{$resident_address}', location_of_meter='{$location_of_meter}', size_of_service='{$size_of_service}', material_of_service='{$material_of_service}', date_constructed='{$date_constructed}'";

		if (mysqli_query($mysqli, $insert_sql)) {
			$success_login = 'yes';
		else {
			$success_login = 'no';
			$message = "Opps! Something went wrong";
			
		}*/

	}else{
		$success_login = 'no';
		$message = "New password and confirm password must be same";
	}
}
  
include('header.php');
?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-xl-5 col-lg-5 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body login-form p-0">
						<div class="row">
                            
                            <div class="col-lg-12">
                                <h1 class="h4 text-gray-900 mb-4 form-heading">Reset Password</h1>
                                <div class="p-4">
									<div class="text-center">
										<div class="return_msg">
											<?php if($success_login == 'yes'){ ?>
											<div class="bg-success mb-4"><?php echo $message; ?></div>
											<?php } else if($success_login == 'no') { ?>
											<div class="bg-danger mb-4"><?php echo $message; ?></div>
											<?php } ?>
										</div>
                                    </div>
                                    
                                    <form method="POST" action="">
                                        <div class="form-group">
											<label for="n_pass">New Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="n_pass" name="n_pass" placeholder="Enter New Password.." required>
                                        </div>
										<div class="form-group">
											<label for="c_pass">Confirm Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="c_pass" name="c_pass" placeholder="Enter Confirm Password.." required>
                                        </div>
                                        <input type="submit" name="submit_btn" id="submit_btn" value="Submit" class="btn btn-primary btn-user btn-block">
                                            
                                    </form>
                                    <!--<hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
 <?php
	include('footer.php');
?>