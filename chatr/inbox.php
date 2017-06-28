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
   
    <link rel="stylesheet" href="css/table.css" />
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
        height:auto;
        min-height: 150px;
        
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
body .center{
            width: auto;
            height: auto;
            min-height: 1024px;
            margin-left: 90px;
            margin-right: 40px;
            margin-top: 80px;
            margin-bottom: 10px;
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

.center img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
.center #sty img {
  float: left;
  margin-right: 10px;
  border-radius: 50%;
  width: 50px;
  height:50px;
}
.center #sty
{
	margin:0 auto;
	margin-top:auto;
	border:#ddd solid 3px ;
       
        height: auto;
	width:700px;
	padding:5px;
	}
        #nameid
{
	font-size:18px;
	color:#000000;
	font-family:"Comic Sans MS", cursive;
	margin-bottom:5px;
}
.center #comment_form {
	margin-top:15px;
}

.center #comment_form input {
	font-size:1.2em;
	margin:0 0 10px;
	padding:3px;
	display:block;
	width:50%;
}
.center #comment_body {
	display:block;
	width:500px;
	height:200px;
        margin: 40px;
        
}
#divContent
{
  height: 0px;
  width: 100%; 
  overflow: hidden;
  margin:auto;
  background: #fff;  
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
         <title>sample-inbox </title>
    </head>
    <body>
        
          <header class="header">
         <div class="font">Sample!!! stay online</div>
         <a href="signout.php">signout</a>
         
     </header>
         
      <ul class="cbp-vimenu">
         <li><a href="profile.php" class="icon-logo"><img src="images/profile.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="profile.php" class="icon-location"><img src="images/friends2.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="comments.php" class="icon-archive"><img src="images/comments1.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="indichat.php" class="icon-pencil"><img src="images/indichat.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li> 
         <li><a href="inbox.php" class="icon-search"><img src="images/receive.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="outbox.php" class="icon-pencil"><img src="images/sendmsg2.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
         <li><a href="deletetrash.php" class="icon-images"><img src="images/delete4.jpg" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>
            <li><a href="setting.php" class="icon-download"><img src="images/setting.png" vspace="18px" align="left" hspace="18px" width=36; height=36;></a></li>

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

   $sql = "SELECT * FROM chatrusers WHERE emailid ='".$_SESSION['username']."' ";

   $retval = mysqli_query( $conn ,$sql);

        
   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }
while($row = mysqli_fetch_assoc($retval))
{
    $sqlinbox = "SELECT toid,message,createdat,id,profileimgtoid FROM messagesinbox WHERE fromid ='".$row['username']."' ";

   $r = mysqli_query( $conn ,$sqlinbox);
   while($row = mysqli_fetch_assoc($r))
       {
     echo "<div id='sty'>";
	echo "<img src='".$row['profileimgtoid']."' "."width='50px' height='50px' align='left' />";
	echo "<div id='nameid'>From :".$row['toid']."&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp<font align='right'color='black'> Time:".$row['createdat']."</font> ";
	
        
       echo " &nbsp &nbsp&nbsp &nbsp<a href='?run=".$row['id']."' >Delete</a>";
        echo "<br><br>".$row['message']."</div>";
	
						echo '<table border="0">';
                                                echo '<tr>';
									echo "<form name='subcomm' action=''  method='get'>";
										
										echo '<input name="namename" type="hidden" value="'.$row['toid'].'">';
										
										
									echo '<td><input name="message" type="text" style="width: 400px;" class="form-control input-sm" placeholder="To Reply ...">';
									echo '</form>';
								echo '</tr>';				
								echo '</table>';
        
       
        echo "</div><br />";
   }
   mysqli_close($conn);
}
   ?>
        <?php
// reply message
if(isset($_REQUEST['namename'], $_REQUEST['message']))
                        {
                         $mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
                           if($mysqli->errno)
                           {
		               header("location: home.php");
                           }
                           $select="select * from chatrusers where username= '{$mysqli->real_escape_string($_REQUEST['namename'])}'";
                           $qry =$mysqli->query($select);
                            
                           if(mysqli_num_rows($qry)==1)
                           {
                               $selectfromid="select * from chatrusers where emailid= '{$mysqli->real_escape_string($_SESSION['username'])}'";
                           $qryfromid =$mysqli->query($selectfromid);
                            while($row = mysqli_fetch_assoc($qryfromid))
                            {
                             $sqlsend = "INSERT INTO messages (fromid,message,toid,profileimgfromid,fromemailid) VALUES ( '".$row['username']."', '{$mysqli->real_escape_string($_REQUEST['message'])}', '{$mysqli->real_escape_string($_REQUEST['namename'])}','".$row['profileimage']."','{$mysqli->real_escape_string($_SESSION['username'])}' )";
                             $insert = $mysqli->query($sqlsend);
                             $sqlreceiver = "INSERT INTO messagesinbox (toid,message,fromid,profileimgtoid,toemailid) VALUES ( '".$row['username']."', '{$mysqli->real_escape_string($_REQUEST['message'])}', '{$mysqli->real_escape_string($_REQUEST['namename'])}','".$row['profileimage']."','{$mysqli->real_escape_string($_SESSION['username'])}' )";
                             $insert = $mysqli->query($sqlreceiver);
                             $mysqli->close();
                            }
                            ?><script>
    alert("Message Send To  <?php echo $_REQUEST['namename']?>");
    history.back();
</script>
<?php
                        }
                        else
                            {?>
<script>
    alert('Invalid Our Friend Name');
</script>
                          <?php  }
                        
                             }
   
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
    $sqldelete = "SELECT toid,message,fromid,createdat FROM messagesinbox WHERE id ='".$_GET['run']."' ";

   $r = mysqli_query( $conn ,$sqldelete);
   while($row = mysqli_fetch_assoc($r))
   {
    $insert="INSERT INTO messagesdelete (fromid,message,toid,emailid,createdat) VALUES ( '".$row['toid']."', '".$row['message']."', '".$row['fromid']."','".$_SESSION['username']."','".$row['createdat']."' )";
   $rinsert = mysqli_query( $conn ,$insert);
    $deletemsg=" DELETE FROM messagesinbox WHERE `id`='".$_GET['run']."'";
    $delete = mysqli_query( $conn ,$deletemsg);
    mysqli_close($conn);
    ?><script>
    alert("Message is Deleted");
    history.back();
</script>
<?php
   }
}
else 
{
   
}

?>   
                   
        </div>
    </body>
</html>