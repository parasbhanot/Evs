#!/bin/sh

 #local file
 from=$1
 #remote url
 to=$2
 #file
 file=$3
 #uid
 uid=$4 
 
 curl -T $from/$file  $to/$file --user $uid
 exit 0
 
