#!/bin/bash

# 1. Check if all the required executables has correct permissions 
# 2. Check lastrun.info and match if we are executing first time if so
#   check and create app.ini if missing
#   check and create logs.ini if missing
#   check and create copy of db etc...
#   take backup of old version 
# 3. save your this run info         


APP_CONFIG_DIR=$DELAPL_APPDATA_DIR/$DELAPP_ID

if [ ! -d "$APP_CONFIG_DIR" ]; then
    mkdir $APP_CONFIG_DIR
    echo "App Config Dir: $APP_CONFIG_DIR Created"
fi

#Ini File..................................................
INI_FILE=$DELAPL_APPDATA_DIR/$DELAPP_ID/app.ini

echo "INI File Location:" $INI_FILE

if [ -f "$INI_FILE" ]; then
    echo "app.ini already present"
else
    cp $DELAPP_DIR/app.ini $INI_FILE
    echo "default app.ini copied"
fi

#DB File..................................................
DB_FILE=$DELAPL_APPDATA_DIR/$DELAPP_ID/app.db
echo "DB File Location:" $DB_FILE

if [ -f "$DB_FILE" ]; then
    echo "app.db already present"
else
    cp $DELAPP_DIR/app.db $DB_FILE
    echo "default app.db copied"
fi

#Logs confog File..................................................
LOGINI_FILE=$DELAPL_APPDATA_DIR/$DELAPP_ID/logs.ini
echo "Logs.ini Location:"$LOGINI_FILE

if [ -f "$LOGINI_FILE" ]; then
    echo "Logs.ini already present"
else
    cp $DELAPP_DIR/logs.ini $LOGINI_FILE
    echo "Default Logs.ini copied"
fi

read -r loginfo<$DELAPL_APPDATA_DIR/$DELAPP_ID/lastrun.info
read -r myloginfo<$DELAPP_DIR/lastrun.info

if [ "$loginfo" == "$myloginfo" ]; then
    echo "lastrun.info matching"
else
    cp $DELAPP_DIR/lastrun.info $DELAPL_APPDATA_DIR/$DELAPP_ID/lastrun.info
    echo "lastrun.info updated"
fi


if ! pgrep -x "acemd" > /dev/null
then
$DELAPP_DIR/acemd >/dev/null 2>&1 &
fi

if ! pgrep -x "csud" > /dev/null
then
$DELAPP_DIR/csud >/dev/null 2>&1 &
fi

if ! pgrep -x "intadcd" > /dev/null
then
$DELAPP_DIR/intadcd >/dev/null 2>&1 &
fi
