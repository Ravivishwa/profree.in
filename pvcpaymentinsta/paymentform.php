<?php
$price=$_GET['price'];
$bank_fee=3+($price*2/100)+($price*18/100);
$total_pay=$price+$bank_fee;





?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
  
  <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <img src="http://profree.in/btPublic/html/images/logo-profree.png"></img>    
     
    </div>
    
  </div>
  
    <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <span style="font-size:12px;font-weight:bold;">Product Name:</span><span style="color:blue;font-size:12px;font-weight:bold;">REGISTRATION FEES</span>
    
    </div>
    </div>    
  
    <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <span style="font-size:12px;font-weight:bold;">Price:</span><span style="font-size:12px;font-weight:bold;"><?=$price;?></span>
    
    </div>
    </div>
    
    <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <span style="font-size:12px;font-weight:bold;">Bank Fee:</span><span style="font-size:12px;font-weight:bold;"><?=$bank_fee?>(Rs3+2% of fee+15%service tax)</span>
    
    </div>
    </div>
    
     <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <span style="font-size:12px;font-weight:bold;">Total:</span><span style="font-size:12px;font-weight:bold;"><?=$total_pay;?></span>
    
    </div>
    </div>
    
      <div class="row" style="margin-top:20px;">
    <div class="col-sm-12">
     <span style="font-size:20px;font-weight:bold;">Your Payment Details</span>
    
    </div>
    </div>
    <hr>
    <form name="f1" method="post" action="pay.php">
  <div class="form-group">
    <label for="name">Your Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="form-group">
    <label for="pwd">Your Phone</label>
    <input type="text" class="form-control" id="phone" name="phone">
  </div>
  
    <div class="form-group">
    <label for="pwd">Your Email</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <input type="hidden" name="price" value="<?= $total_pay;?>">
  
  <input type="hidden" name="userid" value="<?= $_GET['userid'];?>">
  
  <input type="hidden" name="plan_id" value="<?= $_GET['plan_id'];?>">
  
  <input type="hidden" name="phone" value="<?= $_GET['phone'];?>">
  

  <button type="submit" class="btn btn-success">Click here to Pay Rs.<?=$total_pay;?></button>
</form>

    
  
</div>

</body>
</html>
