<?php
/**
 * The Grapes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thegrapes
 */


 /* -------------------------------------------------- */
 /* 1. CONSTANTS */
 /* -------------------------------------------------- */

 define ( 'THEMEPATH', get_template_directory() );
 define ( 'THEMEROOT', get_stylesheet_directory_uri() );
 define ( 'IMAGES', THEMEROOT . '/imgs' );
 define ( 'ICONS', THEMEROOT . '/icons' );
 define ( 'JS', THEMEROOT . '/js' );
 define ( 'CSS', THEMEROOT . '/css' );



 /* -------------------------------------------------- */
 /* 2. REGISTER HELPERS */
 /* -------------------------------------------------- */

 /**
 * Register Custom Navigation Walker
 * Register thegrapesmizer changes
 */
function get_additonals(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
	require_once get_template_directory() . '/inc/customizer.php';

}
add_action( 'after_setup_theme', 'get_additonals' );

/*
 * GET HELPER FUNCTIONALITIES
 */
require_once get_template_directory() . '/inc/tags-checkbox.php';
require_once get_template_directory() . '/inc/helper-functions.php';
require_once get_template_directory() . '/inc/shortcodes.php';


/* -------------------------------------------------- */
/* 2. DETECT USER BROWSER */
/* -------------------------------------------------- */

define ( 'USER_BROWSER', get_browser_name($_SERVER['HTTP_USER_AGENT']) );




/* -------------------------------------------------- */
/* 2. SCRIPTS & STYLES */
/* -------------------------------------------------- */

function thegrapes_scripts() {
  wp_register_script( 'bootstrap-js', THEMEROOT . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'wow-js', JS . '/wow.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'isinviewport-js', JS . '/isInViewport.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'sticky-js', JS . '/jquery.sticky.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'actual-js', JS . '/jquery.actual.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'lazy-js', JS . '/jquery.lazy.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'lazy.av-js', JS . '/jquery.lazy.av.min.js', array( 'jquery' ), false, true );
  wp_register_script( 'products-filter-js', JS . '/products-filter.js', array( 'jquery' ), false, true );
  wp_register_script( 'main-js', JS . '/main.js', array( 'jquery' ), false, true );

	wp_enqueue_script( 'popper-ext-js','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array( 'jquery' ),'',true );
	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_script( 'wow-js' );
	wp_enqueue_script( 'isinviewport-js' );
	wp_enqueue_script( 'sticky-js' );
	wp_enqueue_script( 'actual-js' );
	wp_enqueue_script( 'lazy-js' );
	wp_enqueue_script( 'lazy.av-js' );
	wp_enqueue_script( 'products-filter-js' );
	wp_enqueue_script( 'main-js' );




  /* Ajax script */
  global $wp_query;
  // register our main script but do not enqueue it yet
	wp_register_script( 'ajax-helpers', JS. '/ajax-helpers.js', array('jquery') );

	wp_localize_script( 'ajax-helpers', 'thegrapes_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts
	) );


 	wp_enqueue_script( 'ajax-helpers' );

  // Scripts for CHECKOUT page
  if( is_page( 'checkout' ) ) {
    wp_enqueue_style( 'jquery-ui-css', CSS . '/jquery-ui.min.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'jquery-theme-css', CSS . '/jquery-ui.theme.min.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'jquery-structure-css', CSS . '/jquery-ui.structure.min.css', array(), '1.0', 'all' );
    wp_register_script( 'jquery-ui-js', JS . '/jquery-ui.min.js', array( 'jquery' ), false, true );
    wp_register_script( 'datepicker-js', JS . '/datepicker.js', array( 'jquery', 'jquery-ui-js' ), false, true );
    wp_enqueue_script( 'jquery-ui-js' );
    wp_enqueue_script( 'datepicker-js' );
  }

  wp_enqueue_style( 'animate-css', CSS . '/animate.min.css', array(), '1.0', 'all' );
  wp_enqueue_style( 'theme-css', CSS . '/theme.min.css', array(), '1.0', 'all' );
}

add_action( 'wp_enqueue_scripts', 'thegrapes_scripts' );


// Admin script

function thegrapes_admin_scripts() {
	wp_register_script( 'admin-js', JS . '/admin.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'admin-js' );


        wp_enqueue_media();

        wp_register_script( 'meta-image', JS . '/media-uploader.js', array( 'jquery' ) );
        wp_localize_script( 'meta-image', 'meta_image',
            array(
                'title' => __( 'Upload an Image', 'thegrapes' ),
                'button' => __( 'Use this Image', 'thegrapes' ),
            )
        );
        wp_enqueue_script( 'meta-image' );



	wp_enqueue_style( 'admin-css', CSS . '/thegrapes-admin.min.css', array(), '1.0', 'all' );
}

add_action( 'admin_enqueue_scripts', 'thegrapes_admin_scripts' );


/* -------------------------------------------------- */
/* 3. THEME SETUP */
/* -------------------------------------------------- */

function thegrapes_config() {
  // Register nav menu
  // you can register more that one menu at once
  register_nav_menus(
    array(
      'thegrapes_main_menu' => __( 'Main Menu', 'thegrapes' ),
      'thegrapes_footer_menu' => __( 'Footer Menu', 'thegrapes' )
    )
  );

  // Declare Woocommerce support
  add_theme_support( 'woocommerce', array(
    'thumbnail_image_width' => 255,
    'single_image_width' => 255,
    'product_grid' => array(
      'default_rows' => 3,
      'min_rows' => 3,
      'max_rows' => 12,
      'default_columns' => 3,
      'min_columns' => 1,
      'max_columns' => 3
    )
  ));

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'thegrapes-product-img', 600, 600, false );
	add_image_size( 'thegrapes-product-img-thumb', 80, 120, false );
	add_image_size( 'thegrapes-product-img-bundle', 120, 180, false );
	add_image_size( 'thegrapes-edu-preview', 508 );

  if ( ! isset( $content_width ) ) {
  	$content_width = 1200;
  }

	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'thegrapes_config', 0 );


/*-------------------------------*/
/* 4. CUSTOM POST TYPE */
/*-------------------------------*/

function thegrapes_post_types() {

    // FAQ Post Type

    register_post_type( 'faq', array(
        'show_in_rest' => false,
        'public' => true,
        'rewrite' => array(
            'slug' => 'faq'
        ),
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'query_var'           => false,
        'labels' => array(
            'name' => 'FAQ',
            'singular_name' => 'FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit_item' => 'Edit FAQ',
            'view_item' => 'View FAQ',
            'view_items' => 'View FAQ',
            'search_items' => 'Search FAQ',
            'not_found' => 'No FAQ found',
            'not_found_in_trash' => 'No FAQ found in Trash',
            'all_items' => 'All FAQ',
            'archives' => 'FAQ Archives',
            'attributes' => 'FAQ Attributes',
            'insert_into_item' => 'Insert into FAQ',
            'upload_to_this_item' => 'Upload to this FAQ',
            'filter_items_list' => 'Filter FAQ list',
            'items_list_navigaition' => 'FAQ list navigation',
            'items_list' => 'FAQ list',
            'item_published_privately' => 'FAQ published privately',
            'item_revereted_to_draft' => 'FAQ reverted to draft',
            'item_scheduled' => 'FAQ scheduled',
            'item_updated' => 'FAQ updated'
        ),
        'description' => 'FAQ Post Type',
        'menu_icon' => 'dashicons-search',
        'supports' => array(
            'title',
            'editor',
            'revisions'
        ),
        'has_archive' => false
    ));

}

add_action( 'init', 'thegrapes_post_types' );


/* -------------------------------------------------- */
/* 5. WOOCOMMERCE REMOVE DEFAULT STYLESHEETS */
/* -------------------------------------------------- */

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/* -------------------------------------------------- */
/* 6. WOOCOMMERCE ADD MODIFICATIONS */
/* -------------------------------------------------- */

if ( class_exists( 'WooCommerce' ) ) {
  require THEMEPATH . '/inc/wc-modifications.php';
}


/* -------------------------------------------------- */
/* 7. AJAX HANDLER */
/* -------------------------------------------------- */

function thegrapes_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
  $args['posts_per_page'] = $_POST['posts_per_page'];

  // it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/content', get_post_format() );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();


		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'thegrapes_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'thegrapes_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

/*
 * FILTERING PRODUCTS
 */

function thegrapes_filter_function(){

	// Query sorting
	$order = explode( '-', $_POST['thegrapes-orderby'] );



	switch( $order[0] ) {
		case 'price':
			$params = array(
				'post_type' => 'product',
				//'posts_per_page' => $_POST['thegrapes_posts_per_page'],
		    'orderby'   => 'meta_value_num',
		    'meta_key'  => '_' . $order[0],
				'order'	=> $order[1]
			);
			break;
		case 'date' :
			$params = array(
				'post_type' => 'product',
				//'posts_per_page' => $_POST['thegrapes_posts_per_page'],
				'orderby' => $order[0] . ' ID',
				'order'	=> $order[1]
			);
			break;
		case 'menu_order' :
			$params = array(
				'post_type' => 'product',
				//'posts_per_page' => $_POST['thegrapes_posts_per_page'],
				'orderby' => $order[0],
				'order'	=> $order[1]
			);
			break;
		case 'total_sales' :
		case 'thegrapes_product_details_rating' :
		case 'thegrapes_product_details_award' :
			$params = array(
				'post_type' => 'product',
				//'posts_per_page' => $_POST['thegrapes_posts_per_page'],
		    'orderby'   => 'meta_value_num',
		    'meta_key'  => $order[0],
				'order'	=> $order[1]
			);
			break;

		default:
			$params = array();
			break;
	}

	// No limits for products
	$params['posts_per_page'] = -1;

	// Query tags
/*
	$filters = array();
	$i = 0;
	if(!empty($_POST['filterAttrColor'])) {
		$filters[$i] = $_POST['filterAttrColor'];
		$i++;
	}
	if(!empty($_POST['filterAttrGrapes'])) {
		$filters[$i] = $_POST['filterAttrGrapes'];
		$i++;
	}
	if(!empty($_POST['filterAttrFood'])) {
		$filters[$i] = $_POST['filterAttrFood'];
		$i++;
	}

	$params['tax_query'] = array();


	if( !empty($filters) ) {
		foreach ($filters as $filter) {
			array_push( $params['tax_query'], array(
				'taxonomy' => 'product_tag',
	      'field'    => 'slug',
	      'terms'    => $filter, // searches for EITHER tag
			));
		}

	}
*/
	// Only simple and variable products
	array_push( $params['tax_query'], array(
		'relation' => 'OR',
		array(
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => 'simple',
			),
		array(
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => 'variable',
			),
	));


	// Query Taxonomy
	if ( !empty($_POST['taxonomy']) && !empty($_POST['slug']) ) {
		array_push($params['tax_query'], array(
        'taxonomy'      => $_POST['taxonomy'],
        'field'         => 'slug',
        'terms'         => $_POST['slug']
    ));
	}

	// Query relation
	if( count($params['tax_query']) > 1 ) {
		$params['tax_query']['relation'] = 'AND';
	}
	query_posts( $params );

  global $wp_query;

	if( have_posts() ) :


 		ob_start(); // start buffering because we do not need to print the posts now

		while( have_posts() ): the_post();
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );


		endwhile;

 		$posts_html = ob_get_contents(); // we pass the posts to variable
   		ob_end_clean(); // clear the buffer
	else:
		$posts_html = '<h2>Nothing found for your criteria.</h2>';
	endif;

	// no wp_reset_query() required

 	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html
	) );

	die();
}

add_action('wp_ajax_thegrapesfilter', 'thegrapes_filter_function');
add_action('wp_ajax_nopriv_thegrapesfilter', 'thegrapes_filter_function');

/* -------------------------------------------------- */
/* 7. Show cart contents / total Ajax */
/* -------------------------------------------------- */

add_filter( 'woocommerce_add_to_cart_fragments', 'thegrapes_woocommerce_header_add_to_cart_fragment' );

function thegrapes_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<span class="minicart-number items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['span.items'] = ob_get_clean();
	return $fragments;
}

/* -------------------------------------------------- */
/* 8. REMOVE VIRTUAL AND DOWNLOADABLE IN WOOCOMMERCE
/* -------------------------------------------------- */

add_filter( 'product_type_options', function( $options ) {

	// remove "Virtual" checkbox
	if( isset( $options[ 'virtual' ] ) ) {
		unset( $options[ 'virtual' ] );
	}

	// remove "Downloadable" checkbox
	if( isset( $options[ 'downloadable' ] ) ) {
		unset( $options[ 'downloadable' ] );
	}

	return $options;

} );

add_filter( 'woocommerce_products_admin_list_table_filters', function( $filters ) {

	if( isset( $filters[ 'product_type' ] ) ) {
		$filters[ 'product_type' ] = 'thegrapes_product_type_callback';
	}
	return $filters;

});

function thegrapes_product_type_callback(){
	$current_product_type = isset( $_REQUEST['product_type'] ) ? wc_clean( wp_unslash( $_REQUEST['product_type'] ) ) : false;
	$output               = '<select name="product_type" id="dropdown_product_type"><option value="">Filter by product type</option>';

	foreach ( wc_get_product_types() as $value => $label ) {
		$output .= '<option value="' . esc_attr( $value ) . '" ';
		$output .= selected( $value, $current_product_type, false );
		$output .= '>' . esc_html( $label ) . '</option>';
	}

	$output .= '</select>';
	echo $output;
}


/* -------------------------------------------------- */
/* 9. SETUP RELATED PRODUCTS LIMIT
/* -------------------------------------------------- */

add_filter( 'woocommerce_output_related_products_args', 'thegrapes_related_products_args' );
function thegrapes_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}


/* -------------------------------------------------- */
/* 10. HIGHLIGHT MENU FOR CUSTOM TAXONOMY
/* -------------------------------------------------- */

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class($classes, $item) {
    global $naventries;
    $naventries[$item->ID] = $item;
    if($item->type == 'product-vineyards' || $item->type == 'product-estates' ) {
        global $post;
        $terms = get_the_terms($post->ID, $item->object);

        $currentTerms = array();
        if ( $terms && ! is_wp_error( $terms ) ) {
            foreach($terms as $term) {
                $currentTerms[] = $term->slug;
            }
        }

        if(is_array($currentTerms) && count($currentTerms) > 0) {
            $currentTerm = get_term($item->object_id, $item->object);
            if(in_array($currentTerm->slug, $currentTerms)) {
                $classes[] = 'current-menu-item';
            }
        }
    }

     return $classes;
}

/* -------------------------------------------------- */
/* 13. ALLOW EXCERPT IN PAGES
/* -------------------------------------------------- */

add_action( 'init', 'wpse325327_add_excerpts_to_pages' );
function wpse325327_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}


/* -------------------------------------------------- */
/* 13. ALLOW HTML IN CATEGORY AND TAXONOMY DESCRIPTIONS
/* -------------------------------------------------- */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'pre_link_description', 'wp_filter_kses' );
remove_filter( 'pre_link_notes', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );


/* -------------------------------------------------- */
/* 14. REGISTER META BOXES
/* -------------------------------------------------- */

/*
* POST VIDEO SETTINGS
*/
add_action( 'load-post.php', 'video_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'video_post_meta_boxes_setup' );

function video_post_meta_boxes_setup() {
    add_action( 'add_meta_boxes', 'video_add_post_meta_boxes' );
    add_action( 'save_post', 'video_save_post_class_meta', 10, 2 );
}

function video_add_post_meta_boxes() {
    add_meta_box(
        'video-post-class',
        'Video settings',
        'video_post_class_meta_box',
        'post',
        'side',
        'default'
    );
}

function video_post_class_meta_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'video_post_class_nonce' );?>
    <div class="components-panel__row">
      <div class="components-base-control">
        <div class="components-base-control__field">
          <label class="components-checkbox-control__label" for="video-post-class"><?php _e( 'Post with video', 'thegrapes' ); ?></label>
          <select name="video-post-class" id="video-post-class" class="edit-post-post-schedule">
            <?php
              $video_select_values = array(
                'no' => 'No',
                'yes' => 'Yes'
              );
              $video_select_saved_value = get_post_meta( $post->ID, 'video_post_class', true );
              foreach ($video_select_values as $key => $value) {
                $selected_value = $key == $video_select_saved_value ? 'selected="selected"' : '';
                echo '<option value="' . $key . '" ' . $selected_value . '>' . $value . '</option>';
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="components-panel__row">
      <div className="editor-post-featured-image">
        <label for="video-preview-post-class"><?php _e( 'Video preview (240p)', 'thegrapes' ); ?></label>
        <input type="text" name="video-preview-post-class" id="video-preview-post-class" class="edit-post-post-schedule" value="<?php echo esc_attr( get_post_meta( $post->ID, 'video_preview_post_class', true ) ); ?>">
        <input type="button" class="button upload_video_btn" value="Upload a video" />
  		</div>
    </div>
    <div class="components-panel__row">
      <div className="editor-post-featured-image">
        <label for="video-header-post-class"><?php _e( 'Video header (720p)', 'thegrapes' ); ?></label>
        <input type="text" name="video-header-post-class" id="video-header-post-class" class="edit-post-post-schedule" value="<?php echo esc_attr( get_post_meta( $post->ID, 'video_header_post_class', true ) ); ?>">
        <input type="button" class="button upload_video_btn" value="Upload a video" />
  		</div>
    </div>
<?php }

function video_save_post_class_meta( $post_id, $post ) {

    if ( !isset( $_POST['video_post_class_nonce'] ) || !wp_verify_nonce( $_POST['video_post_class_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    $post_type = get_post_type_object( $post->post_type );
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $meta_values = array(
      'video_post_class' => 'video-post-class',
      'video_header_post_class' => 'video-header-post-class',
      'video_preview_post_class' => 'video-preview-post-class'
    );

    foreach ($meta_values as $key => $value) {
      $new_meta_value = ( isset( $_POST[$value] ) ? $_POST[$value] : '' );
      $meta_key = $key;
      $meta_value = get_post_meta( $post_id, $meta_key, true );

      if ( $new_meta_value && '' == $meta_value )
          add_post_meta( $post_id, $meta_key, $new_meta_value, true );
      elseif ( $new_meta_value && $new_meta_value != $meta_value )
          update_post_meta( $post_id, $meta_key, $new_meta_value );
      elseif ( '' == $new_meta_value && $meta_value )
          delete_post_meta( $post_id, $meta_key, $meta_value );
    }
}

/*
* POST CUSTOM READ TIME SETTINGS
*/
add_action( 'load-post.php', 'readtime_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'readtime_post_meta_boxes_setup' );

function readtime_post_meta_boxes_setup() {
    add_action( 'add_meta_boxes', 'readtime_add_post_meta_boxes' );
    add_action( 'save_post', 'readtime_save_post_class_meta', 10, 2 );
}

function readtime_add_post_meta_boxes() {
    add_meta_box(
        'readtime-post-class',
        'Reading time',
        'readtime_post_class_meta_box',
        'post',
        'side',
        'default'
    );
}

function readtime_post_class_meta_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'readtime_post_class_nonce' );?>
    <div class="components-panel__row">
      <div className="editor-post-featured-image">
        <label for="read-time-post-class"><?php _e( 'Custom read time', 'thegrapes' ); ?></label>
        <input type="number" name="read-time-post-class" id="read-time-post-class" class="edit-post-post-schedule" value="<?php echo esc_attr( get_post_meta( $post->ID, 'read_time_post_class', true ) ); ?>">
        <small><?php _e( 'Fill in custom read time in minutes.', 'thegrapes' ); ?></small>
  		</div>
    </div>
<?php }

function readtime_save_post_class_meta( $post_id, $post ) {

    if ( !isset( $_POST['readtime_post_class_nonce'] ) || !wp_verify_nonce( $_POST['readtime_post_class_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    $post_type = get_post_type_object( $post->post_type );
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $meta_values = array(
      'read_time_post_class' => 'read-time-post-class',
    );

    foreach ($meta_values as $key => $value) {
      $new_meta_value = ( isset( $_POST[$value] ) ? $_POST[$value] : '' );
      $meta_key = $key;
      $meta_value = get_post_meta( $post_id, $meta_key, true );

      if ( $new_meta_value && '' == $meta_value )
          add_post_meta( $post_id, $meta_key, $new_meta_value, true );
      elseif ( $new_meta_value && $new_meta_value != $meta_value )
          update_post_meta( $post_id, $meta_key, $new_meta_value );
      elseif ( '' == $new_meta_value && $meta_value )
          delete_post_meta( $post_id, $meta_key, $meta_value );
    }
}


/* -------------------------------------------------- */
/* 15. POST READ TIME COUNT
/* -------------------------------------------------- */

add_action( 'save_post', 'save_post_read_time', 3, 10 );

function save_post_read_time( $post_id ) {
    $post    = get_post( $post_id );
    $content = $post->post_content;
    $content = strip_tags(apply_filters('the_content', $content));

    $meta_key = 'post_read_time';
    $symbol_count = strlen($content);
    $average_symbols_per_minute = 1000;
    $meta_value = $symbol_count/$average_symbols_per_minute;
    if( $meta_value < 0.5 ) $meta_value = 1;
    $meta_value = round( $meta_value );
    if ( metadata_exists('post', $post_id, 'post_read_time') ) {
      update_post_meta( $post_id, $meta_key, $meta_value );
    } else {
      add_post_meta( $post_id, $meta_key, $meta_value, true );
    }
}


/* -------------------------------------------------- */
/* 16. ALLOW WEBP
/* -------------------------------------------------- */

/**
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

/**
 * Adds webp filetype to allowed mimes
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}


/* -------------------------------------------------- */
/* 17. BUY NOW BUTTON
/* -------------------------------------------------- */

function buy_now_submit_form() {
 ?>
  <script>
      jQuery(document).ready(function(){
          // listen if someone clicks 'Buy Now' button
          jQuery('#buy_now_button').click(function(){
              // set value to 1
              jQuery('#is_buy_now').val('1');
              //submit the form
              jQuery('form.cart').submit();
          });
      });
  </script>
 <?php
}
add_action('woocommerce_after_add_to_cart_form', 'buy_now_submit_form');


add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url) {
  if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
     global $woocommerce;
     $redirect_url = wc_get_checkout_url();
  }
  return $redirect_url;
}
