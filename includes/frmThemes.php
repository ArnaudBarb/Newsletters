<form action="index.php?page=themes" method="post">
    <ul>
        <li>
            <label for="subjectContent">Thème :</label>
            <input type="text" id="subjectcontent" name="subjectcontent" value="<?php echo $subjectContent;?>" />
        </li>        
        <li>
            <input type="reset" value="Effacer" />
            <input type="submit" value="Valider le choix" name="validation" />
        </li>
    </ul>

</form>