<?php
   $con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");
    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $user=$_POST["username"];$pass=$_POST["password"];     
      $sql="INSERT INTO users (username,password) VALUES ('$user','$pass')";  
      mysqli_query($con,$sql);      
      mysqli_free_result($result);
      mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

</body>
</html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Keystroke data</title>
  
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    
  <!-- Google Fonts-------------------------------------------------------------- -->
  <link href='http://fonts.googleapis.com/css?family=Nixie+One' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=UnifrakturCook:700|Monoton|Ewert' rel='stylesheet' type='text/css'>
  <!-- --------------------------------------------------------------Google Fonts -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->
  
  <style>

  body{
  }
  input {
    display: block;
    margin-bottom: .25em;
  }
 
  .print-output-line {
    white-space: pre;
    padding: 5px;
    font-family: monaco, monospace;
    font-size: .7em;

  }
  #target{
    height: auto;
    width: 500px;
    text-align:top;
    background-color: #E0F8D8;
  }
  </style>
  <script src="jquery.js"></script>
  <script type="text/javascript" src="bootstrap.js"></script>

</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50" screen_capture_injected="true">
 
<div class="container">
  <div class="row">
          <form id="ultimateinput" class="well">
          <label for="target">Type Password:</label>
          <input id="target" type="text" class="span3" placeholder="">  
           <span class="help-block">Type password without special keys and press Enter. Refresh or press enter before next input</span>
          </form>
  </div>
  <div class="row">
          
            <button id="other" class="btn btn-success">REGISTER THE DATA</button>
            <button id="otherdel" class="btn btn-info">REFRESH</button>
            <a href="index.html" class="btn">REGISTER ANOTHER USER</a>
            <a href="#modalforauthenticate" role="button"  data-toggle="modal">
            <h1>AUTHENTICATE USER</h1>
            </a> 
  </div>
  
    <p id="log"> </p>
  
</div>

  <div id="modalforauthenticate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel" style="text-transform:none;">Authenticate</h3>
  </div>
  <div class="modal-body">
  <form class="well form-inline" id="formauthenticate" action="validate.php" method="post">
  <input type="text" name="username" id="username" class="input-large" placeholder="Username : max 12 chars">
    <br></br>
  <input type="text" name="password" id="password" class="input-large" placeholder="Password : max 12 chars">
    <br></br>
  <button type="submit" class="btn btn-custom" style="opacity:1;" >Go For It</button>
</form>
  </div>

</div>
<script src="plugins.js"></script>
<script src="main.js"></script>
<script type="text/javascript" src="events.js"></script> 
<script type="text/javascript">
//variable declaration
var xTriggeredu = 0;var xTriggeredd = 0;var collectarray=[]; 
var counterspecialist=15;

var passwordc="<?php echo $pass;?>";var passwordk;

var i,j,k;//iteration variables
var temp,temp1,temp2,temp3,temp4,temp5,temp6,temp7;//temporary variables
var flag,flag1;//flag variables

//declaration of feature indice variables

var mono=[],pr=[],pp=[],rr=[],rrr=[];
var jsonmono,jsonpr,jsonpp,jsonrr,jsonrrr;
var finalmono=[],finalpr=[],finalpp=[],finalrr=[],finalrrr=[];


$("#other").click(function() {    
  //take average of final 
  for(i=0; i<finalpr.length;i++)
              {                                
                finalpp[i].timec/=10;                
                finalpr[i].timec/=10;                
                finalrr[i].timec/=10;
              }
               
  for(i=0;i<finalmono.length;i++)
  {
    finalmono[i].timec/=10;
  }
  for(i=0;i<finalrrr.length;i++)
  {
    finalrrr[i].timec/=10;
  }
  //convert to json
  jsonmono=JSON.stringify(finalmono);
  jsonpr=JSON.stringify(finalpr);
  jsonpp=JSON.stringify(finalpp);
  jsonrr=JSON.stringify(finalrr);
  jsonrrr=JSON.stringify(finalrrr);
  //posting the data
  $.post("post.php",{ mono:jsonmono,pp:jsonpp,pr:jsonpr,rr:jsonrr,rrr:jsonrrr,username:'<?php echo $user;?>'})
   .done(function (){alert("SUCCESSFULLY COLLECTED");});  
  collectarray=[];
  document.getElementById("target").value="";
  xTriggeredu=0;
  xTriggeredd=0;
  });
$("#otherdel").click(function() {
  collectarray=[];
  document.getElementById("target").value="";
  document.getElementById("log").innerHTML="";
  xTriggeredd=0;
  xTriggeredu = 0;
  });
$( "#target" ).keyup(function( event ){
                                        if(event.which != 13)
                                        {
                                        xTriggeredu++;
                                        var msg = "Handler for .keyup() called " + xTriggeredu + " time(s).";
                                        $.print( msg, "html" );
                                        collectarray.push(new collect(event.which,"keyup",event.timeStamp)); 
                                        }    
                                        else{}                                     
                                      })
              .keydown(function( event){
                                        if ( event.which == 13 ) 
                                        {
                                          event.preventDefault();
                                          passwordk=$("#target").val();
                                                      
                                               

                                          if(passwordk == passwordc)
                                          {
                                             //CORRECT PASSWORD

                                            if(counterspecialist<10 && counterspecialist>0)
                                            {
                                              sessionattempts();
                                            }
                                            else{}                                                                                    
                                            //reset 
                                            refreshtheform();                                            
                                          }
                                          else
                                          { 
                                            // WRONG PASSWORD ENTERED
                                            
                                            document.getElementById("log").innerHTML="WRONG PASSWORD TRY AGAIN";
                                            justrefresh();                                           
                                            
                                          }
                                        }
                                        else
                                        {
                                          xTriggeredd++;
                                          var msg1 = " \t \t \t \t \t \t Handler for .keydown() called " + xTriggeredd + " time(s).";
                                          $.print( msg1, "html"); 
                                          collectarray.push(new collect(event.which,"keydown",event.timeStamp));
                                        }
                                        
                                      }); 
// Implementation of registration of data 


  
function justrefresh()
{
  collectarray=[];
  document.getElementById("target").value="";
  
  xTriggeredd=0;
  xTriggeredu = 0; 
}
//creation of object collect
function collect(keycodec,eventc,timec)
{
this.keycodec=keycodec;
this.eventc=eventc;
this.timec=timec;
}
//constructor for aggr array elements
function aggr(keycodec, timec)
{
  this.keycodec=keycodec;
  this.timec=0;
}
//constructor for pr, pp, rr object
function dimono(keycodec,timec)
{
  this.keycodec=keycodec;
  this.timec=timec;
  this.ocurrences=1;
}
//function to check if a key event is contained in monograph/digraph array
function containselem(a, elem) {
    for (var x = 0; x < a.length; x++) {
        if (a[x].keycodec == elem) {
            return x; //returning index if element found
        }
    }
    return -1;//returning -1 if element not found
}
//initializing all aggr arrays

for(var k=0; k<passwordc.length;k++)
{
  finalmono.push( new aggr("",0));  
}
for(var k=0; k<passwordc.length-1;k++)
{
  finalpp.push( new aggr("",0));
  finalpr.push( new aggr("",0));
  finalrr.push( new aggr("",0));
  
}
for(var k=0; k<passwordc.length-2;k++)
{
  
  finalrrr.push( new aggr("",0));
}
//declaration of variables used


// resetting the values
function refreshtheform()
{
  justrefresh();
  counterspecialist--; 
  if(counterspecialist >0)
  {document.getElementById("log").innerHTML="Type" + counterspecialist + "times"; }
  else
    {document.getElementById("log").innerHTML="Register and you are Done";}  

}
// evaluation and summation
function sessionattempts(){
              flag1=0;
              //populating monograph and digraph arrays
              for (i =0;i<collectarray.length-2;i++)
              {

                if(collectarray[i].eventc=="keydown"){
                  //finding next keydown and adding to 2pp
                  
                  for(j=i+1;j<collectarray.length;j++)
                  {

                    if(collectarray[j].eventc=="keydown")
                    {
                      temp=collectarray[j].timec-collectarray[i].timec;
                      temp4=collectarray[i].keycodec;
                      temp5=collectarray[j].keycodec;
                      temp1=temp4+""+temp5;
                      break;
                    }
                  }
                  if(j==collectarray.length){i=collectarray.length;}
                  else
                  {
                  //finding next keyup and adding to 2pr
                  flag=j;//storing keydown index of second letter of digraph
                  //finding keyup of first letter of digraph
                  
                  for(j=i+1;collectarray[j].keycodec!=temp4;j++){}
                  temp6=collectarray[j].timec;
                  //finding keyup of second letter of digraph
                  for(j=flag+1;collectarray[j].keycodec!=temp5;j++){}
                  temp7=collectarray[j].timec;
                  temp2=containselem(pp,temp1);
                  //adding time to 2pp
                  if(temp2==-1){
                    pp.push(new dimono(temp1,temp));
                  }else{
                    temp3=pp[temp2].timec*pp[temp2].ocurrences +temp;
                    pp[temp2].timec=temp3/(pp[temp2].ocurrences+1);
                    pp[temp2].ocurrences++;
                  }
                  //adding time to 2pr
                  temp=temp7-collectarray[i].timec;
                  temp2=containselem(pr,temp1);
                  if(temp2==-1){
                    pr.push(new dimono(temp1,temp));
                  }else{
                    temp3=pr[temp2].timec*pr[temp2].ocurrences +temp;
                    pr[temp2].timec=temp3/(pr[temp2].ocurrences+1);
                    pr[temp2].ocurrences++;
                  }
                  //adding time to 2rr
                  temp=Math.abs(temp7-temp6);
                  temp2=containselem(rr,temp1);
                  if(temp2==-1){
                    rr.push(new dimono(temp1,temp));
                  }else{
                    temp3=rr[temp2].timec*rr[temp2].ocurrences +temp;
                    rr[temp2].timec=temp3/(rr[temp2].ocurrences+1);
                    rr[temp2].ocurrences++;
                  }
                  //adding time to 1pr
                  temp=temp6-collectarray[i].timec;
                  temp2=containselem(mono,collectarray[i].keycodec);
                  if(temp2==-1){
                    mono.push(new dimono(collectarray[i].keycodec,temp));
                  }else{
                    temp3=mono[temp2].timec*mono[temp2].ocurrences +temp;
                    mono[temp2].timec=temp3/(mono[temp2].ocurrences+1);
                    mono[temp2].ocurrences++;
                  }
                  //rrr calculation here
                  for(k=flag+1;k<collectarray.length && flag1==0;k++){
                  if(collectarray[k].eventc=="keydown")
                    {
                      temp5=collectarray[k].keycodec;
                      temp4=collectarray[i].keycodec;
                      temp1=temp4+""+temp5;
                      break;
                    }
                  }
                  if (k==collectarray.length) {flag1=1;}
                  else{
                    for(k=k+1;k<collectarray.length;k++){
                      if (collectarray[k].keycodec==temp5) {
                        temp=collectarray[k].timec-collectarray[i].timec;
                        temp2=containselem(rrr, temp1);
                        if(temp2==-1){
                          rrr.push(new dimono(temp1,temp));
                        }else{
                          temp3=rrr[temp2].timec*rrr[temp2].ocurrences +temp;
                          rrr[temp2].timec=temp3/(rrr[temp2].ocurrences+1);
                          rrr[temp2].ocurrences++;
                        }
                      }
                    }
                  }//end of rrr calculation
                }
              }
              }
              //getting the last monograph
              flag=collectarray.length-3
              if(collectarray[flag].event=="keydown")
              {
                temp=collectarray[flag+1].timec - collectarray[flag].timec;
                temp1=collectarray[flag].keycodec;
                temp2=containselem(mono,temp1);
                if(temp2==-1){
                  mono.push(new dimono(temp1,temp));
                }else{
                  temp3=mono[temp2].timec*mono[temp2].ocurrences +temp;
                  mono[temp2].timec=temp3/(mono[temp2].ocurrences+1);
                  mono[temp2].ocurrences++;
                }
              }
              //adding 1pr, 2pp, 2pr, 2rr values to arrays storing aggr value of all sessionattemptss
              for(i=0; i<pr.length;i++)
              {
                finalpp[i].keycodec=pp[i].keycodec;
                finalpp[i].timec+=pp[i].timec;
                finalpr[i].keycodec=pr[i].keycodec;
                finalpr[i].timec+=pr[i].timec;
                finalrr[i].keycodec=rr[i].keycodec;
                finalrr[i].timec+=rr[i].timec;                
              }

              for (i=0; i<mono.length;i++ )
              {
                finalmono[i].keycodec=mono[i].keycodec;
                finalmono[i].timec+=mono[i].timec;
              }
              for (i =0; i <= finalrrr.length; i++) {
                finalrrr[i].keycodec=rrr[i].keycodec;
                finalrrr[i].timec+=rrr[i].timec;
              }
              //deleting end qtyiapa
              for ( i = finalmono.length-1; i >=0; i--) {
                if(finalmono[i].timec==0)
                {
                  finalmono.pop();
                }
                else{}
              }
              for ( i = finalpp.length-1; i >=0; i--) {
                if(finalpp[i].timec==0)
                {
                  finalpp.pop();
                }
                else{}
              }
              for ( i = finalpr.length-1; i >=0; i--) {
                if(finalpr[i].timec==0)
                {
                  finalpr.pop();
                }
                else{}
              }
            for ( i = finalrr.length-1; i >=0; i--) {
                if(finalrr[i].timec==0)
                {
                  finalrr.pop();
                }
                else{}
              }
            for ( i = finalrrr.length-1; i >=0; i--) {
                if(finalrrr[i].timec==0)
                {
                  finalrrr.pop();
                }
                else{}
              }

                 }
// end of sessionattempts
// collection of keystrokes in collectarray and registration 


</script>
 
  



<script type="text/javascript"> 

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36060270-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>
