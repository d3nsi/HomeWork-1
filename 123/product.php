<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <link rel="stylesheet" href="styleProduct.css">
  <?php 
    require_once 'sql/productQuery.php';
  ?>
  <title><?=$arrProduct['product_name'];?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
  <?php 
    require_once 'header/header.php';
    showPage($productID, $arrProduct, $arrImage, $arrCategoryProduct, $priceTheme);
  ?>
  <div class="layout">
    <div class="product">
      <div class="product__preview">
        <div class="product__gallery">
          <div class="product__scroll">
            <img class='product__image' src='<?=printImgSrc($arrImage, 0)?>' alt='<?=printImgAlt($arrImage, 0)?>'>
            <img class='product__image' src='<?=printImgSrc($arrImage, 1)?>' alt='<?=printImgAlt($arrImage, 1)?>'>
            <img class='product__image' src='<?=printImgSrc($arrImage, 2)?>' alt='<?=printImgAlt($arrImage, 2)?>'>
          </div>
            <img class='product__image--main' src='<?=printImgSrc($arrImage, 0)?>' alt='<?=printImgAlt($arrImage, 0)?>'>
        </div>
      </div>

      <div class="product__description">
        <h2 class="product__title"><?=printTitle($arrProduct)?></h2>
        <div class="product__categories">
          <?php
            foreach ($arrCategoryProduct as $value) {
          ?>
              <a class='product__link' href='catalog.php?category_id=<?=printCategoryId($value)?>&page_id=1'><?=printCategoryName($value)?></a>
      <?php } ?>
        </div>

        <div class="product__price">
          <div class="product__price-actual">
            <span class="product__price-old"><?=printOldPrice($arrProduct, $priceTheme)?></span>
            <span class="product__price-current price" style="<?=printCurrentStylePrice($priceTheme)?>"><?=printCurrentPrice($arrProduct, $priceTheme)?></span>
          </div>
        
          <div class="product__price-discount" style="<?=printStyleDiscountPrice($priceTheme)?>">
            <span class="product__discount-value price"><?=printDiscountPrice($arrProduct, $priceTheme)?></span>
            <span class="product__discount-text">– с промокодом</span>
          </div>
        </div>

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

        <div class="product__text"><?=$arrProduct['product_description']?></div>

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