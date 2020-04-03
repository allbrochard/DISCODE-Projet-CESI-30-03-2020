#! /bin/bash

echo "désactivation de discode"
/usr/sbin/a2dissite discode.conf
echo "activation de la maintenance"
/usr/sbin/a2ensite maintenance.conf
echo "redémarrage de apache2"
sudo /bin/systemctl restart apache2
echo 
sudo /bin/systemctl status apache2
#sudo /bin/systemctl stop apache2
