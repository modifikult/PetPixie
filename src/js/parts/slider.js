import $ from 'jquery';
import 'slick-carousel';

function defaultSlider() {
  const block = $('.slider');

  block.each(function () {
    const slider = $('.default--slider');

    slider.slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 1200,
      autoplay: 5000,
    })

    setTimeout(function () {
      slider.addClass('slider--load');
    }, 30)
  })
}

function bestSellerSlider() {
  const block = $('.best-seller');

  block.each(function () {
    let slider = $(this).find('.best-seller__slider');

    slider.slick({
      infinite: false,
      arrows: false,
      dots: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      speed: 500,
      adaptiveHeight: false,
      centerMode: false,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        },
      ],
    });

    slider.on('setPosition', function () {
      $(this).find('.best-seller__slider-item').height('auto');
      var slickTrack = $(this).find('.slick-track');
      var slickTrackHeight = $(slickTrack).height();
      $(this).find('.best-seller__slider-item').css('height', slickTrackHeight + 'px');
    });

    setTimeout(function () {
      slider.addClass('slider--load');
    }, 30)
  })
}

function gallerySlider() {
  const block = $('.gallery--slider');

  block.each(function () {
    const imageSlider = $(this).find('.general--slider');
    const thumbnailSlider = $(this).find('.thumbnail--slider');

    imageSlider.slick({
      infinite: false,
      arrows: false,
      dots: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 500,
      asNavFor: thumbnailSlider,
      swipe: false
    })

    thumbnailSlider.slick({
      // infinite: false,
      arrows: false,
      dots: false,
      slidesToShow: 7.51,
      slidesToScroll: 1,
      speed: 500,
      // centerMode: true,
      asNavFor: imageSlider,
      focusOnSelect: true,
      swipe: true,
      responsive: [
        {
          breakpoint : 993,
          settings: {
            slidesToShow: 4.04,
          }
        },
        {
          breakpoint : 769,
          settings: {
            slidesToShow: 7.51,
          }
        },
        {
          breakpoint : 769,
          settings: {
            slidesToShow: 4.04,
          }
        },
      ],
    })

    $('button.nav-link').on('click', function () {
      imageSlider.slick('reinit');
      thumbnailSlider.slick('reinit');
    })

    $('.view-more-btn').on('click', function () {
      imageSlider.slick('reinit');
      thumbnailSlider.slick('reinit');
    })

    setTimeout(function () {
      imageSlider.addClass('slider--load');
      thumbnailSlider.addClass('slider--load');
    }, 30)
  })
}

function reviewsSlider() {
  const block = $('.customer-reviews');

  block.each(function () {
    let slider = $(this).find('.reviews--slider');

    slider.slick({
      infinite: false,
      arrows: false,
      dots: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      speed: 500,
      adaptiveHeight: false,
      centerMode: false,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        },
      ],
    });

    slider.on('setPosition', function () {
      $(this).find('.review-card').height('auto');
      var slickTrack = $(this).find('.slick-track');
      var slickTrackHeight = $(slickTrack).height();
      $(this).find('.review-card').css('height', slickTrackHeight + 'px');
    });

    setTimeout(function () {
      slider.addClass('slider--load');
    }, 30)
  })
}

export {defaultSlider, bestSellerSlider, gallerySlider, reviewsSlider}
