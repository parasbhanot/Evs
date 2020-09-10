sqlite3 product_config.db "REPLACE INTO keys (key,value) VALUES ('$1','$2');"
a=$(sqlite3 product_config.db "SELECT value FROM keys where key = '$1';")
echo $a 
