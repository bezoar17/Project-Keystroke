var xTriggeredu = 0;var xTriggeredd = 0;var collectarray=[]; 
var counterspecialist=25;

var passwordc="<?php echo $pass;?>";var passwordk;

var i,j;//iteration variables
var temp,temp1,temp2,temp3,temp4,temp5,temp6,temp7;//temporary variables
var flag;//flag variables

//declaration of feature indice variables

var mono=[],pr=[],pp=[],rr=[];
var jsonmono,jsonpr,jsonpp,jsonrr;
var finalmono=[],finalpr=[],finalpp=[],finalrr=[];

$("#formauthenticate").submit(function(event) {

      /* stop form from submitting normally */
      

      /* get some values from elements on the page: */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post */
      var posting = $.post( url,{ username: $('#username').val(), password: $('#password').val()} );

      /* Put the results in a div */
      posting.done(function( data ) {
        alert('success');

      });
    });

$("#other").click(function() {    
  //take average of final 
  for(i=0; i<finalpr.length;i++)
              {                                
                finalpp[i].timec/=15;                
                finalpr[i].timec/=15;                
                finalrr[i].timec/=15;
              }
               
  for(i=0;i<finalmono.length;i++)
  {
    finalmono[i].timec/=15;
  }
  //convert to json
  jsonmono=JSON.stringify(finalmono);
  jsonpr=JSON.stringify(finalpr);
  jsonpp=JSON.stringify(finalpp);
  jsonrr=JSON.stringify(finalrr);
  //posting the data
  $.post("post.php",{ mono:jsonmono,pp:jsonpp,pr:jsonpr,rr:jsonrr,username:'<?php echo $user;?>'})
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
                                        if(event.which == 8 || event.which == 46)
                                        {
                                        collectarray=[];
                                        document.getElementById("target").value="";
                                        if(event.which==8){document.getElementById("log").innerHTML="DO NOT USE BACKSPACE. TRY AGAIN";} else{}
                                        if(event.which==8){document.getElementById("log").innerHTML="DO NOT USE DELETE. TRY AGAIN";} else{}
                                        xTriggeredd=0;
                                        xTriggeredu = 0;
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

                                            if(counterspecialist<15 && counterspecialist>0)
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
                                            
                                            document.getElementById("log").innerHTML="WRONG PASSWORD. TRY AGAIN";
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
  document.getElementById("log").innerHTML=" ";
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
  this.timec=timec;
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
//declaration of variables used


// resetting the values
function refreshtheform()
{
  justrefresh();
  counterspecialist--; 
  if(counterspecialist >0)
  {document.getElementById("log").innerHTML="TYPE " + counterspecialist + " MORE TIMES"; }
  else
    {document.getElementById("log").innerHTML="REGISTER AND YOU ARE DONE";}  

}
// evaluation and summation
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
              flag=collectarray.length-2;
              for(;flag>0;flag--){
              if(collectarray[flag].eventc=="keydown")
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
                }break;
              }}
              
              
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
              //deleting qtiyapa
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
              
                 }
// end of sessionattempts
// collection of keystrokes in collectarray and registration 

