<?php
include('config.php');
  
include('header.php');
?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        
                            
                            
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="f_email" name="f_email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
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
 <?php
	include('footer.php');
?>