<?php 
$con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
      $user=$_REQUEST["username"] ;
            $sql="SELECT pp FROM users WHERE username='$user'";
            $result=mysqli_query($con,$sql);      
            $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
            echo ($row[0]["pp"]);        
mysqli_free_result($result);
mysqli_close($con);
 ?>

