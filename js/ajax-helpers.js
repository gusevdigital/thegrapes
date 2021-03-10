jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error

	// PARAMETERS
  var transition_time = 300;

	/*
	 * Load more posts
	 */
	$('.p-loadmore').click(function(){

		var button = $(this),
			button_text = button.text(),
		    data = {
    			'action': 'loadmore',
    			'query': $(this).attr('data-query'), // that's how we get params from wp_localize_script() function
    			'page' : thegrapes_loadmore_params.current_page,
          'posts_per_page' : $(this).attr('data-posts-page')
    		};


		$.ajax({ // you can also use $.post here
			url : thegrapes_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.find('span').text('Loading...');
				button.attr('disabled','disabled');
			},
			success : function( data ){
				if( data ) {
					button.find('span').text( button_text );
					button.removeAttr('disabled');
					$('#posts-container').append(data); // insert new posts
          $("video").lazy();
					thegrapes_loadmore_params.current_page++;

					if ( thegrapes_loadmore_params.current_page == thegrapes_loadmore_params.max_page )
						button.hide(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.hide(); // if no data, remove the button as well
				}
			}
		});

		return false;
	});


	/*
	 * Filter
	 */

   /* Disable Ajax filters */
   // Everything moved to products-filter.js
/*
	$(document).on('change', '#thegrapes-orderby', function() {
		ptApplyFilter();
	});

	$(document).on('change', 'input[name^="filterAttr"]', function() {
		ptApplyFilter();
	});
  */

	function ptApplyFilter() {

    var dataTaxonomy = $('.product-archive').attr('data-taxonomy');
    var dataSlug = $('.product-archive').attr('data-slug');
    var form = $('#thegrapes-filter-form');
    if( dataTaxonomy && dataTaxonomy != "" ) {
      $(form).find('input[name="taxonomy"]').val(dataTaxonomy);
    }
    if( dataSlug && dataSlug != "" ) {
      $(form).find('input[name="slug"]').val(dataSlug);
    }

		$.ajax({
			url : thegrapes_loadmore_params.ajaxurl,
			data : $('#thegrapes-filter-form').serialize(), // form data
			dataType : 'json', // this data type allows us to receive objects from the server
			type : 'POST',
			beforeSend : function(xhr){
				$('.product-archive+.section-overlay').fadeIn(transition_time);
			},
			success : function( data ){
				// when filter applied:
				// set the current page to 1
				thegrapes_loadmore_params.current_page = 1;

				// set the new query parameters
				thegrapes_loadmore_params.posts = data.posts;


				// set the new max page parameter
				thegrapes_loadmore_params.max_page = data.max_page;

				// Change load more button data
				$('.product-archive').attr('data-ajax', data.posts);

				// Do smth after finished filtering
				$('.product-archive+.section-overlay').fadeOut(transition_time);

				// insert the posts to the container
				$('.product-archive').html(data.content);

				$('[data-toggle="tooltip"]').tooltip();

				// hide load more button, if there are not enough posts for the second page
				if ( data.max_page < 2 ) {
					$('.pt-loadmore').hide();
				} else {
					$('.pt-loadmore').show();
				}
			}
		});
	}

	$('#thegrapes-filter-form').submit(function(){
		// do not submit the form
		return false;
	});

});
