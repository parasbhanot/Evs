#!/bin/bash

fdir=$1
file1=$2

export GNUPGHOME=/root

echo "making dir"

mkdir $fdir

if [ $? != "0" ] 
then
echo "make dir fail"
exit 1
fi

echo "decrypting "
gpg -o $fdir/EvdcApp --passphrase jeet21evapp --decrypt $file1

if [ $? != "0" ]
then
echo "decrypt fail"
exit 2
fi

echo "Allowing permission "
chmod +x $fdir/EvdcApp

if [ $? != "0" ]
then
echo "chmod fail"
exit 3
fi

exit 0
