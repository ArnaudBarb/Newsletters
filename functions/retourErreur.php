<?php

function retourErreur(array $erreur) : string
{
    $messageErreur = "<ul>";
    $i = 0;
    do 
    {
        $messageErreur .= "<li>";
        $messageErreur .= $erreur[$i];
        $messageErreur .= "</li>";
        $i++;
    } 
    while ($i < count($erreur));

    $messageErreur .= "</ul>";

    return $messageErreur;
}