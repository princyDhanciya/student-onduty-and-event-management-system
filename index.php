<?php 
	include('inc/head.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
		<div class="container">
			<button class="navbar-toggler toggler-right" data-target="#mynavbar" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a href="index.php" class="navbar-brand mr-3">On Duty Approval System</a>
		</div>
	</nav>

	<header id="main-header" class="bg-primary py-2 text-white">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1><i class="fa fa-user"></i> User Login</h1>
				</div>
			</div>
		</div>
	</header>

	<section id="post">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<div class="card-header">
							<h5>Login Panel</h5>
						</div>
						<div class="card-body p-3">
							<form action="" method="POST">
								<label class="form-control-label">Email</label>
								<input type="email" name="email" class="form-control"  required />
								<br />
								<label class="form-control-label">Password</label>
								<input type="password" name="password" class="form-control"  required />
								<br />
								<input type="submit" name="submit" class="btn btn-primary" style="border-radius:0%;" value="Log In" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	
	<script src="js/jquery.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1');
	</script>

</body>
</html>

<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Hashing the password
		$hashed_password = md5($password);

		include 'inc/config.php';

		// Using prepared statement to prevent SQL injection
		$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ss', $email, $hashed_password);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$count = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);

		if($count == 1){
			session_start();
			$_SESSION['email'] = $email;
			header('location: dashboard.php');
			exit;
		}else{
			echo "<script> 
			alert('Email or Password Invalid');
			window.location.href = 'index.php';
			</script>";
		}
	}
 ?>
