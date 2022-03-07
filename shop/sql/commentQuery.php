<?php
  require_once('sql/connectDB.php');

  $isGet = $_SERVER['REQUEST_METHOD'] == 'GET';
  $isPost = $_SERVER['REQUEST_METHOD'] == 'POST';

  if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $topic = $_POST['topic'];
    $msg = $_POST['msg'];
    $check = $_POST['checkbox'];
    
    $isAllHaveValues = ((bool)$name and (bool)$email and (bool)$date and (bool)$gender and (bool)$topic and (bool)$msg and (bool)$check);
  }