<!DOCTYPE html>
<html>
<head>
<title>News Made Simple</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
session_start();
$_SESSION['story']=null;
$_SESSION['yesorno']=null;
$_SESSION['message']=null;
if (isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
}
else {
	$email = "Guest";
	$fname = "Guest";
	$lname = "";
}
// CourseWiki for database connection

$mysqli = new mysqli('localhost', 'dc', 'dc330', 'news');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
<div id="logo">
<h1><a href="home.php">News Made Simple</a></h1>
		<p></p>
</div>
<div id="menu">
	<ul>
	<form action = "type.php" method = "POST">
		<li><a href="" title=""><input type = "submit" name="ntype" value="%">All</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Pol%">Pol</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Tec%">Tech</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Hea%">Health</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Fin%">Finance</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Spo%">Sports</a></li>
		<li><a href="" title=""><input type = "submit" name="ntype" value="Oth%">Others</a></li>
	</form>
	<div id= "xyz">
		<?php if ($email!="Guest"){ ?><li><a href="NWSaddStory.php" title="">Add Story</a></li>
		<li><a href="logout.php" title="">Logout</a></li><?php echo"";}?>
		<?php if ($email=="Guest"){ ?><li><a href="NWSlogin.php" title="">Login</a></li>
		<li><a href="NWScreateAccount.php" title="">Sign Up</a></li><?php echo"";}?>
	</div>
	</ul>
</div>
<div id="page">
<h2 class="title"><a href="#">Welcome <?php echo $fname." ".$lname;?></a></h2>
	<div id="content">
	<?php
		/*if(isset($_SESSION['page']))
			echo "Hello";
		else
			echo "Hahaha".$_SESSION['page'];
		$myvar = "";
		if(isset($_SESSION['page'])){
			$myvar = $_SESSION['page'];
			$_SESSION['page']=null;
		}
		echo "This".$myvar;
		*/
		$myvar="%";
		$stmt = $mysqli->prepare("select news_id, link, owner, first_name, last_name, title, content, newsdate from users, stories where stories.owner = users.email_address and stories.type like ? order by newsdate desc");
		if(!$stmt){
				 printf("Query Prep Failed: %s\n", $mysqli1->error);
		exit;
		}
		$stmt->bind_param('s',$myvar);
		$stmt->execute();
		$stmt->bind_result($news_id, $link, $owner, $first_name, $last_name, $title, $content, $newsdate);
		echo "<ul>\n";
		while($stmt->fetch()){
	?>
		<div class="post">
		<h3 class="title">
	<a href = "<?php echo $link;?>"><?php
	printf("\t<li>%s",htmlspecialchars($title));
	?>
	</a></h3>
	<div class="entry">
		<?php $news_img="images/".$news_id.".jpg" ?>
		<p><a href = "<?php echo $link;?>"><img src="<?php echo $news_img;?>" class="alignleft" /></a><?php printf("\t<li>%s",htmlspecialchars($content));?></p>
		<p class="clearfix"></p>
		</div>
		Posted by <?php echo $first_name." ".$last_name;?> at <?php echo $newsdate."<br><br>";?><a href="story.php" class="comments">
		<form action = '<?php $_SESSION['story']=$news_id;?>' method ='POST'>
		<?php
		echo "Comments ";
		$mysqli1 = new mysqli('localhost', 'dc', 'dc330', 'news');
		$stmt1 = $mysqli1->prepare("select count(comment_id) from comments where comments.news_id = ?");
		$stmt1->bind_param('i', $news_id);
		$stmt1->execute();
		$stmt1->bind_result($comm_count);
		while($stmt1->fetch())
			echo "(".$comm_count.")";
		$stmt1->close();
		//$mysqli1->close();
		?>
		</form>
		</a>
		<a href="" class="comments">
		<?php
		$like="Like";
		$stmt1 = $mysqli1->prepare("select user from likes where news_id = ?");
		$stmt1->bind_param('i', $news_id);
		$stmt1->execute();
		$stmt1->bind_result($user);
		while($stmt1->fetch()){
			if($user==$email){
				$like="You like this. Likes";
				break;
			}
		}
		$stmt1->close();
		?>
		<a href="like.php" class="comments">
		<form action = '' method = 'POST'>
		<?php echo "newsid".$news_id;?>
		<?php $_SESSION['story']=$news_id;?>
		<input type = 'hidden' name = 'story1' value="<?php echo $news_id;?>">
		<?php
		echo $like;
		$stmt1 = $mysqli1->prepare("select count(news_id) from likes where news_id = ?");
		$stmt1->bind_param('i', $news_id);
		$stmt1->execute();
		$stmt1->bind_result($like_count);
		while($stmt1->fetch())
		 echo " (".$like_count.")";
		$stmt1->close();
		$mysqli1->close();
		?>
		</input>
		</form>
		<?php
		
		?>
</p>
		<p class="clearfix">&nbsp;</p>
		</div>
		<?php } ?>
		<?php
	/* 
	 ?>
		<div style="clear: both;">&nbsp;</div>
	</div>
	<div id="sidebar">		<ul>
			<li>
			<?php
/* 					<h2><% Response.write(rs1("fname")&" "&rs1("lname"))%></h2>
			</li>
           <li>
		      <% link1="images/user/"& rs1("img") &".jpg" %>
               <img src="<% Response.write(link1)%> " alt="" class="alignleft" />
               </li>
				<li>
				<h2>Profile Info</h2>
				<ul>
					<li><%Response.write(" DOB : "&rs1("dd")&"-"&rs1("mm")&"-"&rs1("yy"))%></li>
					<li><a href="friends.asp">Friends</a></li>
					<li><%Response.Write(rs1("nat"))%></li>
					<li><%Response.Write(rs1("loc"))%></li>
				</ul>
			</li>
		</ul>
	</div>
 	*/	?>

<div style="clear: both;">&nbsp;</div>
</div>
</div>
</body>
</html>