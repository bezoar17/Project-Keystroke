<?php 
$con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
      $user=$_POST["username"];$mono=$_POST["mono"];$pr=$_POST["pr"];$pp=$_POST["pp"];$rr=$_POST["rr"];
      $sql="UPDATE users SET mono='$mono',pr='$pr',pp='$pp',rr='$rr' WHERE username='$user' ";
      $result=mysqli_query($con,$sql);
mysqli_free_result($result);
mysqli_close($con);
 ?>
