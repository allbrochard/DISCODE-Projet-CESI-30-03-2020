#!/bin/bash

### VARIRABLES ###

#Couleurs
neutre='\e[0;m'
vert='\e[1;32m'
rouge='\e[1;36m'

#Erreurs
OK='Déjà à jour.'

### DEBUT SCRIPT ###
echo "un pull va être effectué dans /var/www/html/racine"
while true; do
        read -p "Pour continuer appuyez sur [y]" reponse
        case $reponse in
                [YyOo]* ) cd /var/www/html/racine;
                        gitRep=$(sudo git pull);
                          #git pull;
                          if [ "$gitRep" = "$OK" ]
                          then
                                  echo -e "${vert}Déjà à jour!${neutre}"
                          else
                                  echo -e "${rouge} Une erreur a été détéctée${neutre}"
                                  read -p "Voulez vous faire un git reset --hard ? [y/n] " repError
                                  case $repError in
                                          [YyOo]* ) cd /var/www/html/racine;
                                                  sudo git reset --hard;
                                                  sudo git pull;break;;
                                          [Nn]* ) echo "le pull ne sera pas effecuté";exit;;
                                          * ) echo "merci de faire un choix"
                                  esac
                          fi
                          break;;
                [Nn]* ) echo -e "${rouge}Opération annulée${neutre}";exit;;
                * ) echo "Merci de mettre [Y-y-O-o] pour valider ou [N-n] pour annuler"
        esac
done

