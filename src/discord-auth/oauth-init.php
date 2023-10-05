<?php

$discord_redirect = 'https://discord.com/api/oauth2/authorize?client_id=1159419557027524628&redirect_uri=http%3A%2F%2Flocalhost%2Fdiscord-auth%2Fverify-oauth.php&response_type=code&scope=identify%20guilds';

header("Location: $discord_redirect");
exit();

?>