#!/bin/bash

DPATH="/home/delsys/product_config.db"
result=$(sqlite3 $DPATH "select value from keys where key = 'APN';")

str="OK AT+CGDCONT=1,\"IP\",\"$result\",,0,0"

sed -i '12d'  /etc/ppp/peers/quectel-chat-connect 
sed -i "/^# Insert.*/a $str" /etc/ppp/peers/quectel-chat-connect

