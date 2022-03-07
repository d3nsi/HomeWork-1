<?php
const DB_HOST = "localhost";
const DB_LOGIN = "root";
const DB_PASSWORD = "123";
const DB_NAME = 'gorodkov_database';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
  if (!$link)
    echo "<br><h1>Ошибка подключение к базе данных, проверьте файл sql/connectDB.php<br>Убедедитесь что создана база данных с названием gorodkov_database</h1>";