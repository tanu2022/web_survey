<?php
include('config.php');
  $success_login = '';
if(isset($_POST['submit_btn'])){
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	if($email != '' && $password != ''){
		$get_user_data_sql = "SELECT * FROM users where email='{$email}' AND password='{$password}'";
		$userData = $mysqli->query($get_user_data_sql);
		if (!empty($userData->num_rows)) {
			$success_login = 'Yes';
			$message = 'Logged in successfully.';
			$row = mysqli_fetch_assoc($userData);
			
			// Set session variables
			$_SESSION["ID"] = $row['id'];
			$_SESSION["NAME"] = $row['f_name'].' '.$row['l_name'];
			$_SESSION["EMAIL"] = $row['email'];
			
			header("Location: tables.php");
			
		} else {
			$success_login = 'no';
			$message = 'Invalid Data.';
		}
	} else {
		$success_login = 'no';
		$message = 'Please enter Email and Password';
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
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <h1 class="h4 text-gray-900 mb-4 form-heading">Login</h1>
                                <div class="p-4">
                                    <div class="text-center">
                                        
										<div class="return_msg">
											<?php if($success_login == 'yes'){ ?>
											<div class="text-success text-bold"><?php echo $message; ?></div>
											<?php } else if($success_login == 'no') { ?>
											<div class="text-danger"><?php echo $message; ?></div>
											<?php } ?>
										</div>
                                    </div>
                                    <form class="user" method="POST" action="" >
                                        <div class="form-group">
											<label for="email">Email Address</label>
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" required 
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
											<label for="password">Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" required placeholder="Password">
                                        </div>
                                      
                                        <input type="submit" id="submit_btn" name="submit_btn" value="Login" class="btn btn-primary btn-user btn-block">
                                           
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <!--<div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
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