for line in $(sqlite3 device_config.db "SELECT * FROM keys"); do
  echo $line
done
 
