<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <style>
    body {
      background-color: rgb(247, 247, 247);
    }
    .category__item {
      color: rgb(44, 42, 42);
      display: block;
      font-size: 26px;
      font-weight: 700;
      text-decoration: none; 
    }

    .category__item:hover {
      text-decoration: underline;
      color: red; 
    }
  </style>
  <title>Каталог</title>
</head>
<body>
  <?php
    require_once('header/header.php');
  ?>

<div class="layout">
  <ul class="category__items">
    <?php
      foreach ($arrCategory as $val) {
        echo "<a class='category__item' href='catalog.php?category_id=" . $val['category_id'] . "&page_id=1" . "'>" . $val['category_name'] . " ({$val['count']})" . "</a>";
      }
    ?>
  </ul>
</div>
</body>
</html>