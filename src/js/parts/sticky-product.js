import $ from 'jquery';

function setStickyClass() {
  const buyButton = $('.product-hero .btn');
  const stickyProduct = $('.sticky-product');
  const documentOffsetTop = $(document).scrollTop();

  if ($(window).width() > 992 && buyButton.length) {
    if (documentOffsetTop + 96 > buyButton.offset().top) {
      stickyProduct.addClass('sticky');
    } else {
      stickyProduct.removeClass('sticky');
    }
  } else if(buyButton.length) {
    if (documentOffsetTop + 72 > buyButton.offset().top) {
      stickyProduct.addClass('sticky');
    } else {
      stickyProduct.removeClass('sticky');
    }
  }
}

$(window).on('resize', setStickyClass);
$(document).on('scroll', setStickyClass);

export {setStickyClass}
