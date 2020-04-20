<?php
include("fb_files/fb_index_file/fb_SignUp_file/SignUp.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Social Pic - Sign Up</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="fb_files/fb_index_file/fb_js_file/Registration_validation.js" type="text/javascript"> </script>
<style type="text/css">
	.auto-style5 {
	color: #800000;
}
	</style>
	<script>
	function time_get()
	{
		d = new Date();
		mon = d.getMonth()+1;
		time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
		Reg.fb_join_time.value=time;
	}
</script>

</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form class="form-signin" method="post" name="Reg" onSubmit="return check();">
            <h3 class="form-signin-heading" title="Create new account on Social Pic  Network">Sign up To Social Pic.</h3><hr />
                        <div class="form-group">
            <input class="form-control" name="first_name" placeholder="First Name" required="" type="text" title="Enter your First Name" />
            </div>
            <div class="form-group">
            <input class="form-control" name="last_name" placeholder="Last Name" required="" type="text" title="Enter your Last name" />
            </div>
            <div class="form-group">
            <input class="form-control" name="email" placeholder="E-Mail ID" required="" type="text" title="Enter your Email address"/>
            </div>
            <div class="form-group">
            <input class="form-control" name="remail" placeholder="Re-enter E-Mail ID" required="" type="text"  title="Enter your Email address again"/>
            </div>
            <div class="form-group">
            	<input class="form-control" name="password" placeholder="Enter Password" required="" type="password" title="Enter your Password" />
            </div>
            <div class="form-group">		  
		<select class="auto-style5" name="sex" style="width:120;height:45px; font-size:18px;padding:3;" title="Please Choose your Gender" required="">
			<option required="" value="Select Sex:" title="Select sex:"> Select Sex: </option>
			<option required="" value="Female" title="Female"> Female </option>
			<option required="" value="Male" title="Male"> Male </option>
		</select><br /><br />
	<select class="auto-style5" name="month" style="width:80;font-size:18px;height:45px; padding:3;" title="Please choose month of Birth" required="">
	<option required="" value="Month:" title="Month : "> Month: </option>
	
	<script type="text/javascript">
	
		var m=new Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		for(i=1;i<=m.length-1;i++)
		{
			document.write("<option value='"+i+"'>" + m[i] + "</option>");
		}	
	</script>
	
	</select>&nbsp;&nbsp;&nbsp;
	<select class="auto-style5" name="day" style="width:80px; font-size:18px;height:45px; padding:3;" title="Please choose Day of Birth" required="">
	<option required="" value="Day:" title="Day : "> Day: </option>
	
	<script type="text/javascript">
	
		for(i=1;i<=31;i++)
		{
			document.write("<option value='"+i+"'>" + i + "</option>");
		}
		
	</script>
	
	</select>&nbsp;&nbsp;&nbsp;
	<select class="auto-style5" name="year" style="width:80px; font-size:18px; height:45px; padding:3;" title="Please choose year of Birth" required="">
	<option required="" value="Year:" title="Year : "> Year: </option>
	
	<script type="text/javascript">
	
		for(i=2005;i>=1950;i--)
		{
			document.write("<option value='"+i+"'>" + i + "</option>");
		}
	
	</script>
	
	</select><br>&nbsp;<div><input type="checkbox" value="Terms & Conditions" name="T&C" required="" title="Check this box if you are sure my terms & conditions"/> 
					<span class="auto-style5" title="Accept Terms & conditions of Super Pic."><a href="t&c.php">
					<span class="auto-style5">Terms & Conditions</span></a></span></div>
 <div class="form-group">


            <hr />
            <div class="form-group">
            	<button id="sign_button"  class="btn btn-primary" name="signup" onClick="time_get()" type="submit" title="Sign up To Social Pic">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label title="Already an account !">Already an account ! <a href="index.php" title="Press login buttton to login your account">Log In</a></label>
        </div>
        </form>
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