(function($) {

  // BLOCK FROM NOT CHOOSING VARIATION FOR PRODUCT IN BUNDLE
  $('#publishing-action input[type="submit"]').on('click', function() {
    if ( $('#product-type').val() == 'bundle' ) {
      var variations_chosen = true;
      $('.override_variations input[type="checkbox"]').each(function() {
        if( ! $(this).is(":checked") ) {
          variations_chosen = false;
          alert('Check "Filter Variations"');
          variations_chosen = false;
        } else {
          var options_group = $(this).parents('.options_group');
          variations_chosen_length = $(options_group).find('.allowed_variations select').val().length;
          if( ! variations_chosen_length ) {
            alert('Please, choose variation');
            variations_chosen = false;
          } else if( variations_chosen_length > 1 ) {
            alert('Please, choose only one variation');
            variations_chosen = false;
          } else {
            if( ! $(options_group).find('.override_default_variation_attributes input[type="checkbox"]').is(":checked") ) {
              alert('Check "Override Default Selections"');
              variations_chosen = false;
            } else {
              if ( !$(options_group).find('.default_variation_attributes select').val() || $(options_group).find('.default_variation_attributes select').val() == "" ) {
                alert('Choose "Override Default Selections" option');
                variations_chosen = false;
              } else {
                var allowed_variations_value = $(options_group).find('.allowed_variations select').val();
                var default_variation_value = $(options_group).find('.default_variation_attributes select').val();
                var allowed_variations_text = $(options_group).find('.allowed_variations select option[value="' + allowed_variations_value + '"]').text();
                if (allowed_variations_text.indexOf(default_variation_value) == -1 ) {
                  alert('Choose the same Variation and Default Selection');
                  variations_chosen = false;
                }
              }
            }

          }
        }
        if( ! variations_chosen ) {
          return false;
        }
      });
      if( ! variations_chosen ) {
        return false;
      }
    }
  });
})(jQuery);
