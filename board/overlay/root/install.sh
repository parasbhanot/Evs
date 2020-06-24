#!/bin/bash

a=$(sqlite3 /home/launchApps/Apps/ChargerApps/sqlite/charger.db "SELECT value FROM keys where key = 'fwdir';")

TARGETPATH="/home/launchApps/Apps/ChargerApps/$a"
SOURCEPATH=$1/EvdcApp

echo "name of targer folder is $a"
echo "Passed PATH is $1"
echo "Full Source PATH is $SOURCEPATH"
echo "Full Targate PATH is $TARGETPATH"

cp -f $SOURCEPATH $TARGETPATH

#if [ $? -eq 0 ]
#then
#	echo "Updation complete"
#else
#	echo "Update Failed"
#	exit -5
#fi
