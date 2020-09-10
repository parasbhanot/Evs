<?php
$sock = stream_socket_client('unix:///phptemp/testunixd', $errno, $errst);
fwrite($sock, 'getstatus');
$resp = fread($sock,1024);
fclose($sock);
echo $resp;
?>

