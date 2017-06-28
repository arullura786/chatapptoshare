<?php

 $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
  if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
if(isset($_POST['emailid'],$_POST['ans1'],$_POST['ans1']))
    {



    $query="SELECT * FROM `forgetquestion` WHERE `answer1`='".$_POST['ans1']."' AND `answer2`='".$_POST['ans2']."' AND `emailid`='".$_POST['emailid']."'";
   $result = mysqli_query( $mysqli,$query);

	 if(! $result ) {
      die('Could not get data: ' . mysqli_error());
   }
   if(mysqli_num_rows($result) == 0)
   {
         ?>
     <script type="text/javascript">
       alert("Answer is  wrong");
       history.back();
          </script>
  <?php
   }
   else if(mysqli_num_rows($result)== 1)
   {
       $query="SELECT * FROM `chatrusers` WHERE `emailid`='".$_POST['emailid']."'";
   $result = mysqli_query( $mysqli,$query);
   while ($row = mysqli_fetch_array($result)) {
       session_start();
        $_SESSION['username']=$row['emailid'];
    $_SESSION['password']=$row['password'];
       header("location:profile.php");
   }
   
   }
  

}
 else{
         ?>
     <script type="text/javascript">
       alert("Enter the Emailid ");
       history.back();
          </script>
  <?php
   }

?>

