<?php
 $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
  if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
   
if(isset($_REQUEST['username'], $_REQUEST['emailid'],$_REQUEST['setpass'], $_REQUEST['conformpass']))
                {
$compass=$_REQUEST['conformpass'];
$setpass=$_REQUEST['setpass'];
if($compass==$setpass)
{
    if(isset($_REQUEST['username'], $_REQUEST['emailid'],$_REQUEST['setpass'], $_REQUEST['conformpass']))
                {
                    $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
                    if($mysqli->errno)
                    {
		        header("location: home.php");
                    }
        $stmt = mysqli_query($mysqli,"SELECT COUNT(emailid) AS total FROM chatrusers WHERE emailid = '".$_REQUEST['emailid']."'");
	
  while($re = mysqli_fetch_assoc($stmt))
  {      
      if($re['total'] == 0 )
  
                 {
                   $stmt = mysqli_query($mysqli,"SELECT COUNT(username) AS total FROM chatrusers WHERE username = '".$_REQUEST['username']."'");
	
  while($re = mysqli_fetch_assoc($stmt))
  {      
      if($re['total'] == 0 ) 
                 {
                    if(isset($_REQUEST['username'], $_REQUEST['emailid'],$_REQUEST['setpass'], $_REQUEST['conformpass']))
                        {
                         $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
                           if($mysqli->errno)
		               header("location: home.php");

                             $sql = "INSERT INTO chatrusers (username,emailid,password) VALUES ( '{$mysqli->real_escape_string($_REQUEST['username'])}', '{$mysqli->real_escape_string($_REQUEST['emailid'])}', '{$mysqli->real_escape_string($_REQUEST['setpass'])}' )";
                             $insert = $mysqli->query($sql);
                             $mysqli->close();
    ?>

<script type="text/javascript">
    alert("Success!!! Dear User <?php echo  $_REQUEST['username']; ?> account created!!!");
    history.back();
  </script>

    <?php
                        }
                             }
                  else 
        {
         ?>

<script type="text/javascript">
    alert("Username already exits..Enter valid  username !!!");
    history.back();
  </script>

    <?php  
                }
  }
                             
                             }
                
  
                    
                             
     else 
        {
         ?>

<script type="text/javascript">
    alert("UnSuccess!!! Dear User..Enter valid  Emailid !!!");
    history.back();
  </script>

    <?php  
                }
  }
                }
}
                else 
        {
         ?>

<script type="text/javascript">
    alert("Enter same password");
    history.back();
  </script>

    <?php  
                }
                }  
            ?>






<html>

<head>

	<title>sample-Signup</title>

        <link rel="stylesheet" href="css/signinheader.css">
        <link rel="stylesheet" href="css/company.css">
       
           
</head>


<body onload="document.form.emailid.focus()" oncontextmenu="return false" onselectstart="return false" ondragstrat="return false">
<br>
       <div class="main-content">
           <form name="form" class="form-labels-on-top"  method="REQUEST"  action="<?php  $_PHP_SELF ?>">

            <div class="form-title-row">
                <h1>Sample Sign Up</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>User Name</span>
                    <input type="text" name="username" required>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>E-mail ID</span>
                    <input type="text" name="emailid"required>
                </label>
            </div>
               
            <div class="form-row">
                <label>
                    <span>Set Password</span>
                    <input type="password" name="setpass"required>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Conform Password</span>
                    <input type="password" name="conformpass"required>
                </label>
            </div>
            
           
            <div class="form-row">
                <input type="submit" name="submit" value="Submit" onclick="return ValidateEmail(document.form.emailid)" >
                
            </div><br><br>
<a class="login-link" href="signin.php">Have an Account..Sign in?</a>
        </form>
    </div>

 <div class="container">

			
            <div class="codrops-top">
                <a href="home.html">
                    <strong>&laquo; Previous </strong>
                </a><br>
                
                </span>
            </div>
     <script>
         function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
document.form.emailid.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
 document.form.emailid.focus();


return false;
}

}
     </script>
    
</body></html>



