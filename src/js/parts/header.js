import $ from 'jquery';

function toggleHeader() {
  const headerOpen = $('.header-open');
  const headerClose = $('.header-close');
  const headerMob = $('.header__mob');

  headerOpen.on('click', function () {
    headerMob.addClass('header-show');
    $('body').addClass('no-scroll');
  })

  headerClose.on('click', function () {
    headerMob.removeClass('header-show');
    $('body').removeClass('no-scroll');
  })
}

function stikyHeader() {
  const header = $('.header');

  $(window).on('scroll', function () {
      if ($(window).scrollTop() > 50) {
        header.addClass('header-fixed');
        header.removeClass('header-unfixed');
      } else if($(window).scrollTop() < 50 && header.hasClass('header-fixed')) {
        header.addClass('header-unfixed');
        header.removeClass('header-fixed');
      }
  })
}

export {toggleHeader, stikyHeader}
