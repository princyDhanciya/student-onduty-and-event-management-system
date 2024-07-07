<?php
	include'inc/config.php'; 
	if (isset($_POST['approve'])){
		$appid = $_POST['appid'];
		$sql = "UPDATE requests SET status='1' WHERE id = '$appid'";
		$run = mysqli_query($con,$sql);
		if($run == true){
			
			echo "<script> 
					alert('Application Approved');
					window.open('dashboard.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Approved');
			</script>";
		}
	}
	
 ?>