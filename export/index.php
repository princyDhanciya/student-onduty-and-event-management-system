<?php
$connect = mysqli_connect("localhost", "root", "", "simpleave");

// Fetch data from the requests table
$sql_requests = "SELECT * FROM requests";  
$result_requests = mysqli_query($connect, $sql_requests);

// Fetch data from the certificates table
$sql_certificates = "SELECT * FROM certificates";  
$result_certificates = mysqli_query($connect, $sql_certificates);
?>
<html>  
 <head>  
  <title>Export MySQL data to Excel in PHP</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  

   <!-- Display data from the requests table -->
   <div class="table-responsive">  
    <h2 align="center">Requests</h2><br /> 
    <table class="table table-bordered">
    <th>Name</th>
      <th>Roll Number</th>
      <th>Department</th>
      <th>Date</th>
      <th>Reason for onduty</th>
      <th>From Date</th>
      <th>To Date</th>
      <th>Venue</th>
      <th>Upload Brochure</th>
      <th>Status</th>
     <?php
     while($row = mysqli_fetch_array($result_requests))  
     {  
        echo '  
       <tr>  
       <td>'.$row["name"] . '</td>  
       <td>'. $row["rollno"] . '</td>  
       <td>'. $row["department"] . '</td>  
       <td>'. $row["date"] . '</td>  
       <td>'. $row["reason_for_onduty"] . '</td>  
       <td>'. $row["from_date"] . '</td>  
       <td>'. $row["to_date"] . '</td>  
       <td>'. $row["venue"] . '</td>
       <td>'.$row["brochure"].'</td>
       <td>'.$row["status"].'</td>
       </tr>  
        ';  
     }
     ?>
    </table>
   </div>

   <!-- Display data from the certificates table -->
   <div class="table-responsive">  
    <h2 align="center">Certificates</h2><br /> 
    <table class="table table-bordered">
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
     
     <?php
     while($row = mysqli_fetch_array($result_certificates))  
     {  
        echo '  
       <tr>  
       <td>' . $row["name"] . '</td>  
      <td>' . $row["roll_number"] . '</td>  
      <td>' . $row["department"] . '</td>
      <td>' . $row["event_type"] . '</td>
      <td>' . $row["organizer"] . '</td>
      <td>' . $row["from_date"] . '</td>
      <td>' . $row["to_date"] . '</td>
      <td>' . $row["venue"] . '</td>
      <td>' . $row["certificate_type"] . '</td>
      <td>' . $row["achievement_position"] . '</td>
     
       </tr>  
        ';  
     }
     ?>
    </table>
   </div>  

   <!-- Export buttons for both tables -->
   <br />

    <form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>  
  </div>  
 </body>  
</html>
