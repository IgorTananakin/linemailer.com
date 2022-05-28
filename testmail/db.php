<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=127.0.0.1;dbname=linemail1','line', 'line12345' );

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}
include 'class/BD.php';//расширения класса PDO
$connection = new BD('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');

session_start();