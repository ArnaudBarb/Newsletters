<h1>Inscription</h1>
<?php
if (isset($_POST['inscription'])) {
    $name = htmlentities(mb_strtoupper(trim($_POST['name']))) ?? '';
    $firstname = htmlentities(ucfirst(mb_strtolower(trim($_POST['firstname'])))) ?? '';
    $email = trim(mb_strtolower($_POST['email'])) ?? '';
    $password = htmlentities(trim($_POST['password'])) ?? '';
    $passwordverif = htmlentities(trim($_POST['passwordverif'])) ?? '';
    $idrole = 2;

    $erreur = array();

    if (preg_match('/(*UTF8)^[[:alpha:]]+$/', html_entity_decode($name)) !== 1)
        array_push($erreur, "Veuillez saisir votre nom");
    else
        $name = html_entity_decode($name);

    if (preg_match('/(*UTF8)^[[:alpha:]]+$/', html_entity_decode($firstname)) !== 1)
        array_push($erreur, "Veuillez saisir votre prénom");
    else
        $firstname = html_entity_decode($firstname);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($erreur, "Veuillez saisir un e-mail valide");

    if (strlen($password) === 0)
        array_push($erreur, "Veuillez saisir un mot de passe");

    if (strlen($passwordverif) === 0)
        array_push($erreur, "Veuillez saisir la vérification de votre mot de passe");

    if ($password !== $passwordverif)
        array_push($erreur, "Vos mots de passe ne correspondent pas");

    if (count($erreur) === 0) {

        try {
            $conn = connPdo();
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            $requete = $conn->prepare("SELECT * FROM T_USERS WHERE USERMAIL='$email'");
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_OBJ);

            if(count($resultat) !== 0) {
                echo "<p>Votre adresse est déjà enregistrée dans la base de données</p>";
            }

            else {
                $query = $conn->prepare("
                INSERT INTO T_USERS(USENAME, USEFIRSTNAME, USERMAIL, USEPASSWORD, ID_ROLE)
                VALUES (:name, :firstname, :email, :password, :idrole)
                ");

                $query->bindParam(':name', $name, PDO::PARAM_STR_CHAR);
                $query->bindParam(':firstname', $firstname, PDO::PARAM_STR_CHAR);
                $query->bindParam(':email', $email, PDO::PARAM_STR_CHAR);
                $query->bindParam(':password', $password);
                $query->bindParam(':idrole', $idrole);
                $query->execute();
                
                echo "<p>Insertions effectuées</p>";
            }
        } catch (PDOException $e) {
            die("Erreur :  " . $e->getMessage());
        }
        $conn = null;

    } else {
        $messageErreur = retourErreur();
        include 'frmInscription.php';
    }
} else {
    echo "<h2>Merci de renseigner le formulaire&nbsp;:</h2>";
    $name = $firstname = $email = '';
    include 'frmInscription.php';
}
    
