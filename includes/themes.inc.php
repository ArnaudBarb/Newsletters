<h1>Thèmes</h1>
<?php

$conn = connPdo();

if (isset($_SESSION['login']) && ($_SESSION['role'] >=3 ))
{
        echo "Vous avez les droits pour insérer des données.";

    if (isset($_POST['validation'])) 
    {
        $subjectContent = htmlentities($_POST['subjectcontent']) ?? '';     

        $erreur = array();

        if (strlen($subjectContent) === 0)
        {
            array_push($erreur, "Veuillez saisir le sujet du thème");
        }
        else
            $subjectContent = html_entity_decode($subjectContent);
            
        if (count($erreur) === 0) {

            try 
            {
                $conn = connPdo();

                $requete = $conn->prepare("SELECT * FROM T_SUBJECTS WHERE SUBCONTENT = '$subjectContent'");
                $requete->execute();
                $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

                if(count($resultat) !== 0) {
                    echo "<p>Le sujet est déjà enregistré</p>";
                }

                else
                {
                    $query = $conn->prepare("
                    INSERT INTO T_SUBJECTS(SUBCONTENT)
                    VALUES (:subcontent)");

                    $query->bindParam(':subcontent', $subjectContent, PDO::PARAM_STR_CHAR);
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
            $messageErreur = retourErreur($erreur);
            include 'frmThemes.php';
        }
    } 
    else 
    {
        echo "<h2>Merci de renseigner le formulaire&nbsp;:</h2>";
        $subjectContent = '';

        include 'frmThemes.php';
    }
}
else
    echo "Vous n'avez pas les droits";
