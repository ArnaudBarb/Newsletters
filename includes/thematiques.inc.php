<h1>Choisissez un ou plusieurs centre d'interrêt</h1>
<?php
// dump($_POST);

$showSubjects = showSubjects();

//Condition donnée: s'il est avéré que l'utilisateur est loggé et que son rôle est >=2
if (isset($_SESSION['login']) && ($_SESSION['role'] >=2))
{//alors il pourra choisir des sujets pour ses newsletters
        echo "Vous pouvez choisr des centres d'interrêts.";
//condition donnée: si le bouton validation est pressé:
    if (isset($_POST['validation'])) 
    {//on attribuera à la variable $themecheck la valeur contenue dans l'input qui est un tableau
        $themeCheck = $_POST['themecheck'] ?? '';     
        // condition donnée: si le tableau n'est pas vide (donc si il contient des données (donc si des checkbox ont été cochées))
        if (count($themeCheck) !== 0)
        {//on passe au try
            try 
            {//on se connecte à la base de données
                $conn = connPdo();
        //on boucle sur le tableau contenant les catégories (($themeCheck)->(cases cochées)) je récupère la première valeur
        // qui est insérée. La boucle est exécutée autant de fois que des valeurs sont présentes.
                for($i = 0; $i < count($themeCheck); $i++)
                {
                    $query = $conn->prepare //on prépare la connexion à la bdd
        //on définit dans quelle table et dans quelles colonnes seront insérées les données correspondans aux values
                    ("
                    INSERT INTO t_users_has_t_subjects(ID_USER, ID_SUBJECT)
                    VALUES (:id, :themecheck)
                    ");
        //on définit ensuite quels paramètres seront reliés à la requète
        //:id sera fixe car il correspond à la personne loguée
                    $query->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        //:themeCheck sera le paramètre sur lequel la boucle sera faite et dont les résultats seront incrémentés dans le tableau
                    $query->bindParam(':themecheck', $themeCheck[$i], PDO::PARAM_STR_CHAR);
        //execute sera effectuée à chaque passage de la boucle pour insérer chaque valeur trouvée dans le tableau
                    $query->execute();

                    echo "<p>Insertions effectuées</p>";
                }
            }
            catch (PDOException $e) 
            {
                die("Erreur :  " . $e->getMessage());
            }
        }
            $conn = null;
    } 
    else 
    {
        echo "<h2>Vous pouvez choisir un ou plusieurs thème&nbsp;:</h2>";
        $themeCheck = '';

        include 'frmThematiques.php';
    }
}
else
    echo "Vous n'avez pas les droits";
