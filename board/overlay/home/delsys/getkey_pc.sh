a=$(sqlite3 product_config.db "SELECT value FROM keys where key = '$1';")
echo $a 

