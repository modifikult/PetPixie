// Load Styles
import '../scss/main.scss';

// Load Bootstrap init
import {initBootstrap} from "./bootstrap.js";

// Loading bootstrap with optional features
initBootstrap({
  tooltip: false,
  popover: false,
  toasts: false,
});

// Parts
import {toggleHeader, stikyHeader} from "./parts/header.js";
import {changeProductImage} from "./parts/product-gallery.js";
import {closeModal, showModal} from "./parts/modal.js";
import {viewMoreBtn, filterPosts} from "./parts/filter.js";
import {defaultSlider, bestSellerSlider, gallerySlider, reviewsSlider} from "./parts/slider.js";
import {lazyLoad} from "./parts/lazyload.js";
import {setStickyClass} from "./parts/sticky-product.js";
import {dropdownToggle} from "./parts/dropdown.js";
import {addIconToBreadcrumb} from "./parts/breadcrumbs.js";

toggleHeader();
stikyHeader();
changeProductImage();
showModal();
closeModal();
viewMoreBtn();
filterPosts()
defaultSlider();
bestSellerSlider();
gallerySlider();
reviewsSlider();
lazyLoad();
setStickyClass();
dropdownToggle();
addIconToBreadcrumb();
