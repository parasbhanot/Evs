a=$(sqlite3 sqlite/charger.db "SELECT value FROM keys where key = '$1';")
echo $a 

