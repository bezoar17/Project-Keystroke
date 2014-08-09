<?php
$con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");
    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql="SELECT * FROM users";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
      mysqli_free_result($result);
      mysqli_close($con); 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>CONTROL</title>
 </head>
 <body>
        <form action="validate.php" method="post">
          <input type="radio" name="username" value="<?php echo $row[0]["username"] ?>"><?php echo $row[0]["username"] ?><br>
          
        </form>

        <?php 
          for ($i=0; $i <count($row) ; $i++)
           { 
            echo ""$row[i].username
           
          }
         ?>
 </body>
 </html>