<?php
//déclaration d'une fonction servant à afficher le contenu d'une base de donnée sous forme de checkbox
function showSubjects()
{
//connexion à la bdd
    $conn = connPdo();
//Préparation de la requète à la base de données dans la table t_subjects
    $requete = $conn->prepare("SELECT * FROM t_subjects");
//exécution de la demande de tout sélectionner dans la table
    $requete -> execute();
//insertion dans une variable d'un tableau contenant toutes les valeurs qui ont été trouvées
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
//Déclaration d'une variable afin de contenir le résultat de la boucle for
    $html = "";
//boucle servant à parser le tableau issu de la requète
    for ($i = 0; $i < count($resultat); $i++)
    {
    //incrémentation des résultats du parsing dont les valeurs sont concaténées comme suit:
    //valeurs contenues dans les index du tableau (tous les noms de sujets) . insertion de l'input dont les valeurs du nom sont
    // contenues dans un tableau, (elles-mêmes dépendant de la valeur des l'id des sujets (value=))
        $html .=  $resultat[$i]['SUBCONTENT'] . "<input type='checkbox' name='themecheck[]' value=". $resultat[$i]['ID_SUBJECT'] . ">";
    }
    return $html;
    $conn = null;
}