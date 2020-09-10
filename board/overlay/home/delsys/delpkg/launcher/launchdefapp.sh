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

if [ -f "/home/delsys/device_config.db" ];then 
DV_File="/home/delsys/device_config.db"
elif [ -f "$HOME/delsys/device_config.db" ];then 
DV_File="$HOME/delsys/device_config.db"
else 
logger -p local3.info -t DefAppLauncher "Device Config Not Found Exiting !!!"
echo "Device Config Not Found Exiting !!!"
exit 0
fi


logger -p local3.info -t DefAppLauncher "Default App Launcher Version 1.00"
logger -p local3.info -t DefAppLauncher "Home: $HOME , User: $USER, Product Config: $PC_File"


p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

logger -p local3.info -t DefAppLauncher "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
#-------------------------------- prepare for config folder -------------------------------------- 

APPDATA_DIR=$apps_data_dir/Delta/chargerapps
APL_CONFIG_DIR=$apps_data_dir/Delta/applauncher
WORK_DIR=/tmp/Delta/Work

if [ ! -d "$APPDATA_DIR" ];then 
mkdir -p $APPDATA_DIR
if [ ! -d "$APPDATA_DIR" ];then 
logger -p local3.info -t DefAppLauncher "Application Data Dir: $APPDATA_DIR could not created, Exiting !!!"
echo "Application Data Dir: $APPDATA_DIR could not created, Exiting !!!"
exit -1
fi
fi

if [ ! -d "$APL_CONFIG_DIR" ];then 
mkdir -p $APL_CONFIG_DIR
if [ ! -d "$APL_CONFIG_DIR" ];then 
logger -p local3.info -t DefAppLauncher "Apl Data Dir: $APL_CONFIG_DIR could not created, Exiting !!!"
echo "Apl Data Dir: $APL_CONFIG_DIR could not created, Exiting !!!"
exit -1
fi
fi

mkdir -p $WORK_DIR
if [ ! -d "$WORK_DIR" ] ;then 
logger -p local3.info -t DefAppLauncher "Work dir: $WORK_DIR could not created, Exiting !!!"
echo "Work dir: $WORK_DIR could not created, Exiting !!!"
exit -1
fi

logger -p local3.info -t DefAppLauncher "APPDATA_DIR: "$APPDATA_DIR
logger -p local3.info -t DefAppLauncher "APPDATA_DIR: "$APL_CONFIG_DIR
logger -p local3.info -t DefAppLauncher "WORK_DIR:  "$WORK_DIR

#Starting Main Application Launch===============================================
#setting environment vars

#Export Product Configs

export DELAPL_APPDATA_DIR=$APPDATA_DIR
export DELAPL_WORK_DIR=$WORK_DIR
export DELAPP_ProductSerialNo=$p_slno   
export DELAPP_ProductConfig=$p_model
export DELAPP_PCDB=$PC_File
export DELAPP_DVDB=$DV_File

source <(grep = /etc/Inbuilt_Versions.ini)
export Device_HwModel=$Model
export Device_HwRev=$Subversion
export Device_OSImage=$ImageName


ec=2
while [ $ec == 2  ]
do
    echo "Launching Application"
    echo "HW Info HW:$Model, Rev:$Subversion, OS:$ImageName"

    #dapp=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'default_app';")
    
    dapp="defaultapp"

    #logger -p local3.info -t DefAppLauncher "Default Application: "$dapp
    #echo "Default Application: "$dapp
 
    dapp_path=$apps_dir/$dapp 

    if [ -f "$apps_dir/$dapp.path" ];then
        read -r appv<"$apps_dir/$dapp.path"
        if [ ! -z "$appv" ]; then
            dapp_path=$apps_dir/$appv
        fi
    fi
    
    echo "Default Application Path : $dapp_path"
    logger -p local3.info -t DefAppLauncher "Default Application Path: $dapp_path"

    if [ ! -d "$dapp_path" ];then 
    logger -p local3.info -t DefAppLauncher "Default App not found !!!"
    echo "Default App not found !!!"
    ec=3
    break
    fi

    #sourcing application environment
    export DELAPP_DIR=$dapp_path
    source "$dapp_path/env.txt"

    echo "Environment:$HOSTNAME"
    
    if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
    then
        echo "Launching App for EVDC" 
        logger -p local3.info -t DefAppLauncher "Launching App for EVDC" 
        $dapp_path/setup.sh >/dev/null 2>&1
        $dapp_path/startapp -platform xcb >/dev/null 2>&1
        ec=$(($? + 0))
        $dapp_path/close.sh >/dev/null 2>&1
    else
        echo "Launching App for Desktop" 
        logger -p local3.info -t DefAppLauncher "Launching App for Desktop" 
        $dapp_path/setup.sh
        $dapp_path/startapp
        ec=$(($? + 0))			
        $dapp_path/close.sh
    fi
     
    logger -p local3.info -t DefAppLauncher "StartApp ExitCode:$ec"
    echo "StartApp ExitCode:$ec"

    if [ $ec == 1  ];then 
    logger -p local3.info -t DefAppLauncher "Application exited with exit code 1,  So Rebooting system"
    echo "Application exited with exit code 1,  So Rebooting system"
    reboot
    fi
    
    #forcing to relaunch 
    ec=2
    sleep 5
    #if [ $ec != 2 ];then
    #break;
    #fi
     
done

#-----------------------------------------------unexpected Application Exit Code ----------------------------------- 

sapp=$delpkgpath/launcher

logger -p local3.info -t DefAppLauncher "Launching StandByApp:$sapp/StandbyApp"
    
export DELAPP_DIR=$sapp 
if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
then
    echo "Environment:buildroot" 
    $sapp/StandbyApp -platform xcb >/dev/null 2>&1
else
    $sapp/StandbyApp
fi
ec=$?

logger -p local3.info -t DefAppLauncher "Standby App exitcode:$ec, Launcher Closing, System Reboot command" 
echo "Standby App exitcode:$ec, Launcher Closing, System Reboot command" 
