<h1>Login</h1>
<?php
if (isset($_POST['envoi'])) {
    $mail = htmlentities(trim($_POST['mail'])) ?? '';
    $mdp = htmlentities(trim($_POST['mdp'])) ?? '';

    $erreur = array();

    if (strlen($mail) === 0)
        array_push($erreur, "Veuillez saisir votre nom");

    if (strlen($mdp) === 0)
        array_push($erreur, "Veuillez saisir un mot de passe");

    if (count($erreur) === 0) {

        try{

            $conn = connPdo();

            $requete = $conn->prepare("SELECT * FROM T_USERS WHERE USERMAIL='$mail'");
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_OBJ);
            
            if(count($resultat) === 0) {
                echo "Pas de résultat avec votre login/mot de passe";
            }

            else {
                $mdpRequete = $resultat[0]->USEPASSWORD;
                if(password_verify($mdp, $mdpRequete)) {
                    if(!isset($_SESSION['login'])) {
                        $_SESSION['login'] = true;
                        $_SESSION['nom'] = $resultat[0]->USENAME;
                        $_SESSION['prenom'] = $resultat[0]->USEFIRSTNAME;
                        $_SESSION['role'] = $resultat[0]->ID_ROLE;
                        $_SESSION['id'] = $resultat[0]->ID_USER;
                        echo "<script>
                        document.location.replace('http://localhost/Newsletters/');
                        </script>";
                    }
                    else {
                        echo "<p>Vous êtes déjà connecté, donc vous navez rien à faire ici";
                    }
                }
                else {
                    echo "Bien tenté, mais non";
                }
            }
                
        }
        catch(PDOException $e){
            die("Erreur :  " . $e->getMessage());
        }   

        $conn = null;
    } else {
        $messageErreur = retourErreur($erreur);
    }
} else {
    echo "<h2>Merci de renseigner le formulaire&nbsp;:</h2>";
    $mail = $mdp = '';
}

include 'frmLogin.php';
