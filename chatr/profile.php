<?php
session_start();
    if(!isset($_SESSION['username'],$_SESSION['password']))
    {
        header("location:signin.php");

    }
     $name=$_SESSION['username'];
$pass=$_SESSION['password'];
?>

<html>
    
    <link rel="stylesheet" href="css/usermenu.css" />
    <link rel="stylesheet" href="css/homeheader.css" />
    
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
        .thum{
            width: 450px;
            height: 300px;
            max-width: 1024px;
            max-height: 1024px;
            margin-left: 400px;
            margin-right: 40px;
            margin-top: -50px;
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
           padding-top: 50px;
           
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

.center img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
    
}

.center img:hover {
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
         <title>Sample-Profile </title>
    </head>
    <body>
        
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
				$db = mysql_connect($hostnamev, $db_userv, $db_passwordv);
$query = "INSERT INTO userprofileimg ( image,emailid ) VALUES ('profileimages/p.jpg','{$name}')";
mysql_query($query) or die('Error, query failed');
$chatruser = mysql_query("UPDATE chatrusers SET profileimage='profileimages/p.jpg' WHERE emailid='{$name}'")
or die(mysql_error());
 $chatruserm = mysql_query("UPDATE messages SET profileimgfromid='profileimages/p.jpg' WHERE fromemailid='{$name}'")
or die(mysql_error());
   
 $chatruseri = mysql_query("UPDATE messagesinbox SET profileimgtoid='profileimages/p.jpg' WHERE toemailid='{$name}'")
or die(mysql_error());
 $chatrcomment = mysql_query("UPDATE overallcomments SET senderprofileimage='profileimages/p.jpg' WHERE senderemailid='{$name}'")
or die(mysql_error());
				} 
 else {
while($row = mysql_fetch_array($resultv))
	{
echo "<a  href=".$row['image']."><img border=\"0\" src=\"".$row['image']."\"  alt=\"No Profile Image\"style=\"width:150px\" height=\"150px\"></a>";
}
 }
?>
                    </center>
             <div class="thum">
                <?php
                 $dbhost = 'localhost';
   $dbuser = 'chatr';
   $dbpass = 'chatr';


   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");

   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }



   $sql = "SELECT * FROM chatrusers WHERE emailid='".$_SESSION['username']."'";

   $retval = mysqli_query( $conn ,$sql);

   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }

   while($row = mysqli_fetch_assoc($retval))
       {
     
         echo "<h4>Username :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"  .$row['username']."<br><br>";
             
          echo  " E-mail Id :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['emailid']."<br><br>";
            
           echo  "Password  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['password']."</h4> " ; 
           
       }
       ?>
                
                </div> 
        </div>
    </body>
</html>