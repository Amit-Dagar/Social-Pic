<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		include("background.php");
?>
<?php
	if(isset($_POST['delete_warning']))
	{
		$user_warning_id=intval($_POST['warning_id']);
		mysql_query("delete from user_warning where user_id=$user_warning_id;");
	}
	if(isset($_POST['delete_notice']))
	{
		$n_id=intval($_POST['notice_id']);
		mysql_query("delete from users_notice where notice_id=$n_id;");
	}
	if(isset($_POST['txt']))
	{
		$txt=$_POST['post_txt'];
		$priority=$_POST['priority'];
		$post_time=$_POST['txt_post_time'];
		mysql_query("insert into user_post(user_id,post_txt,post_time,priority) values('$userid','$txt','$post_time','$priority');");
	}
	
	if(isset($_POST['file']) && ($_POST['file']=='post'))
	{
		$txt=$_POST['post_txt'];
		$priority=$_POST['priority'];
		$post_time=$_POST['pic_post_time'];
		if($txt=="")
		{
			$txt="added a new photo.";
		}
		if($gender=="Male")
		{
			$path = "../../fb_users/Male/".$user."/Post/";
		}
		else
		{
			$path = "../../fb_users/Female/".$user."/Post/";
		}
		
		$img_name=$_FILES['file']['name'];
    	$img_tmp_name=$_FILES['file']['tmp_name'];
    	$prod_img_path=$img_name;
		if($gender=="Male")
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Male/".$user."/Post/".$prod_img_path);
		}
		else
		{
			move_uploaded_file($img_tmp_name,"../../fb_users/Female/".$user."/Post/".$prod_img_path);
		}
    	mysql_query("insert into user_post(user_id,post_txt,post_pic,post_time,priority) values('$userid','$txt','$img_name','$post_time','$priority');");
	}
	if(isset($_POST['delete_post']))
	{
		$post_id=intval($_POST['post_id']);
		mysql_query("delete from user_post where post_id=$post_id;");
	}
	if(isset($_POST['Like']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		mysql_query("insert into user_post_status(post_id,user_id,status) values($post_id,$user_id,'Like');");
	}
	if(isset($_POST['Unlike']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		mysql_query("delete from user_post_status where post_id=$post_id and  	user_id=$user_id;");
	}
	if(isset($_POST['comment']))
	{
		$post_id=intval($_POST['postid']);
		$user_id=intval($_POST['userid']);
		$txt=$_POST['comment_txt'];
		if($txt!="")
		{
		mysql_query("insert into user_post_comment(post_id,user_id,comment) values($post_id,$user_id,'$txt');");
		}
	}
	if(isset($_POST['delete_comment']))
	{
		$comm_id=intval($_POST['comm_id']);
		mysql_query("delete from user_post_comment where comment_id=$comm_id;");
	}
?>
<html>
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
<title>Social CS</title>
	<link href="Home_css/Home.css" rel="stylesheet" type="text/css">
	<script src="Home_js/home.js" language="javascript"></script>
    <script>
		function time_get()
		{
			d = new Date();
			mon = d.getMonth()+1;
			time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
			posting_txt.txt_post_time.value=time;
		}
		function time_get1()
		{
			d = new Date();
			mon = d.getMonth()+1;
			time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
			posting_pic.pic_post_time.value=time;
		}
	</script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
<style type="text/css">
.auto-style1 {
	color: #800000;
}
.auto-style2 {
	color: #000080;
}
</style>
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading" title="Log In to Social CS Network">Log In to Social CS.</h2><hr />
        
                  
                    <div > <img src="img/Status.PNG"><input type="button" onClick="upload_close();"  value="Update Status" style="background:#FFFFFF; border:#FFFFFF;"> </div>
 

	<form method="post" name="posting_txt" onSubmit="return blank_post_check();" id="post_txt">
	
	<div>
		<textarea style="height:100; width:380;" name="post_txt" maxlength="511" placeholder="What's on your mind?"></textarea>
        <input type="hidden" name="txt_post_time">
		<br>
	</div>	
	<div>
	<select style="background: transparent; border-bottom:5px;" name="priority"> 
<option value="Public"> Public </option> 
<option value="Private"> Only me </option> 
	</select> 
		<input type="submit" value="post" name="txt" id="post_button" onClick="time_get()"><br>
		<br> 
	</div>
	<div> &nbsp;<img src="img/photo&video.PNG"><input type="button"  value="+Add Photos" onClick="upload_open();" name="file1" style="background:#FFFFFF; border:#FFFFFF;" class="auto-style1"></div>
	</form>
	<div></div>
	<div><form class="form-signin" method="post" enctype="multipart/form-data" name="posting_pic" style="display:none;" id="post_pic" onSubmit="return Img_check();">
	
	<div>
		<textarea style="height:100; width:380;" name="post_txt" maxlength="511" placeholder="What's on your mind?"></textarea>
	</div>
    <input type="hidden" name="pic_post_time">
	<div>
	<select style="background: transparent; border-bottom:5px;" name="priority"> 
<option value="Public"> Public </option> 
<option value="Private"> Only me </option> 
</select> </div>
	<div> <input type="file" name="file" id="img"> </div>
	<div> <input type="submit" value="post" name="file" id="post_button" onClick="time_get1()"> </div>
	</form></div>
<hr />        
 <table class="form-signin" cellspacing="0">
<?php
	$que_post=mysql_query("select * from user_post where priority='Public' order by post_id desc");
	while($post_data=mysql_fetch_array($que_post))
	{
		$postid=$post_data[0];
		$post_user_id=$post_data[1];
		$post_txt=$post_data[2];
		$post_img=$post_data[3];
		$que_user_info=mysql_query("select * from users where user_id=$post_user_id");
		$que_user_pic=mysql_query("select * from user_profile_pic where user_id=$post_user_id");
		$fetch_user_info=mysql_fetch_array($que_user_info);
		$fetch_user_pic=mysql_fetch_array($que_user_pic);
		$user_name=$fetch_user_info[1];
		$user_Email=$fetch_user_info[2];
		$user_gender=$fetch_user_info[4];
		$user_pic=$fetch_user_pic[2];
?>
	<?php
		if($userid==$post_user_id)
		{ ?>
		<tr>
			<?php
			if($post_txt=="***Join Super Pic.***")
			{?>
				
						<?php
			}
			else
			{
			?>
			<td align="right" style="border-top:outset; border-top-width:thin;"> 
			<form method="post">  
				<input type="hidden" name="post_id" value="<?php echo $postid; ?>" />
				 
			</form></td>
		</tr>
		<?php
		}
		}
		else
		{ ?>
		<tr>
			<td colspan="4"align="right" style="border-top:outset; border-top-width:thin;"></td>
				</tr>
		<?php	
		}
	?>
 	
 	<tr>
		<td width="5%" style="padding-left:25;" rowspan="2"> <img src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Profile/<?php echo $user_pic; ?>" height="60" width="55"/>  </td>
			</tr>
	<tr>
		<td colspan="3" style="padding:7;"> <a href="../fb_view_profile/view_profile.php?id=<?php echo $post_user_id; ?>" style="text-transform:capitalize; text-decoration:none; color:navy;" onMouseOver="post_name_underLine(<?php echo $postid; ?>)" onMouseOut="post_name_NounderLine(<?php echo $postid; ?>)" id="uname<?php echo $postid; ?>"> <?php echo $user_name; ?> </a>  </td>
			</tr>
<?php
	$len=strlen($post_data[2]);
	if($len>0 && $len<=73)
	{
		$line1=substr($post_data[2],0,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7; color:gray;">Status:- <?php echo $line1; ?> </td>
	</tr>
	<?php
	}
	else if($len>73 && $len<=146)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
	?>
	<tr >
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr >
		<td> </td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>
	</tr>
	<?php
	}
	else if($len>146 && $len<=219)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line3; ?> </td>	
	</tr>
	<?php
	}
	else if($len>219 && $len<=292)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line3; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line4; ?> </td>	
	</tr>
	
	
	<?php
	}
	else if($len>292 && $len<=365)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line3; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line4; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line5; ?> </td>	
	</tr>
	
	
	<?php
	}
	else if($len>365 && $len<=438)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
		$line6=substr($post_data[2],365,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line3; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line4; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line5; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line6; ?> </td>	
	</tr>
	
	<?php
	}
	else if($len>438 && $len<=511)
	{
		$line1=substr($post_data[2],0,73);
		$line2=substr($post_data[2],73,73);
		$line3=substr($post_data[2],146,73);
		$line4=substr($post_data[2],219,73);
		$line5=substr($post_data[2],292,73);
		$line6=substr($post_data[2],365,73);
		$line7=substr($post_data[2],438,73);
	?>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line1; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line2; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line3; ?> </td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line4; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line5; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line6; ?> </td>	
	</tr>
	
	<tr>
		<td></td>
		<td colspan="3" style="padding-left:7;"><?php echo $line7; ?> </td>	
	</tr>
	
	<?php
	}
	?>
	<?php 
		if($post_data[3]!="")
		{
	?>
	<tr>
		<td>   </td>
		<td colspan="3"><img src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_Email; ?>/Post/<?php echo $post_img; ?>" width="380" height="400"/> </td>
		
		
	</tr>
	<?php
		}
	?>
	
	<tr style="color:#6D84C4;">
		<td >   </td>
		<?php
		 	$que_status=mysql_query("select * from user_post_status where post_id=$postid and user_id=$userid;");
			$que_like=mysql_query("select * from user_post_status where post_id=$postid");
			$count_like=mysql_num_rows($que_like);
			$status_data=mysql_fetch_array($que_status);
			if($status_data[3]=="Like")
			{?>
			
			<td style="padding-top:15; width: 25%;">
		<form method="post">
		<input type="hidden" name="postid" value="<?php echo $postid; ?>"/>
		<input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
			<img src="img/like.PNG"/><span style="color:#6D84C4;">(<?php echo $count_like; ?>)</span>&nbsp;&nbsp;
		<input type="submit" value="Unlike" name="Unlike" style="border:#FFFFFF; background:#FFFFFF; font-size:15px; color:#6D84C4;" onMouseOver="unlike_underLine(<?php echo $postid; ?>)" onMouseOut="unlike_NounderLine(<?php echo $postid; ?>)" id="unlike<?php echo $postid; ?>"/></form></td>
			<?php
			}
			else
			{?>
			<td style="padding-top:15; width: 294px;">
		<form method="post">
		<input type="hidden" name="postid" value="<?php echo $postid; ?>"/>
		<input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
		<input type="submit" value="Like" name="Like" style="border:#FFFFFF; background:#FFFFFF; font-size:15px; color:#6D84C4;" onMouseOver="like_underLine(<?php echo $postid; ?>)" onMouseOut="like_NounderLine(<?php echo $postid; ?>)" id="like<?php echo $postid; ?>"/></form></td>
			<?php
			}
		 ?>
		 <?php
		 
		 	$que_comment=mysql_query("select * from user_post_comment where post_id =$postid order by comment_id");
	$count_comment=mysql_num_rows($que_comment);
		 ?>
		
		<td colspan="3" style="width: 289px"> &nbsp; <input type="button" value="Comment(<?php echo $count_comment; ?>)" style="background:#FFFFFF; border:#FFFFFF;font-size:15px; color:#6D84C4;" onClick="Comment_focus(<?php echo $postid; ?>);" onMouseOver="Comment_underLine(<?php echo $postid; ?>)" onMouseOut="Comment_NounderLine(<?php echo $postid; ?>)" id="comment<?php echo $postid; ?>"/>   <span style="color:#800000;">   (<?php echo $post_data[4]; ?>) </span> </td>
		
	</tr>
	<tr>

		&nbsp;
		
		
	</tr>
	<tr>
	<td style="color=#800000" >Comments </td></tr>
<?php
	while($comment_data=mysql_fetch_array($que_comment))
	{
		$comment_id=$comment_data[0];
		$comment_user_id=$comment_data[2];
		$que_user_info1=mysql_query("select * from users where user_id=$comment_user_id");
		$que_user_pic1=mysql_query("select * from user_profile_pic where user_id=$comment_user_id");
		$fetch_user_info1=mysql_fetch_array($que_user_info1);
		$fetch_user_pic1=mysql_fetch_array($que_user_pic1);
		$user_name1=$fetch_user_info1[1];
		$user_Email1=$fetch_user_info1[2];
		$user_gender1=$fetch_user_info1[4];
		$user_pic1=$fetch_user_pic1[2];
?>
	<tr>
		
		<td width="4%"  style="padding-left:12;">  <img src="../../fb_users/<?php echo $user_gender1; ?>/<?php echo $user_Email1; ?>/Profile/<?php echo $user_pic1; ?>" height="40" width="47"/>    </td>
		<td  style="padding-left:8; width: 25%;" > <a href="../fb_view_profile/view_profile.php?id=<?php echo $comment_user_id; ?>" style="text-transform:capitalize; text-decoration:none; color:#800000;" onMouseOver="Comment_name_underLine(<?php echo $comment_id; ?>)" onMouseOut="Comment_name_NounderLine(<?php echo $comment_id; ?>)" id="cuname<?php echo $comment_id; ?>"> (<?php echo $user_name1; ?>)</a> </td>
	<?php
		if($userid==$post_user_id)
		{ ?>
			<td align="right" style="width: 294px" > 
			<form method="post">  
				<input type="hidden" name="comm_id" value="<?php echo $comment_id; ?>" />
				<input type="submit" name="delete_comment" value="  " style="background-color:#FFFFFF; border:#FFFFFF; background-image:url(img/delete_comment.gif); width:13; height:13;"/> &nbsp;
			</form> </td>
		<?php
		}
		else if($userid==$comment_user_id)
		{ ?>
		<td align="right" style="width: 289px" >
			<form method="post">  
				<input type="hidden" name="comm_id" value="<?php echo $comment_id; ?>" />
				<input type="submit" name="delete_comment" value="  " style="background-color:#FFFFFF; border:#FFFFFF; background-image:url(img/delete_comment.gif); width:13; height:13;"/> &nbsp;
			</form> </td>
		<?php
		}
		else
		{?>
			
		<?php
		}
	?>
		
	</tr>
	<?php
	$clen=strlen($comment_data[3]);
	if($clen>0 && $clen<=60)
	{
		$cline1=substr($comment_data[3],0,60);
	?>
	<tr>
		<td> </td>
		<td  style="padding-left:7;" colspan="2" color="Navy" class="auto-style2"> Comment:-<?php echo $cline1; ?></td>
	</tr>
	<br/>
	<br/>
	<?php
	}
	else if($clen>60 && $clen<=120)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
	?>
	<tr>
		<td> </td>
		<td style="padding-left:7;" colspan="2" class="auto-style2"> Comment:-<?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td> </td>
		<td style="width: 25%" > </td>
		<td style="padding-left:7; width: 294px;" colspan="1"> &nbsp;</td>
	</tr>
	<?php
	}
	else if($clen>120 && $clen<=180)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
	?>
	<tr>
		<td> </td>
		<td  style="padding-left:7; width: 25%;" colspan="1"> <?php echo $cline1; ?></td>
	</tr>
	<tr>
		<td> </td>
		<td style="width: 25%" > </td>
		<td  style="padding-left:7; width: 294px;" colspan="1"> <?php echo $cline2; ?></td>
	</tr>
	<tr>
		<td> </td>
		<td style="width: 25%" > </td>
		<td  style="padding-left:7;" colspan="2"> <?php echo $cline3; ?></td>
	</tr>
	<?php
	}
	else if($clen>180 && $clen<=240)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
	?>
	<tr>
		<td> </td>
		<td  style="padding-left:7;" colspan="2"> <?php echo $cline1; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline2; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline3; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline4; ?></td>
	</tr>
	<?php
	}
	else if($clen>240 && $clen<=300)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
	?>
	<tr>
		<td> </td>
		<td style="padding-left:7;" colspan="2"> <?php echo $cline1; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline2; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline3; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline4; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline5; ?></td>
	</tr>
	<?php
	}
	else if($clen>300 && $clen<=360)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
		$cline6=substr($comment_data[3],300,60);
	?>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline1; ?></td>
	</tr>
	<tr>
				<td style="padding-left:7;" colspan="2"> <?php echo $cline2; ?></td>
	</tr>
	<tr>
				<td style="padding-left:7;" colspan="2"> <?php echo $cline3; ?></td>
	</tr>
	<tr>
			<td style="padding-left:7;" colspan="2"> <?php echo $cline4; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline5; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline6; ?></td>
	</tr>
	<?php
	}
	else if($clen>360 && $clen<=420)
	{
		$cline1=substr($comment_data[3],0,60);
		$cline2=substr($comment_data[3],60,60);
		$cline3=substr($comment_data[3],120,60);
		$cline4=substr($comment_data[3],180,60);
		$cline5=substr($comment_data[3],240,60);
		$cline6=substr($comment_data[3],300,60);
		$cline7=substr($comment_data[3],360,60);
	?>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline1; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline2; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline3; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline4; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline5; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline6; ?></td>
	</tr>
	<tr>
				<td  style="padding-left:7;" colspan="2"> <?php echo $cline7; ?></td>
	</tr>
	<?php
	}
	?>
	<?php
	}
	?>
	<tr>
	<td> </td>
	<td style="padding-left:17; width: 25%;"  rowspan="2">  <img src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height:33; width:33;"/>    </td>
		<td bgcolor="#800000" colspan="2" style="padding-top:15;"> 
		<form method="post" name="commenting" onSubmit="return blank_comment_check()"> 
		<input type="text" name="comment_txt" placeholder="Write a comment..." maxlength="420" style="width:320;" id="<?php echo $postid;?>"/> 
		<input type="hidden" name="postid" value="<?php echo $postid; ?>"/> 
		<input type="hidden" name="userid" value="<?php echo $userid; ?>"/> 
		<input type="submit" name="comment" style="display:none;"/> 
		</form> </td>
	</tr>
<tr><td></td><td style="width: 294px"></td><td style="width: 289px"></td></tr><tr><td></td>
		<td style="width: 25%"></td><td style="width: 294px"></td>
		<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr><tr><td></td>
			<td style="width: 25%"></td><td style="width: 294px"></td>
			<td style="width: 289px"></td></tr>	
	
<?php } ?>
	</table>
<br />

 
 </form>

    </div>
    
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>

	
	<?php
		include("Home_error/Home_error.php");
	?>
</body>
</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>