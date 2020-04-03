#! /bin/bash
### VARIABLES ###
neutre='\e[0;m'  #couleur normale
sneutre='\e[4m' #couleur normale + souligné
bvert='\e[1;32m' #couleur verte + gras
rouge='\e[0;31m'
bleu='\e[1;34m'
sbleu='\e[4;34m'


### DEBUT SCRIPT ###~
# script général #
clear
echo
echo -e  "			~~  ${bleu}Script gestion des serveurs${neutre}  ~~"
echo
while true; do
	echo -e "${bleu}Que souhaitez vous faire ? ${neutre}"
	echo
	echo -e "	${bvert}1${neutre} - Afficher l'aide"
	echo -e "	${bvert}2${neutre} - Faire un pull sur ce serveur"
	echo -e "	${bvert}3${neutre} - Faire un pull sur le serveur de production"
	echo -e "	${bvert}4${neutre} - Mettre à jour le .conf du serveur distant"
	echo -e "	${bvert}5${neutre} - Mettre en maintenance le site"
	echo -e "	${bvert}6${neutre} - Activer Discode"
	echo -e "	${bvert}7${neutre} - Envoyer les scripts sur le serveur distant"
	echo
	echo -e "	${bvert}C${neutre} - Nettoyer le shell"
	echo -e "	${bvert}8${neutre} - Quitter le programme"
	echo
	read -p "entrez le numéro de votre choix " reponse
	echo
	case $reponse in
		[1]* ) /etc/scripts/help.sh;continue;;
        	[2]* ) /etc/scripts/pullv1.sh;continue;;
        	[3]* ) /etc/scripts/pullProd.sh;continue;;
        	[4]* ) /etc/scripts/upApacheConf.sh;continue;;
       		[5]* ) /etc/scripts/maintenance.sh;continue;;
        	[6]* ) /etc/scripts/upDiscode.sh;continue;;
        	[7]* ) /etc/scripts/upScripts.sh;continue;;
		[Cc]* ) clear;continue;;
        	[8]* ) break;;
		*) echo "Merci de faire un choix"
	esac
done



