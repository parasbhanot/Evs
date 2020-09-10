#!/bin/sh

export LD_LIBRARY_PATH=/usr/local/lib
echo "config script started...\n"
gpg --import /home/launchApps/Apps/ChargerApps/ChargerFwKeysBkp.asc
echo "config script finished.."
exit $?
