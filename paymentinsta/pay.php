<?php 
$product_name = 'REGISTRATION FEES';
$price = $_POST["price"];

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$userid=$_POST["userid"];
$plan_id=$_POST["plan_id"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:bcf037cfb7eac37da1fdc8712c7b42b4",
                  "X-Auth-Token:48f369a4d8742428ee0df7c9c67e6225"));
$payload = Array(
    'purpose' => $product_name,
    'amount' =>  $price,
    'phone' =>$phone ,
    'buyer_name' => $name,
    'redirect_url' => "http://profree.in/paymentinsta/thankyou.php?userid=".$userid."&plan_id=".$plan_id,
    'send_email' => true,
    'webhook' => 'http://profree.in/paymentinsta/webhook.php',
    'send_sms' => true,
    'email' => 'foo@example.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

//echo $response;
$response=json_decode($response,true);
//print_r($response);
//die();

if(count($response)>0){
    $pay_ulr = $response['payment_request']['longurl'];;
    header("Location: $pay_ulr");
    exit();
}else{
    echo "Error";
}

    





// include 'src/instamojo.php';

// $api = new Instamojo\Instamojo('bcf037cfb7eac37da1fdc8712c7b42b4', '48f369a4d8742428ee0df7c9c67e6225','https://instamojo.com/api/1.1/');


// try {
//     $response = $api->paymentRequestCreate(array(
//         "purpose" => $product_name,
//         "amount" => $price,
//         "buyer_name" => $name,
//         "phone" => $phone,
//         "send_email" => true,
//         "send_sms" => true,
//         "email" => $email,
//         'allow_repeated_payments' => false,
//         "redirect_url" => "http://profree.in/paymentinsta/thankyou.php?userid=".$userid."&plan_id=".$plan_id,
//         "webhook" => "http://profree.in/paymentinsta/webhook.php"
//         ));
//     print_r($response);

//     $pay_ulr = $response['longurl'];
    
//     //Redirect($response['longurl'],302); //Go to Payment page

//     header("Location: $pay_ulr");
//     exit();

// }
// catch (Exception $e) {
//     print('Error: ' . $e->getMessage());
// }     
  ?>