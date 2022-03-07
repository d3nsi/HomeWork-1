var mainSrcImg = $(".product__image--main").attr('src');

$(".product__image").mouseover(function() {
  $(this).css({
    'border': '1px solid #006be5'
  });
  $(".product__image--main").attr('src', $(this).attr('src'));
});

$(".product__image").mouseout(function() {
  $(this).css({
    'border': 'none'
  });
  $(".product__image--main").attr('src', mainSrcImg);
});

var count = 0;

$(".product__button-minus").click(function() {
  if (count > 0) {
    count--;
    $(".product__count").html(count);
  }
  
  if (count == 0) {
    $(".product__button-minus").css({
      'color': 'gainsboro'
    });
  } 
});

$(".product__button-plus").click(function() {
  count++;

  if (count == 1)
    $(".product__button-minus").css({
      'color': 'black'
    });

  $(".product__count").html(count);
});

$("#buy").click(function () {
  if (count > 0)
    $.notice('В корзину добавлено ' + count + ' товаров')
  else
    $.notice('Добавьте количество товаров')
});