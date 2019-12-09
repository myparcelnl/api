<?php

$base64EncodedApiKey = "enter_your_myparcel_api_key_here"; // your API key
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.myparcel.nl/return_shipments", // The URL to call
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 5, // Maximum number of redirects
  CURLOPT_TIMEOUT => 25,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Let's use HTTP version 1.1
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Authorization: basic " .base64_encode($base64EncodedApiKey), // we will base64encode it your API key  here
    "Content-Type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  echo "cURL Error #:" . $err;
} else {

  $associativeArray = json_decode($response, TRUE);

  /*
  The array

  array(1) {
    ["data"]=>
    array(1) {
      ["download_url"]=>
      array(1) {
        ["link"]=>
        string(64) "https://backoffice.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147"
      }
    }
  }
  */

  $sendYourCustomerToThisPage = $associativeArray['data']['download_url']['link'];


  echo $sendYourCustomerToThisPage; // https://backoffice.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147
  // i.e.
  //header('Location: https://backoffice.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=ES'); // Spanish version (cc=ES)
  //default language is Dutch (cc=NL)
}
