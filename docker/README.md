## Démarrer le conteneur

`docker-compose up --build`

Une fois les images récupérées depuis DockerHub (ce qui peut prendre du temps en fonction de la connexion), ces dernières sont mises en cache ce qui devrait réduire le temps mis pour relancer le conteneur.

Normalement, le conteneur est configuré pour que chaque modification faite sur votre projet soit visible en direct sur l'application, sans devoir relancer le conteneur.

Vous avez aussi la possibilité de lancer le conteneur en mode "détaché", c'est à dire, que ce dernier tourne en fond et ne bloque pas votre terminal en utilisant l'option `-d` : 

`docker-compose up -d --build`