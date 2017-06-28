<?php
session_start();
    if(!isset($_SESSION['username'],$_SESSION['password']))
    {
        header("location:signin.php");

    }
     $name=$_SESSION['username'];
$pass=$_SESSION['password'];

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
         <title>sample-indichat </title>
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
            

<style type="text/css">

#fileid
{
	width:85px;
	height:20px;
	}

#tnameid
{
	width:300px;
	font-size:20px;
	font-family:"Courier New", Courier, monospace;
	height:35px;
	color:#006;
	border:#666 solid 2px;
}

#tmessageid
{
	max-width:300px;
	max-height:300px;
	min-width:300px;
	min-height:300px;
	font-size:20px;
	font-family:"Courier New", Courier, monospace;
	color:#006;
	border:#666 solid 2px;
}
#one
{
	font-size:18px;
	font-family:"Times New Roman", Times, serif;
	color:#00F;
}
#submit
{
	width:200px;
	height:30px;
	background-color:#999;
	color:#FFF;
	border:#666 solid 2px;
}



</style>

<script type="text/javascript">
function validation()
{
	var nam=document.comment.namename.value;
	var nam1=document.getElementById('tnameid');
	if(nam=="")
	{
		document.comment.namename.focus();
		nam1.style.borderColor="#f00";
		return false;
	}
	var nam1=document.getElementById('tnameid');
	nam1.style.borderColor="";
	
	
	var mess=document.comment.message.value;
	var mess1=document.getElementById('tmessageid');
	if(mess=="")
	{
		document.comment.message.focus();
		mess1.style.borderColor="#f00";
		return false;
	}
}
</script>
<center><h4>CHAT WITH FRIENDS</h4></center>
<form name="comment" method="get" action="<?php $_PHP_SELF ?>" onSubmit="return validation()">
<table width="500" border="0" cellspacing="3" cellpadding="3" style="margin:auto;">
  <tr>
    <td align="right" id="one">Friend Name :<span style="color:#F00;">*</span></td>
    <td><input type="text" name="namename" id="tnameid" required="Friends Name"></td>
  </tr>
  
  <tr>
    <td align="right" id="one">Text :<span style="color:#F00;">*</span></td>
    <td><textarea name="message" id="tmessageid" required="Text"></textarea></td>
  </tr>
  <tr>
  <td align="right" id="one"></td>
  <td><input type="submit" name="submit" id="submit" value="Send Message"></td>
  </tr>
</table>
</form>

            
        </div>
    </body>
</html>


