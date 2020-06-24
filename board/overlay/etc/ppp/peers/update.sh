#!/bin/bash

DPATH="/home/launchApps/Apps/ChargerApps/sqlite/charger.db"
result=$(sqlite3 $DPATH "select * from keys where key='APN'"| cut -c 5-)

str="OK AT+CGDCONT=1,\"IP\",\"$result\",,0,0"

sed -i '12d'  /etc/ppp/peers/quectel-chat-connect 
sed -i "/^# Insert.*/a $str" /etc/ppp/peers/quectel-chat-connect


