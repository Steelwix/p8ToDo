Collaborer sur le projet


Introduction à Github

Pour travailler en équipe sur le projet, nous allons utiliser Github. C’est un outil qui marche comme un Google Drive, chaque personne va pouvoir éditer le projet en même temps que d’autres, à la seule différence que les éditions devront être validés pour intégrer la version finale. 
Pour faire ça, chaque collaborateur va cloner le projet qui est sur le Github, pour pouvoir l’éditer localement dans ce qu’on appelle une branche. Lorsque la tâche correspondant à la branche est réalisée, le collaborateur l’envoie sur le Github, et la branche sera sauvegardée. Pour fusionner la branche du collaborateur avec la version finale nommée main, la branche du collaborateur devra être sujet à un pull request, c'est-à-dire une demande de fusion avec la branche principale. Si les modifications sont validées par le lead dev, la branche du collaborateur est fusionnée à la version principale.

Pour utiliser cet outil, il faut dans un premier temps installer Git : https://git-scm.com

note: pour Linux, notamment Ubuntu pour WSL par exemple, il suffit d'exécuter la commande sudo apt install git-all dans le terminal
Il faudra ensuite notamment se créer un compte sur Github et s’identifier dans le terminal git avec les commandes suivantes : 
git config --global user.name “Votre nom”
git config --global user.email “votreemail@email.com”

Par la suite, il faudra passer par la console pour accéder au dossier dans lequel vous voulez installer le projet en local. Une fois dans le bon dossier, il faut désormais cloner le projet, avec la commande : git clone git@github.com/Steelwix/p8ToDo

Une fois le projet récupéré, il faut basculer sur une autre branche pour ensuite pouvoir demander la fusion plus tard. Pour créer une branche, il faut utiliser la commande : 
git checkout -b [nom] 

Pour savoir les tâches qui doivent être réalisées, il faut aller sur la rubrique Issues sur Github : https://github.com/Steelwix/p8ToDo/issues

Après avoir terminé une tâche, il faut désormais exporter la branche sur le Github. Pour cela, il faut une suite de 3 commandes : 
git add .  Cette commande sert à ajouter tous les fichiers modifiés à l’envoi sur le Github.
git commit -m “[nom de l’issue]” Celle-ci va définir un nom unique pour l’envoi actuel.
git push origin [nom de la branche] Et cette dernière envoi le tout sur Github.

//pull request


Les bonnes pratiques

Pour travailler en commun sur un projet professionnel, il faut travailler avec une certaine méthodologie. L’avantage du développement, c’est que cette méthodologie est un ensemble de loi définie par et pour les développeurs, et qui est donc universelle. On y retrouve 3 grands principes: 

Keep It Simple Stupid (KISS)

Sous son nom léger se cache un principe fondamental: ne pas s’embourber dans des mécaniques complexes quand on peut faire plus simple.

En effet, il peut arriver parfois de devoir créer quelque chose de toutes pièces, mais il est plus sain pour tout le monde de se renseigner sur la meilleure méthode de le faire, plutôt que de tenter un bricolage que chaque développeur devra décrypter derrière.
Il est aussi important de laisser des notes dans son code, car notre propre travail peut devenir une énigme après quelques jours loin du projet. L’ergonomie demande du travail à son créateur.

PSR principles

Les principes PSR sont des standards de code pour le PHP. C’est une véritable petite bible, consultable sur le site : https://www.php-fig.org/psr/
Grâce à Symfony, beaucoup de ses règles n’ont pas à être considérées (par exemple, la règle PSR-4 à propos de l’autoloading est directement géré par Symfony). Le standard le plus important à avoir en tête est le PSR-12, qui décrit toutes les normes de syntaxe avancées. 
Des extensions d’éditeur de code pour PHP et Symfony peuvent retravailler la syntaxe pour nous. Par exemple corriger l'indentation du code, supprimer les espaces dans les parenthèses d’une méthode etc.

SOLID principles

SOLID est un acronyme pour les 5 principes qui le composent.

S - Responsabilité unique (Single responsibility principle)
O - Ouvert/fermé (Open/closed principle)
L - Substitution de Liskov (Liskov substitution principle)
I - Ségrégation des interfaces (Interface segregation principle)
D - Inversion des dépendances (Dependency inversion principle)

Single responsibility principle

“Une classe doit avoir une seule et unique raison de changer, ce qui  signifie qu’une classe ne doit appartenir qu’à une seule tâche.”

C'est -à -dire qu’une classe doit s’occuper du rôle qui lui est attribué. Une classe Account va s’occuper de gérer les méthodes liées aux comptes des utilisateurs, mais ne va pas s’occuper du format de sortie des données par exemple, il faudra créer une autre classe qui va récupérer les données et qui se chargera d’adapter le format.

 Open/closed principle

“Les objets ou entités devraient être ouverts à l’extension mais fermés à la modification.”

Le message de ce principe est qu’il faut pouvoir améliorer et agrandir chaque portion du projet, sans avoir à retaper des éléments déjà créés. Pour la classe Account, si des méthodes doivent être assignées à un utilisateur que si ce dernier est un administrateur par exemple, il est préférable de placer cette méthode dans l’entité User plutôt qu’un code changeant dans une autre classe.

Liskov substitution principle

“Les fonctions qui utilisent des pointeurs ou des références à des classes de base doivent pouvoir utiliser des objets de classes dérivées sans le savoir.”

C’est un principe qui a une logique mathématique qui explique que si A et B sont des implémentations ou des classes héritées de C, alors A et B doivent pouvoir être interchangés sans casser l'exécution du programme.

Interface segregation principle

“Un client ne doit jamais être forcé à installer une interface qu’il n’utilise pas et les clients ne doivent pas être forcés à dépendre de méthodes qu’ils n’utilisent pas.”

Une interface est censée vous permettre d’obliger un objet à utiliser certaines fonctionnalités. Il est donc important de ne pas surcharger ses interfaces pour distinguer plus facilement les contrats et leurs utilités.

Dependency inversion principle

“Les modules d’une application devraient dépendre d’abstractions, pas d’implémentations”

Ce dernier principe explique qu’une classe à besoin de dépendances pour fonctionner. Il faut donc injecter ces dépendances soit par le constructeur, soit par les mutateurs.
Autrement dit, on évite de passer des objets en paramètre lorsqu’une interface est disponible.
Passer en paramètre une interface permet d’être certain que l’objet que tu manipules, peu importe son type, aura les bonnes méthodes associées.
