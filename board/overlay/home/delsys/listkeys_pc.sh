for line in $(sqlite3 product_config.db "SELECT * FROM keys"); do
  echo $line
done
 
