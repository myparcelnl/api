<?php

$url = 'https://api.myparcel.nl/return_shipments'; // this is the URL we are going to use
$yourAPIkey = "MYPAk8xeGA6yU5APIe8abMF8fn6xFWYneuZ1Key0"; // no need to encode it, this script will do it for you!

$data = array(); // no data is needed for this request

// use key 'http' even if you send the request to https://...
$options = array(
  'http' => array(
    'header'  => "Content-type: application/json;charset=utf-8\r\nAuthorization: basic ".base64encode($yourAPIkey),
    'method'  => 'POST',
    'content' => http_build_query($data),
  ),
);

$context  = stream_context_create($options);

$result = file_get_contents($url, false, $context);
/*
The result

{
  "data": {
    "download_url": {
      "link": "https:\/\/api.myparcel.nl\/retour\/8015ebb27d55425c5eaf2dff2fa41147"
    }
  }
}

*/
$associativeArray = json_decode($result, TRUE);

/*
The array

array(1) {
  ["data"]=>
  array(1) {
    ["download_url"]=>
    array(1) {
      ["link"]=>
      string(64) "https://backoffice.myparcel.nl/retour/8015ebb27d55425c5eaf2dff2fa41147"
    }
  }
}
*/

$sendYourCustomerToThisPage = $associativeArray['data']['download_url']['link'];


echo $sendYourCustomerToThisPage; // https://backoffice.myparcel.nl/retour/8005e5b27d55425c5eaf2dff2fa41147
