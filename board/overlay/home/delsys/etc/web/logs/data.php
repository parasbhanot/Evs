<?php
$sock = stream_socket_client('unix:///phptemp/testunixd', $errno, $errst);
fwrite($sock, 'getvi');
$resp = fread($sock,1024);
fclose($sock);
$str_arr = explode (",", $resp);

echo "[{\"lbl\":".$str_arr[0].",\"vl\":".$str_arr[1]."}]";
?>

