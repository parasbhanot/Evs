#!/usr/bin/env python

import dbus
	
progname = 'org.delta.evcs'
objpath  = '/PackageManager'
intfname = 'PackageManager.defif'
methname = 'version'

bus = dbus.SystemBus()

obj  = bus.get_object(progname, objpath)  # Here we get object
intf = dbus.Interface(obj, intfname)      # Here we get interface
meth = intf.get_dbus_method(methname)      # Here we get method

print(meth())            
