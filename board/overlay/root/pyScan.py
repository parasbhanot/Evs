#!/usr/bin/python


import serial


def get_baudrate(default_baudrate=115200):

    cmd = "AT+IPR?\r"

    ser = serial.Serial('/dev/ttyS3',default_baudrate, timeout=2)
    ser.write(cmd.encode())

    while True :

        byteCount = ser.inWaiting()

        if( byteCount >= 0):

            response = ser.readline()
            response = ser.readline().decode('utf-8')
            print ("get baudrate respose {}".format(response),end='')
            break
    ser.close()
    return 

def set_baudrate():

    cmd="AT+IPR=460800\r"

    #cmd = "AT+IPR?\r"
    ser = serial.Serial('/dev/ttyS3', 115200, timeout=2)
    ser.write(cmd.encode())

    while True :

        byteCount = ser.inWaiting()

        if( byteCount >= 0):

            response = ser.readline()
            response = ser.readline().decode('utf-8')
            #print ("initial baudrate is -> {}".format(response.decode("utf-8")),end='')
                
            print("set baudrate respone {}".format(response),end='')
            break
    ser.close()
    return


print("initial baudrate:")
get_baudrate()
print("setting baudrate:")
set_baudrate()
print("Checking new baudrate:")
get_baudrate()
