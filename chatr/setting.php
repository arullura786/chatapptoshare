<?php
session_start();
    if(!isset($_SESSION['username'],$_SESSION['password']))
    {
        header("location:signin.php");

    }
     $name=$_SESSION['username'];
     $pass=$_SESSION['password'];
?>

    <?php
    // set forget questions
    if(isset($_REQUEST['q1'],$_REQUEST['q2'],$_REQUEST['a1'],$_REQUEST['a2']))
    {
    $dbhost = 'localhost';
               $dbuser = 'chatr';
                $dbpass = 'chatr';


   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");
   $name=$_SESSION['username'];


    $query="SELECT emailid FROM forgetquestion WHERE emailid='$name'";
   $result = mysqli_query( $conn,$query);

	 if(! $result ) {
      die('Could not get data: ' . mysqli_error());
   }
   if(mysqli_num_rows($result) == 0)
   {
                   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr") OR DIE ("Unable to select db".mysql_error());

                    $sql = "INSERT INTO forgetquestion
                    (emailid, question1,question2,answer1,answer2)
                    VALUES
                    ('{$name}', '".$_REQUEST['q1']."','".$_REQUEST['q2']."','".$_REQUEST['a1']."','".$_REQUEST['a2']."');";


                    mysqli_query($conn,$sql) or die("Error in Query: " . mysqli_error());
             ?>    <script type="text/javascript">
       alert("Question is saved");
       history.back();
          </script>
          <?php
   }
  else if(mysqli_num_rows($result) == 1)
  {
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");
      $updatequestion= "UPDATE forgetquestion SET question1='".$_REQUEST['q1']."',question2='".$_REQUEST['q2']."',answer1='".$_REQUEST['a1']."',answer2='".$_REQUEST['a2']."',emailid='{$name}' WHERE emailid='{$name}'";
    mysqli_query($conn,$updatequestion);
    mysqli_close($conn);
    ?>    <script type="text/javascript">
       alert("Question is updated");
       history.back();
          </script>
          <?php
  }
    }
?>
<?php
//change profile image

$hostname = "localhost";
$db_user = "chatr";
$db_password = "chatr";
$database = "chatr";
$db_table = "userprofileimg";

$db = mysql_connect($hostname, $db_user, $db_password);
mysql_select_db($database,$db);
$uploadDir = 'profileimages/';
if(isset($_POST['Submit']))
{
$fileName = $_FILES['Photo']['name'];
$tmpName  = $_FILES['Photo']['tmp_name'];
$fileSize = $_FILES['Photo']['size'];
$fileType = $_FILES['Photo']['type'];
$filePath = $uploadDir . $fileName;
$result = move_uploaded_file($tmpName, $filePath);

if (!$result) {
echo "Error uploading file";
exit;
}
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
	$filePath = addslashes($filePath);
}
$name=$_SESSION['username'];


   $db = mysql_connect($hostname, $db_user, $db_password);
    $queryu="SELECT emailid FROM userprofileimg WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
$query = "INSERT INTO $db_table ( image,emailid ) VALUES ('$filePath','{$name}')";
mysql_query($query) or die('Error, query failed');
$chatruser = mysql_query("UPDATE chatrusers SET profileimage='$filePath' WHERE emailid='{$name}'")
or die(mysql_error());
 $chatruserm = mysql_query("UPDATE messages SET profileimgfromid='$filePath' WHERE fromemailid='{$name}'")
or die(mysql_error());
   
 $chatruseri = mysql_query("UPDATE messagesinbox SET profileimgtoid='$filePath' WHERE toemailid='{$name}'")
or die(mysql_error());
 $chatrcomment = mysql_query("UPDATE overallcomments SET senderprofileimage='$filePath' WHERE senderemailid='{$name}'")
or die(mysql_error());
 ?><script>
    alert("Profile Picture is Changed");
    history.back();
</script>
<?php
}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    $update= "UPDATE userprofileimg SET image='$filePath',emailid='{$name}' WHERE emailid='{$name}'";
    mysql_query($update);
    $chatruser = mysql_query("UPDATE chatrusers SET profileimage='$filePath' WHERE emailid='{$name}'")
or die(mysql_error());
  
  
  $chatruserm = mysql_query("UPDATE messages SET profileimgfromid='$filePath' WHERE fromemailid='{$name}'")
or die(mysql_error());
   
 $chatruseri = mysql_query("UPDATE messagesinbox SET profileimgtoid='$filePath' WHERE toemailid='{$name}'")
or die(mysql_error());
 $chatrcomment = mysql_query("UPDATE overallcomments SET senderprofileimage='$filePath' WHERE senderemailid='{$name}'")
or die(mysql_error());
 ?><script>
    alert("Profile Picture is Changed");
    history.back();
</script>
<?php
   }
}
//end :change profile picture
?>

<html>
    <link rel="stylesheet" href="css/usermenu.css" />
    <link rel="stylesheet" href="css/homeheader.css" />
    <link rel="stylesheet" href="css/settingpasswordform.css" />
  
    <style>
        header a{
    color:#000;
    float: right;
    text-decoration: none;
    display: inline-block;
    padding: 16px ;
    margin: 10px;
    border-radius: 1px;
    font: bold 14px/1 'Open Sans', sans-serif;
    text-transform: uppercase;
    background-color:#f3f3f3;
        }
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
        .center{
            width: 93%;
            height: auto;
            min-height: 1024px;
            margin-left: 90px;
            margin-right: 40px;
            margin-top: 80px;
            background: #fff;
            background: rgba(255, 255, 255, 0.5);
           padding-top: 30px;

        }
    .center img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;

}

.center img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
        .profileimg{
            margin-top: 400px;
            margin-left: 1000px;
            border: 1px solid #ddd;
            border-radius: 4px;
              padding: 5px;
             width: 150px;
        }
html{

}

	body{
	font:14px/1.5 Arial, Helvetica, sans-serif;
	margin:0;
       
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

}


.changeback img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
    margin-left: 10px;
}

.changeback img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

    </style>
 <?php
         $hostname = "localhost";
$db_user = "chatr";
$db_password = "chatr";
$database = "chatr";
$db_table = "bgimage";
 $name=$_SESSION['username'];
$db = mysql_connect($hostname, $db_user, $db_password);
mysql_select_db($database,$db);
$bgimg="SELECT * FROM bgimage WHERE emailid='{$name}'";
$resbg=mysql_query($bgimg);
if(mysql_num_rows($resbg)==1)
{
while($row =  mysql_fetch_array($resbg))
{
?>
   <style> 
       body{
           background-image:url("<?php echo $row['bgimage'];?>");
       }
   </style>
       <?php
}
}
 else {
    ?>
   <style> 
       body{
           background-image:url("backgroundimages/1527_eyeinthesky_1600x1200.jpg");
       }
   </style>
       <?php
 }
 ?>
    <head>
<title>sample-setting </title>
    </head>
    <body >

          <header class="header">
         <div class="font">Sample!!! stay online</div>
         <a href="signout.php">signout</a>

     </header>

      <ul class="cbp-vimenu">
         <li><a href="profile.php" title="Profile" class="icon-logo"><img src="images/profile.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="friends.php" title="Friends" class="icon-location"><img src="images/friends2.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="comments.php" title="Comments" class="icon-archive"><img src="images/comments1.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
          
         <li><a href="indichat.php" title="Chat" class="icon-pencil"><img src="images/indichat.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li> 
         <li><a href="inbox.php" title="Inbox" class="icon-search"><img src="images/receive.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="outbox.php" title="Outbox"  class="icon-pencil"><img src="images/sendmsg2.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
				
				
         <li><a href="deletetrash.php" title="Trash"  class="icon-images"><img src="images/delete4.jpg" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="setting.php"  title="Setting" class="icon-download"><img src="images/setting.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>

     </ul>
        <div class="center">

            <fieldset class="changepp"><legend><h4>Change Profile Picture</h4></legend>
                <center> <?PHP
$hostnamev = "localhost";
$db_userv = "chatr";
$db_passwordv = "chatr";
$databasev = "chatr";
$db_tablev = "userprofileimg";
 $name=$_SESSION['username'];
$db = mysql_connect($hostnamev, $db_userv, $db_passwordv);
mysql_select_db($databasev,$db);
$queryv = "SELECT * FROM $db_tablev WHERE emailid = '$name'";
$resultv = mysql_query($queryv) or die(mysql_error());
 if(mysql_num_rows($resultv) == 0){
     
					echo "<a  href='profileimages/p.jpg'><img border=\"0\" src='profileimages/p.jpg'  alt=\"No Profile Image\"style=\"width:150px\" height=\"150px\"></a>";

				}
 else {
	while($row = mysql_fetch_array($resultv))
	{
echo "<a  href=".$row['image']."><img border=\"0\" src=\"".$row['image']."\"  alt=\"No Profile Image\"style=\"width:150px\" height=\"150px\"></a>";
}
 }
?>

                </center><br>
                 <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                     <center>
Select the Profile Image :<input type="file" name="Photo"  accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" ><br><br>
<INPUT type="submit" class="button" name="Submit" value="  Submit  ">
&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel"></center>
</form>
                <form method="get">
                  <center>   <INPUT type="hidden" name="delete" class="button" name="Submit" value="1">
                    <INPUT type="submit"  class="button" name="Submit" value="  Remove Profile  ">
               </center> </form>
                <?php
                if(isset($_GET['delete']))
                {
                     $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
                    $del="DELETE FROM userprofileimg WHERE emailid='{$name}'";
                    $delete=mysqli_query($mysqli,$del);
                   
                    $query = "INSERT INTO userprofileimg( image,emailid ) VALUES ('profileimages/p.jpg','{$name}')";
mysqli_query($mysqli,$query) or die('Error, query failed');
$chatruser = mysqli_query($mysqli,"UPDATE chatrusers SET profileimage='profileimages/p.jpg' WHERE emailid='{$name}'")
or die(mysqli_error());
 $chatruserm = mysqli_query($mysqli,"UPDATE messages SET profileimgfromid='profileimages/p.jpg' WHERE fromemailid='{$name}'")
or die(mysqli_error());
   
 $chatruseri = mysqli_query($mysqli,"UPDATE messagesinbox SET profileimgtoid='profileimages/p.jpg' WHERE toemailid='{$name}'")
or die(mysqli_error());
 $chatrcomment = mysqli_query($mysqli,"UPDATE overallcomments SET senderprofileimage='profileimages/p.jpg' WHERE senderemailid='{$name}'")
or die(mysqli_error());
                    ?>
                <script>
                    alert("Profile Picture is Deleted");
                    histroy.back();
                </script>
                <?php
                }
                ?>
            </fieldset>



            <fieldset class="changepw"><legend><h4>Change Password</h4> </legend>
                <form class="form-3" action="<?php $_PHP_SELF ?>" name="" method="get">
					<p class="float">
						<label for="studentname"><i class="icon-lock"></i>Emailid</label>
						<input type="text" name="emailidp"  required>
                                        </p>

                                        <p class="float">
						<label for="password"><i class="icon-lock"></i>OLD PASSWORD</label>
						<input type="text" name="oldpassword"  required>
					</p>
                                        <br><br>
                                        <p class="float">
						<label for="password"><i class="icon-lock"></i>NEW PASSWORD</label>
						<input type="text" name="newpassword"  required>
					</p>
                                        <p class="float">
						<label for="password"><i class="icon-lock"></i>AGAIN NEW PASSWORD</label>
						<input type="text" name="cnewpassword"  required>
					</p>


                                        <br><p class="clearfix">

                                               <br><input type="submit" name="update" value="CHANGE NOW">
					</p>
				</form>

            </fieldset>

            <?php
             // change password
            if(isset($_GET['emailidp'],$_GET['oldpassword'],$_GET['newpassword'],$_GET['cnewpassword'],$_SESSION['username'],$_SESSION['password']))
{

    $username=$_GET['emailidp'];
    $oldpassword=$_GET['oldpassword'];
    $newpassword=$_GET['newpassword'];
    $cnewpassword=$_GET['cnewpassword'];
    $name=$_SESSION['username'];
$pass=$_SESSION['password'];
if($name == $username)
{
    if($newpassword == $cnewpassword)
    {
 $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
  if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }



    $query="SELECT * FROM chatrusers WHERE emailid='$username' AND password='$oldpassword'";
   $result = mysqli_query( $mysqli,$query);

	 if(! $result ) {
      die('Could not get data: ' . mysqli_error());
   }
   if(mysqli_num_rows($result) == 0)
   {
       ?>
     <script type="text/javascript">
       alert(" old password is worng..Mr/Mrs");
       history.back();
          </script>
<?php

   }
   else if(mysqli_num_rows($result)== 1)
   {
       $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
  if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
       $sql = "UPDATE chatrusers SET password='$newpassword'  WHERE emailid= '$username' AND password= '$oldpassword'";
$update = $mysqli->query($sql);
?>
     <script type="text/javascript">
       alert(" password is changed..");
       history.back();
          </script>
<?php


  $mysqli->close();


   }
}
}

  }
  //End : change Password
            ?>
            <fieldset class="changeback"><legend><h4>Change Background</h4> </legend>
                 <a  href="?bgimg=1">
                            <img id="src" name=img src="backgroundimages/1235_flower24_1600x1200.jpg" alt="no img" style="width:150px" onclick="" >
                     </a>

                 <a  href="?bgimg=2" >
                     <img src="backgroundimages/1239_blacktree_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=3" >
                     <img src="backgroundimages/1240_seagulls_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=4">
                     <img src="backgroundimages/1241_summerbutterfly_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=5">
                     <img src="backgroundimages/1242_lightzonthewater_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=6">
                     <img src="backgroundimages/1244_newcastleridge_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=7">
                     <img src="backgroundimages/1245_wildhorse_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=8">
                     <img src="backgroundimages/1246_sludge_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=9">
                     <img src="backgroundimages/1247_highwayatnight_1600x1200.jpg" alt="no img" style="width:150px">
</a>

                 <a  href="?bgimg=10">
                     <img src="backgroundimages/1251_fruit_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=11">
                     <img src="backgroundimages/1252_joe_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=12">
                     <img src="backgroundimages/1253_silence_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=13">
                     <img src="backgroundimages/1254_asilhouetteofwar_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=14">
                     <img src="backgroundimages/1255_miscbutterfly_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=15">
                     <img src="backgroundimages/1256_karlsruhe_1600x1200.jpg" alt="no img" style="width:150px">
</a>

             <a  href="?bgimg=16">
                 <img src="backgroundimages/1274_flower26_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=17">
                     <img src="backgroundimages/1275_rainbowhearts_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=18">
                     <img src="backgroundimages/1276_lightmovement_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=19">
                     <img src="backgroundimages/1280_marshlandsunset_1600x1200_2.jpg" alt="no img" style="width:150px">
</a>

                 <a  href="?bgimg=20">
                     <img src="backgroundimages/1284_baltimoreturtle_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=21">
                     <img src="backgroundimages/1285_ufo_1600x1200_3.jpg" alt="no img" style="width:150px">
</a>

                 <a  href="?bgimg=22">
                     <img src="backgroundimages/1288_esontown_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=23">
                     <img src="backgroundimages/1291_connemara_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=24">
                     <img src="backgroundimages/1293_purpleflowers_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=25">
                     <img src="backgroundimages/1294_breakingthrough_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=26">
                     <img src="backgroundimages/1295_freedom_1600x1200.jpg" alt="no img" style="width:150px">
</a>

                 <a  href="?bgimg=27">
                     <img src="backgroundimages/1298_sanfran_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=28">
                     <img src="backgroundimages/1299_darkday2_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=29">
                     <img src="backgroundimages/1441_greenfieldsofsweden_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=30">
                     <img src="backgroundimages/1443_utahlakeatdusk_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=31">
                     <img src="backgroundimages/1445_wispyurbansunset_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=32">
                     <img src="backgroundimages/1446_lonesunset_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=33">
                     <img src="backgroundimages/1449_sunflower_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=34">
                     <img src="backgroundimages/1450_ansesourcedagent_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=35">
                     <img src="backgroundimages/1452_serradaestrelaportugal_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=36">
                     <img src="backgroundimages/1455_mdredbarnhdr_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=37">
                     <img src="backgroundimages/1456_reverie_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=38">
                     <img src="backgroundimages/1457_colorfulplacevcolor_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                  <a  href="?bgimg=39">
                      <img src="backgroundimages/1277_californianfarmsunset_1600x1200.jpg" alt="no img" style="width:150px">
</a>

                 <a  href="?bgimg=40">
                     <img src="backgroundimages/1506_moodywaters_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=41">
                     <img src="backgroundimages/1520_chicagoskyline_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=42">
                     <img src="backgroundimages/1524_awalkintime_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=43">
                     <img src="backgroundimages/1527_eyeinthesky_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                 <a  href="?bgimg=44">
                     <img src="backgroundimages/1528_crocus_1600x1200.jpg" alt="no img" style="width:150px">
</a>
                  <a  href="?bgimg=45">
                      <img src="backgroundimages/1264_leaf40_1600x1200.jpg" alt="no img" style="width:150px">
</a>
               <?php
//change background
                if(isset($_GET['bgimg']))
                {
                    $linkchoice=$_GET['bgimg'];
                 $name=$_SESSION['username'];

                    $database = "chatr";
                   $hostname = 'localhost';
               $db_user = 'chatr';
                $db_password = 'chatr';
               $db = mysql_connect($hostname, $db_user, $db_password);
              mysql_select_db($database,$db);

           switch($linkchoice){

case '1' :
    
                     $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1235_flower24_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET filepath='backgroundimages/1235_flower24_1600x1200.jpg',bgimage='backgroundimages/1235_flower24_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
    ?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
  }
    break;

case '2' :
                             $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1239_blacktree_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1239_blacktree_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
  
    ?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
    }
    break;

case '3' :
                $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1240_seagulls_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1240_seagulls_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
    ?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
  }
    break;

case '4' :
                $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1241_summerbutterfly_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1241_summerbutterfly_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '5' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1242_lightzonthewater_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1242_lightzonthewater_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php  

    }
    break;

case '6' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1244_newcastleridge_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1244_newcastleridge_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
    }
    break;
case '7' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1245_wildhorse_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1245_wildhorse_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '8' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1246_sludge_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1246_sludge_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
    ?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
  }
    break;
case '9' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1247_highwayatnight_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1247_highwayatnight_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
    }
    break;

case '10' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1251_fruit_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1251_fruit_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
    }
    break;
case '11' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1252_joe_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1252_joe_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php  }
    break;

case '12' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1253_silence_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1253_silence_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php  }
    break;

case '13' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1254_asilhouetteofwar_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1254_asilhouetteofwar_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php  

    }
    break;

case '14' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1255_miscbutterfly_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1255_miscbutterfly_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '15' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1256_karlsruhe_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1256_karlsruhe_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php 
}
    break;

case '16' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1274_flower26_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1274_flower26_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php 
}
    break;
case '17' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1275_rainbowhearts_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1275_rainbowhearts_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '18' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1276_lightmovement_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1276_lightmovement_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '19' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1280_marshlandsunset_1600x1200_2.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1280_marshlandsunset_1600x1200_2.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '20' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1284_baltimoreturtle_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1284_baltimoreturtle_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '21' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1285_ufo_1600x1200_3.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1285_ufo_1600x1200_3.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '22' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1288_esontown_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1288_esontown_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '23' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1291_connemara_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1291_connemara_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '24' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1293_purpleflowers_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1293_purpleflowers_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '25' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1294_breakingthrough_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1294_breakingthrough_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '26' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1295_freedom_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1295_freedom_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '27' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1298_sanfran_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1298_sanfran_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '28' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1299_darkday2_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='1299_darkday2_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '29' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1441_greenfieldsofsweden_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1441_greenfieldsofsweden_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '30' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1443_utahlakeatdusk_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1443_utahlakeatdusk_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '31' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1445_wispyurbansunset_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1445_wispyurbansunset_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '32' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1446_lonesunset_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1446_lonesunset_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '33' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1449_sunflower_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1449_sunflower_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '34' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1450_ansesourcedagent_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1450_ansesourcedagent_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '35' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1452_serradaestrelaportugal_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1452_serradaestrelaportugal_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '36' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1455_mdredbarnhdr_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1455_mdredbarnhdr_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '37' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1456_reverie_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1456_reverie_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '38' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1277_californianfarmsunset_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1277_californianfarmsunset_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '39' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1277_californianfarmsunset_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1277_californianfarmsunset_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '40' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1506_moodywaters_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1506_moodywaters_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php 
}
    break;
case '41' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1520_chicagoskyline_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1520_chicagoskyline_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

case '42' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1524_awalkintime_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1524_awalkintime_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php 
}
    break;

case '43' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1527_eyeinthesky_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1527_eyeinthesky_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php 
}
    break;

case '44' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1528_crocus_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1528_crocus_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;
case '45' :
    $queryu="SELECT emailid FROM bgimage WHERE emailid='$name'";
   $resultu = mysql_query( $queryu);

	 if(! $resultu ) {
      die('Could not get data: ' . mysql_error());
   }
    if(mysql_num_rows($resultu) == 0)
   {
        $db = mysql_connect($hostname, $db_user, $db_password);
        mysql_select_db($database,$db);
$query = "INSERT INTO bgimage ( bgimage,emailid ) VALUES ('backgroundimages/1264_leaf40_1600x1200.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php

}
else if(mysql_num_rows($resultu) == 1)
  {
    $db = mysql_connect($hostname, $db_user, $db_password);
    mysql_select_db($database,$db);
    $result = mysql_query("UPDATE bgimage SET bgimage='backgroundimages/1264_leaf40_1600x1200.jpg',emailid='{$name}' WHERE emailid='{$name}'")
or die(mysql_error());

    mysql_query($result);
?><script>
    alert("Background Changed");
    history.back();
</script>
<?php
}
    break;

default :
    echo 'no run';

}


                }
                ?>
             </fieldset>
              <fieldset class="changepp"><legend><h4>Forget Password</h4></legend>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<center>

    Enter the question 1 :<input name="q1" type="text" required><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Answer 1 :&nbsp;&nbsp;&nbsp;
<input name="a1" type="text" required><br><br>
Enter the question 2 :<input name="q2" type="text" required><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Answer 2 :&nbsp;&nbsp;&nbsp;
<input name="a2" type="text" required><br><br>
<input type="submit" value="Set Question" /></center>
</form>
                  </fieldset>

            <fieldset><legend><h4>Your Previous Question Set(Forget Password)</h4></legend>
                <?php
                 $dbhost = 'localhost';
               $dbuser = 'chatr';
                $dbpass = 'chatr';


   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");
   $name=$_SESSION['username'];


    $query="SELECT * FROM forgetquestion WHERE emailid='$name'";
   $result = mysqli_query( $conn,$query);

	 if(! $result ) {
      die('Could not get data: ' . mysqli_error());
   }
   if(mysqli_num_rows($result) == 0)
   {
       echo "<center>No Data Found</center>";
   }
   else
   {
      while($row=mysqli_fetch_array($result))
      {
          echo"<center><div class='questionset'>Question 1 :".$row['question1']."<br><br>";
          echo"Answer 1 :".$row['answer1']."<br><br>";
          echo"Question 2 :".$row['question2']."<br><br>";
          echo"Answer 2 :".$row['answer2']."<br></div></center>";
      }
   }

                ?>
            </fieldset>
        </div>

    </body>

</html>


