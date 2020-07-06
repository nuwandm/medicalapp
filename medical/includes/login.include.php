<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

$url = 'https://scaf.lk:610/api/Auth/login';
$data = '{"UserName":"'.$username.'","Password":"'.$password.'"}';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Connection: Keep-Alive',
'Accept: text/plain',
"Expect:"
));
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resultJson = curl_exec($curl);
echo $resultJson;
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$results = json_decode($resultJson, true);
curl_close($curl);

if($httpcode == 200){
$_SESSION['userData']=$results;
$_SESSION['error'] = null;
header("Location: ../index.php");
}
else{
if (isset($resultJson[0])){
$_SESSION['error'] = $resultJson;
}
else{
$_SESSION['error'] = "Incorrect username or password";
}
header("Location: ../login.php");
}


