a=$(sqlite3 device_config.db "SELECT value FROM keys where key = '$1';")
echo $a 

