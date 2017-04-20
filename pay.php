

<?php

$ch = curl_init();

$nam = $_POST['nam']; 
$pri = $_POST['pri'];
$ph  = $_POST['ph']; 
$em  = $_POST['em'];
$las = $_POST['las']; 
$saa = $_POST['saa'];
$sab = $_POST['sab']; 
$reg = $_POST['reg'];
$cty = $_POST['cty']; 
$pin = $_POST['pin']; 
$cnt = $_POST['cnt'];


$nad = str_replace(' ', '_',$nam);

$lad = str_replace(' ', '_',$las);


$sad = str_replace(' ', '_',$saa);

$sar = str_replace(' ', '_',$sab);

$red = str_replace(' ', '_',$reg);

$ctd = str_replace(' ', '_',$cty);

$pid = str_replace(' ', '_',$pin);

$cnd = str_replace(' ', '_',$cnt);


curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:c66661d1adc122fb9e68bfbf32ee3225",
                  "X-Auth-Token:e07a89381e9efb5a05bb5eb6119a9354"));
$payload = Array(
    "purpose" => "Product Purchase",
    "amount" => $pri,
    "phone" => $ph,
    "buyer_name" => $nam,
    "redirect_url" => "https://divaah.com/success.php",
    "send_email" => true,
    "webhook" => "https://divaah.com/webhook.php?nam=$nad&las=$lad&phone=$ph&em=$em&saa=$sad&sab=$sar&reg=$red&cty=$ctd&pin=$pid&cnt=$cnd",
    "send_sms" => true,
    "email" => $em,
    "allow_repeated_payments" => false
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$data = json_decode($response,true);
var_dump($data);
$site=$data["payment_request"]["longurl"];
header('HTTP/1.1 301 Moved Permanently');
header('Location:'.$site);

?>