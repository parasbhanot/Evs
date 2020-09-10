#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
read -r delpkgpath<"/home/delsys/delpkg.path"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
read -r delpkgpath<"$HOME/delsys/delpkg.path"
else 
logger -p local3.info -t ClearAppData "Product Config Not Found Exiting !!!"
echo "Product Config Not Found Exiting !!!"
exit 0
fi

logger -p local3.info -t ClearAppData "Clear AppData Version 1.00"
logger -p local3.info -t ClearAppData "Home: $HOME , User: $USER, Product Config: $PC_File"


p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

logger -p local3.info -t ClearAppData "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
#-------------------------------- prepare for config folder -------------------------------------- 

APPDATA_DIR=$apps_data_dir/Delta/chargerapps
APL_CONFIG_DIR=$apps_data_dir/Delta/applauncher
WORK_DIR=/tmp/Delta/Work

dapp=$1
logger -p local3.info -t ClearAppData "Application: "$dapp
echo "Application: "$dapp

dapp_path=$apps_dir/$dapp 
if [ -f "$apps_dir/$dapp.path" ];then
        read -r appv<"$apps_dir/$dapp.path"
        if [ ! -z "$appv" ]; then
            dapp_path=$apps_dir/$appv
        fi
fi  
echo "Application path : "$dapp_path

if [ ! -d "$dapp_path" ];then 
    logger -p local3.info -t ClearAppData  "App not found !!!"
    echo "App not found !!!"
    exit -1
fi

read -r appid="$dapp_path/app.id"

if [ ! -d "$APPDATA_DIR/$appid" ];then 
    logger -p local3.info -t ClearAppData  "App Data Not Found !!!"
    echo "App Data Not Found  !!!"
    exit -1
fi

rm -r $APPDATA_DIR/$appid/*

exit 0



