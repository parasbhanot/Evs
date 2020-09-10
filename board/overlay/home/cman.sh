#!/bin/bash

<<NOTE1

In pc ppp=eth and eth=wifi [Version v11.O]

NOTE1

#machine="pc"
state="NULL"
ping_state="NULL"
failCount=0
pregister="NULL"
pip="google.com"

MASTER_PING_CHECK_TIME="600s"
SLAVE_PING_CHECK_TIME="180s"
PPPD_REBOOT_COUNT=1
PING_RECHECK="30s"
TRY_COUNT=0

initialize_modem () {
    
    
  if [[ $machine == "pc" ]]
  then
        echo "i am on pc and hence i cannot initialize_modem"
  else
       
        echo 108 > /sys/class/gpio/export
        echo out > /sys/class/gpio/PD12/direction

	echo 109 > /sys/class/gpio/export
	echo out > /sys/class/gpio/PD13/direction
        echo "initialize_modem complete"
       
  fi
    
}

# turn on functions
turnoff_pppd () {

  echo "turning off pppd"

  if [[ "$machine" == "pc" ]]
  then
       echo "i am on pc not turning off pppd"
  else
       poff provider
       echo "pppd has been turned off"
  fi
}

turnon_pppd () {

  echo "turning on pppd"

  if [[ "$machine" == "pc" ]]
  then
       echo "i am on pc not turning on pppd"
  else
       pon &
       echo "pppd has been turned on"
       echo "now wait started for 120s to let the pppd eastablish connection"
       sleep 120s
       echo "now wait ended for 120s to let the pppd eastablish connection"
  fi
}

on_off_modem_pulse () {

 
	 mode=$(python /root/check.py)

           if [ "$mode" = "Err" ]
           then
                echo "Since gsm is off , hence turing it on using pulse"


                echo "Pull modem power pin high"
                echo 1 > /sys/class/gpio/PD12/value
                sleep 1s
                echo "Pull modem power pin low"
                echo 0 > /sys/class/gpio/PD12/value

        else
           echo "gsm is already on and hence doing nothing"
	fi

}

turnon_modem () {
    
    if [[ ${machine} == "pc" ]]
    then
        echo "I am on pc and hence cannot turnon_modem"
    else
        on_off_modem_pulse
        echo "wait started for 60s between turn on and pppd start"
        sleep 60s 
        echo "wait ended for 60s between turn on and pppd start"

        echo "setting new baudrate started X"
        /root/pyScan.py
        echo "setting new baudrate ended X"
	sleep 20s 
        turnon_pppd
    fi
}



# restart funcions 
restart_pppd () {

  echo "restart sequence started"
  echo "turning off pppd"
  turnoff_pppd
  echo "wating 5s before restart pppd"
  sleep 5s
  echo "turing on pppd"
  turnon_pppd
  echo "restart sequence ended"
}

restart_alternate_modem(){

	echo "restarting  modem started"
	echo 1 > /sys/class/gpio/PD13/value
	sleep 0.3s
	echo 0 > /sys/class/gpio/PD13/value
	echo "restarting modem ended"

	echo "60s wait started to set the new baudrate"
    	sleep 60s
    	echo "60s wait ended to set the new baudrate"
    	echo "setting new baudrate started Y"
    	/root/pyScan.py
    	echo "setting new baudrate ended Y"
	echo "waiting 20s before starting pppd started"
    	sleep 20s
	echo "wating 20s before starting pppd ended"
}

restart_modem(){

    echo "restarting modem started"
    echo "turning off modem"4
    on_off_modem_pulse # turn off
    echo "60s wait started between restart sequence"
    sleep 60s
    echo "60s wait ended between restart sequence"
    echo "turning on modem"
    on_off_modem_pulse # turn on
    echo "restarting modem ended"

    echo "60s wait started to set the new baudrate" 
    sleep 60s
    echo "60s wait ended to set the new baudrate"
	
    echo "setting new baudrate started Y"
    /root/pyScan.py	
    echo "setting new baudrate ended Y"
    sleep 20s
}

restart_all () {

   echo "restart all sequence started"
   turnoff_pppd
   restart_alternate_modem
   turnon_pppd
   echo "restart all sequence ended"
}

# check functions

check_ppp_state () {

  if [[ $machine == "pc" ]]; then

        echo "i am on pc cannot check ppp state"
  else
	     
        local FILE=/sys/class/net/ppp0/operstate
        
        if [[ -f "$FILE" ]]
        then
            echo "ppp has been registered"
            pregister="yes"
        else
            echo "ppp has not been registered"
            pregister="no"
        fi
        
  fi

}

check_ping () {

  if  [[ "$machine" == "pc" ]]; then
      ping -I wlp1s0 -s 10 -c 20 -w 60 "$pip" >/dev/null 2>&1
      echo $?
  else
      ping -I ppp0 -s 10 -c 20 -w 60  "$pip" >/dev/null 2>&1

      # echo $? #previously
      ret=$?

      if [ $ret -ne 0 ]
      then

        state=$(cat /tmp/evdcapp_sconn_state.txt)

	sleep $PING_RECHECK

	if [[ ${state} == "----" ]]
	then
		echo 1
	else
		echo 0
	fi
      else
      	echo 0
      fi
      
  fi

}

set_gsm_priority () {

    if [[ ${machine} == "pc" ]]
    then
        echo "setting gsm priority started";
        echo "i am on pc and hence cannot set priority"
        echo "setting gsm priority ended";
    else
        echo "setting gsm priority started";
        
        check_ppp_state
        
        if [[ ${pregister} == "yes" ]] 
        then 
            echo "pppd is registered and hence setting gsm priority"
            route add default dev ppp0
        else
            echo "pppd is not registered and hence not setting gsm priority"
        fi 
        echo "setting gsm priority ended";
    fi
}

# Main functions 

try_and_recover () {

  echo "try and recover started"

  for ((var = 0; var < $PPPD_REBOOT_COUNT; var++))
  do
  
      restart_pppd
      set_gsm_priority

      
      check_ping
      
      echo "pppd has been restarted, waiting started for $SLAVE_PING_CHECK_TIME to check the ping again"
      sleep $SLAVE_PING_CHECK_TIME
      echo "pppd has been restarted , waiting ended for $SLAVE_PING_CHECK_TIME to check the ping again"
         
      ping_state=$(check_ping)
      if [[ $ping_state -eq 0 ]]
      then
           echo "ping passed after pppd restart"
           failCount=0
           break
           
      else
      
           echo "ping failed even after pppd restart"
           ((failCount++))

      fi
  done

  
  if [[ ${failCount} -ge $PPPD_REBOOT_COUNT ]]
  then
       echo "pppd has restarted $((PPPD_REBOOT_COUNT+1)) times and hence modem is gonna restart"
       restart_all
       set_gsm_priority 
       
       check_ping
       
       echo "gsm modem has been restarted, waiting started for $SLAVE_PING_CHECK_TIME to check the ping again"
       sleep $SLAVE_PING_CHECK_TIME
       echo "gsm modem has been restarted , waiting ended for $SLAVE_PING_CHECK_TIME to check the ping again"

       ping_state=$(check_ping)

       if [[ "$ping_state" -eq 0 ]]
       then
       	  echo "ping passed after restarting modem"
	  
       else
            echo "ping has failed even after restarting modem"
       fi 
       
       failCount=0
  fi
}


main () {

    echo "Launching Cman version v12.O"

    initialize_modem
    echo "turning on modem"
    turnon_modem
    set_gsm_priority
    
    echo "wating for 300s before first ping check"
    sleep 300s

    echo "starting gsm connection manger"

    while [[ true ]]
    do
    	ping_state=$(check_ping)


    	if [[ "$ping_state" -eq 0 ]]
    	then

		echo "ppp ping passed and hence checking normal ping"

                ping -s 10 -c 20 -w 60  "$pip" >/dev/null 2>&1
                pret=$?

	        if [[ "$pret" -eq 0 ]]
		then

        	   echo "normal ping passed"
        	   TRY_COUNT=0

	        else
			echo "normal ping failed hence setting priority"
                        route add default dev ppp0
	        fi
        	
    	else
        	echo "ppp ping failed "
        	
            ((TRY_COUNT++))
            
            if [[ "$TRY_COUNT" -lt 6   ]] 
            then
                try_and_recover
            fi 
            
            if [[ "$TRY_COUNT" -gt 60 ]] 
            then 
            
                echo "ping is failed from last $TRY_COUNT try_counts"
                readline=$(cat /tmp/evdcapp_state.txt)

                if [[ "$readline" = "idle" ]]
                then
                    echo "state is idle so it is safe to reboot the system"
                    reboot
                else 
                    echo "12hrs has not passed but no charging is going on  so cannot reboot the system" 
                fi
            
            fi
        	
    	fi
    	sleep $MASTER_PING_CHECK_TIME
    done

}

main
