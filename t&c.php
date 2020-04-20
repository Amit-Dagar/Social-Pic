<?php
include("fb_files/fb_index_file/fb_SignUp_file/SignUp.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Social Pic - Terms & Conditions</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="fb_files/fb_index_file/fb_js_file/Registration_validation.js" type="text/javascript"> </script>
	<script>
	function time_get()
	{
		d = new Date();
		mon = d.getMonth()+1;
		time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
		Reg.fb_join_time.value=time;
	}
</script>

<style type="text/css">
.auto-style1 {
	color: #FFFFFF;
}
</style>

</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form class="form-signin" method="post" name="Reg" onSubmit="return check();">
            <h3 class="form-signin-heading" title="Create new account on Social Pic  Network">
			Terms &amp; Conditions.</h3><hr />
                        <br>
        	<br><br>Your Safety is your resposebility.<br><br>updating date: 
			01/26/2017.<br><br><br><br>
        <hr><br>
			<a href="index.php">
			<input class="btn btn-primary" style="width: 83px; " title="Press Log In button to enter Social Pic Network" type="button" value="Log In" /></a>&nbsp;<a href="sign-up.php"><input class="btn btn-primary" style="width: 83px; " title="Press Sign Up button to enter Social Pic Network" type="button" value="Sign Up" /></a></form>
       </div>


<?php
	include("fb_files/fb_index_file/fb_erorr_file/fb_erorr.php");
?>

</div>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


</body>
</html>