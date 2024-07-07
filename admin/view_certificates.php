<?php
// Include your database connection file
include('inc/head.php'); 
	
// Fetch uploaded certificates from the database
$sql = "SELECT id, name, department, profile_picture,organizer,from_date,to_date, file_name, certificate_type, achievement_position, event_type, roll_number,venue FROM certificates";
$result = mysqli_query($con, $sql);

// Start HTML output
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Uploaded Certificates</title>
    <!-- Include Bootstrap CSS if necessary -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .gradient-header {
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* Orange gradient */
            color: #fff;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <h1>Uploaded Certificates</h1>
                <table class='table table-bordered table-hover table-striped'>
                    <thead class='gradient-header'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Roll Number</th>
                            <th>Department</th>
                            <th>Event Type</th>
                            <th>Organizer</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Venue</th>
                            <th>Certificate Type</th>
                            <th>Achievement Position</th>
                            <th>Geo tagged photo</th>
                            <th>View Certificate</th>
                            <th>File Name</th>
                        </tr>
                    </thead>
                    <tbody>";

if (mysqli_num_rows($result) > 0) {
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Output table row with certificate details
        echo "<tr>";
        echo "<td>" . $count . "</td>"; // #
        echo "<td>" . $row["name"] . "</td>"; // Name
        echo "<td>" . $row["roll_number"] . "</td>"; // Roll Number
        echo "<td>" . $row["department"] . "</td>"; // Department
        echo "<td>" . $row["event_type"] . "</td>"; // Event Type
        echo "<td>" . $row["organizer"] . "</td>"; // Roll Nber
        echo "<td>" . $row["from_date"] . "</td>"; // Department
        echo "<td>" . $row["to_date"] . "</td>"; // Event Type
        echo "<td>" . $row["venue"] . "</td>";
        echo "<td>" . $row["certificate_type"] . "</td>"; // Certificate Type
        echo "<td>" . $row["achievement_position"] . "</td>"; // Achievement Position
        echo "<td><img src='uploads/" . $row["profile_picture"] . "' alt='Geo tagged photo' style='width: 50px; height: auto;'></td>"; // Geo tagged photo
        echo "<td><a href='uploads/" . $row["file_name"] . "' target='_blank'>View </a></td>"; // View Certificate
        echo "<td>" . $row["file_name"] . "</td>"; // File Name
        echo "</tr>";
$count++;

    }
} else {
    echo "<tr><td colspan='10'>No certificates uploaded yet.</td></tr>";
}

// Close HTML tags
echo "</tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>";

// Close database connection
mysqli_close($con);
?>
