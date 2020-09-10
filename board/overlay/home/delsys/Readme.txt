Procedure to copy delsys along with mage -----------------------------

1. copy delsys to /home 

copy /home/delsys/etc/syslog-ng.conf    to   /etc/
copy /home/delsys/etc/logrotate.conf    to   /etc/
copy /home/delsys/etc/X11/xinitrc       to   /etc/X11/xinit/
copy /home/delsys/etc/init.d/S95_delsysini to /etc/init.d/
copy /home/delsys/etc/init.d/S97PENV    to    /etc/init.d/
copy /home/delsys/delservices/fwdd/evcs-dbus.conf to /usr/share/dbus-1/system.d/
copy /home//home/delsys/etc/web/*  to   /var/www
chmod -R 755 /var/www
chmod -R 777 delsys

