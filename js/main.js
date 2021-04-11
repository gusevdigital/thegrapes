(function($) {

  // PARAMETERS
  var transition_time = 300;
  var headerPosition = 0;
  var headerStyle = 0;
  var headerStyleBreakpoint = 40;
  var headerWrapper = $('header');
  var headerMobile = $('.mobile-navbar-wrapper');
  var screenMode = $(window).width() < 960 ? 'mobile' : 'desktop';

  function showSideModal(elem, transition) {
    elem.toggleClass('modal--open');
    $('body').toggleClass('no-scroll').css('padding-right', getScrollBarWidth() + 'px');
    headerWrapper.css('padding-right', getScrollBarWidth() + 'px');
    if (elem.hasClass('modal--open')) {
      elem.css('visibility', 'visible');
    }
  }

  function hideSideModal(elem, transition) {
    if (elem.hasClass('modal--open')) {
      elem.removeClass('modal--open');
      $('body').removeClass('no-scroll').css('padding-right', '0px');
      headerWrapper.css('padding-right', '0px');
      setTimeout(function() {
        elem.css('visibility', 'hidden');
      }, transition)
    }
  }

  // Check if header is on the top area
  function headerPositionTop() {
    var scroll = $(window).scrollTop();
    if (scroll < headerStyleBreakpoint) return true;
    else return false;
  }

  // Switch header style
  function headerSticky() {
    if (headerPositionTop() && headerStyle) {
      headerRemoveSticky();
    } else if (!headerPositionTop() && !headerStyle) {
      headerMakeSticky();
    }
  }

  // Check if header is on the top area
  function headerPositionTop() {
    var scroll = $(window).scrollTop();
    if (scroll < headerStyleBreakpoint) return true;
    else return false;
  }

  // Make header white
  function headerMakeSticky() {
    headerWrapper.addClass("sticky");
    headerStyle = 1;
  }

  // Make header transparent
  function headerRemoveSticky() {
    headerWrapper.removeClass("sticky");
    headerStyle = 0;
  }

  // Get HREF param
  function hrefToId(elem) {
    var hrefParam = elem.attr("href");
    return "#" + hrefParam.substr(hrefParam.indexOf('#') + 1)
  }

  // Set Up Header Space
  function headerSpace() {
    $('.header-space').css("height", headerWrapper.height() + "px");
  }


  // Get Scroll Bar Width
  function getScrollBarWidth() {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);

    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) w2 = outer.clientWidth;

    document.body.removeChild(outer);

    return (w1 - w2);
  };

  // POST VIDEO PREVIEW SHOW ON VIEWPORT
  function videoPlayViewport() {

    $('.pr-with-video').each(function() {

      var video = $(this).find('video');

      if ($(this).is(":in-viewport")) {

        $(video).show();
        $(video)[0].play();
      } else {
        $(video)[0].pause();
      }
      if ($(video).get(0).paused) {
        $(video).hide();
      } else {
        $(video).show();
      }
    });

  }

  // MOBILE HEADER CLASS
  function bodyMobileHeader() {
    $(document).width() <= 960 ? $("body").addClass('mobile-header') : $("body").removeClass('mobile-header');
  }
  bodyMobileHeader();

  /*
   * PRODUCT GALLERY SET UP HEIGHT
   */
  function productGalleryHeight() {
    var ptImgH = 0;
    $('#product-gallery .carousel-item img').each(function() {
      $this = $(this);
      var ptImgCurrH = $this.actual('height')
      if (ptImgCurrH > ptImgH) {
        ptImgH = ptImgCurrH;
      }
    });
    if (ptImgH) {
      $('#product-gallery .carousel-item').each(function() {
        $this = $(this);
        $this.height(ptImgH);
      });
    }
  }

  /*
   * ADAPTIVE CAROUSEL GALLERY
   */
  function carouselAdaptiveStart() {
    screenMode == 'desktop' ? carouselAdaptiveDesktop() : carouselAdaptiveMobile();
  }

  function carouselAdaptiveSwitch() {
    var currentScreenMode = $(window).width() < 960 ? 'mobile' : 'desktop';
    if (currentScreenMode != screenMode) {
      screenMode = currentScreenMode;
      screenMode == 'desktop' ? carouselAdaptiveDesktop() : carouselAdaptiveMobile();
    }
  }

  function carouselAdaptiveMobile() {
    $('.carousel-adaptive').each(function() {
      $this = $(this);
      if ($this.attr('data-state') != "mobile") {
        $this.children(".row").addClass('carousel-inner');
        $this.find(".row>[class*='col-']").addClass('carousel-item');
        $this.children(".carousel-indicators").show();
        $this.attr('data-state', 'mobile');
      }
    });
  }

  function carouselAdaptiveDesktop() {
    $('.carousel-adaptive').each(function() {
      $this = $(this);
      if ($this.attr('data-state') != "desktop") {
        $this.children(".row").removeClass('carousel-inner');
        $this.find(".row>[class*='col-']").removeClass('carousel-item');
        $this.children(".carousel-indicators").hide();
        $this.attr('data-state', 'desktop');
      }
    });
  }

  /*
   * READY() SCRIPT
   */
  $(document).ready(function() {

    /*
     * INITIALIZATION
     */

    // Video preview lazy load
    $("video").lazy();
    // Play video on viewport
    videoPlayViewport();
    // Initilize WOW script
    wow = new WOW({
      mobile: false,
    })
    wow.init();
    // Check header stickiness
    headerSticky();
    // Initialize Tooltips
    $('[data-toggle="tooltip"]').tooltip()
    // Custom Select Input
    customSelectInput();
    // PRODUCT GALLERY HEIGHT
    productGalleryHeight();
    // Adaptive Carousel Gallery
    carouselAdaptiveStart();
    // Quantity field
    quantityField();
    // Checkbox decor
    $('.checkboxes .checkbox-container').click(function() {
      checkBoxDecor($(this));
    });
    $('.radios .checkbox-container').click(function() {
      radioDecor($(this));
    });


    /*
     * CLICK EVENTS
     */

    // Click modal button -> open side modal
    $('.open-side-modal').on('click', function(e) {
      e.preventDefault();
      showSideModal($(hrefToId($(this))), transition_time);
    });

    // Click overlay -> close side modal
    $('.overlay').on('click', function(e) {
      hideSideModal($(this).parent(), transition_time);
    });

    // Click close button -> close side modal
    $('.close-button').on('click', function(e) {
      e.preventDefault();
      hideSideModal($(hrefToId($(this))), transition_time);
    });

    // Minicart hover delete -> product opacity
    /*
        $('.mc-pt-del').hover(
          function() {
            $(this).parent().addClass('transparent');
          },
          function() {
            $(this).parent().removeClass('transparent');
          }
        );
    */

    // FILTER BUTTON
    $('.filters-button').on('click', function(e) {
      !$("#shop-filters").hasClass('show') ?
        $(this)
        .addClass('filters-active')
        .find('span').text('hide filters') :
        $(this)
        .removeClass('filters-active')
        .find('span').text('show filters');
    });



    /*
     * VIDEO MODAL
     */

    // Gets the video src from the data-src on each button
    var $videoSrc;
    $('.video-btn').click(function() {
      $videoSrc = $(this).data("src");
    });

    // when the modal is opened autoplay it
    $('#videoModal').on('shown.bs.modal', function(e) {

      // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
      $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })

    // stop playing the youtube video when I close the modal
    $('#videoModal').on('hide.bs.modal', function(e) {
      // a poor man's stop video
      $("#video").attr('src', $videoSrc);
    })


    /*
     * CHOOSE FIRST VARIATION RADIO
     */
    $('.variation-radios .checkbox-container ').first().trigger("click");

    /*
     * SET UP PRODUCT PRICE DEPENDING ON QUANTTITY
     */
    setTimeout(function() {
      changePtQtyPrice($('#product_qty'));
    }, 1000);


    /*
    * HIDE ACCOUNT SETTINGS FORM WHILE EDITING DELIVERY ADDRESS
    */
    var account_settings_wrapper = $('.woocommerce-address-fields').parent().parent();
    account_settings_wrapper.find('.edit-account').hide();
    account_settings_wrapper.find('.payment-methods').hide();


    /*
    * ADD SPAN TO SITEMAP LIST ITEMS
    */
    $('.wsp-container li a').prepend('<span></span>').addClass('list-link');

    /*
    * DROPDOWN PARENTS ITEMS MAKE CLICKABLE
    */
    $('.navbar .dropdown').hover(function() {
    $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

    }, function() {
    $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

    });

    $('.navbar .dropdown > a').click(function(){
    location.href = this.href;
    });

    /*
    * OFFER TIMERS
    */
    $('.offers-item__timer').each( function() {
      if( $(this).attr('valid-till') ) {

        var countDownDate = new Date($(this).attr('valid-till')).getTime();

        $(this).timer = setInterval( () => {

          var now = new Date().getTime();

          // Find the distance between now and the count down date
          var distance = countDownDate - now;


          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          $(this).html('<span class="timer-item"><span class="timer-item__value">' + days + '</span><span class="timer-item__label">days</span></span><span class="timer-item"><span class="timer-item__value">' + hours + '</span><span class="timer-item__label">hours</span></span><span class="timer-item"><span class="timer-item__value">' + minutes + '</span><span class="timer-item__label">min</span></span><span class="timer-item"><span class="timer-item__value">' + seconds + '</span><span class="timer-item__label">sec</span></span>');

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval($(this).timer);
            $(this).html("EXPIRED");
          }
        }, 1000);
      }
    });

    /*
     * REMOVE LAODING SCREEN
     */

    $('#loading-wrap').delay(400).fadeOut("slow", function() {
      // Animation complete.
    });




  });
  // end ready();




  // CHECKBOX
  function checkBoxDecor(checkbox) {

    $(checkbox).find('input').prop('checked') ? $(checkbox).addClass('is-checked') : $(checkbox).removeClass('is-checked')
  }


  // RADIO
  function radioDecor(radioBox) {
    var radio = $(radioBox).find('input');

    if (radio.is(':checked') === false) {

      radio.prop('checked', true);
      radio.trigger('change');
      $(radioBox).siblings('.checkbox-container').removeClass('is-checked');
      $(radioBox).addClass('is-checked');
      $data_price = radio.attr('data-price');
      $data_sale_price = radio.attr('data-sale-price');
      if ($data_price) {
        $('#product_qty').attr('data-price', $data_price);
        if( $data_sale_price ) {
          $('#product_qty').attr('data-price-sale', $data_sale_price);
        }
        changePtQtyPrice($('#product_qty'));
      }
    }
  }




  /*
   * QUANTITY FIELD
   */
  function quantityField() {
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e) {
      // Stop acting like a button
      e.preventDefault();
      // Get input
      inputElem = $(this).parents('.input-quantity').find('input.qty');
      // Get its current value
      var currentVal = parseInt(inputElem.val());
      // If is not undefined
      if (!isNaN(currentVal)) {
        if (Math.abs(inputElem.attr('max'))) {
          if ((currentVal + 1) <= inputElem.attr('max')) {
            inputElem.val(currentVal + 1).change();
          }
        } else {
          // Increment
          inputElem.val(currentVal + 1).change();
        }
      } else {
        // Otherwise put a 1 there
        inputElem.val(1).change();
      }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
      // Stop acting like a button
      e.preventDefault();
      // Get input
      inputElem = $(this).parents('.input-quantity').find('input.qty');
      // Get its current value
      var currentVal = parseInt(inputElem.val());

      // If it isn't undefined or its greater than 0
      if (!isNaN(currentVal)) {
        if (Math.abs(inputElem.attr('min')) || inputElem.attr('min') === '0') {
          if ((currentVal - 1) >= inputElem.attr('min')) {
            inputElem.val(currentVal - 1).change();
          }
        } else {
          // Decrement one
          inputElem.val(currentVal - 1).change();
        }
      } else {
        // Otherwise put a 0 there
        inputElem.val(1).change();
      }
    });
  }


  /*
   * ON QUANTITY CHANGE UPDATE CART
   */
  var timeout;
  $('.woocommerce').on('change', 'input.qty', function() {

    if (timeout !== undefined) {
      clearTimeout(timeout);
    }

    timeout = setTimeout(function() {
      $("[name='update_cart']").trigger("click");
    }, 500); // 1 second delay, half a second (500) seems comfortable too

  });

  /*
   * ON AJAX CART UPDATED
   */
  $(document.body).on('updated_cart_totals', function() {
    quantityField();
    $('#cart-notify').trigger('change');
  });

  $(document.body).on('removed_from_cart', function() {
    $(document.body).trigger('wc_fragment_refresh');
  })

  $(document.body).on('updated_checkout', function() {
    radioDecor();
  });

  /*
   * QUANTITY CHANGE -> CHANGE PRICE
   */
  $(document).on('change', '#product_qty', function() {
    $this = $(this);
    changePtQtyPrice($this);
  });

  function changePtQtyPrice(input) {
    if (input) {
      var price_wrap = $('.pt-final-price');
      var price_amount = price_wrap.find('.amount');
      var price = input.attr('data-price');
      var price_sale = input.attr('data-price-sale');
      var price_currency = input.attr('data-price-currency');
      var qty = input.val();

      if (price_wrap && price && qty && price_currency ) {
        if( price_sale && price_sale != 0) {
          price_wrap.find('del .amount').html("<bdi><span class='woocommerce-Price-currencySymbol'>" + price_currency + "</span>" + qty * price + "</bdi>");
          price_wrap.find('ins .amount').html("<bdi><span class='woocommerce-Price-currencySymbol'>" + price_currency + "</span>" + qty * price_sale + "</bdi>");
        } else {
          price_amount.html("<bdi><span class='woocommerce-Price-currencySymbol'>" + price_currency + "</span>" + qty * price + "</bdi>");
        }
      }
    }
  }

  /*
   * VARIATION RADIO BUTTON
   */
  $(document).on('change', '.variation-radios input[type="radio"]', function() {
    $('.variation-radios input:checked').each(function(index, element) {
      var $el = $(element);
      var thisName = $el.attr('name');
      var thisVal = $el.attr('value');
      $('select[name="' + thisName + '"]').val(thisVal).trigger('change');
    });
  });
  $(document).on('woocommerce_update_variation_values', function() {
    $('.variation-radios input[type="radio"]').each(function(index, element) {
      var $el = $(element);
      var thisName = $el.attr('name');
      var thisVal = $el.attr('value');
      $el.removeAttr('disabled');
      if ($('select[name="' + thisName + '"] option[value="' + thisVal + '"]').is(':disabled')) {
        $el.prop('disabled', true);
      }
    });
  });


  /*
   * SCROLL() SCRIPT
   */
  $(window).scroll(function(event) {

    // Change header style on scroll
    headerSticky();

    // Play video on viewport
    videoPlayViewport();

  });

  /*
   * RESIZE() SCRIPT
   */
  $(window).resize(function() {

    // Add Mobile header class to body
    bodyMobileHeader()

    // PRODUCT GALLERY HEIGHT
    productGalleryHeight();

    // SIMILAR PRODUCTS GALLERY SWITCH
    carouselAdaptiveSwitch();

  });

  // Listen for orientation changes
  window.addEventListener("orientationchange", function() {
    // Announce the new orientation number
    // Add Mobile header class to body
    bodyMobileHeader()
  }, false);

  /*
   * CUSTOM SELECT INPUT
   */

  function customSelectInput() {
    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("select-wrap");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /* For each element, create a new DIV that will act as the selected item: */
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /* For each element, create a new DIV that will contain the option list: */
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 0; j < ll; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        if (a.innerText == selElmnt.options[j].innerHTML) {
          c.setAttribute("class", "same-as-selected");
        }
        c.addEventListener("click", function(e) {
          /* When an item is clicked, update the original select box,
          and the selected item: */
          var y, i, k, s, h, sl, yl;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          sl = s.length;
          h = this.parentNode.previousSibling;
          for (i = 0; i < sl; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              yl = y.length;
              for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
          }
          h.click();
          $(selElmnt).trigger('change');
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }
  }

  function closeAllSelect(elmnt) {
    /* A function that will close all select boxes in the document,
    except the current select box: */
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }

  /* If the user clicks anywhere outside the select box,
  then close all select boxes: */
  document.addEventListener("click", closeAllSelect);


})(jQuery);
