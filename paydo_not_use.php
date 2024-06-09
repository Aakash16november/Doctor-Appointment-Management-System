<?php
$randomNumber = uniqid();
$amount = 456;
$custMobileno = 'Customer Mobile no';
$custEmailID = 'info@codewithcode.com';



$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.cashfree.com/pg/links",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "Define Method",
  CURLOPT_POSTFIELDS => json_encode([
    'customer_details' => [
        'customer_phone' => $custMobileno,
        'customer_email' => $custEmailID
    ],
    'link_notify' => [
        'send_sms' => true,
        'send_email' => true
    ],
    'link_id' => $randomNumber,
    'link_amount' => $amount,
    'link_currency' => 'INR',
    'link_purpose' => 'Payment for PlayStation 11'
  ]),
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "content-type: application/json",
    "x-api-version: 2022-09-01",
    "x-client-id: 94425a244790aecef58fb5f9d52449",
    "x-client-secret: e4bffd38440fc810e12780c44a398c9df70ec788"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
    $result = json_decode($response);
    // print_r($result);
    header('Location: '.$result->link_url);
}

?>