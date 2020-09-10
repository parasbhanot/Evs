#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
read -r delpkgpath<"/home/delsys/delpkg.path"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
read -r delpkgpath<"$HOME/delsys/delpkg.path"
else 
logger -p local3.info -t DefAppLauncher "Product Config Not Found Exiting !!!"
echo "Product Config Not Found Exiting !!!"
exit 0
fi

logger -p local3.info -t DefAppStopScript "Default App Stopping Script Version 1.00"
logger -p local3.info -t DefAppStopScript "Home: $HOME , User: $USER, Product Config: $PC_File"

apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

#-------------------------------- prepare for config folder -------------------------------------- 

APPDATA_DIR=$apps_data_dir/Delta/chargerapps
APL_CONFIG_DIR=$apps_data_dir/Delta/applauncher
WORK_DIR=/tmp/Delta/Work

if [ ! -d "$apps_dir" ];then 
exit -1
fi

echo "Stopping Application"

#dapp=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'default_app';")
dapp="defaultapp"

echo "Default Application: "$dapp
dapp_path=$apps_dir/$dapp 
if [ -f "$apps_dir/$dapp.path" ];then
        read -r appv<"$apps_dir/$dapp.path"
        if [ ! -z "$appv" ]; then
            dapp_path=$apps_dir/$appv
        fi
fi
echo "Default Application path : "$dapp_path
pkill $dapp_path/startapp

sapp=$delpkgpath
pkill $sapp/StandbyApp

logger -p local3.info -t DefAppStopScript "Default App Stopping Script Closing"


