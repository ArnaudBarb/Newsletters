<form action="index.php?page=thematiques" method="post">
    <ul>
        <li>
            <?php echo showSubjects()?>
            <input type="submit" value="Valider le choix" name="validation" />
        </li>
    </ul>
</form>