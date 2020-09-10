#!/bin/bash
if [ $HOSTNAME == "buildroot" ] || [ $HOSTNAME == "Broot" ]
then
cp /home/delsys/etc/syslog-ng.conf /etc/
cp /home/delsys/etc/logrotate.conf /etc/
cp /home/delsys/etc/X11/xinitrc /etc/X11/xinit/
cp /home/delsys/etc/init.d/S95_delsysini /etc/init.d/
cp /home/delsys/etc/init.d/S97PENV /etc/init.d/
#
cp /home/delsys/etc/ppp/peers/update.sh /etc/ppp/peers/ 
# update S98PPP
rm /etc/init.d/S99gpg
#
cp /home/delsys/delservices/fwdd/evcs-dbus.conf /usr/share/dbus-1/system.d/
cp -a /home/delsys/etc/web/* /var/www
chmod -R 755 /var/www
echo "Delsys Install Completed !!!"
exit 0
else
echo "This is not evdc system !!! abort"
exit 1
fi
