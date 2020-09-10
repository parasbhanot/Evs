#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

logger -p local3.info -t AppSearch "Default App Launcher Version 1.00"

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
else 
echo "Product Config Not Found Exiting !!!"
exit 0
fi

echo "Home: $HOME , User: $USER, Product Config: $PC_File"

p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"

#Starting Main Application Launch======================================================================================

rm /tmp/delappslist.txt

read -r dap<$apps_dir/defaultapp.path
read -r sap<$apps_dir/systestapp.path
read -r cap<$apps_dir/ctrltestapp.path

echo "$dap,$sap,$cap-----------" 

for f in $(ls $apps_dir); do
    echo $f

    if [ -d "$apps_dir/$f" ]; then
        echo "$f is directory"
        
        if [ -f "$apps_dir/$f/app.id" ] && [ -f "$apps_dir/$f/app.info" ] && [ -f "$apps_dir/$f/startapp" ] && [ -f "$apps_dir/$f/setup.sh" ];then
        
            read -r appid<"$apps_dir/$f/app.id"
            read -r appinfo<"$apps_dir/$f/app.descr"

            if [ $f == $dap ]
            then
            echo "$f,$appinfo,defaultapp" >> /tmp/delappslist.txt
            elif [ $f == $sap ]
            then
            echo "$f,$appinfo,systestapp" >> /tmp/delappslist.txt            
            elif [ $f == $cap ]
            then
            echo "$f,$appinfo,ctrltestapp" >> /tmp/delappslist.txt            
            else
            echo "$f,$appinfo" >> /tmp/delappslist.txt
            fi
        fi
    fi
done
