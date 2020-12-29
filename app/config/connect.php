<?php 
    $address_db = 'localhost';
    $user_db = 'root';
    $pass_db = 'root';

    $connect = mysqli_connect($address_db, $user_db, $pass_db, 'appusers_db');
    $connect_tables = mysqli_connect($address_db, $user_db, $pass_db, 'tables_db');

    if (!$connect || !$connect_tables) {
        die('Ошибка подключения! Пожалуйста повторите.');
    }
?>