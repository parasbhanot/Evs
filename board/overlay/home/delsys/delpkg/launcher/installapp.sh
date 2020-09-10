#!/bin/bash

export LD_LIBRARY_PATH=/usr/local/lib

echo  "Application Installer V1.00"
logger -p local3.info -t InstallApp "Application Installer V1.00"

file1=$1

if [[ ${file1: -4} == ".gpg" ]]; then
echo "$file is Encrypted Application"
elif [[ ${file1: -4} == ".tar" ]]; then
echo "$file is Unencrypted Tar"
else
echo "Unknown file type, Aborting"
exit -1
fi

if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
then
export HOME=/root
#export GNUPGHOME=/root
fi

if [ -f "/home/delsys/product_config.db" ];then 
PC_File="/home/delsys/product_config.db"
elif [ -f "$HOME/delsys/product_config.db" ];then 
PC_File="$HOME/delsys/product_config.db"
else 
echo "Product Config Not Found Exiting !!!"
logger -p local3.info -t InstallApp "Product Config Not Found Exiting !!!"
exit -2
fi

echo "Home: $HOME , User: $USER, Product Config: $PC_File"

p_slno=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_serial_no';")
p_cat=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_category';")
p_model=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'product_model';")
apps_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_dir';")
apps_data_dir=$(sqlite3 $PC_File "SELECT value FROM keys where key = 'apps_data_dir';")

echo "PC: SL:$p_slno, CAT:$p_cat, Model:$p_model, AD: $apps_dir, ADD: $apps_data_dir"
#===========================================================================================================
install_path=$apps_dir

wdir=/tmp/work/delta/installer

echo "Installation Script Starting...with WorkDir $wdir"
logger -p local3.info -t Installer "Installation Script Starting...with WorkDir $wdir"

#if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
#then
#export GNUPGHOME=/root
#fi

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
exit -3
fi

if [[ ${file1: -4} == ".gpg" ]]; then

#Decrypt----------------------------------------------------------------
echo "Gnupghome: $GNUPGHOME"
echo "Check gpg keys............"

gpg --list-keys

dfile=$dest/decryptedApp

echo "Decrypting $file1 as $dfile"
logger -p local3.info -t Installer "Decrypting $file1 as $dfile"

gpg -o $dfile --batch --yes --passphrase jeet21evapp --decrypt $file1
res=$?
echo "Decrypt Result:$res"
logger -p local3.info -t Installer "Decrypt Result:"$res

#if [ $res != "0" ];then
#echo "Decrypt or Varify Fail Intallation Aborted"
#logger -p local3.info -t Installer "Decrypt or Varify Fail Intallation Aborted"
#exit -4
#fi


else
dfile=$file1
fi

#untar------------------------------------------------------------------
echo "Untar $dfile into $dest"
logger -p local3.info -t Installer "Untar $dfile into $dest"

tar -xvf $dfile  -C $dest
res=$?
echo "Untar Result: $res"
logger -p local3.info -t Installer "Untar Result: $res"

#running preinstall-----------------------------------------------------
$dest/temp-package/preinstall.sh

if [ $? != "0" ];then
echo "Pre install Fail !!! Abort install"
logger -p local3.info -t Installer "Pre install Fail !!! Abort install"
exit -5
fi

#coping application.....................................................
echo "Coping application .............."
logger -p local3.info -t Installer "Coping application ................."
appfolder=$dest/temp-package
read -r appname<$appfolder/app.info
newappdir=$install_path/$appname

#....preparing for next
newappdir_next=$newappdir
appname_next=$appname

if [ -d "$newappdir"  ]
then

intvar=1
newappdir_next=${newappdir}_$intvar 
appname_next=${appname}_$intvar

while [ -d "$newappdir_next" ]
do
let "intvar += 1"
newappdir_next=${newappdir}_$intvar 
appname_next=${appname}_$intvar
done

fi

echo "New App Directory $newappdir_next"
logger -p local3.info -t Installer "New App Directory $newappdir_next"
mkdir -p $newappdir_next

if [ $? != "0" ];then
echo "make application dir fail"
logger -p local3.info -t Installer "make application dir fail"
exit -6
fi

cp -r $appfolder/*  $newappdir_next

#===================== Executing Post install  ============================================================
$newappdir_next/postinstall.sh

if [ $? != "0" ];then
echo "post install fail"
logger -p local3.info -t Installer "post install fail"
exit -7
fi

echo "Installation Finished Succefully !!!"
logger -p local3.info -t Installer "Installation Finished Succefully !!!"

#===================== Executing Post install  ============================================================

if [ $2 == "setdefault" ];then

echo "Setting newly installed app as defaultapp"
logger -p local3.info -t Installer "Setting $appname_next as defaultapp"

echo $appname_next > $apps_dir/defaultapp.path

fi

exit 0

