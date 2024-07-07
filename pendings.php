<?php
include('inc/head.php');

$sql = "SELECT * FROM requests WHERE status = 0 ";
$que = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
    <!-- Include Bootstrap CSS if necessary -->
</head>
<body>
    <div class="container">
        <h1>Pending Requests</h1>
        <table class="table table-bordered table-hover table-striped">
            <thead>
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
            </thead>
            <tbody>
                <?php
               $sql = "SELECT * FROM requests WHERE status = 0 ";
               $que = mysqli_query($con,$sql);
               $cnt=1;
               while ($result = mysqli_fetch_assoc($que)) {
               ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
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
                        ?>
                    </td>
                </tr>
                <?php
                $cnt++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
