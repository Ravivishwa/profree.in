<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
</head>

<body>
<div class="login-container" style="margin-top:10px;">
	<div style="min-width:360px;">
    	<div style="height:70px; margin-top:70px; margin-left:-60px;" align="center">
        <img src="<?=base_url()?>btPublic/admin/images/admin-logo.png" alt="Back Admin Logo" />
        </div>
        <div class="message" style="margin-top:-10px;">
            <?=$Message?>
        </div>
    </div>
    <div class="login" style="margin-top:0px;">
    	<form action="<?=base_url()?>admin/login" method="post">
        	<label>Email Address</label>
        	<input type="text" name="userName" id="userName" value="<?=$userName?>" />
            <label>Password</label>
        	<input type="password" name="password" id="password" value="<?=$password?>" />
            <div class="clear" style="margin-top:15px;"></div>
            <span class="forget"><a href="<?=base_url().'admin/general/recoverPassword'?>" style="color:#b2b1b1;">Forgot password??</a></span>
            <input type="hidden" name="GetUserLogin" value="userLogin" />
            <input name="btnLogin"  id="btnLogin" type="submit" value="" class="btn-login" />
        </form>
    </div>
</div>
</body>
</html>
