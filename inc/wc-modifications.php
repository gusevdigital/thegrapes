<?php
function thegrapes_wc_modify() {

  /*-------------------------------
  * REMOVE BREADCRUMBS
  */
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

  /*-------------------------------
  * REMOVE PRODUCT SINGLE CONTENT
  */

  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

  /*-------------------------------
  * REMOVE PRODUCT COUNT AND DEFAULT SORTING
  */

  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );

}

add_action ( 'wp', 'thegrapes_wc_modify' );

/*-------------------------------
* REMOVE TABS AND ADDITIONAL INFORMATION
*/

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}

/*-------------------------------
* HIDE VARIATION INFO IN TITLE
*/
/*
add_filter( 'woocommerce_product_variation_title_include_attributes', 'custom_product_variation_title', 10, 2 );
function custom_product_variation_title($should_include_attributes, $product){

    $should_include_attributes = false;
    return $should_include_attributes;
}*/

/*-------------------------------
* ADMIN PRODUCT COLUMNS
*/

// CUSTOM COLUMNS

add_filter( 'manage_edit-product_columns', 'admin_custom_columns',15 );
function admin_custom_columns($columns){
  //remove column
  unset( $columns['featured'] );
  unset( $columns['thumb'] );
  unset( $columns['is_in_stock'] );
  unset( $columns['product_cat'] );
  unset( $columns['taxonomy-product-occasions'] );
  unset( $columns['taxonomy-product-grapes'] );

  // Custom SKU and Image columns
  $new_columns = array();
      foreach( $columns as $key => $column ){
          if( $key === 'name' ) $new_columns['thegrapes_img'] = __( 'Image', 'thegrapes' );
          if( $key === 'price' ) $new_columns['thegrapes_is_in_stock'] = __( 'Stock','woocommerce');
          $new_columns[$key] =  $columns[$key];
      }

  return $new_columns;
}


// SHOW VARIANT STOCK QTY

add_action( 'manage_product_posts_custom_column', 'admin_show_variant_stock_qty', 10, 2);
function admin_show_variant_stock_qty( $column, $post_id ) {
  // Image column
  if ( 'thegrapes_img' === $column ) {
    echo '<div style="text-align: center;">' . get_the_post_thumbnail( $post_id, 'thegrapes-product-img-thumb' ) . '</div>';
  }
  // Stock column
  if ( 'thegrapes_is_in_stock' === $column ) {

    $_product = wc_get_product( $post_id );
    if( $_product -> get_stock_status() == "instock" ) {
      echo '<mark class="instock">' . __( 'In stock', 'thegrapes' ) . '</mark>';

      if( $_product->is_type( 'simple' ) && null !== $_product->get_stock_quantity() && $_product->get_stock_quantity() > 0 ) {
        echo ' (' . $_product->get_stock_quantity() . ')';
      } elseif ( $_product->is_type( 'variable' ) ) {
        $stock_limit = true;
        $variation_ids = $_product->get_children(); // Get product variation IDs
        $pt_max_qty = 0;
        foreach( $variation_ids as $variation_id ){
            $variation = wc_get_product($variation_id);
            if( $variation->get_manage_stock() != "1" ) {
              $stock_limit = false;
              break;
            }
            if($variation->is_in_stock())
            $pt_max_qty += $variation->get_max_purchase_quantity();
        }
        if( $stock_limit && $pt_max_qty ) {
          echo ' (' . $pt_max_qty . ')';
        }
      }
    } elseif (  $_product -> get_stock_status() == "outofstock" ) {
      echo '<mark class="outofstock">' . __( 'Out of stock', 'thegrapes' ) . '</mark>';
    } else {
      echo '';
    }
  }
}

/*-------------------------------
* REMOVE TABS
*/

add_filter('woocommerce_product_data_tabs', 'thegrapes_product_remove_tabs' );

function thegrapes_product_remove_tabs( $tabs ){

	unset( $tabs['shipping'] );
	unset( $tabs['advanced'] );

  return $tabs;

}

/*-------------------------------
* PRODUCT CUSTOM TABS
*/

add_filter('woocommerce_product_data_tabs', 'thegrapes_product_settings_details' );

function thegrapes_product_settings_details( $tabs ){

	$tabs['thegrapes_details'] = array(
		'label'    => 'Details',
		'target'   => 'thegrapes_product_details',
		'priority' => 11,
	);
  $tabs['thegrapes_additional'] = array(
		'label'    => 'Additional',
		'target'   => 'thegrapes_product_additional',
		'priority' => 12,
	);
  $tabs['thegrapes_bundle_info'] = array(
		'label'    => 'Bundle info',
		'target'   => 'thegrapes_product_bundle_info',
		'priority' => 13,
	);
  $tabs['thegrapes_restock'] = array(
		'label'    => 'Restock',
		'target'   => 'thegrapes_product_restock',
		'priority' => 21,
	);
	return $tabs;
}


/*-------------------------------
* PRODUCT DETAILS TAB CONTENT
*/

add_action( 'woocommerce_product_data_panels', 'thegrapes_product_settings_details_panel' );

function thegrapes_product_settings_details_panel(){

	echo '<div id="thegrapes_product_details" class="panel woocommerce_options_panel hidden">';

  // Award
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_award',
          'placeholder' => 'Number in Laurel',
          'label' => __('Award number', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_award', true ),
          'type' => 'number',
          'custom_attributes' => array(
              'step' => '1',
              'min' => '0',
              'max' => '100'
          )
      )
  );

  // Award text
  woocommerce_wp_textarea_input(
      array(
          'id' => 'thegrapes_product_details_award_text',
          'placeholder' => 'Award text on hover',
          'label' => __('Award text', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_award_text', true ),
          'desc_tip' => 'true'
      )
  );

  // Rating
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_rating',
          'placeholder' => 'Number from 0 to 100',
          'label' => __('Rating', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_rating', true ),
          'type' => 'number',
          'custom_attributes' => array(
              'step' => '1',
              'min' => '0',
              'max' => '100'
          )
      )
  );

  // Color
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_color',
          'placeholder' => 'Ex. "Red"',
          'label' => __('Wine color', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_color', true ),
          'desc_tip' => 'true'
      )
  );

  // Food pairing
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_food_pairing',
          'placeholder' => 'Ex. "Seafood"',
          'label' => __('Food pairing', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_food_pairing', true ),
          'desc_tip' => 'true'
      )
  );

  // Volume
  woocommerce_wp_text_input(
      array(
        'id' => 'thegrapes_product_details_volume',
        'placeholder' => 'Ex. "750 ml."',
        'label' => __('Volume', 'thegrapes'),
        'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_volume', true ),
        'desc_tip' => 'true'
      )
  );

  // Grapes
  woocommerce_wp_text_input(
      array(
        'id' => 'thegrapes_product_details_grapes',
        'placeholder' => 'Ex. "Merlot, Cabernet Sauvignon, Cabernet Franc" (Use comma to separate the grapes)',
        'label' => __('Grapes', 'thegrapes'),
        'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_grapes', true ),
        'desc_tip' => 'true',
        'description' => 'Use comma to separate the grapes.'
      )
  );

	echo '</div>';
}

/*-------------------------------
* PRODUCT ADDITIONOAL TAB CONTENT
*/

add_action( 'woocommerce_product_data_panels', 'thegrapes_product_settings_additional_panel' );

function thegrapes_product_settings_additional_panel(){

	echo '<div id="thegrapes_product_additional" class="panel woocommerce_options_panel hidden">';

  // YouTube Link
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_add_youtube',
          'placeholder' => 'Ex "https://www.youtube.com/watch?v=7gquYRxLMFI"',
          'label' => __('Link for YouTube video', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_add_youtube', true ),
          'desc_tip' => 'true'
      )
  );

  // YouTube Link Text
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_add_youtube_text',
          'placeholder' => 'Ex "Watch production process"',
          'label' => __('Text for YouTube video link', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_add_youtube_text', true ),
          'desc_tip' => 'true'
      )
  );

  // Tasting Notes
  woocommerce_wp_textarea_input(
      array(
          'id' => 'thegrapes_product_details_tasting_notes',
          'placeholder' => 'Describe here tasting notes',
          'label' => __('Tasting notes', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_tasting_notes', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Soil Composition
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_soil_composition',
          'placeholder' => 'Ex "Red soil, yellow clay, broken rocks"',
          'label' => __('Soil composition', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_soil_composition', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Estate Altitude
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_estate_altitude',
          'placeholder' => 'Ex "350 m."',
          'label' => __('Estate altitude', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_estate_altitude', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Aging
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_aging',
          'placeholder' => 'Ex "Wooden cask"',
          'label' => __('Aging', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_aging', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Alcohol
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_alcohol',
          'placeholder' => 'Ex "14,5"',
          'label' => __('Alcohol', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_alcohol', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Acidity
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_acidity',
          'placeholder' => 'Ex "5.7"',
          'label' => __('Acidity', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_acidity', true ),
          'desc_tip' => 'true'
      )
  );

  // Details -> Dry Extract
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_details_extract',
          'placeholder' => 'Ex "30"',
          'label' => __('Dry extract', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_details_extract', true ),
          'desc_tip' => 'true'
      )
  );

	echo '</div>';
}

/*-------------------------------
* PRODUCT BUNDLE INFO TAB CONTENT
*/

add_action( 'woocommerce_product_data_panels', 'thegrapes_product_settings_bundle_info_panel' );

function thegrapes_product_settings_bundle_info_panel(){

	echo '<div id="thegrapes_product_bundle_info" class="panel woocommerce_options_panel hidden">';

  // Bundle Volume
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_bundle_volume',
          'placeholder' => 'Ex "6 x 750 ml."',
          'label' => __('Bundle volume', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_bundle_volume', true ),
          'desc_tip' => 'true'
      )
  );

  // Bundle Setup
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_bundle_setup',
          'placeholder' => 'Ex "3 white | 1 rose | 2 red"',
          'label' => __('Bundle setup', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_bundle_setup', true ),
          'desc_tip' => 'true'
      )
  );

	echo '</div>';
}


/*-------------------------------
* PRODUCT ADDITIONOAL TAB CONTENT
*/

add_action( 'woocommerce_product_data_panels', 'thegrapes_product_settings_restock_panel' );

function thegrapes_product_settings_restock_panel(){

	echo '<div id="thegrapes_product_restock" class="panel woocommerce_options_panel hidden">';

  // Restock Text
  woocommerce_wp_text_input(
      array(
          'id' => 'thegrapes_product_restock_text',
          'placeholder' => 'Ex "Restock on February 15"',
          'label' => __('"Restock" text"', 'thegrapes'),
          'value'   => get_post_meta( get_the_ID(), 'thegrapes_product_restock_text', true ),
          'desc_tip' => 'true'
      )
  );

	echo '</div>';
}

/*-------------------------------
* PRODUCT FIELDS SAVING
*/

add_action( 'woocommerce_process_product_meta', 'thegrapes_save_fields', 10, 2 );
function thegrapes_save_fields( $id, $post ){

  $save_fields = array (
    'thegrapes_product_details_award',
    'thegrapes_product_details_award_text',
    'thegrapes_product_details_rating',
    'thegrapes_product_details_color',
    'thegrapes_product_details_food_pairing',
    'thegrapes_product_details_volume',
    'thegrapes_product_details_grapes',
    'thegrapes_product_add_youtube',
    'thegrapes_product_add_youtube_text',
    'thegrapes_product_details_tasting_notes',
    'thegrapes_product_details_soil_composition',
    'thegrapes_product_details_estate_altitude',
    'thegrapes_product_details_aging',
    'thegrapes_product_details_alcohol',
    'thegrapes_product_details_acidity',
    'thegrapes_product_details_extract',
    'thegrapes_product_restock_text',
    'thegrapes_product_bundle_volume',
    'thegrapes_product_bundle_setup',
  );

  foreach ( $save_fields as $field ) {
    if( !empty( $_POST[$field] ) ) {
  		update_post_meta( $id, $field, $_POST[$field] );
  	} else {
  		delete_post_meta( $id, $field );
  	}
  }
}


/*-------------------------------
* CUSTOM PRODUCT VARIATION FIELDS
*/

add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );
add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

function variation_settings_fields( $loop, $variation_data, $variation ) {

    woocommerce_wp_text_input(
        array(
            'id'            => "the_grapes_variation_rating{$loop}",
            'name'          => "the_grapes_variation_rating[{$loop}]",
            'value'         => get_post_meta( $variation->ID, 'the_grapes_variation_rating', true ),
            'label'         => __( 'Variation Rating', 'thegrapes' ),
            'desc_tip'      => true,
            'description'   => __( 'Enter value from 0 to 100.', 'thegrapes' ),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => '1',
                'min' => '0',
                'max' => '100'
            ),
            'wrapper_class' => 'form-row form-row-full',
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'            => "the_grapes_variation_restock{$loop}",
            'name'          => "the_grapes_variation_restock[{$loop}]",
            'value'         => get_post_meta( $variation->ID, 'the_grapes_variation_restock', true ),
            'label'         => __( '"Restock" text', 'thegrapes' ),
            'desc_tip'      => true,
            'description'   => __( 'Enter "Restock" text', 'thegrapes' ),
            'type' => 'text',
            'wrapper_class' => 'form-row form-row-full',
        )
    );
}

function save_variation_settings_fields( $variation_id, $loop ) {
    $text_rating = $_POST['the_grapes_variation_rating'][ $loop ];
    $text_restock = $_POST['the_grapes_variation_restock'][ $loop ];

    if ( ! empty( $text_rating ) ) {
        update_post_meta( $variation_id, 'the_grapes_variation_rating', esc_attr( $text_rating ));
    }

    if ( ! empty( $text_restock ) ) {
        update_post_meta( $variation_id, 'the_grapes_variation_restock', esc_attr( $text_restock ));
    }
}

function load_variation_settings_fields( $variation ) {
    $variation['the_grapes_variation_rating'] = get_post_meta( $variation[ 'variation_id' ], 'the_grapes_variation_rating', true );
    $variation['the_grapes_variation_restock'] = get_post_meta( $variation[ 'variation_id' ], 'the_grapes_variation_restock', true );
    $variation['name'] = print_r($variation['attributes']['attribute_vintage'],true);

    return $variation;
}





/*-------------------------------
* SORTING
*/

add_filter( 'woocommerce_catalog_orderby', 'thegrapes_sorting_options' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'thegrapes_sorting_options' );

function thegrapes_sorting_options( $options ){
  unset( $options[ 'menu_order' ] );
	unset( $options[ 'rating' ] );
	unset( $options[ 'price-desc' ] );
	unset( $options[ 'price' ] );
	unset( $options[ 'date' ] );
	unset( $options[ 'popularity' ] );
	//$options[ 'total_sales-desc' ] = 'Best selling';
	$options[ 'menu-order' ] = 'Best selling';
	$options[ 'points' ] = 'Points';
	$options[ 'award' ] = 'Awards';
	$options[ 'price-asc' ] = 'Price: low to high';
	$options[ 'price-desc' ] = 'Price: high to low';
	return $options;
}

/*-------------------------------
* REGISTER CUSTOM TAXONOMY
*/

function thegrapes_custom_taxonomy()  {

$labels = array(
    'name'                       => 'Estates',
    'singular_name'              => 'Estate',
    'menu_name'                  => 'Estates',
    'all_items'                  => 'All Estates',
    'parent_item'                => 'Parent Estate',
    'parent_item_colon'          => 'Parent Estate:',
    'new_item_name'              => 'New Estate Name',
    'add_new_item'               => 'Add New Estate',
    'edit_item'                  => 'Edit Estate',
    'update_item'                => 'Update Estate',
    'separate_items_with_commas' => 'Separate Estates with commas',
    'search_items'               => 'Search Estate',
    'add_or_remove_items'        => 'Add or remove Estates',
    'choose_from_most_used'      => 'Choose from the most used Estates',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'product-estates', 'product', $args );


$labels = array(
    'name'                       => 'Occasions',
    'singular_name'              => 'Occasion',
    'menu_name'                  => 'Occasions',
    'all_items'                  => 'All Occasions',
    'parent_item'                => 'Parent Occasion',
    'parent_item_colon'          => 'Parent Occasion:',
    'new_item_name'              => 'New Occasion Name',
    'add_new_item'               => 'Add New Occasion',
    'edit_item'                  => 'Edit Occasion',
    'update_item'                => 'Update Occasion',
    'separate_items_with_commas' => 'Separate Occasions with commas',
    'search_items'               => 'Search Occasion',
    'add_or_remove_items'        => 'Add or remove Occasions',
    'choose_from_most_used'      => 'Choose from the most used Occasions',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'product-occasions', 'product', $args );


$labels = array(
    'name'                       => 'Grapes',
    'singular_name'              => 'Grape',
    'menu_name'                  => 'Grapes',
    'all_items'                  => 'All Grapes',
    'parent_item'                => 'Parent Grape',
    'parent_item_colon'          => 'Parent Grape:',
    'new_item_name'              => 'New Grape Name',
    'add_new_item'               => 'Add New Grape',
    'edit_item'                  => 'Edit Grape',
    'update_item'                => 'Update Grape',
    'separate_items_with_commas' => 'Separate Grapes with commas',
    'search_items'               => 'Search Grape',
    'add_or_remove_items'        => 'Add or remove Grapes',
    'choose_from_most_used'      => 'Choose from the most used Grapes',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'product-grapes', 'product', $args );

}

add_action( 'init', 'thegrapes_custom_taxonomy', 0 );


/*-------------------------------
* RENAME TAGS TO FILTERS
*/

add_action( 'init', 'wpa4182_init');
function wpa4182_init()
{
    global $wp_taxonomies;

    // The list of labels we can modify comes from
    //  http://codex.wordpress.org/Function_Reference/register_taxonomy
    //  http://core.trac.wordpress.org/browser/branches/3.0/wp-includes/taxonomy.php#L350
    $wp_taxonomies['product_tag']->labels = (object)array(
        'name' => 'Filters',
        'menu_name' => 'Filters',
        'singular_name' => 'Filter',
        'search_items' => 'Search Filters',
        'popular_items' => 'Popular Filters',
        'all_items' => 'All Filters',
        'parent_item' => null, // Tags aren't hierarchical
        'parent_item_colon' => null,
        'edit_item' => 'Edit Filter',
        'update_item' => 'Update Filter',
        'add_new_item' => 'Add new Filter',
        'items_list' => 'Filters List',
        'items_list_navigation' => 'Filter Navigation',
        'new_item_name' => 'New Filter Name',
        'separate_items_with_commas' => 'Separata Filters with commas',
        'add_or_remove_items' => 'Add or remove Filters',
        'choose_from_most_used' => 'Choose from the most used Filters',
    );

    $wp_taxonomies['product_tag']->label = 'Filters';
}


/*-------------------------------
* TAXONOMY UPLOAD IMAGE BUTTON
*/
add_action('product-estates_add_form_fields', 'add_term_image', 10, 2);
add_action('created_product-estates', 'save_term_image', 10, 2);
add_action('product-estates_edit_form_fields', 'edit_image_upload', 10, 2);
add_action('edited_product-estates', 'update_image_upload', 10, 2);

add_action('product-occasions_add_form_fields', 'add_term_image', 10, 2);
add_action('created_product-occasions', 'save_term_image', 10, 2);
add_action('product-occasions_edit_form_fields', 'edit_image_upload', 10, 2);
add_action('edited_product-occasions', 'update_image_upload', 10, 2);

add_action('product-grapes_add_form_fields', 'add_term_image', 10, 2);
add_action('created_product-grapes', 'save_term_image', 10, 2);
add_action('product-grapes_edit_form_fields', 'edit_image_upload', 10, 2);
add_action('edited_product-grapes', 'update_image_upload', 10, 2);


function add_term_image($taxonomy){
    ?>
    <div class="form-field term-group">
        <label for="">Upload and Image</label>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="" style="width: 77%">
        <input type="button" class="button upload_image_btn" value="Upload an Image" />
    </div>
    <?php
}

function save_term_image($term_id, $tt_id) {
  if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
      $group = esc_url($_POST['txt_upload_image']);
      add_term_meta($term_id, 'term_image', $group, true);
  }
}

function edit_image_upload($term, $taxonomy) {
    // get current group
    $txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
?>
  <table class="form-table" role="presentation">
    <tbody><tr class="form-field form-required term-name-wrap">

      <tr class="form-field form-required term-name-wrap">
			<th scope="row"><label for="name"><?php _e( 'Upload image', 'thegrapes' ); ?></label></th>
			<td>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="<?php echo $txt_upload_image ?>" style="width: 77%">
        <input type="button" class="button upload_image_btn" value="Upload an Image" />
        <?php if( isset( $txt_upload_image ) && $txt_upload_image ) : ?>
          <img src="<?php echo $txt_upload_image; ?>" style="max-width: 360px; max-height: 360px;" />
        <?php endif; ?>
      </td>
		</tr>
    </tbody>
  </table>
<?php
}

function update_image_upload($term_id, $tt_id) {
  if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
      $group = esc_url($_POST['txt_upload_image']);
      update_term_meta($term_id, 'term_image', $group);
  }
}


/*-------------------------------
* VINEYARDS PREVIEW TITLE AND SUBTITLE
*/

add_action('product-estates_add_form_fields', 'add_vy_preview', 10, 2);
add_action('created_product-estates', 'save_vy_preview', 10, 2);
add_action('product-estates_edit_form_fields', 'edit_vy_preview', 10, 2);
add_action('edited_product-estates', 'change_vy_preview', 10, 2);


function add_vy_preview($taxonomy) {
  ?>
  <div class="form-field term-group">
      <label for=""><?php _e( 'Preview: Title', 'thegrapes' ); ?></label>
      <input type="text" name="vy_title_preview" id="" size="25" style="width:77%;" value="">
  </div>
  <div class="form-field term-group">
      <label for=""><?php _e( 'Preview: Subtitle', 'thegrapes' ); ?></label>
      <input type="text" name="vy_subtitle_preview" id="" size="25" style="width:77%;" value="">
  </div>
  <?php
}


function save_vy_preview($term_id, $tt_id) {
  if (isset($_POST['vy_title_preview']) && '' !== $_POST['vy_title_preview']){
      $group = esc_html($_POST['vy_title_preview']);
      add_term_meta($term_id, 'term_preview_title', $group, true);
  }
  if (isset($_POST['vy_subtitle_preview']) && '' !== $_POST['vy_subtitle_preview']){
      $group = esc_html($_POST['vy_subtitle_preview']);
      add_term_meta($term_id, 'term_preview_subtitle', $group, true);
  }
}

function edit_vy_preview($term, $taxonomy) {
    // get current group
    $preview_title = get_term_meta($term->term_id, 'term_preview_title', true);
    $preview_subtitle = get_term_meta($term->term_id, 'term_preview_subtitle', true);
?>
  <table class="form-table" role="presentation">
    <tbody><tr class="form-field form-required term-name-wrap">

      <tr class="form-field form-required term-name-wrap">
			<th scope="row"><label for="name"><?php _e( 'Preview: Title', 'thegrapes' ); ?></label></th>
			<td>
        <input type="text" name="vy_title_preview" id="vy_title_preview" value="<?php echo $preview_title ?>" style="width: 60%"><br />
        <span class="description"><?php _e( 'This is title for Estate preview', 'thegrapes' ); ?></span>
      </td>
		</tr>
    </tbody>
  </table>
  <table class="form-table" role="presentation">
    <tbody><tr class="form-field form-required term-name-wrap">

      <tr class="form-field form-required term-name-wrap">
			<th scope="row"><label for="name"><?php _e( 'Preview: Subtitle', 'thegrapes' ); ?></label></th>
			<td>
        <input type="text" name="vy_subtitle_preview" id="vy_subtitle_preview" value="<?php echo $preview_subtitle ?>" style="width: 60%"><br />
        <span class="description"><?php _e( 'This is subtitle for Estate preview', 'thegrapes' ); ?></span>
      </td>
		</tr>
    </tbody>
  </table>
<?php
}

function change_vy_preview($term_id, $tt_id) {
  if (isset($_POST['vy_title_preview']) && '' !== $_POST['vy_title_preview']){
      $group = esc_html($_POST['vy_title_preview']);
      update_term_meta($term_id, 'term_preview_title', $group);
  }
  if (isset($_POST['vy_subtitle_preview']) && '' !== $_POST['vy_subtitle_preview']){
      $group = esc_html($_POST['vy_subtitle_preview']);
      update_term_meta($term_id, 'term_preview_subtitle', $group);
  }
}


/*-------------------------------
* CHANGE CHECKOUT FIELDS
*/
add_filter( 'woocommerce_checkout_fields', 'thegrapes_change_checkout_fields', 9999 );
add_filter('woocommerce_default_address_fields', 'reorder_woocommerce_address_fields', 20, 1);

function thegrapes_change_checkout_fields( $checkout_fields ) {
  unset( $checkout_fields['billing']['billing_country'] );
  unset( $checkout_fields['billing']['billing_city'] );
  unset( $checkout_fields['billing']['billing_company'] );
  unset( $checkout_fields['billing']['billing_address_2'] );
  unset( $checkout_fields['shipping']['shipping_country'] );
  unset( $checkout_fields['shipping']['shipping_city'] );
  unset( $checkout_fields['shipping']['shipping_company'] );
  unset( $checkout_fields['shipping']['shipping_address_2'] );

  $checkout_fields['billing']['billing_phone']['priority'] = 25;
  $checkout_fields['billing']['billing_email']['priority'] = 26;

  return $checkout_fields;
}

function reorder_woocommerce_address_fields( $billing_fields) {
  unset( $billing_fields['city'] );

  return $billing_fields;
}


add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );
function custom_override_billing_fields( $fields ) {
  unset($fields['billing_company']);
  unset($fields['billing_address_2']);
  return $fields;
}

function custom_override_shipping_fields( $fields ) {
  unset($fields['shipping_company']);
  unset($fields['shipping_address_2']);
  return $fields;
}



/*-------------------------------
* CHECKOUT DELIVERY FIELDS
*/
add_action( 'woocommerce_after_checkout_billing_form', 'thegrapes_checkout_delivery' );

function thegrapes_checkout_delivery( $checkout ){

	echo '<div class="col-lg-6">';
	woocommerce_form_field( 'deliverydate', array(
		'type'            => 'text', // text, textarea, select, radio, checkbox, password, about custom validation a little later
		'required'        => true, // actually this parameter just adds "*" to the field
		'class'           => array('mb-0', 'form-row'), // array only, read more about classes and styling in the previous step
    'input_class'     => array( 'input-field', 'datepicker-ui'),
    'custom_attributes' => array(
      'required' => 'required'
    ),
		'label'           => 'Delivery date',
		), $checkout->get_value( 'deliverydate' ) );
  echo '<div class="small mb-3">We delivery on the next day, but you can choose another date.</div>';
  echo '</div>';

  echo '<div class="col-lg-6">';

	woocommerce_form_field( 'deliverytime', array(
		'type'            => 'select', // text, textarea, select, radio, checkbox, password, about custom validation a little later
		'required'        => true, // actually this parameter just adds "*" to the field
		'class'           => array('form-row select-wrap'), // array only, read more about classes and styling in the previous step
		'label'           => 'Delivery time',
    'input_class'     => array( 'input-field' ),
    'custom_attributes' => array( 'required' => 'required' ),
    'options' => array(
               '' => __( 'Select delivery time', 'thegrapes' ),
               '10:00 - 12:00'  => __( '10:00 - 12:00', 'thegrapes' ),
               '12:00 - 15:00'  => __( '12:00 - 15:00', 'thegrapes' ),
               '15:00 - 18:00'  => __( '15:00 - 18:00', 'thegrapes' ),
               '18:00 - 21:00'  => __( '18:00 - 21:00', 'thegrapes' ),
           ),
  ), $checkout->get_value( 'deliverytime' ) );

  echo '</div>';

}


// Save custom fields
add_action( 'woocommerce_checkout_update_order_meta', 'thegrapes_update_checkout_fields' );


function thegrapes_update_checkout_fields( $order_id ){

	if( !empty( $_POST['deliverydate'] ) )
		update_post_meta( $order_id, 'deliverydate', sanitize_text_field( $_POST['deliverydate'] ) );

    if( !empty( $_POST['deliverytime'] ) )
		update_post_meta( $order_id, 'deliverytime', sanitize_text_field( $_POST['deliverytime'] ) );

}




/**
 * @snippet       Hide ALL shipping rates in ALL zones when Free Shipping is available
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=260
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.3
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_filter( 'woocommerce_package_rates', 'bbloomer_unset_shipping_when_free_is_available_all_zones', 10, 2 );

function bbloomer_unset_shipping_when_free_is_available_all_zones( $rates, $package ) {

$all_free_rates = array();

foreach ( $rates as $rate_id => $rate ) {
      if ( 'free_shipping' === $rate->method_id ) {
         $all_free_rates[ $rate_id ] = $rate;
         break;
      }
}

if ( empty( $all_free_rates )) {
        return $rates;
} else {
        return $all_free_rates;
}

}


/**
 * @snippet       Set Default Billing Country @ WooCommerce Checkout Page
 * @how-to        Get CustomizeWoo.com FREE
 * @source        https://businessbloomer.com/?p=601
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */


add_filter( 'default_checkout_billing_country', 'bbloomer_change_default_checkout_country' );

function bbloomer_change_default_checkout_country() {
  return 'SG';
}



/*-------------------------------
* PAYMENT GATEAWAY CUSTOM ICONS
*/


add_filter( 'woocommerce_gateway_icon', 'custom_payment_gateway_icons', 10, 2 );
function custom_payment_gateway_icons( $icon, $gateway_id ){

    foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway )
        if( $gateway->id == $gateway_id ){
            $title = $gateway->get_title();
            break;
        }

    // The path (subfolder name(s) in the active theme)
    $path = IMAGES;

    // Setting (or not) a custom icon to the payment IDs
    if( $gateway_id == 'cheque' )
        $icon = '<img class="payment-paynow" src="' . WC_HTTPS::force_https_url( "$path/PayNow.png" ) . '" alt="' . esc_attr( $title ) . '" />';

    return $icon;
}

/*-------------------------------
* MAKE STRIPE DEFAULT PAYMENT GATAWAY
*/

add_action( 'template_redirect', 'define_default_payment_gateway' );
function define_default_payment_gateway(){
    if( is_checkout() && ! is_wc_endpoint_url() ) {
        // HERE define the default payment gateway ID
        $default_payment_id = 'stripe_cc';

        WC()->session->set( 'chosen_payment_method', $default_payment_id );
    }
}

/*-------------------------------
* ADD META KEY TO EMAILS
*/

add_filter('woocommerce_email_order_meta_keys', 'my_custom_checkout_field_order_meta_keys');
function my_custom_checkout_field_order_meta_keys( $keys ) {
    $keys[] = 'deliverydate';
    $keys[] = 'deliverytime';
    return $keys;
}


/**
 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

///////////////////////////////
// 1. ADD FIELDS

add_action( 'woocommerce_register_form_start', 'thegrapes_add_name_woo_account_registration' );

function thegrapes_add_name_woo_account_registration() {
    ?>
  <div class="col-lg-6">
    <div class="input-group">
      <label for="reg_billing_first_name"><?php _e( 'First name', 'thegrapes' ); ?> <span class="required">*</span></label>
      <input type="text" class="input-text input-field" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </div>
  </div>
  <div class="col-lg-6">
    <div class="input-group">
      <label for="reg_billing_last_name"><?php _e( 'Last name', 'thegrapes' ); ?> <span class="required">*</span></label>
      <input type="text" class="input-text input-field" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </div>
  </div>

    <?php
}

///////////////////////////////
// 2. VALIDATE FIELDS

add_filter( 'woocommerce_registration_errors', 'thegrapes_validate_name_fields', 10, 3 );

function thegrapes_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'thegrapes' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'thegrapes' ) );
    }
    return $errors;
}

///////////////////////////////
// 3. SAVE FIELDS

add_action( 'woocommerce_created_customer', 'thegrapes_save_name_fields' );

function thegrapes_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }

}


/**
 * @snippet       Merge Two "My Account" Tabs @ WooCommerce Account
 * @how-to        Get CustomizeWoo.com FREE
 * @source        https://businessbloomer.com/?p=73601
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.3
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

// -------------------------------
// 1. First, hide the tab that needs to be merged/moved (edit-address in this case)

add_filter( 'woocommerce_account_menu_items', 'thegrapes_edit_account_menu_items', 999 );

function thegrapes_edit_account_menu_items( $items ) {
unset($items['edit-address']);
unset($items['payment-methods']);
$items['edit-account'] = __( 'Settings', 'thegrapes' );
$items['dashboard'] = __( 'Membership', 'thegrapes' );
return $items;
}

// -------------------------------
// 2. Second, print the ex tab content into an existing tab (edit-account in this case)

add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address' );
add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_payment_methods' );


/*
 * Change the entry title of the endpoints that appear in My Account Page - WooCommerce 2.6
 * Using the_title filter
 */

function wpb_woo_endpoint_title( $title, $id ) {
	if ( is_wc_endpoint_url( 'edit-account' ) && in_the_loop() ) {
		$title = "Account settings";
	}
	return $title;
}
add_filter( 'the_title', 'wpb_woo_endpoint_title', 10, 2 );


/*-------------------------------
* REDIRECT USER BACK TO EDIT ACCOUNT AFTER EDIT ACCOUNT
*/


function action_woocommerce_customer_save_account( $user_id ) {
       wp_safe_redirect(esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . 'edit-account');
       exit;
};
add_action( 'woocommerce_save_account_details', 'action_woocommerce_customer_save_account', 99, 2 );


/*-------------------------------
* RENAME SHIPPING TO DELIVERY
*/

add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Delivery:';
}



/*-------------------------------
* RENAME ACTIONS TO ORDER DETAILS
*/

function filter_woocommerce_account_orders_columns( $columns ) {

    $columns['order-actions'] = __( 'Order details', 'woocommerce' );

    return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'filter_woocommerce_account_orders_columns', 10, 1 );



/**
 * Notify admin when a new customer account is created
 */
add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );
function woocommerce_created_customer_admin_notification( $customer_id ) {
  wp_send_new_user_notifications( $customer_id, 'admin' );
}

add_filter( 'wp_new_user_notification_email_admin', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
    $name = $_POST['billing_first_name'];

    $surname = $_POST['billing_last_name'];

    if( !( $name || $surname ) ) {
      $name = $user->user_login;
      $surname = '';
    } else {
      $name = $name . ' ' . $surname;
    }

    $register_source = $_POST['register_source'];

    $wp_new_user_notification_email['subject'] = sprintf( '%s has just become a member.', $name );
    $wp_new_user_notification_email['message'] = sprintf( "%s ( %s ) has become a member of The Grapes family. The registration was made on %s.", $name, $user->user_email, $register_source);
    return $wp_new_user_notification_email;
}


/**
 * Always show price even for single variation
 */
add_filter( 'woocommerce_show_variation_price', '__return_true' );
