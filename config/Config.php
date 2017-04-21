<?php
define('E_MAIL_ADMIN', 'admin@example.com' );
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'codeskills');

define('WITRYNA', 'http://localhost/AplikacjaKontakty_05_1_1/');


function __autoload($className){
    require 'class/'.$className.'.php';
}
