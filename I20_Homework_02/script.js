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
  $(".product__image--main").attr('src', 'img/img1.jpg');
});

var count = 0;

$(".product__minus").click(function() {
  if (count > 0) {  
    count--;
    $(".product__count").html(count);
  }
  
  if (count == 0) {
    $(".product__minus").css({
      'color': 'gainsboro'
    });
  } 
});

$(".product__plus").click(function() {
  count++;

  if (count == 1)
    $(".product__minus").css({
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
