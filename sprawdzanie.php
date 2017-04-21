<?php
require_once 'config/Config.php';

$login = $_POST['login'];
$haslo = $_POST['haslo'];
$walidacja=new Validate();
$walidacja->puste($login, 'Login');
$walidacja->puste($haslo,'Hasło');


unset($walidacja);