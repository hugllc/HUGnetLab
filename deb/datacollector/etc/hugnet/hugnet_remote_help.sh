#!/bin/bash
# Use this when you need help from Hunt Utilities Group, LLC

MAINTAINER="Hunt Utilities Group, LLC"
PORT=50022
USER=`hostname`
IP=sync.hugnetlab.com

echo -e "Instructions:\n"
echo -e "This script will allow" $MAINTAINER "to connect to your computer and bypass \nyour firewall. You must leave this running while they are connected. \nAfterwards, you MUST also close this window to make sure the connection \nis closed.\n======\n"

echo -e "Running SSH Client.  The script will appear to hang.  This is normal."
sudo ssh -R 40022:localhost:22 -R 45902:localhost:5900 -R 40080:localhost:80 -l $USER -p $PORT -N $IP
#else 
#	echo "exiting."
#	exit 1;
#fi
