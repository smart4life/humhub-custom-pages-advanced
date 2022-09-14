TODOS 
=====

On crée une page via ce module Custom pages de type "iframe" dans "Without adding to navigation (Direct link)".
Puis, le module "Custom Pages Advanced" propose une interface d'admin permettant d'ajouter un lien dans la top bar uniquement pour les utilisateurs de certains groupes. Une case à cocher permet de charger la librairie "Iframe resizer".
Concrètement, dans l'admin de ce module, on aurait la liste des pages qui ont été créées "Without adding to navigation (Direct link)" (je sais que votre besoin c'est pour une seule page, mais je pense que c'est mieux si le module est plus générique et de toutes façons il aurait fallu pouvoir choisir la page concernée).
On clique sur le crayon et on arrive sur l'admin avancée de cette page.
On a 2 champs :
des cases à cocher correspondant aux différents groupes existant sur la plateforme
la case à cocher pour charger la librairie "Iframe resizer".
Puis le module affichera la page via sa propre vue afin de pouvoir intégrer la librairie "iframe resizer".
Il faudra donc ajouter une table dans la BDD pour enregistrer ces données (3 colonnes : ID custom page, groupes sélectionnés, librairie iframe resizer).