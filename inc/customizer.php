<?php
/**
 * The Grapes Theme Customizer
 *
 * @package thegrapes
 */

function thegrapes_customizer( $wp_customize ) {

  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // SITE IDENTITY
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  /*------------------------------------*/
  // LAODING LOGO

  $wp_customize->add_setting(
    'set_loading_logo', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_loading_logo', array(
    'label' => __( 'Logo on Loading Screen', 'thegrapes' ),
    'section' => 'title_tagline',
    'mime_type' => 'image'
  ) ) );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // HEADER
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // HEADER SECTION

  $wp_customize->add_section(
    'sec_header', array(
      'title'           => 'Header',
      'description'     => 'Header Settings',
      'priority' => 130,
    )
  );

  // HEADER -> DESKTOP LOGO

  $wp_customize->add_setting(
    'set_header_logo', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_header_logo', array(
    'label' => __( 'Desktop Logo in the Header', 'thegrapes' ),
    'section' => 'sec_header',
    'mime_type' => 'image'
  ) ) );

  // HEADER -> MOBILE LOGO

  $wp_customize->add_setting(
    'set_header_mobile_logo', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_header_mobile_logo', array(
    'label' => __( 'Mobile Logo in the Header', 'thegrapes' ),
    'section' => 'sec_header',
    'mime_type' => 'image'
  ) ) );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // SOCIALS
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/


  $wp_customize->add_section(
    'sec_socials', array(
      'title'           => 'Socials',
      'description'     => 'socials Settings',
      'priority' => 130,
    )
  );

  $socials = array(
    'instagram',
    'facebook',
    'youtube',
    'whatsapp'
  );

  foreach ($socials as $social) {

    $wp_customize->add_setting(
      'set_social_' . $social, array(
        'type'               => 'theme_mod',
        'default'             => '',
        'sanitize_callback'   => 'esc_url_raw'
      )
    );
    $wp_customize->add_control(
      'set_social_' . $social, array(
        'label'         => 'URL for ' . $social,
        'description'   => 'URL for ' . $social,
        'section'       => 'sec_socials',
        'type'          => 'url'
      )
    );
  }


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // HOME PAGE
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // HOMEPAGE PANEL

  $wp_customize->add_panel( 'panel_page_home', array(
    'title' => __( 'Page: Home', 'thegrapes' ),
    'priority' => 140,
    'description' => __( 'Home page settings', 'thegrapes' ), // Include html tags such as <p>.
  ) );

  /*------------------------------------*/
  // HOMEPAGE -> MAIN SECTION

  $wp_customize->add_section(
    'sec_home_main', array(
      'title'           => __( 'Main Section', 'thegrapes' ),
      'description'     => __( 'Main section settings', 'thegrapes' ),
      'panel'           => 'panel_page_home'
    )
  );

  // HOMEPAGE -> MAIN -> TITLE
  $wp_customize->add_setting(
    'set_home_main_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_home_main_title', array(
      'label'         => __( 'Main Section: Title', 'thegrapes' ),
      'description'   => __( 'Main header in the main section.', 'thegrapes' ),
      'section'       => 'sec_home_main',
      'type'          => 'text'
    )
  );

  // HOMEPAGE -> MAIN -> DESCRIPTION
  $wp_customize->add_setting(
    'set_home_main_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_home_main_desc', array(
      'type' => 'textarea',
      'section' => 'sec_home_main',
      'label' => __( 'Main Section: Description', 'thegrapes' ),
      'description' => __( 'Main description in the main section.', 'thegrapes' ),
    )
  );

  // HOMEPAGE -> MAIN -> BOTTLE IMAGE
  $wp_customize->add_setting(
    'set_home_main_bottle', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_home_main_bottle', array(
    'label' => __( 'Main Section: Bottle Image', 'thegrapes' ),
    'section' => 'sec_home_main',
    'description' => __( 'Prepare padding around image. Download and use current image as example. Image maximum height - 650px.', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

  // HOMEPAGE -> MAIN -> BOTTLE LINK
  $wp_customize->add_setting(
    'set_home_main_bottle_link', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(
    'set_home_main_bottle_link', array(
      'label'         => 'Link for bottle image',
      'description'   => 'Link to the product',
      'section'       => 'sec_home_main',
      'type'          => 'url'
    )
  );

  // HOMEPAGE -> MAIN -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_home_main_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_home_main_img', array(
    'label' => __( 'Main Section: Background Image', 'thegrapes' ),
    'section' => 'sec_home_main',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

  // HOMEPAGE -> MAIN -> LOGO
  $wp_customize->add_setting(
    'set_home_main_logo', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_home_main_logo', array(
    'label' => __( 'Main Section: Logo', 'thegrapes' ),
    'section' => 'sec_home_main',
    'description' => __( 'Upload PNG logo with maximum height 300px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

  /*------------------------------------*/
  // HOMEPAGE -> FEATURED PRODUCTS SECTION

  $wp_customize->add_section(
    'sec_home_featured', array(
      'title'           => __( 'Featured Wines & Bundles', 'thegrapes' ),
      'description'     => __( 'Featured Wines & Bundles section settings', 'thegrapes' ),
      'panel'           => 'panel_page_home'
    )
  );

  // HOMEPAGE -> FEATURED PRODUCTS -> WINES TITLE
  $wp_customize->add_setting(
    'set_home_featured_wines_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_home_featured_wines_title', array(
      'label'         => __( 'Featured wines title', 'thegrapes' ),
      'description'   => __( 'Title for the featured wines.', 'thegrapes' ),
      'section'       => 'sec_home_featured',
      'type'          => 'text',
      'input_attrs'   => array(
        'style'       => 'margin-bottom: 24px;',
      ),
    )
  );

  // HOMEPAGE -> FEATURED PRODUCTS -> BUNDLES TITLE
  $wp_customize->add_setting(
    'set_home_featured_bundles_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_home_featured_bundles_title', array(
      'label'         => __( 'Featured bundles title', 'thegrapes' ),
      'description'   => __( 'Title for the featured bundles.', 'thegrapes' ),
      'section'       => 'sec_home_featured',
      'type'          => 'text',
      'input_attrs'   => array(
        'style'       => 'margin-bottom: 24px;',
      ),
    )
  );


  /*------------------------------------*/
  // HOMEPAGE -> WINE & VINEYARDS SECTION

  $wp_customize->add_section(
    'sec_home_wine', array(
      'title'           => __( 'Wine & Estates Section', 'thegrapes' ),
      'description'     => __( 'Wine & Estates section settings', 'thegrapes' ),
      'panel'           => 'panel_page_home'
    )
  );

  // HOMEPAGE -> WINE & VINEYARDS -> TITLE
  $wp_customize->add_setting(
    'set_home_wine_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_home_wine_title', array(
      'label'         => __( 'Section Title', 'thegrapes' ),
      'description'   => __( 'Title in the wine & estates section.', 'thegrapes' ),
      'section'       => 'sec_home_wine',
      'type'          => 'text',
      'input_attrs'   => array(
        'style'       => 'margin-bottom: 24px;',
      ),
    )
  );

  // HOMEPAGE -> WINE & VINEYARDS -> BLOCKS

  for ($i=1; $i <= 5; $i++) {
    // HOMEPAGE -> WINE & VINEYARDS -> BLOCK: TEXT
    $wp_customize->add_setting(
      'set_home_wine_block_title_' . $i, array(
        'type'               => 'theme_mod',
        'default'             => '',
        'sanitize_callback'   => 'sanitize_text_field'
      )
    );

    $wp_customize->add_control(
      'set_home_wine_block_title_' . $i, array(
        'label'         => __( 'Image block ' . $i . ': Title', 'thegrapes' ),
        'section'       => 'sec_home_wine',
        'type'          => 'text'
      )
    );

    // HOMEPAGE -> WINE & VINEYARDS -> BLOCK: LINK
    $wp_customize->add_setting(
      'set_home_wine_block_url_' . $i, array(
        'type'               => 'theme_mod',
        'default'             => '',
        'sanitize_callback'   => 'esc_url_raw'
      )
    );
    $wp_customize->add_control(
      // the same name as for settings
      'set_home_wine_block_url_' . $i, array(
        'label'         => __( 'Image block ' . $i . ': Link', 'thegrapes' ),
        'section'       => 'sec_home_wine',
        'type'          => 'url'
      )
    );

    // HOMEPAGE -> WINE & VINEYARDS -> BLOCK: LINK TARGET
    $wp_customize->add_setting(
      'set_home_wine_block_url_new_window_' . $i, array(
        'default' => '',
      )
    );

    $wp_customize->add_control(
      'set_home_wine_block_url_new_window_' . $i, array(
        'label' => 'Open link in a new tab?',
        'type'  => 'checkbox',
        'section' => 'sec_home_wine'
      )
    );

    // HOMEPAGE -> WINE & VINEYARDS -> BLOCK: IMAGE
    $wp_customize->add_setting(
      'set_home_wine_block_img_' . $i, array(
        'type'               => 'theme_mod',
        'default'             => '',
        'sanitize_callback'   => 'absint',
      )
    );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_home_wine_block_img_' . $i, array(
      'label' => __( 'Image block ' . $i . ': Image', 'thegrapes' ),
      'section' => 'sec_home_wine',
      'description' => __( 'Upload image with max width 640px and max height 200px', 'thegrapes' ),
      'mime_type' => 'image',
      'input_attrs'   => array(
        'style'       => 'margin-bottom: 24px;',
      ),
    ) ) );
  }


  /*------------------------------------*/
  // HOMEPAGE -> EDUTAINMENT SECTION

  $wp_customize->add_section(
    'sec_home_edu', array(
      'title'           => __( 'Edutainment Section', 'thegrapes' ),
      'description'     => __( 'Edutainment section settings', 'thegrapes' ),
      'panel'           => 'panel_page_home'
    )
  );

  // HOMEPAGE -> EDUTAINMENT -> DISPLAY
  $wp_customize->add_setting(
    'set_home_edu_display', array(
      'default' => 0,
    )
  );

  $wp_customize->add_control(
    'set_home_edu_display', array(
      'label' => 'Show Edutainment on home page?',
      'type'  => 'checkbox',
      'section' => 'sec_home_edu'
    )
  );

  // HOMEPAGE -> EDUTAINMENT -> TITLE
  $wp_customize->add_setting(
    'set_home_edu_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_home_edu_title', array(
      'label'         => __( 'Title', 'thegrapes' ),
      'description'   => __( 'Title in the edutainment section.', 'thegrapes' ),
      'section'       => 'sec_home_edu',
      'type'          => 'text'
    )
  );

  // HOMEPAGE -> EDUTAINMENT -> DESCRIPTION
  $wp_customize->add_setting(
    'set_home_edu_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_home_edu_desc', array(
      'type' => 'textarea',
      'section' => 'sec_home_edu',
      'label' => __( 'Description', 'thegrapes' ),
      'description' => __( 'Description in the edutainment section.', 'thegrapes' ),
    )
  );

  // HOMEPAGE -> EDUTAINMENT -> AMOUNT TO DISPLAY

  $wp_customize->add_setting(
    'set_home_edu_amount', array(
      'type'              => 'theme_mod',
      'sanitize_callback' => 'themeslug_sanitize_number_absint',
      'default'           => 6,
    )
  );

  $wp_customize->add_control(
    'set_home_edu_amount', array(
      'type' => 'number',
      'section' => 'sec_home_edu', // Add a default or your own section
      'label' => __( 'Amount of preview posts', 'thegrapes' ),
      'description' => __( 'Set 3, 6 or 9 for better design.', 'thegrapes' ),
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // SHOP
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // SHOP SECTION

  $wp_customize->add_section(
    'sec_shop', array(
      'title'           => 'Page: Shop',
      'description'     => 'Shop Page Settings',
      'priority' => 150
    )
  );

  // SHOP -> TITLE
  $wp_customize->add_setting(
    'set_shop_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_shop_title', array(
      'label'         => __( 'Shop: Title', 'thegrapes' ),
      'description'   => __( 'Main header on the shop page.', 'thegrapes' ),
      'section'       => 'sec_shop',
      'type'          => 'text'
    )
  );

  // SHOP -> DESCRIPTION
  $wp_customize->add_setting(
    'set_shop_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_shop_desc', array(
      'type' => 'textarea',
      'section' => 'sec_shop',
      'label' => __( 'Shop: Description', 'thegrapes' ),
      'description' => __( 'Main description on the shop page.', 'thegrapes' ),
    )
  );

  // SHOP -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_shop_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_shop_img', array(
    'label' => __( 'Shop: Background Image', 'thegrapes' ),
    'section' => 'sec_shop',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

  // SHOP -> POINTS TEXT
  $wp_customize->add_setting(
    'set_shop_points_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_shop_points_text', array(
      'label'         => 'Points hover text',
      'description'   => 'Text appear on tooltip while hovering over points',
      'section'       => 'sec_shop',
      'type'          => 'text'
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // PRODUCT
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // PRODUCT SECTION

  $wp_customize->add_section(
    'sec_product', array(
      'title'           => 'Page: Product',
      'description'     => 'Product Page Settings',
      'priority' => 150
    )
  );

  // PRODUCT -> RELATED TITLE
  $wp_customize->add_setting(
    'set_product_related_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_product_related_title', array(
      'label'         => __( 'Related products: Header', 'thegrapes' ),
      'description'   => __( 'Header for related products section.', 'thegrapes' ),
      'section'       => 'sec_product',
      'type'          => 'text'
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // BUNDLES
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // BUNDLES SECTION

  $wp_customize->add_section(
    'sec_bundles', array(
      'title'           => 'Page: Bundles',
      'description'     => 'Bundles Page Settings',
      'priority' => 150
    )
  );

  // BUNDLES -> TITLE
  $wp_customize->add_setting(
    'set_bundles_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_bundles_title', array(
      'label'         => __( 'Bundles: Title', 'thegrapes' ),
      'description'   => __( 'Main header on the bundles page.', 'thegrapes' ),
      'section'       => 'sec_bundles',
      'type'          => 'text'
    )
  );

  // BUNDLES -> DESCRIPTION
  $wp_customize->add_setting(
    'set_bundles_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_bundles_desc', array(
      'type' => 'textarea',
      'section' => 'sec_bundles',
      'label' => __( 'Bundles: Description', 'thegrapes' ),
      'description' => __( 'Main description on the bundles page.', 'thegrapes' ),
    )
  );

  // BUNDLES -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_bundles_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_bundles_img', array(
    'label' => __( 'Bundles: Background Image', 'thegrapes' ),
    'section' => 'sec_bundles',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // OCCASIONS
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // OCCASIONS SECTION

  $wp_customize->add_section(
    'sec_occasions', array(
      'title'           => 'Page: Occasions',
      'description'     => 'Occasions Page Settings',
      'priority' => 150
    )
  );

  // OCCASIONS -> TITLE
  $wp_customize->add_setting(
    'set_occasions_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_occasions_title', array(
      'label'         => __( 'Occasions: Title', 'thegrapes' ),
      'description'   => __( 'Main header on the occasions page.', 'thegrapes' ),
      'section'       => 'sec_occasions',
      'type'          => 'text'
    )
  );

  // OCCASIONS -> DESCRIPTION
  $wp_customize->add_setting(
    'set_occasions_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_occasions_desc', array(
      'type' => 'textarea',
      'section' => 'sec_occasions',
      'label' => __( 'Occasions: Description', 'thegrapes' ),
      'description' => __( 'Main description on the occasions page.', 'thegrapes' ),
    )
  );

  // OCCASIONS -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_occasions_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_occasions_img', array(
    'label' => __( 'Occasions: Background Image', 'thegrapes' ),
    'section' => 'sec_occasions',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // GRAPES
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // GRAPES SECTION

  $wp_customize->add_section(
    'sec_grapes', array(
      'title'           => 'Page: Grapes',
      'description'     => 'Grapes Page Settings',
      'priority' => 150
    )
  );

  // GRAPES -> TITLE
  $wp_customize->add_setting(
    'set_grapes_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_grapes_title', array(
      'label'         => __( 'Grapes: Title', 'thegrapes' ),
      'description'   => __( 'Main header on the grapes page.', 'thegrapes' ),
      'section'       => 'sec_grapes',
      'type'          => 'text'
    )
  );

  // GRAPES -> DESCRIPTION
  $wp_customize->add_setting(
    'set_grapes_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_grapes_desc', array(
      'type' => 'textarea',
      'section' => 'sec_grapes',
      'label' => __( 'Grapes: Description', 'thegrapes' ),
      'description' => __( 'Main description on the grapes page.', 'thegrapes' ),
    )
  );

  // GRAPES -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_grapes_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_grapes_img', array(
    'label' => __( 'Grapes: Background Image', 'thegrapes' ),
    'section' => 'sec_grapes',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // EDUTAINMENT
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // EDUTAINMENT PANEL

  $wp_customize->add_panel( 'panel_page_edu', array(
    'title' => __( 'Page: Edutainment', 'thegrapes' ),
    'priority' => 160,
    'description' => __( 'Edutainment page settings', 'thegrapes' ), // Include html tags such as <p>.
  ) );

  /*------------------------------------*/
  // EDUTAINMENT -> HEADER SECTION

  $wp_customize->add_section(
    'sec_edu_header', array(
      'title'           => __( 'Header', 'thegrapes' ),
      'description'     => __( 'Header section settings', 'thegrapes' ),
      'panel'           => 'panel_page_edu'
    )
  );

  // EDUTAINMENT -> DESCRIPTION
  $wp_customize->add_setting(
    'set_edu_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_edu_desc', array(
      'type' => 'textarea',
      'section' => 'sec_edu_header',
      'label' => __( 'Header Description', 'thegrapes' ),
      'description' => __( 'Main description on the Edutainment page.', 'thegrapes' ),
    )
  );

  // EDUTAINMENT -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_edu_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_edu_img', array(
    'label' => __( 'Header Background Image', 'thegrapes' ),
    'section' => 'sec_edu_header',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

  /*------------------------------------*/
  // EDUTAINMENT -> RELATED POSTS

  $wp_customize->add_section(
    'sec_edu_related', array(
      'title'           => __( 'Related posts', 'thegrapes' ),
      'description'     => __( 'Related posts settings', 'thegrapes' ),
      'panel'           => 'panel_page_edu'
    )
  );

  // EDUTAINMENT -> RELATED POSTS -> TITLE
  $wp_customize->add_setting(
    'set_edu_related_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_edu_related_title', array(
      'label'         => __( 'Title', 'thegrapes' ),
      'description'   => __( 'Title for related posts.', 'thegrapes' ),
      'section'       => 'sec_edu_related',
      'type'          => 'text'
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // CART
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // CART SECTION

  $wp_customize->add_section(
    'sec_cart', array(
      'title'           => 'Cart',
      'description'     => 'Cart Page Settings'
    )
  );

  // CART -> INFO -> DELIVERY -> TITLE
  $wp_customize->add_setting(
    'set_cart_info_delivery_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_delivery_title', array(
      'label'         => 'Delivery information: General Title',
      'description'   => 'Ex. "Delivery"',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> DELIVERY -> ICON TITLE
  $wp_customize->add_setting(
    'set_cart_info_delivery_icon_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_delivery_icon_title', array(
      'label'         => 'Delivery information: Icon Title',
      'description'   => 'Ex "Delivery days"',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> DELIVERY -> ICON TEXT
  $wp_customize->add_setting(
    'set_cart_info_delivery_icon_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_delivery_icon_text', array(
      'label'         => 'Delivery information: Icon Text',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> DELIVERY -> ADD TEXT
  $wp_customize->add_setting(
    'set_cart_info_delivery_add_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_delivery_add_text', array(
      'label'         => 'Delivery information: Additional Text',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> SHIPPING-> TITLE
  $wp_customize->add_setting(
    'set_cart_info_shipping_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_shipping_title', array(
      'label'         => 'Shipping information: General Title',
      'description'   => 'Ex. "shipping fees"',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> SHIPPINH -> ICON TITLE
  $wp_customize->add_setting(
    'set_cart_info_shipping_icon_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_shipping_icon_title', array(
      'label'         => 'Shipping information: Icon Title',
      'description'   => 'You can leave this field empty to disable title',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> SHIPPING -> ICON TEXT
  $wp_customize->add_setting(
    'set_cart_info_shipping_icon_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_shipping_icon_text', array(
      'label'         => 'Shipping information: Icon Text',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );

  // CART -> INFO -> SHIPPING -> ADD TEXT
  $wp_customize->add_setting(
    'set_cart_info_shipping_add_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_cart_info_shipping_add_text', array(
      'label'         => 'Shipping information: Additional Text',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_cart',
      'type'          => 'text'
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // MINICART
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // MINICART SECTION

  $wp_customize->add_section(
    'sec_minicart', array(
      'title'           => 'Minicart',
      'description'     => 'Minicart Settings'
    )
  );

  // MINICART -> NOTICE TEXT
  $wp_customize->add_setting(
    'set_minicart_notice', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_minicart_notice', array(
      'label'         => 'Minicart notification message',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_minicart',
      'type'          => 'text'
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // FOOTER
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/



  // FOOTER PANEL

  $wp_customize->add_panel( 'panel_footer', array(
    'title' => __( 'Footer', 'thegrapes' ),
    'priority' => 170,
    'description' => __( 'Footer settings', 'thegrapes' ), // Include html tags such as <p>.
  ) );


  /*------------------------------------*/
  // FOOTER -> LOGO SECTION

  /*$wp_customize->add_section(
    'sec_footer_logo', array(
      'title'           => 'Logo',
      'description'     => 'Footer logo settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER LOGO - DESKTOP

  $wp_customize->add_setting(
    'set_footer_logo_desc', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_footer_logo_desc', array(
    'label' => __( 'Desktop logo in footer', 'thegrapes' ),
    'section' => 'sec_footer_logo',
    'mime_type' => 'image'
  ) ) );

  // FOOTER LOGO - MOBILE

  $wp_customize->add_setting(
    'set_footer_logo_mobile', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_footer_logo_mobile', array(
    'label' => __( 'Mobile logo in footer', 'thegrapes' ),
    'section' => 'sec_footer_logo',
    'mime_type' => 'image'
  ) ) );
  */

  /*------------------------------------*/
  // FOOTER -> CONTACTS SECTION

  $wp_customize->add_section(
    'sec_footer_contacts', array(
      'title'           => 'Contacts',
      'description'     => 'Footer contacts settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER -> CONTACT -> TITLE
  $wp_customize->add_setting(
    'set_footer_contact_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_contact_title', array(
      'label'         => __( 'Contacts Title:', 'thegrapes' ),
      'section'       => 'sec_footer_contacts',
      'type'          => 'text'
    )
  );

  // FOOTER -> CONTACT -> PHONE
  $wp_customize->add_setting(
    'set_footer_contact_phone', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_contact_phone', array(
      'label'         => __( 'Phone number:', 'thegrapes' ),
      'section'       => 'sec_footer_contacts',
      'type'          => 'text'
    )
  );

  // FOOTER -> CONTACT -> EMAIL
  $wp_customize->add_setting(
    'set_footer_contact_email', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_contact_email', array(
      'label'         => __( 'Email:', 'thegrapes' ),
      'section'       => 'sec_footer_contacts',
      'type'          => 'text'
    )
  );
  // FOOTER -> CONTACT -> ADDRESS
  $wp_customize->add_setting(
    'set_footer_contact_address', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_contact_address', array(
      'label'         => __( 'Address:', 'thegrapes' ),
      'section'       => 'sec_footer_contacts',
      'type'          => 'text'
    )
  );

  /*------------------------------------*/
  // FOOTER -> LINKS SECTION

  $wp_customize->add_section(
    'sec_footer_links', array(
      'title'           => 'Links',
      'description'     => 'Footer links settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER -> LINKS -> TITLE
  $wp_customize->add_setting(
    'set_footer_links_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_links_title', array(
      'label'         => __( 'Links Title:', 'thegrapes' ),
      'section'       => 'sec_footer_links',
      'type'          => 'text'
    )
  );

  /*------------------------------------*/
  // FOOTER -> SUBSCRIPTION SECTION

  $wp_customize->add_section(
    'sec_footer_subscription', array(
      'title'           => 'Subscription',
      'description'     => 'Footer Subscription settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER -> SUBSCRIPTION -> TITLE
  $wp_customize->add_setting(
    'set_footer_subscription_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_subscription_title', array(
      'label'         => __( 'Subscription Title:', 'thegrapes' ),
      'section'       => 'sec_footer_subscription',
      'type'          => 'text'
    )
  );

  // FOOTER -> SUBSCRIPTION -> TEXT
  $wp_customize->add_setting(
    'set_footer_subscription_text', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_footer_subscription_text', array(
      'type' => 'textarea',
      'section' => 'sec_footer_subscription',
      'label' => __( 'Subscription text in footer', 'thegrapes' ),
    )
  );


  /*------------------------------------*/
  // FOOTER -> LEGAL SECTION

  $wp_customize->add_section(
    'sec_footer_legal', array(
      'title'           => 'Legal text',
      'description'     => 'Footer legal text settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER -> LEGAL -> TITLE
  $wp_customize->add_setting(
    'set_footer_legal_title', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_legal_title', array(
      'label'         => __( 'Legal Title:', 'thegrapes' ),
      'section'       => 'sec_footer_legal',
      'type'          => 'text'
    )
  );

  // FOOTER -> LEGAL -> TEXT
  $wp_customize->add_setting(
    'set_footer_legal_text', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_footer_legal_text', array(
      'type' => 'textarea',
      'section' => 'sec_footer_legal',
      'label' => __( 'Legal text in footer', 'thegrapes' ),
    )
  );

  /*------------------------------------*/
  // FOOTER -> COPYRIGHT

  $wp_customize->add_section(
    'sec_footer_copyright', array(
      'title'           => 'Copyright',
      'description'     => 'Footer copyright settings',
      'panel'           => 'panel_footer'
    )
  );

  // FOOTER -> COPYRIGHT -> TEXT
  $wp_customize->add_setting(
    'set_footer_copyright_text', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_footer_copyright_text', array(
      'label'         => __( 'Copyright text:', 'thegrapes' ),
      'section'       => 'sec_footer_copyright',
      'type'          => 'text'
    )
  );

  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // SECURE CHECKOUT
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // SECURE CHECKOUT SECTION

  $wp_customize->add_section(
    'sec_secure_checkout', array(
      'title'           => 'Secure Checkout',
      'description'     => 'Secure Checkout Settings',
      'priority' => 130,
    )
  );

  // SECURE CHECKOUT -> IMAGE

  $wp_customize->add_setting(
    'set_secure_checkout_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_secure_checkout_img', array(
    'label' => __( 'Image for Secure Checkout', 'thegrapes' ),
    'section' => 'sec_secure_checkout',
    'mime_type' => 'image'
  ) ) );

  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // PRICE COLORS
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // PRICE SECTION

  $wp_customize->add_section(
    'sec_price', array(
      'title'           => 'Prices Settings',
      'description'     => 'Prices Settings',
      'priority' => 135,
    )
  );

  // PRICE -> COLORS

  // PRICE -> COLORS -> REGULAR PRICE
   $wp_customize->add_setting( 'set_price_regular_color', array(
       'default' => '#121212',
   ));

   $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'set_price_regular_color', array(
       'label' => 'Price Color: Regular',
       'section' => 'sec_price',
       'settings' => 'set_price_regular_color'
   )));

   // PRICE -> COLORS -> DISCOUNT PRICE
    $wp_customize->add_setting( 'set_price_discount_color', array(
        'default' => '#717171',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'set_price_discount_color', array(
        'label' => 'Price Color: Regular',
        'section' => 'sec_price',
        'settings' => 'set_price_discount_color'
    )));



  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // MEMBERSHIP
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // MEMBERSHIP PANEL

  $wp_customize->add_panel( 'panel_page_membership', array(
    'title' => __( 'Page: Membership', 'thegrapes' ),
    'priority' => 160,
    'description' => __( 'Membership page settings', 'thegrapes' ), // Include html tags such as <p>.
  ) );

  /*------------------------------------*/
  // MEMBERSHIP -> HEADER SECTION

  $wp_customize->add_section(
    'sec_member_header', array(
      'title'           => __( 'Header', 'thegrapes' ),
      'description'     => __( 'Header section settings', 'thegrapes' ),
      'panel'           => 'panel_page_membership'
    )
  );

  // MEMBERSHIP -> HEADER -> DESCRIPTION
  $wp_customize->add_setting(
    'set_member_header_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_member_header_desc', array(
      'type' => 'textarea',
      'section' => 'sec_member_header',
      'label' => __( 'Header: Description', 'thegrapes' ),
      'description' => __( 'Main description in the header section.', 'thegrapes' ),
    )
  );

  // MEMBERSHIP -> HEADER -> IMAGE
  $wp_customize->add_setting(
    'set_member_header_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_member_header_img', array(
    'label' => __( 'Header: Image', 'thegrapes' ),
    'section' => 'sec_member_header',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );


  /*------------------------------------*/
  // MEMBERSHIP -> BENEFITS SECTION

  $wp_customize->add_section(
    'sec_member_benefits', array(
      'title'           => __( 'Benefits', 'thegrapes' ),
      'description'     => __( 'Benefits section settings', 'thegrapes' ),
      'panel'           => 'panel_page_membership'
    )
  );

  // MEMBERSHIP -> BENEFITS
  for ($i=1; $i <= 5; $i++) {


    // MEMBERSHIP -> BENEFITS -> ICON
    $wp_customize->add_setting(
      'set_member_benefits_icon_' . $i, array(
        'type'               => 'theme_mod',
        'default'             => '',
        'sanitize_callback'   => 'absint',
      )
    );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_member_benefits_icon_' . $i, array(
      'label' => __( 'Benifit ' . $i . ': Icon', 'thegrapes' ),
      'section' => 'sec_member_benefits',
      'description' => __( 'Upload PNG icon with max size 64x64 px.', 'thegrapes' ),
      'mime_type' => 'image'
    ) ) );

    // MEMBERSHIP -> BENEFITS -> TEXT
    $wp_customize->add_setting(
      'set_member_benefits_text_' . $i, array(
        'type'              => 'theme_mod',
        'default'           => '',
        'sanitize_callback'   => 'wp_kses_post'
      )
    );

    $wp_customize->add_control(
      'set_member_benefits_text_' . $i, array(
        'type' => 'textarea',
        'section' => 'sec_member_benefits',
        'label' => __( 'Benifit ' . $i . ': Text', 'thegrapes' ),
        'input_attrs'   => array(
          'style'       => 'margin-bottom: 24px;',
        ),
        'description' => __( 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.', 'thegrapes' )
      )
    );
  }

  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // CHECKOUT
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // CHECKOUT SECTION

  $wp_customize->add_section(
    'sec_checkout', array(
      'title'           => 'Checkout',
      'description'     => 'Checkout Settings'
    )
  );

  // CHECKOUT -> PAYNOW -> CODE
  $wp_customize->add_setting(
    'set_checkout_paynow_code', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'set_checkout_paynow_code', array(
      'label'         => __( 'PayNow code:', 'thegrapes' ),
      'section'       => 'sec_checkout',
      'type'          => 'text'
    )
  );

  // CHECKOUT -> PAYNOW -> NOTIFICATION
  $wp_customize->add_setting(
    'set_checkout_paynow_notify', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'wp_kses_post'
    )
  );

  $wp_customize->add_control(
    'set_checkout_paynow_notify', array(
      'label'         => 'PayNow notification text',
      'description'   => 'Use &#60;strong&#62;<strong>bold</strong>&#60;/strong&#62; or &#60;u&#62;<u>underline</u>&#60;/u&#62; to highlight.',
      'section'       => 'sec_checkout',
      'type' => 'textarea',
    )
  );


  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/
  // FAQ
  /*---------------------------------------------------------------------*/
  /*---------------------------------------------------------------------*/

  // FAQ SECTION

  $wp_customize->add_section(
    'sec_faq', array(
      'title'           => 'Page: FAQ',
      'description'     => 'FAQ Page Settings',
      'priority' => 150
    )
  );


  // FAQ -> DESCRIPTION
  $wp_customize->add_setting(
    'set_faq_header_desc', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    )
  );

  $wp_customize->add_control(
    'set_faq_header_desc', array(
      'type' => 'textarea',
      'section' => 'sec_faq',
      'label' => __( 'Header: Description', 'thegrapes' ),
      'description' => __( 'Main description on the FAQ page.', 'thegrapes' ),
    )
  );

  // FAQ -> BACKGROUND IMAGE
  $wp_customize->add_setting(
    'set_faq_header_img', array(
      'type'               => 'theme_mod',
      'default'             => '',
      'sanitize_callback'   => 'absint',
    )
  );

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'set_faq_header_img', array(
    'label' => __( 'Header: Background Image', 'thegrapes' ),
    'section' => 'sec_faq',
    'description' => __( 'Upload masked image with maximum height 600px', 'thegrapes' ),
    'mime_type' => 'image'
  ) ) );

// END OF thegrapes_customizer
}
// END OF thegrapes_customizer

add_action( 'customize_register', 'thegrapes_customizer' );

//checkbox sanitization function
function theme_slug_sanitize_checkbox( $input ){

    //returns true if checkbox is checked
    return ( isset( $input ) ? true : false );
}

function themeslug_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}
