<h1>Choisissez un ou plusieurs centre d'interrêt</h1>
<?php

$conn = connPdo();
$showSubjects = showSubjects();

if (isset($_SESSION['login']) && ($_SESSION['role'] >=2 ))
{
        echo "Vous pouvez choisr des centres d'interrêts.";

    if (isset($_POST['validation'])) 
    {
        $themeCheck = htmlentities($_GET['themecheck']) ?? '';     

        $erreur = array();

        if (strlen($themeCheck) === 0)
        {
            array_push($erreur, "Veuillez saisir le sujet du thème");
        }
        else
            $themeCheck = themeChecker();
            
        if (count($erreur) === 0) {

            try 
            {
                $conn = connPdo();

                $requete = $conn->prepare("SELECT * FROM T_SUBJECTS WHERE SUBCONTENT = '$themeCheck'");
                $requete->execute();
                $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

                if(count($resultat) !== 0) {

                    $query = $conn->prepare("
                    INSERT INTO t_users_has_t_subjects(ID_SUBJECT)
                    VALUES (:themecheck)");

                    $query->bindParam(':themecheck', $themeCheck, PDO::PARAM_STR_CHAR);
                    $query->execute();
                    
                    echo "<p>Insertions effectuées</p>";
                }
            }
            catch (PDOException $e) {
                die("Erreur :  " . $e->getMessage());
            }
            $conn = null;
        } 
        else 
        {
            $messageErreur = retourErreur();
            include 'frmThematiques.php';
        }
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
