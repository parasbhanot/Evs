#!/bin/bash
#expect install directory 
file1=$2
install_path=$3

wdir=/tmp/work/delta/installer
adir=$DELAPL_A_DIR/applauncher

echo "Installation Script Starting...with WorkDir $wdir"
logger -p local3.info -t Installer "Installation Script Starting...with WorkDir $wdir"

if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
then
export GNUPGHOME=/root
fi

echo "Preparing Temp Derectory.... "
logger -p local3.info -t Installer "Preparing Temp Derectory.... "

#making temp directory under WorkDir................ 
dirp="tmp_"
dir=$dirp$(date +%s)
dest=$wdir/$dir

echo "Temp Derectory would be $dest"
logger -p local3.info -t Installer "Temp Derectory would be $dest"

mkdir -p $dest
if [ $? != "0" ];then
echo "make temp dir fail"
logger -p local3.info -t Installer "make temp dir fail"
exit 1
fi

#Decrypt----------------------------------------------------------------
dfile=$dest/decryptedApp

echo "Decrypting $file1 as $dfile"
logger -p local3.info -t Installer "Decrypting $file1 as $dfile"

gpg -o $dfile --batch --yes --passphrase jeet21evapp --decrypt $file1
echo "Decrypt Result:"$?
logger -p local3.info -t Installer "Decrypt Result:"$?

#untar------------------------------------------------------------------
echo "Untar $dfile into $dest"
logger -p local3.info -t Installer "Untar $dfile into $dest"

tar -xvf $dfile  -C $dest
echo "Untar Result:"$?
logger -p local3.info -t Installer "Untar Result:"$?

#running preinstall-----------------------------------------------------
source $dest/application/preinstall.sh

if [ $? != "0" ];then
echo "Pre install Fail !!! Abort install"
logger -p local3.info -t Installer "Pre install Fail !!! Abort install"
exit 1
fi
 
#coping application.....................................................
echo "Coping application .............."
logger -p local3.info -t Installer "Coping application .............."
appfolder=$dest/application
read -r appname<$appfolder/app.info
newappdir=$install_path/$appname
newappdir_next=$newappdir

if [ -d "$newappdir"  ]
then

intvar=0
newappdir_next=${newappdir}_$intvar 

while [ -d "$newappdir_next" ]
do
let "intvar += 1"
newappdir_next=${newappdir}_$intvar 
done

fi

echo "New App Directory $newappdir_next"
logger -p local3.info -t Installer "New App Directory $newappdir_next"
mkdir -p $newappdir_next

if [ $? != "0" ];then
echo "make application dir fail"
logger -p local3.info -t Installer "make application dir fail"
exit 1
fi

cp -r $appfolder/*  $newappdir_next

#===================== Executing Post install  ============================================================
source $newappdir_next/postinstall.sh
echo "Installation Finished !!!!"
exit 0

