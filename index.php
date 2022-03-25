<?PHP
include('config.php');
if(isset($_POST['submit_btn'])){
	echo "<pre>"; print_r($_POST); die('--hiii');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Survey</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
		
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Web Survey Form</h1>
                            </div>
                            <form class="user" name="survey_form" method="POST" action="" enctype="multipart/form-data" >
                                <div class="form-group">
									<label for="resident_name">Resident Name</label>
                                    <input type="text" class="form-control form-control-user" id="resident_name" name="resident_name" placeholder="Resident Name">
                                </div>
                                <div class="form-group">
									<label for="resident_address">Resident Address</label>
                                    <select class="form-control form-control-user selectpicker" data-live-search="true"  id="resident_address" name="resident_address">
										<option value="" selected>----Please Select Address----</option>
										<option value="a1">Address1</option>
										<option value="a2">Address2</option>
										<option value="a3">Address3</option>
										<option value="a4">Address4</option>
										<option value="a5">Address5</option>
									</select>
                                </div>
								<div class="form-group">
									<label for="location_of_meter">Location of meter within the building</label>
                                    <input type="text" class="form-control form-control-user" id="location_of_meter" name="location_of_meter" placeholder="Location of meter within the building">
                                </div>
								<div class="form-group">
									<label for="size_of_service">Size of the service (inches)</label>
                                    <input type="text" class="form-control form-control-user" id="size_of_service" name="size_of_service" placeholder="Size of the service (inches) ">
                                </div>
								<div class="form-group">
									<label for="material_of_service">Material of the service upstream of the meter</label>
									<select class="form-control form-control-user" id="material_of_service" name="material_of_service">
										<option value="" selected>--Please Select--</option>
										<option value="m1">Material1</option>
										<option value="m2">Material2</option>
										<option value="m3">Material3</option>
										<option value="m4">Material4</option>
										<option value="m5">Material5</option>
									</select>
                                </div>
								<div class="form-group">
									<label for="date_constructed">Date constructed</label>
                                    <input type="text" class="form-control form-control-user" id="date_constructed" name="date_constructed" placeholder="Date constructed">
                                </div>
								<div class="form-group">
									<label for="photo_upstream_meter">A photo of the service line upstream of the meter</label>
                                    <input type="file" class="form-control form-control-user" id="photo_upstream_meter" name="photo_upstream_meter" placeholder="A photo of the service line upstream of the meter">
                                </div>
								<div class="form-group">
									<label for="photo_meter">A photo of the meter</label>
                                    <input type="file" class="form-control form-control-user" id="photo_meter" name="photo_meter" placeholder="A photo of the meter">
                                </div>
                                
                                <input type="submit" class="btn btn-primary btn-user btn-block" id="submit_btn" name="submit_btn" value="Submit Survey" >
                                    
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
	
	

</body>

</html>
