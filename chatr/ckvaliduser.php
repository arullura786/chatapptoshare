<?php

 $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
  if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
if(isset($_POST['luser'])){
$username= $_POST['luser'] ;}else{$_SESSION['username']=$_POST['luser'];}
if(isset($_POST['lpass'])){
$password= $_POST['lpass'] ;}else{$_SESSION['password']= $_POST['lpass'];}

$_SESSION['username']=$username;
    $_SESSION['password']=$password;


    $query="SELECT emailid,password FROM chatrusers WHERE emailid='$username' AND password='$password'";
   $result = mysqli_query( $mysqli,$query);

	 if(! $result ) {
      die('Could not get data: ' . mysqli_error());
   }
   if(mysqli_num_rows($result) == 0)
   {
         ?>
     <script type="text/javascript">
       alert("User Id and Password is  wrong");
       history.back();
          </script>
  <?php
   }
   else if(mysqli_num_rows($result)== 1)
   {
       session_start();
        $_SESSION['username']=$_POST['luser'];
    $_SESSION['password']=$_POST['lpass'];
       header("location:profile.php");
   }
   else{
         ?>
     <script type="text/javascript">
       alert("Id and Password is twice..pls visit sql server database");
       history.back();
          </script>
  <?php
   }




?>
