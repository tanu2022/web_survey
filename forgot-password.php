<?php
include('config.php');

$success_login = '';

if(isset($_POST['submit_btn'])){
$email = mysqli_real_escape_string($mysqli, $_POST['f_email']);
$sql = "SELECT * FROM `users` WHERE email = '$email'";
$res = mysqli_query($mysqli, $sql);
$count = mysqli_num_rows($res);
if($count == 1){
	
	//Generate Password
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		$generated_pass = implode($pass); //turn the array into a string
	//Generate Password
	
	$r = mysqli_fetch_assoc($res);
	//$password = $r['password'];
	
	$password = md5($generated_pass);
	$to = $r['email'];
	$subject = "Your Recovered Password";
	 
	$email_message = "Please use this password to login " . $generated_pass;
	$headers = "From : no-reply@drainlineguard.com";
	$update_sql = "UPDATE users set password='{$password}' WHERE email='{$to}' ";

	if(@mail($to, $subject, $email_message, $headers)){
		$update_sql = "UPDATE users set password='{$password}' WHERE email='{$to}' ";

		if (mysqli_query($mysqli, $update_sql)) {
			$success_login = 'yes';
			$message = "Your Password has been sent to your email id.";
		} else {
			$success_login = 'no';
			$message = "Failed to Recover your password, try again";
		}
		
	} else {
		$success_login = 'no';
		$message = "Failed to Recover your password, try again";
	}
} else {
	$success_login = 'no';
	$message = "Email does not exist";
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
                                <h1 class="h4 text-gray-900 mb-4 form-heading">Forgot Your Password?</h1>
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
                                    <div class="text-center1">
                                        <p class="mb-4">Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="f_email" name="f_email" placeholder="Enter Email Address..." required>
                                        </div>
                                        <input type="submit" name="submit_btn" id="submit_btn" value="Reset Password" class="btn btn-primary btn-user btn-block">
                                            
                                    </form>
                                    <hr>
                                    <!--<div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>-->
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
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