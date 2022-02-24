<?php

function showSubjects()
{
    $conn = connPdo();
        // var_dump($conn);
    $requete = $conn->prepare("SELECT * FROM t_subjects");
    $requete -> execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($resultat);

    $html = "<table>";
    $html .= "<tr>";
    $html .= "<th>Centre d'interrêt</th>";
    $html .= "</tr>";
    
    for ($i = 0; $i < count($resultat); $i++){
        $html .= "<tr>";
        $html .= "<td>" . $resultat[$i]['SUBCONTENT'] . "<input type = 'checkbox'></td>";
        $html .= "</tr>";
    }
        $html .= "</table>";

        return ($html);

        // var_dump($html);
}