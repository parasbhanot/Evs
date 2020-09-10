sqlite3 sqlite/charger.db "REPLACE INTO keys (key,value) VALUES ('$1','$2');"
a=$(sqlite3 sqlite/charger.db "SELECT value FROM keys where key = '$1';")
echo $a 
