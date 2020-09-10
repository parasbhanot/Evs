for line in $(sqlite3 sqlite/charger.db "SELECT key FROM keys"); do
  echo $line
done
 
