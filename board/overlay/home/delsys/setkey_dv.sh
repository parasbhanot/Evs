sqlite3 device_config.db "REPLACE INTO keys (key,value) VALUES ('$1','$2');"
a=$(sqlite3 device_config.db "SELECT value FROM keys where key = '$1';")
echo $a 
