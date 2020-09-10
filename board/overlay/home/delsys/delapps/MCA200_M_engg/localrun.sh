#!/bin/sh

export LD_LIBRARY_PATH=/usr/local/lib
export QT_LOGGING_CONF=logs.ini

startapp app.ini app.db

echo "Closed"
