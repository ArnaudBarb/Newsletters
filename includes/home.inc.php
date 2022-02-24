<h1>Bienvenue sur Newsletters</h1>
<?php
if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
    $bienvenue = "<p>";
    $bienvenue .= "Bonjour ";
    $bienvenue .= $_SESSION['prenom'];
    $bienvenue .= " ";
    $bienvenue .= $_SESSION['nom'];
    $bienvenue .= "</p>";
    echo $bienvenue;
}