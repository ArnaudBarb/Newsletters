<?php

function showSubjects()
{
    $conn = connPdo();
        // var_dump($conn);
    $requete = $conn->prepare("SELECT * FROM t_subjects");
    $requete -> execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    $html = "";
    for ($i = 0; $i < count($resultat); $i++)
    {
        $html .=  $resultat[$i]['SUBCONTENT'] . "<input type='checkbox' name='themecheck[]' value=". $resultat[$i]['ID_SUBJECT'] . "></td>";
    }
    return $html;
    $conn = null;
}