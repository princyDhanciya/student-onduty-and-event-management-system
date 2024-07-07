<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "simpleave");
$output = '';
if(isset($_POST["export"]))
{
 // Fetch data from requests table
 $query_requests = "SELECT name, department, date, reason_for_onduty,rollno,from_date,to_date,venue,brochure,status FROM requests";
 $result_requests = mysqli_query($connect, $query_requests);
 
 // Fetch data from certificates table
 $query_certificates = "SELECT name, department, file_name, certificate_type, achievement_position, event_type, roll_number, venue FROM certificates";

 $result_certificates = mysqli_query($connect, $query_certificates);
 
 // Check if there are any rows in requests table
 if(mysqli_num_rows($result_requests) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
      <tr>  
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
      </tr>
  ';
  while($row = mysqli_fetch_array($result_requests))
  {
   $output .= '
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
 }
 
 // Check if there are any rows in certificates table
 if(mysqli_num_rows($result_certificates) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
      <tr>  
         <th>Name</th>  
         <th>Department</th>  
         <th>File Name</th>
         <th>Certificate Type</th>
         <th>Achievement Position</th>
         <th>Event Type</th>
         <th>Roll Number</th>
         <th>Venue</th>
      </tr>
  ';
  while($row = mysqli_fetch_array($result_certificates))
  {
   $output .= '
    <tr>  
    <td>' . $row["name"] . '</td>  
    <td>' . $row["department"] . '</td>  
    <td>' . $row["file_name"] . '</td>
    <td>' . $row["certificate_type"] . '</td>
    <td>' . $row["achievement_position"] . '</td>
    <td>' . $row["event_type"] . '</td>
    <td>' . $row["roll_number"] . '</td>
    <td>' . $row["venue"] . '</td>
    </tr>
   ';
  }
 }
 
 $output .= '</table>';
 header('Content-Type: application/xls');
 header('Content-Disposition: attachment; filename=download.xls');
 echo $output;
}
?>
