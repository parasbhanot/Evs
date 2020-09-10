#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib
#$1 - application name 
scriptname="setctrltestapp"
scriptver="1.00"

logger -p local3.info -t $scriptname $scriptver

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
else 
logger -p local3.info -t $scriptname "Product Config Not Found Exiting !!!"
echo "Product Config Not Found Exiting !!!"
exit 0
fi

logger -p local3.info -t  $scriptname "Home: $HOME , User: $USER, Product Config: $PC_File"

p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

logger -p local3.info -t $scriptname  "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"

#-------------------------------- prepare for config folder -----------------------------------------------------------
echo $1 > $apps_dir/ctrltestapp.path
