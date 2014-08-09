<?php 
$con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
      $user=$_REQUEST["username"] ;$flag=$_REQUEST["flag"];$mono=$_REQUEST["mono"];
      $pr=$_REQUEST["pr"];$pp=$_REQUEST["pp"];$rr=$_REQUEST["rr"];
      switch ($flag) {
        case 0:
          $sql="INSERT INTO users (username,password) 
          VALUES ('$user','$pass')";  
                  
          /*Register username with a password*/
          break;

        case 1:
          /*    $sql="SELECT * FROM users WHERE username='$user'";
          $loggedin=1;                                              */
        /*Login of a user*/
        break;

        case 2:
        $sql="UPDATE users SET mono='$mono',pr='$pr',pp='$pp',rr='$rr' WHERE username='$user' ";
        /*Input of info */
        break;

        case 3:
        /*Send previous info*/
            $sql="SELECT mono FROM users WHERE username='$user'";
            $result=mysqli_query($con,$sql);      
            $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
            echo ($row[0]);
        break;

        case 4:
        /**/
        break;

        case 5:
        /**/
        break;
        
        default:
          /*Do nothing*/
          break;
      }
      
      

mysqli_free_result($result);
mysqli_close($con);
 ?>

