<?php
  require_once('sql/connectDB.php');
  require_once('function.php');

  $productID = $_GET['product_id'];
  errorPage(isInt($productID));

  $query = "SELECT * FROM product
            WHERE product_id = $productID";
  $result = mysqli_query($link, $query);

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $arrProduct[] = $row;
  }
  errorPage($arrProduct);

  $query = "SELECT i.image_src, i.image_alt FROM product_has_image pi
            JOIN image i
            ON pi.image_image_id = i.image_id
            WHERE product_product_id = $productID
            ORDER BY i.image_src";
  $result = mysqli_query($link, $query);

  $i = 0;
  if ($result) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $arrImage[]['image_src'] = $row['image_src'];
      $arrImage[$i]['image_alt'] = $row['image_alt'];
      $i++;
    }
  }

  $query = "SELECT c.category_id, c.category_name FROM product_has_category pc
            JOIN category c
            ON pc.category_category_id = c.category_id
            WHERE pc.product_product_id = $productID";
  $result = mysqli_query($link, $query);

  if ($result) {
    $i = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $arrCategoryProduct[]['category_id'] = $row['category_id'];
      $arrCategoryProduct[$i]['category_name'] = $row['category_name'];
      $i++;
    }
  }
?>