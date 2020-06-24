#!/bin/sh

echo nameserver 8.8.8.8 > /etc/resolv.conf
chattr +i /etc/resolv.conf
export LD_LIBRARY_PATH=/usr/local/lib
export GNUPGHOME=/root
echo "config script started...\n" > /dev/kmsg
gpg --import /home/launchApps/Apps/ChargerApps/ChargerFwKeysBkp.asc
echo "config script finished.." >/dev/kmsg

export DISPLAY=':0'
exit $?
