<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api-demo.myparcel.nl/return_shipments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 5,
  CURLOPT_TIMEOUT => 25,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Authorization: basic enter_your_base_64_encoded_api_key_in==",
    "Content-Type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  echo "cURL Error #:" . $err;
} else {

  $associativeArray = json_decode($result, TRUE);

  /*
  The array

  array(1) {
    ["data"]=>
    array(1) {
      ["download_url"]=>
      array(1) {
        ["link"]=>
        string(64) "https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147"
      }
    }
  }
  */

  $sendYourCustomerToThisPage = $associativeArray['data']['download_url']['link'];


  echo $sendYourCustomerToThisPage; // https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147
  // i.e.
  //header('Location: https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=ES'); // Spanish version (cc=ES)
  //default language is Dutch (cc=NL)
}
