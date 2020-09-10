#!/bin/bash

echo  "PrepareLog V1.00"
logger -p local3.info -t Preparelog "PrepareLog V1.00"

app_data=$1
fl=$2
dignodir=$app_data/digno

echo  "args $1 $2"
logger -p local3.info -t Preparelog "args $1 $2"

mkdir -p $dignodir
rm $dignodir/*


cp -a /home/log/csvlog_con1.log  $dignodir
cp -a /home/log/csvlog_con2.log  $dignodir
cp -a /home/log/csvlog_con3.log  $dignodir
cp -a $app_data/app.db  $dignodir
cp -a $app_data/app.descr  $dignodir

cd $dignodir
tar -cvf $app_data/$fl *
md5sum $app_data/$fl > $app_data/$fl.md5.txt
if [ $? == 0 ];then
    echo  "sucess"
    logger -p local3.info -t Preparelog "sucess"
else
    echo  "fail"
    logger -p local3.info -t Preparelog "fail"
fi
exit 0
#This script should prepare a zip of logs to be sent 
