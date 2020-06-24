#!/bin/bash

PATHS="Appupdate_$(date +%Y%m%d_%H%M%S)"

mkdir $PATHS

cp /media/usb0/fware/app.gpg $PATHS

if [ $? -eq 0 ]
then
        echo "copy successful"
else
        echo "copy failed"
        exit -1
fi

cd $PATHS

echo "current path is $PWD"

gpg -o EvdcApp  --passphrase voltron --batch --yes --no-tty app.gpg

if [ $? -eq 0 ]
then
	echo "decrytion successful"
else 
	echo "decrytion failed"
	exit -2
fi

echo "backing up database"
bash /root/backup.sh

if [ $? -eq 0 ]
then
	echo "backup complete"
else
	echo "backup failed"
	exit -3
fi


bash /root/install.sh $PWD

if [ $? -eq 0 ]
then
        echo "update successful"
        
else
        echo "update failed"
	exit -4
fi

bash /root/restore.sh

if [ $? -eq 0 ]
then
	echo "Restore Complete"
	reboot
else
	echo "Restore Failed"
	exit -5
fi
