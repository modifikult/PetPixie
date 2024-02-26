import $ from 'jquery';

function dropdownToggle() {
  $(document).on('click', '.dropdown-title', function () {
    const dropdown = $(this).closest('.dropdown');
    const dropdownContent = dropdown.find('.dropdown-content');

    console.log(dropdownContent)
    dropdown.toggleClass('dropdown-open');

    if (dropdown.hasClass('dropdown-open')) {
      dropdownContent.css('height', dropdownContent[0].scrollHeight + 'px');
    } else {
      dropdownContent.css('height', 0);
    }
  })
}

export {dropdownToggle}
