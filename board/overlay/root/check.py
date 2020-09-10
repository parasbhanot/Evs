#!/usr/bin/python

import serial


def get_baudrate(default_baudrate=115200):

    cmd = "AT+IPR?\r"

    ser = serial.Serial('/dev/ttyS3',default_baudrate, timeout=2)
    ser.write(cmd.encode())

    response = ser.readline()
    response = ser.readline().decode('utf-8')

 #   print ("get baudrate respose {}".format(response),end='')
    ser.close()

    if len(response) == 0:
    	print('Err')
    else :
    	print('Ok')

    return 



#print("initial baudrate:")
get_baudrate()
