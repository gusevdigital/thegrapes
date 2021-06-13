<?php
/*
# ===================================================
# template-home.php
#
# Template name: Home
# ===================================================
*/

get_header();

$h_main_title = get_theme_mod( 'set_home_main_title', '' );
$h_main_text = get_theme_mod( 'set_home_main_desc', '' );
$h_main_bottle = get_theme_mod( 'set_home_main_bottle' );
$h_main_bottle_link = get_theme_mod( 'set_home_main_bottle_link', '' );
$h_main_img = get_theme_mod( 'set_home_main_img' );
$h_main_logo = get_theme_mod( 'set_home_main_logo' );
$h_main_btn_text = get_theme_mod( 'set_home_main_btn_text' );
$h_main_btn_link = get_theme_mod( 'set_home_main_btn_link' );

$h_wine_title =get_theme_mod( 'set_home_wine_title', '' );

$h_wine_blocks = array();
$h_wine_blocks_col = array(
  'col-lg-6 col-md-6',
  'col-lg-3 col-md-6',
  'col-lg-3 col-md-6',
  'col-lg-5 col-md-6',
  'col-lg-7 col-md-12'
);
for ($i=0; $i < 5; $i++) {
  $j = $i + 1;
  $h_wine_blocks[$i]['title'] = get_theme_mod( 'set_home_wine_block_title_' . $j, '' );
  $h_wine_blocks[$i]['url'] = get_theme_mod( 'set_home_wine_block_url_' . $j, '#' );
  $h_wine_blocks[$i]['new_tab'] = get_theme_mod( 'set_home_wine_block_url_new_window_' . $j, false );
  $h_wine_blocks[$i]['img'] = get_theme_mod( 'set_home_wine_block_img_' . $j, '' );
  $h_wine_blocks[$i]['col'] = $h_wine_blocks_col[$i];
}

?>
<section id="sec-intro">
  <div class="container">
    <div class="row d-flex align-items-center position-relative">
      <div class="col-lg-5 col-12 intro-text order-2 order-lg-1 mb-1">
        <div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.2s">
          <h1 style="font-weight: 600;"><?php echo esc_html($h_main_title); ?></h1>
          <div class="subheader mb-5 lead">
            <?php echo wpautop( esc_html($h_main_text), false ); ?>
          </div>
          <?php if( $h_main_btn_text && $h_main_btn_link ) : ?>
          <div class="intro-buttons">
            <a href="<?php echo esc_url( $h_main_btn_link ); ?>" title="<?php esc_attr_e( $h_main_btn_text ); ?>" class="btn btn-primary btn-line m-100 mr-3 mb-3"><span><?php esc_html_e( $h_main_btn_text, 'thegrapes' ); ?></span></a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-7 col-12 home-intro-wrap order-1 order-lg-2 mb-5">
        <?php if( isset($h_main_img) && $h_main_img ): ?>
          <div class="home-intro-bg-img">
            <?php
			  $home_main_img = wp_get_attachment_image_url( $h_main_img, 'full' );

			  echo wp_get_attachment_image( $h_main_img, 'full', false, array( 'class' => ' wow fadeInUp nolazyload', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s', 'width' => '626', 'height' => '560', 'sizes' => '(min-width:1200px) 626px, (min-width:960px) 528px, (min-width:720px) 536px, 357px' ) );
			  ?>
            <?php if( isset($h_main_logo) && $h_main_logo ): ?>
              <div class="home-intro-logo wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.6s">
                <?php echo wp_get_attachment_image( $h_main_logo, 'full', false, array( 'class' => 'nolazyload', 'width' => '130', 'height' => '160' ) ); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if( isset($h_main_bottle) && $h_main_bottle ): ?>
          <div class="home-intro-wine-img wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
            <?php if( isset($h_main_bottle_link) && $h_main_bottle_link != '' ) : ?>
              <a href="<?php echo $h_main_bottle_link; ?>">
                <?php echo wp_get_attachment_image( $h_main_bottle, 'full', false, array( 'class' => 'nolazyload', 'width' => '318', 'height' => '664' ) ); ?>
              </a>
            <?php else: ?>
              <?php echo wp_get_attachment_image( $h_main_bottle, 'full', false, array( 'class' => 'nolazyload', 'width' => '318', 'height' => '664' ) ); ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<section id="featured-wines" class="pb-12">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php $featured_wines_title = get_theme_mod( 'set_home_featured_wines_title', 'Featured Wines' ); ?>
        <h2 class="pb-8 text-center"><?php echo $featured_wines_title; ?></h2>
      </div>
    </div>
    <div class="row">
    	<?php
    		$args = array(
    			'post_type' => 'product',
    			'posts_per_page' => 6,
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'product_cat',
              'field' => 'slug',
              'terms' => 'featured',
              'operator' => 'IN',
            ),
            array(
              'taxonomy' => 'product_cat',
              'field' => 'slug',
              'terms' => 'bundle',
              'operator' => 'NOT IN',
            )
          ),
          'orderby' => 'menu_order'
    			);
    		$loop = new WP_Query( $args );
    		if ( $loop->have_posts() ) {
    			while ( $loop->have_posts() ) : $loop->the_post();
    				wc_get_template_part( 'content', 'product' );
    			endwhile;
    		} else {
    			echo __( 'No products found' );
    		}
    		wp_reset_postdata();
    	?>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="<?php echo site_url('/shop'); ?>" class="btn btn-primary btn-line"><span>View All</span></a>
      </div>
    </div>
  </div>
</section>
<section id="featured-bundles" class="pb-12">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php $featured_bundles_title = get_theme_mod( 'set_home_featured_bundles_title', 'Featured Bundles' ); ?>
        <h2 class="pb-8 text-center"><?php echo $featured_bundles_title; ?></h2>
      </div>
    </div>
    <div class="row">
    	<?php
    		$args = array(
    			'post_type' => 'product',
    			'posts_per_page' => 3,
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'product_cat',
              'field' => 'slug',
              'terms' => 'featured',
              'operator' => 'IN',
            ),
            array(
              'taxonomy' => 'product_cat',
              'field' => 'slug',
              'terms' => 'bundle',
              'operator' => 'IN',
            )
          ),
          'orderby' => 'menu_order'
    			);
    		$loop = new WP_Query( $args );
    		if ( $loop->have_posts() ) {
    			while ( $loop->have_posts() ) : $loop->the_post();
    				wc_get_template_part( 'content', 'product' );
    			endwhile;
    		} else {
    			echo __( 'No products found' );
    		}
    		wp_reset_postdata();
    	?>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="<?php echo site_url('/bundles'); ?>" class="btn btn-primary btn-line"><span>View All</span></a>
      </div>
    </div>
  </div>
</section>
<section id="sec-shopnav" class="pb-9">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="text-center mb-8"><?php echo esc_html($h_wine_title); ?></h2>
      </div>
    </div>
    <div class="row mb-2">
      <?php
      $taxonomy = 'product-estates';
  		$terms = get_terms([
  				'taxonomy' => $taxonomy,
  				'hide_empty' => false,
  		]);
  		foreach ($terms as $term) :

        $vy_url = get_term_link( $term->slug, $term->taxonomy );
        $vy_name = $term->name;
        $vy_img = get_term_meta($term->term_id, 'term_image', true);
        $vy_title= get_term_meta($term->term_id, 'term_preview_title', true);
        $vy_subtitle= get_term_meta($term->term_id, 'term_preview_subtitle', true);
      ?>
      <div class="col-lg-4 mb-6">
        <div class="vy-pr d-flex flex-row flex-lg-column justify-content-start align-items-center">
          <?php //$vy_link = get_term_link( 'renieri-brunello-di-montalcino', 'product-estates' ); ?>
          <?php if ( $vy_img ) :
            $vy_img_m = wp_get_attachment_image_src( thegrapes_get_attachment_id_by_url($vy_img), 'medium');
            ?>
          <div class="vy-pr-img mr-4 mr-lg-0 mb-0 mb-lg-4">
            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" >
              <img src="<?php echo $vy_img_m[0] ? $vy_img_m[0] : $vy_img; ?>" alt="<?php echo $vy_name; ?>" width="200" height="167" />
            </a>
          </div>
          <?php endif; ?>
          <div class="estate-pr-content d-flex flex-column align-items-start align-items-lg-center">
            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" class="link-decoration-none">
              <h4 class="d-inline-block mb-1"><?php echo $vy_title; ?></h4>
            </a>
            <p class="d-inline-block mb-1">
              <?php echo $vy_subtitle; ?>
            </p>

            <a href="<?php echo $vy_url; ?>" title="<?php echo $vy_name; ?>" class="btn btn-simple-primary btn-line"><span><?php _e( 'View Estate', 'thegrapes' ); ?></span></a>
          </div>
        </div>
      </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="row">
      <?php foreach ($h_wine_blocks as $block) :
        $block_target = $block['new_tab'] ? ' target="_blank"' : ' target="_self"';
        ?>
        <div class="<?php echo $block['col']; ?> mb-1">
          <figure class="pr-container">
            <a href="<?php echo $block['url']; ?>" title="<?php echo $block['title']; ?>" <?php echo $block_target; ?>>
              <?php echo wp_get_attachment_image( $block['img'], 'full', false, array( 'class' => 'pr-img' ) ); ?>
              <!--<div class="pr-img" style="background-image: url('<?php echo is_numeric( $block['img'] ) ? wp_get_attachment_url( $block['img'] ) : $block['img']; ?>');"></div>-->
              <div class="pr-overlay"></div>
              <div class="pr-content d-flex align-items-end">
                <h4 class="pr-title"><?php echo $block['title']; ?></h4>
              </div>
            </a>
          </figure>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
  $edu_display = get_theme_mod( 'set_home_edu_display', false );
  if( $edu_display ) :
    $edu_title = get_theme_mod( 'set_home_edu_title', '' );
    $edu_desc = get_theme_mod( 'set_home_edu_desc', '' );
    $edu_amount = get_theme_mod( 'set_home_edu_amount', 6 );
    ?>
    <section id="sec-edu" class="pb-3">
      <div class="container">
        <div class="row mb-4">
          <div class="col-lg-6">
            <?php if( $edu_title ) : ?>
            <h2><?php echo $edu_title; ?></h2>
            <?php endif; ?>
            <?php if( $edu_desc ) echo wpautop( $edu_desc ); ?>
          </div>
        </div>
        <div class="row mb-5" id="posts-container">
          <?php
          $args = array(
            'post_type'       => 'post',
            'posts_per_page'  => $edu_amount,
          );

          $blog_posts = new WP_Query( $args );
          //If there are any posts
            if ( $blog_posts->have_posts() ):
              // Load posts loop
              while( $blog_posts->have_posts() ): $blog_posts->the_post();
                get_template_part( 'template-parts/content' );
              endwhile;
              // RESET WP QUERY DATA!
              wp_reset_postdata();
            else:
          ?>
            <div class="col-lg-12">
              <h3><?php _e( 'Nothing to display', 'thegrapes' ); ?></h3>
            </div>
          <?php
            endif;
          ?>
        </div>
        <?php if (  $blog_posts->max_num_pages > 1 ) : ?>
    		<div class="row">
    			<div class="col-lg-12 text-center">
    				<button data-query="<?php echo json_encode( $blog_posts->query_vars ); ?>" data-posts-page="<?php echo $args['posts_per_page']; ?>" class="btn btn-outline-primary btn-line m-100 p-loadmore"><span><?php _e( 'Load more', 'thegrapes' ); ?></span></button>
    			</div>
    		</div>
    		<?php endif; ?>
      </div>
    </section>
    <?php
  endif;
  get_footer();
?>
