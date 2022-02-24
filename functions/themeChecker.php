<?php

function themeChecker()
{
$conn = connPdo();

$requete = $conn->prepare("SELECT * FROM T_SUBJECTS ORDER BY ID_SUBJECT ASC");
$requete->execute();
$resultat = $requete->fetchAll(PDO::FETCH_OBJ);

$html = "<ul>";

for ($i = 0; $i < count($resultat); $i++)
{
    $html .= "<li>" . $resultat[$i]['ID_SUBJECT'] . "</li>";
}
    $html .= "</ul>";

    return ($html);
}