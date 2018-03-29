<?php

	$_GET['roll_no'];
  $con=mysqli_connect("localhost","root","root","UTECHNOS");
// Check connection
if (mysqli_connect_errno())
  {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


    $sql = "SELECT waiting FROM hostel_waiting where roll_no='". $_GET["roll_no"]."'";
		$result=mysqli_query($con,$sql);
   if (mysqli_num_rows($result)>0)
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_assoc($result))
    {
						json_encode($row);
    // echo json_encode($row);
    }
  // Free result set
}
else {
	$myObj->waiting = "No Information Available";
$myJSON = json_encode($myObj);
  echo $myJSON;
}

?>
