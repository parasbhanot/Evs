!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

a=$(sqlite3 sqlite/db "SELECT value FROM keys where key = 'fwdir';")
echo $a
$a/./EvdcApp

echo "Closed"
