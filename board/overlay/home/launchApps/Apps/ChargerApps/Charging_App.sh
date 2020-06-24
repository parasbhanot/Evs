#!/bin/sh

export LD_LIBRARY_PATH=/usr/local/lib

a=$(sqlite3 /home/launchApps/Apps/ChargerApps/sqlite/charger.db "SELECT value FROM keys where key = 'fwdir';")
echo $a
/home/launchApps/Apps/ChargerApps/services/acemd >/dev/null 2>&1 &
/home/launchApps/Apps/ChargerApps/services/csud >/dev/null 2>&1 &
/home/launchApps/Apps/ChargerApps/services/intadcd >/dev/null 2>&1 &

export DELAPP_ProductConfig="CITY_CHARGER_DC_DC"

export QT_LOGGING_CONF=/home/launchApps/Apps/ChargerApps/$a/logs.ini
/home/launchApps/Apps/ChargerApps/$a/EvdcApp /home/launchApps/Apps/ChargerApps/$a/app.ini /home/launchApps/Apps/ChargerApps/sqlite/charger.db -platform xcb >/dev/null 2>&1

while [ $? != "0"  ]
do
  	sleep 10s
	echo "Re-executing Application"
	b=$(sqlite3 /home/launchApps/Apps/ChargerApps/sqlite/charger.db "SELECT value FROM keys where key = 'fwdir';")
	echo $b	
	export QT_LOGGING_CONF=/home/launchApps/Apps/ChargerApps/$b/logs.ini
	/home/launchApps/Apps/ChargerApps/$b/EvdcApp /home/launchApps/Apps/ChargerApps/$b/app.ini /home/launchApps/Apps/ChargerApps/sqlite/charger.db -platform xcb >/dev/null 2>&1
done
echo "Closed"
