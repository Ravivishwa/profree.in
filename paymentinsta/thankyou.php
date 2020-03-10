<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Thank You, Mojo</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    setTimeout(
  function() 
  {
    window.location.href="http://profree.in/property/add";
  }, 5000);
    
    
</script>


  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">Instamojo Payment</a></h1>
       
      </div>

     
  

 <?php

include 'src/instamojo.php';
$userid=$_GET['userid'];
$plan_id=$_GET['plan_id'];

//$api = new Instamojo\Instamojo('bcf037cfb7eac37da1fdc8712c7b42b4', '48f369a4d8742428ee0df7c9c67e6225','https://instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];
$paymentStatus=$_GET['payment_status'];
if($paymentStatus!="Failed"){
        
         //$response = $api->paymentRequestStatus($payid);
    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$payid);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:bcf037cfb7eac37da1fdc8712c7b42b4",
                  "X-Auth-Token:48f369a4d8742428ee0df7c9c67e6225"));
        $response = curl_exec($ch);
        curl_close($ch); 
        echo '<h3 style="color:#6da552">Thank You, Payment success!!</h3>';
        echo '<pre>';
        print_r(json_decode($response,true));
        echo '</pre>';
        //die();?>

 
  
    <?php
//     echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
//     echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
//     echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;

//   echo "<pre>";
//   print_r($response);
// echo "</pre>";

     $response_encoded_value=$response; 

     //$con = mysqli_connect("localhost","profree_pfd","wQA6(n)_Sy^D","profree_pfd");

        $servername = "localhost";
        $username = "profree_pfd";
        $password = "wQA6(n)_Sy^D";
        $dbname = "profree_pfd";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
       $insert_payment_SQL="INSERT INTO `tbl_user_payment` (`ID`, `user_id`, `plan_id`, `date`, `status`, `data`) VALUES (NULL,".$userid.",".$plan_id.", CURRENT_TIMESTAMP, 'YES','".$response_encoded_value."')";
       
        if ($conn->query($insert_payment_SQL) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
       
      $sql = "UPDATE tbl_agents SET plan_id=".$plan_id." WHERE ID=".$userid;
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        
        $conn->close();
      
      


    ?>


    <?php
}else{

    echo 'Error:Payment Failed';?>
    
     
   
    <script>
    setTimeout(
  function() 
  {
    window.location.href="http://profree.in/payment";
  }, 3000);
   
    </script>
    
<?php    
}



  ?>


      
    </div> <!-- /container -->


  </body>
</html>