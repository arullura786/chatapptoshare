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
        .center img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 0px;
    width: 150px;
    
}
.center #sty img {
  float: left;
  margin-right: 10px;
  border-radius: 50%;
  width: 50px;
  height:50px;
}
#sty
{
    margin-top: -8px;
	border:#fff ;
        border-bottom: solid 2px;
        border-top: solid 1px;
        height: auto;
        min-height: 80px;
	width:auto;
	padding:5px;
        padding-left: 10px;
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
         <title>sample-Trash </title>
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
        <?php   
        $dbhost = 'localhost';
   $dbuser = 'chatr';
   $dbpass = 'chatr';


   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");

   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }

 $name=$_SESSION['username'];
     $pass=$_SESSION['password'];
        $view = "SELECT messagesdelete.id,messagesdelete.fromid,messagesdelete.toid,messagesdelete.createdat,messagesdelete.message,messagesdelete.deletedat, userprofileimg.image FROM messagesdelete INNER JOIN userprofileimg ON messagesdelete.emailid =userprofileimg.emailid WHERE messagesdelete.emailid='".$_SESSION['username']."' ";

   $r = mysqli_query( $conn ,$view) or  die('Could not connect: ' . mysqli_error());;
  while($row=  mysqli_fetch_array($r))
       {
     echo "<div id='sty'>";
	echo "<img src='".$row['image']."' "."width='50px' height='50px' align='left' />";
	echo "<div id='nameid'><font align='right'color='blue'>From :".$row['fromid']."&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbspCreated Time:".$row['createdat']."&nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp ";
	 
        echo "&nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbspDeleted Time :".$row['deletedat']."&nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp";
        echo "To:".$row['toid']."&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp</font><a href='?run=".$row['id']."' >Delete</a>";
         echo "<br><br><font color='black'>".$row['message']."</font></div>";
        
	echo "</div><br />";
   }
   mysqli_close($conn);
     ?>
            
       <?php 

if (isset($_GET['run']))
{
    $dbhost = 'localhost';
   $dbuser = 'chatr';
   $dbpass = 'chatr';
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass,"chatr");
    $linkchoice=$_GET['run']; 
     $name=$_SESSION['username'];
     $pass=$_SESSION['password'];
   
    $deletemsg=" DELETE FROM messagesdelete WHERE `id`='".$_GET['run']."'";
    $delete = mysqli_query( $conn ,$deletemsg);
    mysqli_close($conn);
   ?><script>
    alert("Message is Deleted");
    history.back();
</script>
<?php
}


?>         
        </div>
    </body>
</html>
