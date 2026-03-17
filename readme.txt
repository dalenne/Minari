Pour créer la base de donnée : 
Il faut lancer le client mysql
"mysql -h nom_serveur —u nom_utilisateur -p"
puis taper son mot de passe
(en général si on a pas changé le nom_serveur c'est localhost et le nom_utilisateur c'est root)
Le mdp de base est root en général

Ensuite il faut écrire "SOURCE projetminari.sql"
projetminari.sql représente l'ensemble de la base de donnée du réseau social (cf le schéma)

Si jamais vous avez fait des modifications et vouliez revenir sur la base donnée original il suffit de supprimer la base de donnée
et de nouveau "SOURCE projetminari.sql"

Ensuite une fois la base de donnée créée, pour faire fonctionner le site il suffit de cliquer sur Minari.php et il vous redirigera automatiquement vers la page connexion ou profil si vous êtes déjà connecté.
(P-S: faire attention pour les commandes $connexion au sql car personnellement je n'avais pas de mdp donc la commande était de la forme 
$connexion = mysqli_connect("localhost", "root", "", "projetminari"); mais si votre mot de passe est root il faut changer en 
$connexion = mysqli_connect("localhost", "root", "root", "projetminari");)

Pour accéder au compte admin : 
Pseudo : minari
MDP : minari

YAO Alex
LONG Dalenne