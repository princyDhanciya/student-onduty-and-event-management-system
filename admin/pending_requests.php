<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
    <!-- Include necessary CSS files -->
</head>
<body>
    <div class="container">
        <h1>Pending Requests</h1>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Reason for On Duty</th>
                    <th>Roll No</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Venue</th>
                    <th>Upload Brochure</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file
                
                // Fetch pending requests from the database
                $sql = "SELECT * FROM requests WHERE status = 0";
                $result = mysqli_query($con, $sql);
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['reason_for_onduty']; ?></td>
                        <td><?php echo $row['rollno']; ?></td>
                        <td><?php echo $row['from_date']; ?></td>
                        <td><?php echo $row['to_date']; ?></td>
                        <td><?php echo $row['venue']; ?></td>
                        <td><?php echo $row['brochure']; ?></td>
                        <td>Pending</td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/jquery.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1');
	</script>
    <!-- Include necessary JavaScript files -->
</body>
</html>
