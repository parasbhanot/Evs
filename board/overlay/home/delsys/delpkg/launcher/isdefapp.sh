#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
else 
echo "Product Config Not Found Exiting !!!"
exit -1
fi

if [ -f "/home/delsys/device_config.db" ];then 
DV_File="/home/delsys/device_config.db"
elif [ -f "$HOME/delsys/device_config.db" ];then 
DV_File="$HOME/delsys/device_config.db"
else 
echo "Device Config Not Found Exiting !!!"
exit -2
fi

p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

echo "Home: $HOME , User: $USER, Product Config: $PC_File"
echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"

#-------------------------------- prepare for config folder -------------------------------------- 

APPDATA_DIR=$apps_data_dir/Delta/chargerapps
APL_CONFIG_DIR=$apps_data_dir/Delta/applauncher
WORK_DIR=/tmp/Delta/Work

if [ ! -d "$APPDATA_DIR" ];then 
mkdir -p $APPDATA_DIR
if [ ! -d "$APPDATA_DIR" ];then 
logger -p local3.info -t DefAppCheck "Application Data Dir: $APPDATA_DIR could not created, Exiting !!!"
echo "Application Data Dir: $APPDATA_DIR could not created, Exiting !!!"
exit -3
fi
fi

if [ ! -d "$APL_CONFIG_DIR" ];then 
mkdir -p $APL_CONFIG_DIR
if [ ! -d "$APL_CONFIG_DIR" ];then 
logger -p local3.info -t DefAppCheck  "Apl Data Dir: $APL_CONFIG_DIR could not created, Exiting !!!"
echo "Apl Data Dir: $APL_CONFIG_DIR could not created, Exiting !!!"
exit -4
fi
fi

mkdir -p $WORK_DIR
if [ ! -d "$WORK_DIR" ] ;then 
logger -p local3.info -t DefAppCheck  "Work dir: $WORK_DIR could not created, Exiting !!!"
echo "Work dir: $WORK_DIR could not created, Exiting !!!"
exit -5
fi


#Checking Application Launch===============================================

dapp="defaultapp"
dapp_path=$apps_dir/$dapp 

if [ -f "$apps_dir/$dapp.path" ];then
        read -r appv<"$apps_dir/$dapp.path"
        if [ ! -z "$appv" ]; then
            dapp_path=$apps_dir/$appv
        fi
fi
    

if [ ! -d "$dapp_path" ];then 
echo "$dapp_path Default App Path not found !!!"
exit -6
fi

if [ -f $dapp_path/env.txt ] && [ -f $dapp_path/setup.sh ] && [ -f $dapp_path/startapp ];then
echo "Default App Present !!!"
exit 0
fi

echo "Files Missing !!!"
exit -10 

