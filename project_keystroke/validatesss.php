<?php
   $con=mysqli_connect("localhost","tonystark","ebin2","project_keystroke");
    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $user=$_REQUEST["username"];$pass=$_REQUEST["password"];             
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
  <style>
  body{
    height: auto;
   /*background-image: -webkit-gradient(
                        linear,
                        left top,
                        left bottom,
                        color-stop(0, #FD46FE),
                        color-stop(0.85, #63CEFF)
                      );
                      background-image: -o-linear-gradient(bottom, #FD46FE 0%, #63CEFF 85%);
                      background-image: -moz-linear-gradient(bottom, #FD46FE 0%, #63CEFF 85%);
                      background-image: -webkit-linear-gradient(bottom, #FD46FE 0%, #63CEFF 85%);
                      background-image: -ms-linear-gradient(bottom, #FD46FE 0%, #63CEFF 85%);
                      background-image: linear-gradient(to bottom, #FD46FE 0%, #63CEFF 85%);*/
                      background-color: white;
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
</head>
<body>
 

<form id="ultimateinput">
    <label for="target">Type Something:</label>
    <input id="target" type="text">
</form>   
  <button id="otherdel">REFRESH</button>
  <a href="index.html" class="btn">REGISTER ANOTHER USER</a>
  <br>
  <br>
  <p id="display">
    
  </p>
  <br>
  <br>
  <br>
  <p id="display2"></p>
<br>
<br>
<br>

<p id="log"> </p>
<br>
<script src="http://api.jquery.com/jquery-wp-content/themes/jquery/js/plugins.js"></script>
<script src="http://api.jquery.com/jquery-wp-content/themes/jquery/js/main.js"></script>
<script type="text/javascript" src="events.js"></script> 
<script type="text/javascript">
//variable declaration
var xTriggeredu = 0;var xTriggeredd = 0;var collectarray=[]; 
var safecount=0;var threshold=.35;
var passwordc="<?php echo $pass;?>";var passwordk;
var prevmono,prevpp,prevpr,prevrr;

var i,j;//iteration variables
var temp,temp1,temp2,temp3,temp4,temp5,temp6,temp7;//temporary variables
var flag;//flag variables

//declaration of feature indice variables
var mono=[],pr=[],pp=[],rr=[];
var jsonrevmono=[],jsonrevpr=[],jsonrevpp=[],jsonrevrr=[];
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
                                          safecount++;
                                          if(safecount>1)
                                          {
                                            passwordk=passwordk.substring(1,passwordk.length);
                                          }
                                          
                                          if(passwordk == passwordc)
                                          {
                                             //CORRECT PASSWORD 
                                             $.when(sessionattempts()).then(function( ) {  justcheck();},function(){document.write("error in session");});                                                                                 
                                             /* sessionattempts();
                                              justcheck();*/                                          
                                          }
                                          else
                                          { 
                                            // WRONG PASSWORD ENTERED                                            
                                            /*document.getElementById("log").innerHTML="WRONG PASSWORD TRY AGAIN";*/
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
  document.getElementById("target").value=" ";
  document.getElementById("log").innerHTML=" ";
  safecount=0;
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

//input processing
function sessionattempts(){
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
              
              
                 }
// end of sessionattempts
// collection of keystrokes in collectarray and registration 
function dist(s1,s2)
{
  var i=0, user_norm=[], input_norm=[], distance=0;
  var user_max=0, user_min=s1[0].timec, input_max=0, input_min=s2[0].timec;
  while(i<s1.length)
  {
    if(user_max<=s1[i].timec)
      user_max=s1[i].timec;
    if(user_min>=s1[i].timec)
      user_min=s1[i].timec;
    if(input_max<=s2[i].timec)
      input_max=s2[i].timec;
    if(input_min>=s2[i].timec)
      input_min=s2[i].timec;
    i++;
  } 
  i=0;
  while(i<s1.length)
  {
    user_norm[i]=(s1[i].timec-user_min)/(user_max-user_min);
    input_norm[i]=(s2[i].timec-input_min)/(input_max-input_min);
    distance+=(input_norm[i]-user_norm[i])*(input_norm[i]-user_norm[i]);
    i++;
  } 
  distance=distance/i;
  return distance;

}
function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}
function disorder(arr1,arr2)
{
  var i=0,j=0,diff=0,max;
  arr1.sort(dynamicSort("timec"));
  arr2.sort(dynamicSort("timec"));
  while(i<arr1.length)
  {
    j=0;
    while(j<arr2.length)
    {
      if(arr1[i].keycodec==arr2[j].keycodec)
      {
        if(i>=j)
          diff=diff+i-j;
        else
          diff=diff+j-i;
        break;
      }
      j++;
    }
    i++;
  }
  if(i%2==0)
    max=i*i/2;
  else
    max=(i*i-1)/2;
  diff=diff/max;
  return diff;      
}
function rvalueifsheety(s12,s22)
{
  var relvalue;
  var diff1=disorder(s12,s22);
  var i=0;
 /* while(s12[i]!=NULL)
    i++;*/
  return diff1;
} 
function justcheck()
{
  $.get("getmono.php",{username:'<?php echo $user; ?>'},function(data){prevmono=data;}).done(function(data){jsonrevmono=JSON.parse(prevmono);$.get("getpp.php",{username:'<?php echo $user; ?>'},function(data){prevpp=data;}).done(function(data){ jsonrevpp=JSON.parse(prevpp);$.get("getpr.php",{username:'<?php echo $user; ?>'},function(data){prevpr=data;}).done(function(data){ jsonrevpr=JSON.parse(prevpr);$.get("getrr.php",{username:'<?php echo $user; ?>'},function(data){prevrr=data;}).done(function(data){ jsonrevrr=JSON.parse(prevrr);
      var res = euclid(mono,pr,pp,rr,jsonrevmono,jsonrevpr,jsonrevpp,jsonrevrr);
      var ad=rvalueifsheety(rr,jsonrevrr);
        var average=0.6*ad+0.4*res; 
        document.write(res+" " ad+ " "+average); 
       /* document.getElementById("log").innerHTML=res+"  "+ad+" "+average;*/
      
   if(average<=threshold)
  {
   /*document.getElementById("display").innerHTML="WELCOME PROF";*/
  }
  else
  {
    /*document.getElementById("display").innerHTML="UNBREACHABLE";*/
  }

  //refresh
  collectarray=[];
  /*document.getElementById("target").value=" ";*/
  /*document.getElementById("log").innerHTML=" ";  */
  xTriggeredd=0;
  xTriggeredu = 0;
});});});
  });
  
}


function euclid(user_pr1, user_pr2, user_pp2, user_rr2, input_pr1, input_pr2, input_pp2, input_rr2)
{
  var i=0, data=[], av_data;
  data[0] = dist(user_pr1, input_pr1);
  data[1] = dist(user_pr2, input_pr2);
  data[2] = dist(user_pp2, input_pp2);
  data[3] = dist(user_rr2, input_rr2);
  av_data = (data[0]+data[1]+data[3]+data[2])/4;
 /* document.write((1-av_data)+" ");
  document.write(data[0]+" ");
  document.write(data[1]+" ");
  document.write(data[2]+" ");
  document.write(data[3]+" "); */ 
  return av_data;

}

</script>

</body>
</html>
