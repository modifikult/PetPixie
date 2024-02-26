import lozad from "lozad";

function lazyLoad() {
  const observer = lozad('.lazyload', {
    loaded: function (el) {
      if (el.tagName === 'IFRAME' || el.tagName === 'VIDEO') {
        el.classList.add('lazyloaded');
      }
    }
  });
  observer.observe();
}

export {lazyLoad}
