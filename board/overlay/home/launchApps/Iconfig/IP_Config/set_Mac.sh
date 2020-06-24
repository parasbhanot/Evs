ifconfig eth0 down
mac=`i2cdump -r 0xFA-0xFF -y 1 0x50 | sed -n 2p | awk '{print $2 ":" $3 ":" $4 ":" $5 ":" $6 ":" $7}'`
ifconfig eth0 hw ether $mac 
ifconfig eth0 up
