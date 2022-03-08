<?php
  require_once('sql/connectDB.php');
  require_once('function.php');

  function printImgSrc($arrImage, $index) {
    return $arrImage[$index]['image_src'];
  }

  function printImgAlt($arrImage, $index) {
    return $arrImage[$index]['image_alt'];
  }

  function printTitle($arrProduct) {
    return $arrProduct['product_name'];
  }

  function printCategoryId($arrCategory) {
    return $arrCategory['category_id'];
  }

  function printCategoryName($arrCategory) {
    return $arrCategory['category_name'];
  }

  function printOldPrice($arrProduct, $priceTheme) {
    switch ($priceTheme) {
      case 1: return; break;
      case 2:
      case 3: return $arrProduct['product_price']; break;
    }
  }

  function printCurrentStylePrice($priceTheme) {
    switch ($priceTheme) {
      case 1: return; break;
      case 2: 
      case 3: return "margin-left: 10px"; break;
    }
  }

  function printCurrentPrice($arrProduct, $priceTheme) {
    switch ($priceTheme) {
      case 1: return $arrProduct['product_price']; break;
      case 2:
      case 3: return $arrProduct['product_priceActual']; break;
    }
  }

  function printDiscountPrice($arrProduct, $priceTheme) {
    switch ($priceTheme) {
      case 1: break;
      case 2: break;
      case 3: return $arrProduct['product_priceDiscount']; break;
    }
  }

  function printStyleDiscountPrice($priceTheme) {
    switch ($priceTheme) {
      case 1:
      case 2: return "display: none"; break;
      case 3: break;
    }
  }

  function showPage($productID, $arrProduct, $arrImage, $arrCategoryProduct, $priceTheme) {
    $productID = isInt($productID);
    $arrProduct = count($arrProduct);
    $arrImage = count($arrImage);
    $arrCategoryProduct = count($arrCategoryProduct);

    if ($productID and $arrProduct and $arrImage and $arrCategoryProduct and $priceTheme) {
      return;
    } else {
      errorPage();
    }
  }

  $productID = $_GET['product_id'];

  $query = "SELECT * FROM product
            WHERE product_id = $productID";
  $result = mysqli_query($link, $query);

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $arrProduct = $row;
  }

  $query = "SELECT i.image_src, i.image_alt FROM product_has_image pi
            JOIN image i
            ON pi.image_image_id = i.image_id
            WHERE product_product_id = $productID
            ORDER BY i.image_src";
  $result = mysqli_query($link, $query);

  if ($result) {
    $i = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $arrImage[$i]['image_src'] = $row['image_src'];
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

  $havePrice = (int)$arrProduct['product_price'];
  $haveActual = (int)$arrProduct['product_priceActual'];
  $haveDiscount = (int)$arrProduct['product_priceDiscount'];
  $priceTheme = 0;
  
  if ($havePrice and !$haveActual and !$haveDiscount)
    $priceTheme = 1;
  if ($havePrice and $haveActual and !$haveDiscount)
    $priceTheme = 2;
  if ($havePrice and $haveActual and $haveDiscount)
    $priceTheme = 3;
?>