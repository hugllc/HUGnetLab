#!/bin/bash
# tputcolors

BOARDNUM="101A"

echo -e "$(tput bold)To calibrate your Celani cell, please make sure that the Power Mode switch is in the AUTOMATIC position, that the Channel 1 switch is in the ON position and that the Channel 2 switch is in the OFF position.$(tput sgr0)"

read -p "When you are ready to begin the calibration, please press Enter."

hugnet_startdac -i $BOARDNUM

echo -e "\nFirst step of calibration complete. $(tput bold)Please now make sure that the Channel 1 switch is in the OFF position and that the Channel 2 switch is in the ON position.$(tput sgr0)"

read -p "When you are ready to continue the calibration, please press Enter."

hugnet_startdac -i $BOARDNUM

echo -e "\nSecond step of calibration complete. $(tput bold)Please now make sure that both the Channel 1 and Channel 2 switches are in the ON position.$(tput sgr0)"

read -p "When you are ready to complete the calibration, please press Enter."

hugnet_startdac -i $BOARDNUM

echo -e "\n$(tput bold)Calibration complete.$(tput sgr0)"
