(function($) {



  if( $('.shop-filters') ) {

    var shop_filters = $('#shop-filters');

    var products_wrapper = $('.product-archive');

    //show all categories
    var _showProducts = function(item) {
      for (var x = 0; x < item.length; ++x) {
        $(item[x]).fadeIn();
        active_products.push(item[x]);
      }
    };

    function arrayUnique(array) {
        var a = array.concat();
        for(var i=0; i<a.length; ++i) {
            for(var j=i+1; j<a.length; ++j) {
                if(a[i] === a[j])
                    a.splice(j--, 1);
            }
        }

        return a;
    }

    var resources = [],
    initial = "";

    var products = $('figure.pt-pr');
    var active_products = [];

    $(shop_filters).find('.checkbox-container input[type="checkbox"]').click(function() {

      resources = [];
      initial = "";
      active_products = [];

      if ($('#shop-filters .checkbox-container input[type="checkbox"]:checked').length > 0) {

        $('#shop-filters').find('.checkbox-container input:checked').each(function() {

          if (($.inArray($(this).val(), resources)) === -1) {
            resources.push('filter-' + $(this).val());
          }

          //convert our resources array to string
          //then replace the commas (,) with periods (.)
          initial = resources.toString();
          initial = initial.replace(/,/g, '.');

        });

        for (var i = 0; i < products.length; ++i) {

          if ($(products[i]).is('.' + initial)) {

          //  $("." + initial).show('fast');
            $(products[i]).fadeIn('fast');
            active_products.push(products[i]);

          } else {

            $(products[i]).fadeOut('fast');

          }

        }

      } else {
        _showProducts(products);
        active_products = products;
      }

      // CHECK AVAILABLE PRODUCTS
      // And disable checkboxes

      // Collect all current classes
      var current_classes = [];

      $(active_products).each(function() {

        pr_classes = $(this).attr('class').split(/\s+/);

        current_classes = arrayUnique(current_classes.concat(pr_classes));

      });

      $('#shop-filters').find('.checkbox-container input').each(function() {

        if( $.inArray( 'filter-' + $(this).val(), current_classes ) !== -1 ) {

          $(this).removeAttr("disabled", "disabled");
          $(this).parent().removeClass('disabled');

        } else {
          $(this).attr("disabled", "disabled");
          $(this).parent().addClass('disabled');
        }

      });

    });

    $(document).on('change', '#thegrapes-orderby', function() {
      var sorting = $(this).val();
      switch( sorting ) {
        case 'points':
          products_wrapper.find('figure.pt-pr').sort(function(a, b) {
            return +b.getAttribute('data-rating') - +a.getAttribute('data-rating');
          })
          .appendTo(products_wrapper);
          break;
        case 'menu-order':
          products_wrapper.find('figure.pt-pr').sort(function(a, b) {
            return +a.getAttribute('data-menu-order') - +b.getAttribute('data-menu-order');
          })
          .appendTo(products_wrapper);
          break;
        case 'award':
          products_wrapper.find('figure.pt-pr').sort(function(a, b) {
            var first = +a.getAttribute('data-award') ? +a.getAttribute('data-award') : 9999;
            var second = +b.getAttribute('data-award') ? +b.getAttribute('data-award') : 9999;
            return first - second;
          })
          .appendTo(products_wrapper);
          break;
        case 'price-asc':
          products_wrapper.find('figure.pt-pr').sort(function(a, b) {
            var first = +a.getAttribute('data-price') ? +a.getAttribute('data-price') : 0;
            var second = +b.getAttribute('data-price') ? +b.getAttribute('data-price') : 0;
            return first - second;
          })
          .appendTo(products_wrapper);
          break;
        case 'price-desc':
          products_wrapper.find('figure.pt-pr').sort(function(a, b) {
            var first = +a.getAttribute('data-price') ? +a.getAttribute('data-price') : 0;
            var second = +b.getAttribute('data-price') ? +b.getAttribute('data-price') : 0;
            return second - first;
          })
          .appendTo(products_wrapper);
          break;
      }


    });

  }

})(jQuery);
