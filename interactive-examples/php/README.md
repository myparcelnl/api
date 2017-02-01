# MyParcel.nl Interactive Examples

Author: MyParcel.nl <info@myparcel.nl>  
Date: 2017-02-01

## Introduction

These examples are interactive they should run on any operating systems running PHP.
There are three examples:

- a cURL example via the command-line (MacOS / *Nix )
- a file_get_contents PHP example (Without cURL extension)
- a cURL-PHP example (With cURL extension)
- Windows Users no Fear! [GitHub Desktop + GitHub SCM is here](https://git-for-windows.github.io/)

#### Getting a DEMO API key

1. Visit (MyParcel Demo Registration)[https://myparcel.nl/demo]

2. Goto settings >  COG (Gear Wheel) Icon > Dutch: "Instellingen"

3. Generate a API key -> Click "Genereer API-key" API

example: 331591b4dd3aa71e895e37f1ce71ff5ee03f0342
Base64: MzMxNTkxYjRkZDNhYTcxZTg5NWUzN2YxY2U3MWZmNWVlMDNmMDM0Mg==

You can test if this works by running this example request:

Demo API base url: https://api-demo.myparcel.nl/  
Live API base URL: https://api.myparcel.nl/  


#### CURL example (command-line) (The Request)
```
api@demo.myparcel.nl:~$

curl --request POST \
  --url https://api-demo.myparcel.nl/return_shipments \
  --header 'Content-Type: application/json;charset=utf-8' \
  --header 'Authorization: basic enter_your_base_64_encoded_api_key_here'
```

This request produces the following JSON output (The Response):

```
{
  "data": {
    "download_url": {
      "link": "https:\/\/demo.myparcel.nl\/retour\/8005ebb27d55425c5eaf2dff2fa41147"
    }
  }
}
```

> Then grab the link...
[JSON_decode()](http://php.net/manual/en/function.json-decode.php)


```
<?php
$associativeArray = json_decode('{"data":{"download_url":{"link":"https:\/\/demo.myparcel.nl\/retour\/8005ebb27d55425c5eaf2dff2fa41147"}}}', TRUE);
var_dump($associativeArray);
/*
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

echo $associativeArray['data']['download_url']['link'];

// no need to run stripcslashes() in this example...
// json_decode() is smart enough to know you just want that!

/* result: https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147  */

```



This link will generate a page for your consumer that wants to return your product.
We offer this service in 6 languages

use the query-parmeter `cc` for displaying a different language.
(On the page itself we also offer a language switcher out-of-the-box!)
i.e.

- Dutch / Nederlands (Standard: NL)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=NL
- English / Engels (EN)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=EN
- French / Frans (FR)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=FR
- German / Duits (DE)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=DE
- Italian / Italiaans (IT)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=IT
- Spanish / Spaans (ES)
  - https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147?cc=ES


## run this example via your command-line

```
api@api-demo.myparcel.nl:~$

curl --request POST \
  --url https://api-demo.myparcel.nl/return_shipments \
  --header 'Content-Type: application/json;charset=utf-8' \
  --header 'Authorization: basic enter_your_base_64_encoded_api_key_in' \
```

## Run this example in PHP (with cURL extension installed)

```
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
  echo "<pre>";
  echo $response;
  echo "</pre>";
}
```

## Run this example in `plain` PHP (NO cURL extension needed!)

```
<?php

$url = 'https://api-demo.myparcel.nl/return_shipments';
$data = array(); // no data is needed for this request
// use key 'http' even if you send the request to https://...
$options = array(
  'http' => array(
    'header'  => "Content-type: application/json;charset=utf-8\r\nAuthorization: basic enter_your_base_64_encoded_api_key_in==",
    'method'  => 'POST',
    'content' => http_build_query($data),
  ),
);

$context  = stream_context_create($options);

$result = file_get_contents($url, false, $context);

echo "<pre>";
var_dump($result);
echo "</pre>";

```

#### Extra: stripcslashes
> Strip the slashes...
[stripcslashes()](http://php.net/manual/en/function.stripcslashes.php)

```
api@demo.myparcel.nl:~$ php -a
// starts a interactive php shell on your terminal

php > echo stripcslashes("https:\/\/demo.myparcel.nl\/retour\/8005ebb27d55425c5eaf2dff2fa41147");
https://demo.myparcel.nl/retour/8005ebb27d55425c5eaf2dff2fa41147
```

## Extra: Base64encode your API key

```
<?php
// via SCRIPT
$myParcel_NL_ApiKey = "3f89da5c0da7163f65d04dcdeedfd2017a02fe01";
$myParcel_Base_64_encoded = base64_encode($myParcel_NL_ApiKey);
echo $myParcel_Base_64_encoded
```

## Extra: base64encode via interactive PHP shell
```
api@demo.myparcel.nl:~$ php -a
// starts a interactive php shell on your terminal

php > echo base64_encode("331591b4dd3aa71e895e37f1ce71ff5ee03f0342");
MzMxNTkxYjRkZDNhYTcxZTg5NWUzN2YxY2U3MWZmNWVlMDNmMDM0Mg==
```
