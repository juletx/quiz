<?php
// set IP address and API access key 
$ip = 'check';
$access_key = 'e31395d9a77b1e2f9bf95eddcc9c4c0f';

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'&hostname=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, true);

echo '<tr> <td><b>SERVER</b></td> <td>'.$api_result['ip'].'</td> <td>'.$api_result['hostname'].
'</td> <td>'.$api_result['continent_name'].'</td> <td>'.$api_result['country_name'].
'</td> <td>'.$api_result['region_name'].'</td> <td>'.$api_result['city'].'</td> <td>'.$api_result['zip'].'</td> </tr>';
?>