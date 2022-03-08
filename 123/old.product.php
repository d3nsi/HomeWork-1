<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <link rel="stylesheet" href="styleProduct.css">
  <?php 
    require_once 'sql/productQuery.php';
    require_once 'function.php';
  ?>
  <title><?=$arrProduct[0]['product_name'];?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
  <?php 
    $havePrice = (int)$arrProduct[0]['product_price'];
    $haveActual = (int)$arrProduct[0]['product_priceActual'];
    $haveDiscount = (int)$arrProduct[0]['product_priceDiscount'];
    $priceTheme = 0;
    
    if ($havePrice and !$haveActual and !$haveDiscount)
      $priceTheme = 1;
    if ($havePrice and $haveActual and !$haveDiscount)
      $priceTheme = 2;
    if ($havePrice and $haveActual and $haveDiscount)
      $priceTheme = 3;
    if ($priceTheme == 0) {
      errorPage(true);
    }
    require_once 'header/header.php';
  ?>
  <div class="layout">
    <div class="product">
      <div class="product__preview">
        <div class="product__gallery">
          <div class="product__scroll">
            <?php
              foreach ($arrImage as $value) {
                echo "<img class='product__image' src='{$value['image_src']}' alt='{$value['image_alt']}'>";
              }
            ?>
          </div>
          <img class="product__image--main" <?="src='{$arrImage[0]['image_src']}' alt='{$arrImage[0]['image_alt']}'"?>>
        </div>
      </div>

      <div class="product__description">
        <h2 class="product__title"><?=$arrProduct[0]['product_name']?></h2>
        <div class="product__categories">
          <?php
            foreach ($arrCategoryProduct as $value) {
              echo "<a class='product__link' href='catalog.php?category_id={$value['category_id']}&page_id=1'>";
              echo $value['category_name'];
              echo "</a>";
            }
          ?>
        </div>
        <?php 
          if ($priceTheme == 1) {
            echo <<<END
            <div class="product__price">
              <div class="product__price-actual">
                <span class="product__price-current price">{$arrProduct[0]['product_price']}</span>
              </div>
            </div>
END;
          }
          if ($priceTheme == 2) {
            echo <<<END
            <div class="product__price">
              <div class="product__price-actual">
                <span class="product__price-old">{$arrProduct[0]['product_price']}</span>
                <span class="product__price-current price" style="margin-left: 10px">{$arrProduct[0]['product_priceActual']}</span>
              </div>
            </div>
END;
          }
          if ($priceTheme == 3) {
            echo <<<END
            <div class="product__price">
              <div class="product__price-actual">
                <span class="product__price-old">{$arrProduct[0]['product_price']}</span>
                <span class="product__price-current price" style="margin-left: 10px">{$arrProduct[0]['product_priceActual']}</span>
              </div>
            
              <div class="product__price-discount">
                <span class="product__discount-value price">{$arrProduct[0]['product_priceDiscount']}</span>
                <span class="product__discount-text">– с промокодом</span>
              </div>
            </div>
END;
          }
        ?>
        <div class="product__info">
          <div class="product__info-item">
            <img src="img/icon/ok.png" alt="#">
            В наличии в магазине <a class="product__link" href="#">Lamoda</a>
          </div>
          <div class="product__info-item">
            <img src="img/icon/delivery.png" alt="#">
            Бесплатная доставка
          </div>
        </div>

        <div class="product__counter">
          <div class="product__button-box">
            <button class="product__button-minus">–</button>
          </div>
          <div class="product__count">0</div>
          <div class="product__button-box">
            <button class="product__button-plus">+</button>
          </div>
        </div>

        <div class="product__actions">
          <button class="custom-btn custom-btn--blue" id="buy">купить</button>
          <button class="custom-btn">в избранное</button>
        </div>

        <div class="product__text"><?=$arrProduct[0]['product_description']?></div>

        <div class="product__share">
          <span class="product__share-text">Поделиться:</span>
          <div class="icon"><a class="icon__link" href="#"><img class="icon__img" src="img/icon/vk.svg"></a></div>
          <div class="icon"><a class="icon__link" href="#"><img class="icon__img" src="img/icon/google.svg"></a></div>
          <div class="icon"><a class="icon__link" href="#"><img class="icon__img" src="img/icon/facebook.svg"></a></div>
          <div class="icon"><a class="icon__link" href="#"><img class="icon__img" src="img/icon/twitter.svg"></a></div>
          <div class="product__repost">123</div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="script.js"></script>
  <script src="dist/notice.js"></script>
</body>
</html>