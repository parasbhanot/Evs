#!/bin/bash

<<NOTE1

In pc ppp=eth and eth=wifi

NOTE1

#machine="pc"
state="NULL"
ping_state="NULL"
failCount=0
pregister="NULL"
pip="google.com"

initialize_modem () {
    
    
  if [[ $machine == "pc" ]]
  then
        echo "i am on pc and hence i cannot initialize_modem"
  else
       
        echo 108 > /sys/class/gpio/export
        echo out > /sys/class/gpio/PD12/direction
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

 if [[ ${machine} == "pc" ]]
 then
        echo "I am on pc and hence cannot pulse modem"
  else
        echo "Pull modem power pin high"
        echo 1 > /sys/class/gpio/PD12/value
        sleep 1s
        echo "Pull modem power pin low"
        echo 0 > /sys/class/gpio/PD12/value
  fi

}

turnon_modem () {
    
    echo "starting modem for the first time"
    if [[ ${machine} == "pc" ]]
    then
        echo "I am on pc and hence cannot turnon_modem"
    else
        on_off_modem_pulse
	echo "wait started for 60s between turn on and pppd start"
	sleep 60s 
	echo "wait ended for 60s between turn on and pppd start"
	#jeet
        stty 115200 -F /dev/ttyS3
        echo "AT" > /dev/ttyS3
        echo "AT+IPR=460800" > /dev/ttyS3
        sleep 2s    	  
        #jeet	
	turnon_pppd
    fi
}

# restart funcions 
restart_pppd () {

  echo "restart sequence started"
  echo "turning off ppd"
  turnoff_pppd
  echo "wating 5s before restart pppd"
  sleep 5s
  echo "turing on pppd"
  turnon_pppd
  echo "restart sequence ended"
}

restart_modem(){

    echo "restarting modem started"
    echo "turning off modem"
    on_off_modem_pulse # turn off
    echo "60s wait started between restart sequence"
    sleep 60s
    echo "60s wait ended between restart sequence"
    echo "turning on modem"
    on_off_modem_pulse # turn on
    echo "restarting modem ended"

    #jeet
    stty 115200 -F /dev/ttyS3
    echo "AT" > /dev/ttyS3
    echo "AT+IPR=460800" > /dev/ttyS3
    sleep 2s    	  
    #jeet		
}

restart_all () {

   echo "restart all sequence started"
   turnoff_pppd
   restart_modem
   turnon_pppd
   echo "restart all sequence ended"
}

# check functions

get_ethernet_state () {

echo "getting the ethernet connection state"

  if [[ ${machine} == "pc" ]]
  then
           echo "i am on pc and will tell the pc ethernet state"
 		   state=$(cat /sys/class/net/eno1/operstate)
  else
		   state=$(cat /sys/class/net/eth0/operstate)
  fi
}

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
      ping -I wlp1s0 -s 10 -c 1 -w 1 "$pip" >/dev/null 2>&1
      echo $?
  else
      ping -I ppp0 -s 10 -c 1 "$pip" >/dev/null 2>&1
      echo $?
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

check_and_set_priority () {

  get_ethernet_state

  if [[ "$state" = "up" ]]
  then
       echo "ethernet is connected and hence setting gsm priority"
       set_gsm_priority
  else
       echo "ethernet is not connected"
       echo "No need to set the priority"
  fi
}

# Main functions 

try_and_recover () {

  echo "try and recover started"

  restart_pppd
  #check_and_set_priority
  set_gsm_priority
  ((failCount++))

  for ((var = 0; var < 3; var++))
  do
      ping_state=$(check_ping)

      if [[ $ping_state -eq 0 ]]
      then
           echo "ping passed"
           echo "reconnection successful"
           failCount=0
           break
      else
         echo "ping failed"
         echo "reconnection failed"
         restart_pppd
         #check_and_set_priority
	 set_gsm_priority
         ((failCount++))

	 echo "wating sarted for 60s between each ping check and pppd restart"
	 sleep 60s
	 echo "waiting ended for 60s between each ping check and pppd restar"
      fi
  done

  if [[ ${failCount} -eq 4 ]]
  then
       echo "pppd has restarted 4 times and hence modem is gonna restart"
       restart_all
       #check_and_set_priority
       set_gsm_priority 
       failCount=0
  fi
}


main () {

    
    initialize_modem
    echo "turning on modem"
    turnon_modem
    echo "setting priority"

    #check_and_set_priority
    set_gsm_priority

    echo "starting gsm connection manger"

    while [[ true ]]
    do
    ping_state=$(check_ping)

    if [[ "$ping_state" -eq 0 ]]
    then
        echo "ping passed"
    else
        echo "ping failed and hence i will try to reconnect"
        try_and_recover
    fi
    sleep 300s # 5min sleep
    done

}

main


