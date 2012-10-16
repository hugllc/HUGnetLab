#!/bin/bash
# Use this when you need help from Hunt Utilities Group, LLC

MAINTAINER="Hunt Utilities Group, LLC"
PORT=50022
USER=`hostname`
IP=sync.hugnetlab.com

echo -e "Instructions:\n"
echo -e "This script will allow" $MAINTAINER "to connect to your computer and bypass \nyour firewall. You must leave this running while he is connected. \nAfterwards, you MUST also close this window to make sure the connection \nis closed.\n======\n"

#echo -ne "Call" $MAINTAINER "and ask for his IP Address. Type it in now. When finished, hit [Enter] \nIP= "

#read IP

#echo -n "Is this correct? (Y/n) "

#read CHECK

#if [ $CHECK == "y" -o $CHECK == "Y" ];
#then
sudo ssh -R 60022:localhost:22 -l $USER -p $PORT -N $IP	
#else 
#	echo "exiting."
#	exit 1;
#fi
