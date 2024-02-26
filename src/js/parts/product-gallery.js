import $ from 'jquery';

function changeProductImage() {
  const productThumbnails = $('.product-thumbnails .thumbnail-wrap');

  productThumbnails.on('click', function () {

    productThumbnails.each(function () {
      $(this).removeClass('current');
    })

    const thumbnailSrc = $(this).find('img').attr('src');
    const mainImage = $(this).closest('.card-image-wrapper, .product-hero__image').find('.main-image img');

    mainImage.attr('src', thumbnailSrc);

    $(this).addClass('current');
  });
}

export {changeProductImage}
