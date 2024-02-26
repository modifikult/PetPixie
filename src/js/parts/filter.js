import $ from 'jquery';

function viewMoreBtn() {
  $('.view-more-btn').on('click', function (e) {
    e.preventDefault();
    const self = $(this);
    const remainingHidden = self.closest('section').find('.element-hidden').length;
    const quanityShow = self.data('quanity-show');

    let hiddenElements = [];

    for (let i = 0; i < quanityShow && i < remainingHidden; i++) {
      let hiddenElement = self.closest('section').find('.element-hidden')[i];
      hiddenElements.push(hiddenElement)
    }

    hiddenElements.forEach(x => {
      $(x).removeClass('element-hidden');

      if (!self.closest('section').find('.element-hidden').length) {
        $('.view-more-btn').addClass('d-none');
      }
    })
  })
}

function filterPosts() {
  $('.filter .btn').on('click', function (e) {
    e.preventDefault();
    let termSlug = $(this).data('term-slug');
    let termTaxonomy = $(this).data('term-taxonomy');

    $('.filter .btn').removeClass('current');
    $(this).addClass('current');

    let data = {
      action: 'filter_posts', // function name in file ajax-search.php
      termSlug: termSlug,
      termTaxonomy: termTaxonomy,
    }
    $.ajax({
      url: wp_ajax.ajax_url,
      type: 'POST',
      data: data,
      beforeSend: function () {
        $('.loading-spinner').addClass('visible');
      },
      success: function (res) {
        $('.blog-categories__content').html(res);
        viewMoreBtn();
      },
      error: function (res) {
        console.warn(res)
      },
      complete: function () {
        $('.loading-spinner').removeClass('visible');
      }
    })
  })
}

export {viewMoreBtn, filterPosts}
