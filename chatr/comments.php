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
    <script type='text/javascript' src='js/jquery.pack.js'></script>
    <script type='text/javascript'>
$(function(){
	$("a.reply").click(function() {
		var id = $(this).attr("id");
		$("#parent_id").attr("value", id);
		$("#name").focus();
	});
});
</script>
    <link rel="stylesheet" href="css/usermenu.css" />
    <link rel="stylesheet" href="css/homeheader.css" />
   
    <link rel="stylesheet" href="css/commends.css" />
       

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
            width: auto;
            height: auto;
            max-width: 1024px;
            
            margin-left: 50px;
            margin-right: 40px;
            margin-top: -50px;
            background: #fff;
            background: rgba(255, 255, 255, 0.5);
            padding-top: 10px;
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

  #wrapper {
	width:480px;
	margin:0px auto;
	padding:15px 0px;
}

.comment {
    font: 14px/1.5 Arial,Helvetica,sans-serif;
       width: auto;
       height:auto;
	
        padding-bottom: 30px;
	border-bottom: 1px dashed #000;
	margin-top:15px;
	list-style:none;
        margin-bottom:10px;
        margin-left: 30px;
        margin-right: 50px;
}

.aut {
	font-weight:bold;
}

.timestamp {
	font-size:85%;
	float:right;
}

#comment_form {
	margin-top:15px;
        margin-left: 100px;
        margin-right: 100px;
}

#comment_form input {
	font-size:1.2em;
	margin:0 0 10px;
	padding:3px;
	display:block;
	width:100%;
}

#comment_body {
	display:block;
	width:100%;
	height:150px;
}
.comment img 
{
    float: left;
  margin-right: 10px;
  border-radius: 50%;
  width: 50px;
  height:50px;
}
#submit_button {
	text-align:center; 
	clear:both;
        margin-left: 100px;
        margin-right: 100px;
        
        
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
         <title>sample-Commant </title>
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
            <div class="thum">
              
      
             <center>
            
             <div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion">
					  <div class="panel panel-primary">
						<div class="panel-heading">
						  <h5 class="panel-title">
							<a  title="What's on your mind?">
							We Chat!!!
							</a>
							</h5>
						</div>
						
						<form id="comment_form" action="<?php $_PHP_SELF ?>" method="POST">
						<div id="collapseOne" class="panel-collapse collapse">
						  <div class="panel-body">
							<input type='hidden' name='parent_id' id='parent_id' value='0'/>
							
							<textarea class="form-control input-sm" name="comment_body" placeholder="What's on your mind?"></textarea>
								
						</div>
						<div class="panel-footer" align="right">
							<button class="btn btn-primary btn-sm" type="submit" name="share">Share</button>
						</div>
						</div>
						</form>
					  </div>
					</div>	   
                                </div>
             </div></center>
<ul>
    
<?php
$q = "SELECT * FROM overallcomments WHERE parent_id = 0";
$r = mysql_query($q);
while($row = mysql_fetch_assoc($r)):
	getComments($row);
endwhile;
?>
</ul>




           
   <?php         
       function getComments($row) {
   

$mysqli = new MySQLi('localhost', 'chatr', 'chatr','chatr');
	echo "<div class='comment'>";
        echo"<a  href=".$row['senderprofileimage']."><img border=\"0\" src=\"".$row['senderprofileimage']."\" align='left' alt=\"No Profile Image\"style=\"width:50px\" height=\"50px\"></a>";
	echo "<div class='aut'>".$row['sendername']."</div>";
	echo "<div class='comment-body'>".$row['overallcommend']."</div>";
	echo "<div class='timestamp'>".$row['createdatcomm']."</div>";
       
	echo "<a href='#commend_form' class='reply' id=".$row['id']." >Comment</a>  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;<a  href='?like=".$row['id']."'>Like</a>  &nbsp;&nbsp;&nbsp;&nbsp; ".$row['likecount']." &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;<a  href='?unlike=".$row['id']."'>Unlike</a>&nbsp;&nbsp;&nbsp;&nbsp;".$row['unlikecount']."</div>";
  if(isset($_GET['like']))
  {
      $like="SELECT * FROM overallcomments WHERE id=".$_GET['like']."";
$likeresult=$mysqli->query($like);
while($result=mysqli_fetch_assoc($likeresult))
{
    $name=$_SESSION['username'];
    $query="SELECT * FROM likeuser WHERE likeid='".$_GET['like']."' AND likeparentid='".$result['parent_id']."' AND likeremailid='{$name}' ";
$resultquery=$mysqli->query($query);
    if(mysqli_num_rows($resultquery)==0)
    {
       $qlike = "INSERT INTO likeuser ( likeparentid,likeid,likeremailid) VALUES ( '".$result['parent_id']."','".$_GET['like']."','{$name}')";
$r = mysqli_query($mysqli,$qlike)or die("Can query errorlike");
 $res = mysqli_query($mysqli,"SELECT COUNT(*) as likecount FROM likeuser WHERE likeid='".$result['id']."' AND likeparentid='".$result['parent_id']."'") or die(mysqli_error());
                while($re = mysqli_fetch_assoc($res))
                        {
                    $qer="UPDATE overallcomments SET likecount='".$re['likecount']."' WHERE id='".$_GET['like']."'";
               $r = mysqli_query($mysqli,$qer)or die("Can query errorlike1");
                ?><script>
    alert("Post is liked");
    history.back();
    
</script>
<?php 
                    }
    }
 else {
     ?><script>
    alert("You are already liked");
    history.back();
    
</script>
<?php   
 }
    }
  }
  if(isset($_GET['unlike']))
  {
      $like="SELECT * FROM overallcomments WHERE id=".$_GET['unlike']."";
$likeresult=$mysqli->query($like);
while($result=mysqli_fetch_assoc($likeresult))
{
    $name=$_SESSION['username'];
    $query="SELECT * FROM unlikeuser WHERE unlikeid='".$_GET['unlike']."' AND unlikeparentid='".$result['parent_id']."' AND unlikeremailid='{$name}' ";
$resultquery=$mysqli->query($query);
    if(mysqli_num_rows($resultquery)==0)
    {
       $qlike = "INSERT INTO unlikeuser ( unlikeparentid,unlikeid,unlikeremailid) VALUES ( '".$result['parent_id']."','".$_GET['unlike']."','{$name}')";
$r = mysqli_query($mysqli,$qlike)or die("Can query errorlike");
 $res = mysqli_query($mysqli,"SELECT COUNT(*) as unlikecount FROM unlikeuser WHERE unlikeid='".$result['id']."' AND unlikeparentid='".$result['parent_id']."'") or die(mysqli_error());
                while($re = mysqli_fetch_assoc($res))
                        {
                    $qer="UPDATE overallcomments SET unlikecount='".$re['unlikecount']."' WHERE id='".$_GET['unlike']."'";
               $r = mysqli_query($mysqli,$qer)or die("Can query errorlike1");
                ?><script>
    alert("Post is Unliked");
    history.back();
    
</script>
<?php 
                    }
    }
 else {
     ?><script>
    alert("You are already Unliked");
    history.back();
    
</script>
<?php   
 }
    }
  }
	$q = "SELECT * FROM overallcomments WHERE parent_id = ".$row['id']."";
	$r =  $mysqli->query($q);
	if(mysqli_num_rows($r)>0)
		{
   		echo "<ul>";
		while($row = mysqli_fetch_assoc($r)) {
			getComments($row);
		}
		echo "</ul>";
		}
	
}     
            
            
 ?>           
          <?php
                if(isset($_REQUEST['comment_body'],$_REQUEST['parent_id']))
                {
$hostname = "localhost";
$db_username = "chatr";
$db_password = "chatr";

$link = mysqli_connect($hostname, $db_username, $db_password,"chatr") or die("Cannot connect to the database");

$comment_body = $_REQUEST['comment_body'];
$parent_id = $_REQUEST['parent_id'];
$name=$_SESSION['username'];
     $pass=$_SESSION['password'];
$query="SELECT * FROM chatrusers WHERE emailid= '$name' AND password= '$pass'";
$result=  mysqli_query($link, $query)or die("Can query error");
while($row=  mysqli_fetch_array($result))
{
$q = "INSERT INTO overallcomments ( overallcommend, parent_id,sendername,senderprofileimage,senderemailid) VALUES ( '$comment_body',' $parent_id','".$row['username']."','".$row['profileimage']."','$name')";
$r = mysqli_query($link,$q)or die("Can query errorinsert");
?><script>
    alert("Comment is Posted");
    history.back();
    
</script>
<?php
}
                }
?>  

            </div>
            
               
    
       
        </div>     
      
     
      
    </body>
</html>

