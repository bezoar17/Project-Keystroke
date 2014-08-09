<?php 

$con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
mysqli_free_result($result);
mysqli_close($con); 
?>
$.get("getmono.php",{username:'<?php echo $user; ?>'},function(data){prevmono=data;}).done(function(data){
  document.getElementById('log').innerHTML += prevmono;});
  $.get("getpp.php",{username:'<?php echo $user; ?>'},function(data){prevpp=data;}).done(function(data){
  document.getElementById('log').innerHTML += prevpp;});
  $.get("getpr.php",{username:'<?php echo $user; ?>'},function(data){prevpr=data;}).done(function(data){
  document.getElementById('log').innerHTML += prevpr;});
  $.get("getrr.php",{username:'<?php echo $user; ?>'},function(data){prevrr=data;}).done(function(data){
  document.getElementById('log').innerHTML += prevrr;});