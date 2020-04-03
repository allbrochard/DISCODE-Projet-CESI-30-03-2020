#! /bin/bash

echo "désactivation de la maintenance"
/usr/sbin/a2dissite maintenance.conf
echo "activation de discode"
/usr/sbin/a2ensite discode.conf
echo "redémarrage de apache2"
sudo /bin/systemctl restart apache2
echo 
sudo /bin/systemctl status apache2
#sudo /bin/systemctl stop apache2
