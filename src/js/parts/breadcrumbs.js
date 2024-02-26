import $ from 'jquery';

function addIconToBreadcrumb() {
  const breadcrumbs = $('.aioseo-breadcrumb a');

  breadcrumbs.first().prepend('<i class="bi bi-house-door-fill"></i>')
}

export {addIconToBreadcrumb}
