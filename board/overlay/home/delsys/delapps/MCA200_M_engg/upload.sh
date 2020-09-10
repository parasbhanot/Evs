#!/bin/bash

 #local file
 from=$1
 #remote url
 to=$2
 #file
 file=$3
 #uid
 uid=$4 
 
echo  "upload V1.00"
logger -p local3.info -t DignoUploaderSh "upload V1.00"
logger -p local3.info -t DignoUploaderSh "Args: from:$1, to:$2, file:$3, uid:$4"

curl -T $from/$file  $to/$file --user $uid --connect-timeout 15 --max-time 600 -Y 3000 -y 60 --limit-rate 200000  -v > /tmp/upload.txt 2>&1
if [ $? == 0 ];then
logger -p local3.info -t DignoUploaderSh "Success"
exit 0
else
logger -p local3.info -t DignoUploaderSh "Failed"
exit 1
fi
