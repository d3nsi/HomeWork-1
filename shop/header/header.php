<?php
include_once('sql/connectDB.php');

$query = "SELECT c.category_id, c.category_name, COUNT(*) AS count FROM product_has_category pc
          JOIN product p
          ON pc.product_product_id = p.product_id
          JOIN category c
          ON c.category_id = pc.category_category_id
          WHERE p.product_isActive = 1
          GROUP BY c.category_id
          ORDER BY count DESC";
$result = mysqli_query($link, $query);

if ($result) {
  $i = 0;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $arrCategory[$i]['category_id'] = $row['category_id'];
    $arrCategory[$i]['category_name'] = $row['category_name'];
    $arrCategory[$i]['count'] = $row['count'];
    $i++;
  }
}
?>
<div class="header">
  <div class="layout">
    <ul class="header__nav">
      <li class="header__item"><a class="header__link" href="category.php">Каталог</a>
        <ul class="pop-up">
          <?php
            foreach ($arrCategory as $val) {
              echo "<a class='pop-up__link' href='catalog.php?category_id=" . $val['category_id'] . "&page_id=1" . "'>" . $val['category_name'] . " ({$val['count']})" . "</a>";
            }
          ?>
        </ul>
      </li>
      <li class="header__item"><a class="header__link" href="comment.php">Обратная связь</a></li>
      <li class="header__item"><a class="header__link" href="index.php">SQL</a></li>
        <?php
          $isCatalog = strstr($_SERVER['REQUEST_URI'], 'catalog.php');
          $isCategory = strstr($_SERVER['REQUEST_URI'], 'category.php');
          $isProduct = strstr($_SERVER['REQUEST_URI'], 'product.php');
          $productCategoryId = str_replace('category_id=', '',strstr($_SERVER['QUERY_STRING'], 'category_id'));

          if ($isCatalog)
            $linkBack = 'category.php';
          if ($isCategory)
            $linkBack = false;
          if ($isProduct and $productCategoryId) {
            $query = "SELECT * FROM product_has_category
                      WHERE product_product_id = $productID AND category_category_id = $productCategoryId";
            $result = mysqli_query($link, $query);

            if (!$result) {
              echo "Произошла ошибка запроса";
            } else{
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $checkCategory = $row;
              }
              if (!$checkCategory)
                $productCategoryId = $arrProduct[0]['category_id'];
            }

            $linkBack = 'catalog.php?category_id=' . $productCategoryId . '&page_id=1';
          }
          if ($isProduct and !$productCategoryId)
            $linkBack = 'catalog.php?category_id=' . $arrProduct[0]['category_id'] . "&page_id=1";

          if ($linkBack) {
            echo "<li class='header__item'><a class='header__link' href='$linkBack'>Назад</a></li>";
          } else {
            // Из-за стиля .header__item:last-child
            echo "<li class='header__item'></li>";
          }
        ?>
    </ul>
  </div>
</div>