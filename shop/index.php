<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <title>SQL</title>

  <style>
    body {
      background-color: rgb(247, 247, 247);
    }
    
    input {
      margin: 10px;
      padding: 2px;
    }
  </style>
</head>
<body>
  <?php
    include_once('header/header.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      switch ($_POST['button']) {
        case 'Check connection':
          if ($link)
            echo "Подключение успешно"; 
          else 
            echo "<br>Ошибка подключение";
        break;
        case 'Create database':
          if (mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD)) {
            $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
            $query = "CREATE DATABASE `gorodkov_database`";
            $result = mysqli_query($link, $query);
            if ($result)
              echo "<br>Успешно создана база данных";
            else
              echo "<br>Ошибка при создании базы данных";
          }
        break;
      } 
    } 
  ?>

  <form action="#" method="POST">
    <p><input type="submit" value="Check connection" name="button"></p>
    <p>
      <input type="submit" value="Create database" name="button">
      <input type="text" value="gorodkov_database" name="nameBD">
    </p>
    <p>
      <input type="submit" value="Create tables" name="button">
    </p>
    <div>
      <input type="submit" value="Fill tables" name="button">
      <label>Кол-во категорий:</label>
      <input type="text" value="5" name="countCategory">
      <label>Кол-во товаров:</label>
      <input type="text" value="600" name="countProducts">
    </div>
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and $link and $_POST['button'] == 'Create tables') {
      // Создание таблицы Product
      $query = "CREATE TABLE IF NOT EXISTS `Product` (
      `product_id` INT NOT NULL AUTO_INCREMENT,
      `product_name` VARCHAR(255) NOT NULL,
      `product_price` INT UNSIGNED NOT NULL,
      `product_priceActual` INT UNSIGNED NULL,
      `product_priceDiscount` INT UNSIGNED NULL,
      `product_isActive` TINYINT NOT NULL DEFAULT 1,
      `product_description` MEDIUMTEXT NULL,
      `category_id` INT NOT NULL,
      PRIMARY KEY (`product_id`))";
    
      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Product<br>";
      else 
        echo "Неудалось создать таблицу Product<br>";
        
      // Создание таблицы Category
      $query = "CREATE TABLE IF NOT EXISTS `Category` (
      `category_id` INT NOT NULL AUTO_INCREMENT,
      `category_name` VARCHAR(100) NOT NULL,
      `category_description` MEDIUMTEXT NULL,
      PRIMARY KEY (`category_id`))";
    
      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Category<br>";
      else 
        echo "Неудалось создать таблицу Category<br>";
    
      // Создание талицы Image
      $query = "CREATE TABLE IF NOT EXISTS `Image` (
      `image_id` INT NOT NULL AUTO_INCREMENT,
      `image_src` VARCHAR(255) NOT NULL,
      `image_name` VARCHAR(255) NOT NULL,
      `image_alt` VARCHAR(100) NOT NULL,
      PRIMARY KEY (`image_id`))";
    
      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Image<br>";
      else 
        echo "Неудалось создать таблицу Image<br>";
    
      // Созданиее таблицы Product_has_category
      $query = "CREATE TABLE IF NOT EXISTS `Product_has_category` (
      `product_product_id` INT NOT NULL,
      `category_category_id` INT NOT NULL,
      PRIMARY KEY (`product_product_id`, `category_category_id`),
      INDEX `fk_product_has_category_category1_idx` (`category_category_id` ASC) VISIBLE,
      CONSTRAINT `fk_product_has_category_product1`
        FOREIGN KEY (`product_product_id`)
        REFERENCES `product` (`product_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_product_has_category_category1`
        FOREIGN KEY (`category_category_id`)
        REFERENCES `Category` (`category_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)";
    
      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Product_has_category<br>";
      else 
        echo "Неудалось создать таблицу Product_has_category<br>";
    
      // Создание таблицы Product_has_image
      $query = "CREATE TABLE IF NOT EXISTS `Product_has_image` (
      `product_product_id` INT NOT NULL,
      `image_image_id` INT NOT NULL,
      PRIMARY KEY (`product_product_id`, `image_image_id`),
      INDEX `fk_product_has_image_image1_idx` (`image_image_id` ASC) VISIBLE,
      CONSTRAINT `fk_product_has_image_product1`
        FOREIGN KEY (`product_product_id`)
        REFERENCES `product` (`product_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_product_has_image_image1`
        FOREIGN KEY (`image_image_id`)
        REFERENCES `image` (`image_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)";
    
      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Product_has_image<br>";
      else 
        echo "Неудалось создать таблицу Product_has_image<br>";

      // Создание таблицы Feedback
      $query = "CREATE TABLE IF NOT EXISTS Feedback (
        feedback_id INT NOT NULL AUTO_INCREMENT,
        feedback_name VARCHAR(255),
        feedback_mail VARCHAR(255),
        feedback_birthday DATE,
        feedback_gender CHAR(1),
        feedback_topic VARCHAR(255),
        feedback_msg TEXT,
        PRIMARY KEY (feedback_id));";

      $result = mysqli_query($link, $query);
      if ($result)
        echo "Успешное создание таблицы Feedback<br>";
      else 
        echo "Неудалось создать таблицу Feedback<br>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' and $link and $_POST['button'] == 'Fill tables') {
      $rowsCategory = (int)$_POST['countCategory'];
      $rowsProduct = (int)$_POST['countProducts'];
      if ($rowsCategory AND $rowsProduct) {
        for ($i = 1; $i <= $rowsCategory; $i++) {
          $query = "INSERT INTO Category (category_name, category_description)
          VALUES ('Категория$i', 'Описание категории$i')";
          $result = mysqli_query($link, $query);
          if ($result)
            echo "Успешное добавление записи в таблицу Category<br>";
          else 
            echo "Неудалось добавить запись в таблицу Category<br>";
        }

        //Заполнение таблицы Image
        $query1 = "INSERT INTO `image` (image_src, image_name, image_alt)
        VALUES ('img/image1_1_main.png', 'image{$i}_1.png', 'alt')";
        $result1 = mysqli_query($link, $query1);
    
        $query2 = "INSERT INTO `image` (image_src, image_name, image_alt)
        VALUES ('img/image1_2.png', 'image{$i}_2.png', 'alt')";
        $result2 = mysqli_query($link, $query2);
    
        $query3 = "INSERT INTO `image` (image_src, image_name, image_alt)
        VALUES ('img/image1_3.png', 'image{$i}_3.png', 'alt')";
        $result3 = mysqli_query($link, $query3);
    
        if ($result1 and $result2 and $result3)
          echo "Успешное добавление записи в таблицу Image<br>";
        else 
          echo "Неудалось добавить запись в таблицу Image<br>";
      
        
        for ($i = 1; $i <= $rowsProduct; $i++) {
          //Заполнение таблицы Product
          $randomPrice = rand(500, 2000);
          $randomCategory = rand(1, $rowsCategory);
          $query = "INSERT INTO Product (product_name, product_price, product_description, category_id)
          VALUES ('Товар$i', $randomPrice,'Описание товара$i', $randomCategory)";
          $result = mysqli_query($link, $query);
          if ($result)
            $addProduct = 1;
          else 
            $addProduct = 0;

          //Заполнение таблицы Product_has_category
          $query = "INSERT INTO product_has_category (product_product_id, category_category_id)
          VALUES ($i, $randomCategory)";
          $result = mysqli_query($link, $query);
      
          if ($result)
            $addProductHasCategory = 1;
          else 
            $addProductHasCategory = 0;
      
          //Заполнение таблицы Product_has_image
          $query1 = "INSERT INTO product_has_image (product_product_id, image_image_id)
          VALUES ($i, 1)";
          $result1 = mysqli_query($link, $query1);
      
          $query2 = "INSERT INTO product_has_image (product_product_id, image_image_id)
          VALUES ($i, 2)";
          $result2 = mysqli_query($link, $query2);
      
          $query3 = "INSERT INTO product_has_image (product_product_id, image_image_id)
          VALUES ($i, 3)";
          $result3 = mysqli_query($link, $query3);
      
          if ($result1 and $result2 and $result3)
            $addProductHasImage = 1;
          else 
            $addProductHasImage = 0;
        }
        if ($addProduct)
          echo "Успешное добавление записи в таблицу Product<br>";
        else 
          echo "Неудалось добавить запись в таблицу Product<br>";
        if ($addProductHasCategory)
          echo "Успешное добавление записи в таблицу Product_has_category<br>";
        else
          echo "Неудалось добавить запись в таблицу Product_has_category<br>";
        if ($addProductHasImage)
          echo "Успешное добавление записи в таблицу Product_has_image<br>";
        else
          echo "Неудалось добавить запись в таблицу Product_has_image<br>";
      }
    }
  ?>
</body>
</html>