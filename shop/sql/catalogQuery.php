<?php
  require_once('sql/connectDB.php');
  require_once('function.php');

  $categoryID = $_GET['category_id'];
  $pageID = $_GET['page_id'];

  errorPage(isInt($categoryID));
  errorPage(isInt($pageID));
 
  $limitMin = $pageID * 12 - 12;

  $query = "SELECT c.category_name, c.category_description, pc.product_product_id AS product_id FROM category c
            JOIN product_has_category pc
            ON c.category_id = pc.category_category_id
            JOIN product p
            ON p.product_id = pc.product_product_id
            WHERE c.category_id = $categoryID AND p.product_isActive = 1
            ORDER BY pc.product_product_id
            LIMIT $limitMin, 12";
  $result = mysqli_query($link, $query);

  $i = 0;
  if ($result) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if (!$categoryName) {
        $categoryName = $row['category_name'];
        $categoryDescription = $row['category_description'];
      }
      $queryStr = $queryStr . "pi.product_product_id = " . $row['product_id'] . " OR ";
      $i++;
    };
  }
  $queryStr = substr($queryStr,0,-4);
  errorPage($queryStr);

  $queryStr = "(" . $queryStr . ")";

  $query = "SELECT count(*) AS count FROM product p
            JOIN product_has_category pc
            ON pc.product_product_id = p.product_id
            WHERE pc.category_category_id = $categoryID AND p.product_isActive = 1";
  $result = mysqli_query($link, $query);
  if ($result) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $countProducts = $row['count'];
    };
  }
  $countPage = ceil($countProducts/12);

  $query = "SELECT DISTINCT p.product_id, p.product_name, p.product_price, p.product_priceActual, p.product_priceDiscount, p.category_id, i.image_src, i.image_alt FROM product_has_image pi
            JOIN product p
            ON p.product_id = pi.product_product_id
            JOIN image i
            ON pi.image_image_id = i.image_id
            WHERE $queryStr AND i.image_src LIKE '%main.%'";

  $result = mysqli_query($link, $query);
  if ($result) {
    $i = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $arrProduct[$i]['product_id'] = $row['product_id'];
      $arrProduct[$i]['product_name'] = $row['product_name'];
      $arrProduct[$i]['product_price'] = $row['product_price'];
      $arrProduct[$i]['product_priceActual'] = $row['product_priceActual'];
      $arrProduct[$i]['product_priceDiscount'] = $row['product_priceDiscount'];
      $arrProduct[$i]['category_id'] = $row['category_id'];
      $arrProduct[$i]['image_src'] = $row['image_src'];
      $arrProduct[$i]['image_alt'] = $row['image_alt'];
      $i++;
    };
  }
  errorPage($arrProduct);
  errorPage($categoryName);
?>