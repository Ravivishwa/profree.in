<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
</head>

<body>
<div class="login-container" style="margin-top:70px;">
	<div style="min-width:360px;">
    	<div style="height:120px;">
        	<img src="<?=base_url()?>btPublic/admin/images/admin-logo.png" style="margin-left:25px;" />
        </div>
        <div class="message"  style="margin-top:-10px;">
            <?=$Message?>
        </div>
    </div>
    <div class="login" style="height:140px;">
    	<form action="<?=base_url()?>admin/general/recoverPassword" method="post">
        	<label>Email Address:</label>
        	<input type="text" name="email" id="email" value="<?=$email?>" />
            
            <div class="clear" style="margin-top:15px;"></div>
            <span class="forget"><a href="<?=base_url().'admin/login'?>" style="color:#b2b1b1;">Go to login</a></span>
            <input name="RecoverPassword"  id="RecoverPassword" type="submit" value="Send" class="btn-general" />
        </form>
    </div>
</div>
</body>
</html>
