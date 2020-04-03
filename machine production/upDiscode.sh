#! /bin/bash
### VARIABLES ###
neutre='\e[0;m'  #couleur normale
sneutre='\e[4m' #couleur normale + souligné
bvert='\e[1;32m' #couleur verte + gras
rouge='\e[0;31m'
bleu='\e[1;34m'
sbleu='\e[4;34m'




### DEBUT SCRIPT ###~
# Update page maintenance #
echo "mise en production du site"
echo
while true; do
	echo -e "${rouge}l'action activera discode${neutre}"
	read -p "Voulez-vous mettre le site en production ? : " reponse
	case $reponse in
		[YyOo]* ) ssh -t copiessh@adresse -p 229 '/etc/scripts/activeDiscode.sh';break;;
		[Nn]* ) echo "opération annulée";exit;;
		*) echo "merci de faire un choix"
	esac
done

