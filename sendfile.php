<!--How to Send File on Whatsapp using PHP-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>How to Send File On Whatsapp Using PHP</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row mt-5">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="card text-center">
						<div class="card-header bg-primary text-white text-uppercase">
							How to send file in whatsapp using php
						</div>
						<div class="card-body">
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<input type="text" name="mobile" placeholder="Enter Mobile Number" class="form-control" required>
								</div>
								<div class="form-group">
									<input type="file" class="form-control" name="image" required="">
								</div>
								<div class="form-group">
									<textarea name="message"  class="form-control" placeholder="Type Message" required=""></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-success" value="Send Message" > 
								</div>
							</form>
						</div>
						<div class="card-footer text-center">
							&copy;Developed by Er Vivek Gupta
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
			

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>
<?php 
if(isset($_POST['submit']))
{
	$mobile=$_POST['mobile'];
	$message=$_POST['message'];
	$filename=$_FILES['image']['name'];
	$file_tmp=$FILES['image']['tmp_name'];
	move_uploaded_file($file_tmp,$filename);

	//Whatsapp API
	$apiURL = 'https://eu138.chat-api.com/instance136593/';
$token = '9d4j8zvj4eantnmr';

$phone = $mobile;

$data = json_encode(array(
    'chatId'=>$phone.'@c.us',
    'body'=>'https://domain.com/PHP/'.$filename,//FULL PATH and file name
    'filename'=>$filename,
    'caption'=>$message
));

$url = $apiURL.'sendFile?token='.$token;
$options = stream_context_create(['http' => [
    'method'  => 'POST',
    'header'  => 'Content-type: application/json',
    'content' => $data
]
]);
$response = file_get_contents($url,false,$options);
echo $response; exit;
}
?>