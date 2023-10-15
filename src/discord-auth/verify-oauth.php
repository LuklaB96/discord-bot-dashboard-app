<?php
if (!isset($_GET['code'])) {
    echo 'no code, redirect to error page';
    exit();
}

$code = $_GET['code'];
include('../php-scripts/config.php');
$data = [
    'code' => $code,
    'client_id' => DISCORD_CLIENT_ID,
    'client_secret' => DISCORD_CLIENT_SECRET,
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://localhost/discord-auth/verify-oauth.php',
    'scope' => 'identify%20guids',
];

$data_string = http_build_query($data);
$discord_api_token_url = 'https://discord.com/api/oauth2/token';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_api_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);
$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);

print_r($result);

session_start();

$_SESSION['auth'] = true;
$_SESSION['data'] = [
    'id' => $result['id'],
    'userName' => $result['username'],
    'avatar' => $result['avatar']
];

header("Location: ../dashboard/index.php");
?>