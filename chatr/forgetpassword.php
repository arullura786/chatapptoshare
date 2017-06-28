
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Chatr-forgetpassword</title>
  
<div class="codrops-top">
    &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
       &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
       <a href="signin.php"><strong>&laquo; Previous </strong>
                </a>             </div>
 

 <link rel="stylesheet" href="css/forgetpw.css">

   <link rel="stylesheet" type="text/css" href="css/signinheader.css">
</head>
<style>
    .questionset{
            width: 450px;
            height: 300px;
            max-width: 1024px;
            max-height: 1024px;
            margin-left: 250px;
            margin-right: 40px;
            margin-top: 0px;
            background: #fff;
            background: rgba(255, 255, 255, 0.5);
            padding-top: 80px;
            padding-left: 10px;
        }
</style>
<script>
    /* ------------------------------------ Click on login and Sign Up to  changue and view the effect
---------------------------------------
*/

function cambiar_login() {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";  
document.querySelector('.cont_form_login').style.display = "block";
document.querySelector('.cont_form_sign_up').style.opacity = "0";               

setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },400);  
  
setTimeout(function(){    
document.querySelector('.cont_form_sign_up').style.display = "none";
},200); 
return true;
  }

function cambiar_sign_up(at) {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
  document.querySelector('.cont_form_sign_up').style.display = "block";
document.querySelector('.cont_form_login').style.opacity = "0";
  
setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
},100);  

setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
},400);  

return true;
}    



function ocultar_login_sign_up() {

document.querySelector('.cont_forms').className = "cont_forms";  
document.querySelector('.cont_form_sign_up').style.opacity = "0";               
document.querySelector('.cont_form_login').style.opacity = "0"; 

setTimeout(function(){
document.querySelector('.cont_form_sign_up').style.display = "none";
document.querySelector('.cont_form_login').style.display = "none";
},500);  
 return true; 
  }
</script>
<body>
    
  <div class="cotn_principal">


  <div class="cont_login">
<div class="cont_info_log_sign_up">
      <div class="col_md_login">
<div class="cont_ba_opcitiy">
        
        <h2>EMAIL ID</h2>  
  
  <button class="btn_login" onclick="return cambiar_login()">Submit</button>
  </div>
  </div>
<div class="col_md_sign_up">
<div class="cont_ba_opcitiy">
  <h2>Question Set</h2>

  
  

  <button class="btn_sign_up" onclick="return cambiar_sign_up()">Check It</button>
</div>
  </div>
       </div>

    
    <div class="cont_back_info">
       
       
    </div>
<div class="cont_forms" >
   
 <div class="cont_form_login">
     <form name="ckemail"  method="GET" action="<?php $_PHP_SELF ?>"  onSubmit="return cambiar_login()"   >
         <br> <h2>Email Id</h2>
   <br>
         <input type="text"  name='emailid' placeholder="Email id" />
      <br>   <input type="submit" class="btn_login" value="Submit Email Id" > 

     </form>
   
  </div>
  
   <div class="cont_form_sign_up">
       <form name="ckemail" onsubmit="return cambiar_sign_up()" method="post" action="ckquestset.php">
     <h2>Questions</h2>
      <?php
  if(isset($_GET['emailid']))
  {
      $dbhost='localhost';
      $dbuser='chatr';
      $dbpass='chatr';
      $conn=  mysqli_connect($dbhost, $dbuser, $dbpass,'chatr');
      $ques="SELECT * FROM forgetquestion WHERE emailid= '".$_GET['emailid']."' ";
      $getques=  mysqli_query($conn, $ques);
     if(mysqli_num_rows($getques) == 0)
   {
         ?>
     <script type="text/javascript">
       alert("Email Id  is  wrong");
       history.back();
          </script>
  <?php
   }
   else if(mysqli_num_rows($getques)== 1)
   { 
       while($row= mysqli_fetch_array($getques)) 
      {
        echo"Question 1 :".$row['question1']."";
        ?>
       <input type="text" name="ans1" placeholder="Answer 1" />
     <?php
         echo"Question 2 :".$row['question2']."";
         ?>
         <input type="text" name="ans2" placeholder="Answer 2" />
     <?php
     echo"<input type=hidden name=emailid value='".$row['emailid']."'>";
          }
  mysqli_close($conn);
  }
  }
 
  ?>
         
  <input type="submit" class="btn_sign_up" value="Check">
 </form>
  </div>


    
  </div>
      
 </div>
</div>
 

</body>
</html>
