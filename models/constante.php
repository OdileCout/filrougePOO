<?php
switch ($_SERVER['HTTP_HOST']) {
    case 'leslygreta':
    case 'localhost':
        define('HOST', 'localhost');
        define('PORT', 3306);
        define('DATA', 'filrouge');
        define('USER', 'root');
        define('PASS', '');
        break;
    case 'baobab-svr5': // Fictif
        define('HOST', 'baobab-svr5');
        define('DATA', 'baobab-sql5');
        define('USER', 'baobab-usr1');
        define('PASS', 'aR5*hgt+7uIopp$');
        break;
    default:
        // do nothing
}