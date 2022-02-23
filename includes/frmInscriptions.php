<form action="index.php?page=inscription" method="post">
    <ul>
        <li><label for="name">Nom :</label><input type="text" id="name" name="name" value="<?php echo $name;?>" /></li>
        <li><label for="firstname">Prénom :</label><input type="text" id="firstname" name="firstname"  value="<?php echo $firstname;?>" /></li>
        <li><label for="email">e-mail :</label><input type="text" id="email" name="email"  value="<?php echo $email;?>" /></li>
        <li><label for="password">Mot de passe :</label><input type="password" id="password" name="password" /></li>
        <li><label for="passwordverif">Vérification mot de passe :</label><input type="password" id="passwordverif" name="passwordverif" /></li>
        <li><input type="reset" value="Effacer" /><input type="submit" value="S'inscrire" name="inscription" /></li>
    </ul>
</form>