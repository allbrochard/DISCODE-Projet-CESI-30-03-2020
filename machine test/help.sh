#! /bin/bash
#Couleurs
neutre='\e[0;m'  #couleur normale
sneutre='\e[4m' #couleur normale + soulign√©
bvert='\e[1;32m' #couleur verte + gras
rouge='\e[1;36m'
bleu='\e[1;34m'
sbleu='\e[4;34m'

function centrer() {
	long=$(( $(tput cols) / 2 + ${#1} / 2 ))
	fin=$(( $(tput cols) - ${long} ))
	printf "%${long}s%${fin}s\n" "$1" " "
}

centrer  "############"
centrer  "## ~AIDE~ ##"
centrer  "############"


echo -e "${bvert}Cette page recapitule les commandes ainsi que leur fonction${neutre}"
echo
echo -e "${sbleu}gpLocal:${neutre} Cette commande execute le script ${sneutre}pullv1.sh${neutre} qui permet de faire un pull du projet depuis n'importe ou dans le shell "
echo
echo -e "${sbleu}gpProd:${neutre} Cette commande execute le script ${sneutre}pullProd.sh${neutre} qui permet de faire un pull du projet sur le serveur de prod"
echo
echo -e "${sbleu}maintenance:${neutre} Cette commande execute le script ${sneutre}maintenance.sh${neutre} qui permet de mettre en place la maintenance"
echo
echo -e "${sbleu}upDiscode:${neutre} Cette commande execute le script ${sneutre}upDiscode.sh${neutre} qui permet de mettre en production le site"
echo
echo -e "${sbleu}upApacheConf:${neutre} Cette commande execute le script ${sneutre}upApacheConf.sh${neutre} elle met a jour le fichier discode.conf"
echo
echo -e "${sbleu}upScripts:${neutre} Cette commande execute le script ${sneutre}upScripts.sh${neutre} elle permet de mettre ‡ jour les scripts sur le serveur de prod"
echo
