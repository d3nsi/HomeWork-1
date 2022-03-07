<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <link rel="stylesheet" href="styleCatalog.css">
  <?php 
    require_once('sql/catalogQuery.php');
  ?>
  <title><?=$categoryName?></title>
</head>
<body>
  <?php
  require_once('header/header.php');
  ?>

  <div class="layout">
    <div class="catalog">
      <?php
        echo "<h1 class='catalog__header'>$categoryName</h1>";
        if ($categoryDescription)
          echo "<p class='catalog__desc'>$categoryDescription</p>";
        else 
          echo "Описание не найдено";
      ?>
      <div class="items"> 
        <?php
          foreach ($arrProduct as $value) {
            if ($value['product_price'])
              $price = $value['product_price'];
            if ($value['product_priceActual'])
              $price = $value['product_priceActual'];
            if ($value['product_priceDiscount'])
              $price = $value['product_priceDiscount'];

            $request = "product_id=" . $value['product_id'];
            if ($value['category_id'] != $categoryID)
              $request = $request . "&category_id=$categoryID";
            echo <<<END
            <div class='card'>
              <a class='card__link' href='product.php?$request'>
                <div class='card__image-box'>
                  <img class='card__img' src='{$value['image_src']}' alt='{$value['image_alt']}'>
                </div>
                <div class='card__title'>{$value['product_name']}</div>
                <div class='card__price'>$price</div>
              </a>
            </div>
END;
            }
        ?>
      </div>
      <div class="catalog__pages">
          <?php
            for($i=1; $i <= $countPage; $i++) {
          ?>
            <div class="catalog__page-box">
              <a class="catalog__page-link" href="catalog.php?category_id=<?=$categoryID?>&page_id=<?=$i?>"><?=$i?></a>
            </div>
          <?php
            }
          ?>
      </div>
    </div>
  </div>
</body>
</html>