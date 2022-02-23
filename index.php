<?php

require_once './functions/autoLoadFunction.php';
session_start();
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR', 'fr', 'FR', 'fr_FR@euro');

spl_autoload_register(function ($className) {
    include './classes/' . $className . '.php';
});