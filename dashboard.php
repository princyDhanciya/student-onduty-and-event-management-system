<?php 
    include('inc/head.php'); 
    session_start();

    if (!isset($_SESSION['email'])) {
        header('location:index.php');
        exit;
    }

    // Establish database connection (assuming $con is defined in inc/head.php)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onduty Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
        <div class="container">
            <button class="navbar-toggler toggler-right" data-target="#mynavbar" data-toggle="collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#" class="navbar-brand mr-3">On Duty Approval System</a>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav">
                    <li class="nav-item px-2"><a href="#" class="nav-link active">Logged in as <?php echo $_SESSION['email']?></a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="main-header" class="bg-primary py-2 text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-tachometer"></i> Dashboard</h1>
                </div>
            </div>
        </div>
    </header>

    <section id="sections" class="py-4 mb-4 bg-faded">
        <div class="container">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Apply Onduty</a>
                </div>
                <div class="col-md-3">
                  <a href="pendings.php" class="btn btn-warning btn-block" style="border-radius: 0%;"><i class="fa fa-spinner"></i> Pendings</a>
                </div>

                <div class="col-md-3">
                    <a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-check"></i> Approved requests</a>
                </div>
                <div class="row">
    <div class="col-md"></div>
    <div class="col-md-3">
        <div class="d-flex justify-content-end">
            <div style="position: relative; top: -0px;">
                <a href="#" class="btn btn-info btn-block" style="border-radius: 0%;" data-toggle="modal" data-target="#uploadCertificateModal"><i class="fa fa-upload"></i> Upload Certificate</a>
            </div>
        </div>
    </div>
</div>

        </div>
    </section>

    <section id="post">
        <div class="container">
            <div class="row">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Reason for onduty</th>
                        <th>Roll Number</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Venue</th>
                        <th>Upload Brochure</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM requests";
                            $que = mysqli_query($con,$sql);
                            $cnt=1;
                            while ($result = mysqli_fetch_assoc($que)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['department']; ?></td>
                            <td><?php echo $result['date']; ?></td>
                            <td><?php echo $result['reason_for_onduty']; ?></td>
                            <td><?php echo $result['rollno']; ?></td>
                            <td><?php echo $result['from_date']; ?></td>
                            <td><?php echo $result['to_date']; ?></td>
                            <td><?php echo $result['venue']; ?></td>
                            <td><?php echo $result['brochure']; ?></td>
                            <td>
                                <?php 
                                    if ($result['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Pending</span>";
                                    } else {
                                        echo "<span class='badge badge-success'>Approved</span>";
                                    }
                                    $cnt++;
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="" class="text-center text-black bg-inverse mt-4 p-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p</p>
                </div>
            </div>
        </div>
    </section>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- Modal for Applying Onduty -->
    <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Apply On Duty</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" name="name" class="form-control" required/>
                        <input type="hidden" name="email" value="<?php echo $_SESSION['email']?>">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Department</label>
                        <select name="department" class="form-control" required>
                            <option value="CSE">CSE</option>
                            <option value="AIML">AIML</option>
                            <option value="AIDS">AIDS</option>
                            <option value="EEE">EEE</option>
                            <option value="ECE">ECE</option>
                            <option value="AUTOMOBILE">AUTOMOBILE</option>
                            <option value="MECH">MECH</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Date</label>
                        <input type="date" name="date" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Roll Number</label>
                        <input type="text" name="rollno" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">From Date</label>
                        <input type="date" name="from_date" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">To Date</label>
                        <input type="date" name="to_date" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Venue</label>
                        <input type="text" name="venue" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Reason for onduty</label>
                        <textarea name="reason_for_onduty" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Upload Brochure</label>
                        <input type="file" name="brochure" class="form-control-file" accept=".pdf,.txt,.doc,.docx,.jpeg,.jpg,.png" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
                <input type="hidden" name="status" value="0">
                <input type="submit" class="btn btn-success" style="border-radius:0%;" name="apply" value="Apply">
            </div>
            </form>
        </div>
    </div>
</div>

      
	<!-- User Modal -->
	<div class="modal fade" id="addUsertModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Total requests</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
						<thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Reason for onduty</th>
                            <th>Roll Number</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Venue</th>
                            <th>Upload Brochure</th>
                            <th>Status</th>
						</thead>
						 <tbody>
							 	<?php 
									$sql = "SELECT * FROM requests WHERE status ";
									$que = mysqli_query($con,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
                                 <td><?php echo $cnt;?></td>
                                   <td><?php echo $result['name']; ?></td>
                                   <td><?php echo $result['department']; ?></td>
                                   <td><?php echo $result['date']; ?></td>
                                   <td><?php echo $result['reason_for_onduty']; ?></td>
                                   <td><?php echo $result['rollno']; ?></td>
                                   <td><?php echo $result['from_date']; ?></td>
                                   <td><?php echo $result['to_date']; ?></td>
                                   <td><?php echo $result['venue']; ?></td>
                                    <td><?php echo $result['brochure']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
				</div>
				
			</div>
		</div>
	</div>
   <!-- Modal for Uploading Certificate -->

<!-- Modal for Uploading Certificate -->
<div class="modal fade" id="uploadCertificateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Upload Certificate</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" name="name" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Roll Number</label>
                        <input type="text" name="rollNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Department</label>
                        <select name="department" class="form-control" required>
                            <option value="CSE">CSE</option>
                            <option value="AIML">AIML</option>
                            <option value="AIDS">AIDS</option>
                            <option value="EEE">EEE</option>
                            <option value="ECE">ECE</option>
                            <option value="AUTOMOBILE">AUTOMOBILE</option>
                            <option value="MECH">MECH</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Certificate Type</label>
                        <select name="certificateType" class="form-control" required>
                            <option value="Participation">Participation</option>
                            <option value="Achievement">Achievement</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Achievement Position (if applicable)</label>
                        <select name="achievementPosition" class="form-control">
                            <option value="NIL">NIL</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                            <option value="Third">Third</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Event Type</label>
                        <select name="eventType" class="form-control" required>
                            <option value="National">National</option>
                            <option value="International">International</option>
                            <option value="Intercollege">Intercollege</option>
                            <option value="Intracollege">Intracollege</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Organizer</label>
                        <input type="text" name="organizer" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">From Date</label>
                        <input type="date" name="from_date" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">To Date</label>
                        <input type="date" name="to_date" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Geo Tagged Photo</label>
                        <input type="file" name="profilePicture" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Upload Certificate File</label>
                        <input type="file" name="certificateFile" class="form-control-file" required>
                    </div>
                  
                   
                    <div class="form-group">
                        <label class="form-control-label">Venue</label>
                        <input type="text" name="venue_place" class="form-control" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" style="border-radius:0%;" name="uploadCertificate" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
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
$uploadDirectory = 'admin/uploads/';
// Handling form submission for uploading certificate
if (isset($_POST['uploadCertificate'])) {
    // Process the form data
    $name = $_POST['name'];
    $department = $_POST['department'];
    $organizer = $_POST['organizer'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $certificateType = $_POST['certificateType'];
    $achievementPosition = $_POST['achievementPosition'];
    $eventType = $_POST['eventType'];
    $rollNumber = $_POST['rollNumber'];
    $venue_place = $_POST['venue_place'];

    // File uploads
    $profilePictureFile = $_FILES['profilePicture'];
    $certificateFile = $_FILES['certificateFile'];

    $profilePictureName = $profilePictureFile['name'];
    $profilePictureTmpName = $profilePictureFile['tmp_name'];
    $profilePictureError = $profilePictureFile['error'];

    $certificateFileName = $certificateFile['name'];
    $certificateFileTmpName = $certificateFile['tmp_name'];
    $certificateFileError = $certificateFile['error'];

    // Check for file errors
    if ($profilePictureError === UPLOAD_ERR_OK && $certificateFileError === UPLOAD_ERR_OK) {
        // Move the uploaded files to the permanent directory
        $profilePictureDirectory = $uploadDirectory . $profilePictureName;
        $certificateFileDirectory = $uploadDirectory . $certificateFileName;

        if (move_uploaded_file($profilePictureTmpName, $profilePictureDirectory) && move_uploaded_file($certificateFileTmpName, $certificateFileDirectory)) {
            // Insert data into the database
            $query = "INSERT INTO certificates (name, department, profile_picture, file_name, organizer, from_date, to_date, certificate_type, achievement_position, event_type, roll_number, venue) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = $con->prepare($query);

            // Bind parameters
            $stmt->bind_param("ssssssssssss", $name, $department, $profilePictureName, $certificateFileName, $organizer, $from_date, $to_date, $certificateType, $achievementPosition, $eventType, $rollNumber, $venue_place);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Certificate uploaded successfully.');</script>";
            } else {
                echo "<script>alert('Error: Failed to upload certificate.');</script>";
            }
        } else {
            echo "<script>alert('Error: Failed to move uploaded files to destination directory.');</script>";
        }
    } else {
        echo "<script>alert('Error: File upload failed with error code $profilePictureError.');</script>";
    }
}
?>
<?php
// Include database connection


if (isset($_POST['apply'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $date = $_POST['date'];
    $rollno = $_POST['rollno'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $venue = $_POST['venue'];
    $reason_for_onduty = $_POST['reason_for_onduty'];
    $status = $_POST['status'];

    // File upload handling
    $brochure = $_FILES['brochure']['name'];
    $brochure_tmp_name = $_FILES['brochure']['tmp_name'];
    $brochure_folder = 'admin/uploads/' . $brochure;

    // Create uploads directory if it doesn't exist


    if (move_uploaded_file($brochure_tmp_name, $brochure_folder)) {
        // Prepare SQL query
        $sql = "INSERT INTO requests (name, email, department, date, rollno, from_date, to_date, venue, reason_for_onduty, brochure, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssssss", $name, $email, $department, $date, $rollno, $from_date, $to_date, $venue, $reason_for_onduty, $brochure, $status);

        // Execute statement
        if ($stmt->execute()) {
            echo "<script>alert('On-duty application submitted successfully.');</script>";
        } else {
            echo "<script>alert('Error: Could not submit application.');</script>";
        }
    } else {
        echo "<script>alert('Error: Could not upload brochure.');</script>";
    }
}
?>
