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
echo "mise en maintenance du site web"
echo
while true; do
	echo -e "${rouge}l'action aura pour effet d'effacer le fichier actuel${neutre}"
	read -p "Faut il mettre à jour la page de maintenance ? : " reponse
	case $reponse in
		[YyOo]* ) scp '-P 229' /var/www/html/index.html copiessh@adresse:/var/www/html/;break;;
		[Nn]* ) echo "Le fichier ne sera pas mis à jour";break;;
		*) echo "Merci de faire un choix"
	esac
done
while true; do
	echo -e "${rouge}l'action désactivera discode${neutre}"
	read -p "Voulez-vous mettre le site en mode maintenance ? : " reponse
	case $reponse in
		[YyOo]* ) ssh -t copiessh@adresse -p 229 '/etc/scripts/activeMaintenance.sh';break;;
		[Nn]* ) echo "opération annulée";exit;;
		*) echo "merci de faire un choix"
	esac
done

