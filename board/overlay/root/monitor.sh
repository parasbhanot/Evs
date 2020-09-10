pip="google.com"
state="NULL"

check_ping () {


         ping -I wwan0 -s 10 -c 20 -w 60  "$pip" >/dev/null 2>&1
         ret=$?

         if [ $ret -ne 0 ]
         then

                 state=PF

         else
                 state=PS

         fi

}

while [[ true ]]
do

        STATUS=$(mmcli -m 0 |grep state | head -n 1 | awk '{print $3}')

        if [[ ${STATUS} == "'registered'" ]]
        then  
                #echo "gsm has lost connectivity"

                QUALITY=$(mmcli -m 0 |grep quality |awk '{print $4}')

                echo "gms connectivity lost with signal quality : $QUALITY"

                mmcli -m 0 --simple-connect="apn=airtelgprs.com"
                udhcpc -q -f -n -i wwan0

        elif [[ ${STATUS} == "'connected'" ]] 
        then
                #echo "gsm is connected to internet"

                check_ping

                QUALITY=$(mmcli -m 0 |grep quality |awk '{print $4}')

                echo "gsm is connected with signal quality : $QUALITY and state : $state"
        else
                echo "unknown status of gsm"
        fi

        sleep 30s

done

