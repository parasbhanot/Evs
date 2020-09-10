#!/bin/bash

uid=$1
file=$2
url=$3

logger -p local3.info -t downloader "Downloading $file from URL $url"

if [ -d "/home"  ];then
homedir=/home
else
homedir=$HOME
fi

fwdslogdir=$homedir/log/fwds
mkdir -p $fwdslogdir

echo "Downloading uid: $uid , File: $file , url: $url" > $fwdslogdir/download.txt 2>&1  
#curl -u $uid -o $file --url $url --limit-rate 200000 -v > $fwdslogdir/download.txt 2>&1 
curl -u $uid -o $file $url --connect-timeout 15 --max-time 600 -Y 3000 -y 60 --limit-rate 200000  -v >> $fwdslogdir/download.txt 2>&1 
retcode=$?
echo "finished, return code: $retcode" 
echo "finished, return code: $retcode" >> $fwdslogdir/download.txt 2>&1 
logger -p local3.info -t downloader "finished, return code: $retcode , Check download details in $fwdslogdir/download.txt" 
exit $retcode
