#!/bin/bash

### VARIABLES ###
neutre='\e[0;m'  #couleur normale
sneutre='\e[4m' #couleur normale + souligné
bvert='\e[1;32m' #couleur verte + gras
rouge='\e[0;31m'
bleu='\e[1;34m'
sbleu='\e[4;34m'




### DEBUT SCRIPT ###~
# début du pull #
echo "mise à jour du dossier /var/www/html/racine sur le site de production"
echo
while true; do
        echo -e "${rouge}l'action aura pour effet de faire un git pull${neutre}"
        read -p "Voulez vous faire un git pull sur le site distant ? : " reponse
        case $reponse in
                [YyOo]* ) ssh -t copiessh@adresse -p 229 '/etc/scripts/pullv1.sh';break;;
                [Nn]* ) echo "Le fichier ne sera pas mis à jour";break;;
                *) echo "Merci de faire un choix"
        esac
done
