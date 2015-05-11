##Docker

Le Docker file présent dans ce dossier permet de créer une image de container permettant de démarer un serveur IPEXpress

il y a au total 3 scripts :

####build.sh 

Qui permet de créér la base de donnéeet de configurer les fichiers de configuration nécéssaires dans le conteneur 

####distrib.sh 

Qui permet d'installer une distribution (ubuntu 14.04) de démonstration dans le projet IPEXpress

####start.sh

C'est le script qui permet de démarrer tous les services qui se lancent au démarage du conteneur.
