import $ from 'jquery';

function showModal() {
  const btn = $('[data-toggle=modal-window]');

  btn.on('click', function () {
    const modal = $(this).closest('.gallery--slider').find('.modal-window');
    const videoFrame = modal.find('iframe, a');
    const videoSrc = modal.find('span.video-src');

    if (videoSrc.attr('data-video-src')) {
      videoFrame.attr('src', videoSrc.attr('data-video-src'));
    }

    modal.addClass('show-modal');
  });

}

function closeModal() {
  const closeBtn = $('.close-modal');

  $(document).keyup(function (e) {
    if (e.key === "Escape") {
      const modal = $('.modal-window.show-modal');
      const videoFrame = modal.find('iframe, a');
      const videoSrc = modal.find('span.video-src');

      if (videoFrame.attr('src')) {
        videoSrc.attr('data-video-src', videoFrame.attr('src'));
        videoFrame.attr('src', '');
      }

      modal.removeClass('show-modal');
    }
  });

  closeBtn.on('click', function () {
    const modal = $('.modal-window.show-modal');
    const videoFrame = modal.find('iframe, a');
    const videoSrc = modal.find('span.video-src');

    if (videoFrame.attr('src')) {
      videoSrc.attr('data-video-src', videoFrame.attr('src'));
      videoFrame.attr('src', '');
    }

    modal.removeClass('show-modal');
  })
}


export {showModal, closeModal}
