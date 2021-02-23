<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thegrapes
 */

get_header();


$edu_desc = get_theme_mod( 'set_edu_desc', '' );
$edu_img = get_theme_mod( 'set_edu_img', '' );
?>
<section id="sec-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h1>
          <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title( get_option('page_for_posts', true) ); ?></li>
						</ol>
					</nav>
					<div class="subheader mb-5">
						<p class="lead">
							<?php echo wpautop( esc_html($edu_desc), false ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-7 col-12 home-intro-wrap mb-5">
				<?php if( isset($edu_img) && $edu_img ): ?>
					<div class="home-intro-bg-img">
		      	<?php echo wp_get_attachment_image( $edu_img, 'full', false, array( 'class' => ' wow fadeInUp', 'data-wow-duration' => '1s', 'data-wow-delay' => '.4s' ) ); ?>
		      </div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section id="sec-edu" class="pb-3">
  <div class="container">
    <div id="posts-container" class="row mb-5">
      <?php
      //If there are any posts
        $thumbs = array(
          'meta_query' => array(
            array(
              'key' => '_thumbnail_id'
            )
          )
        );

        $query = new WP_Query($thumbs);
        if ( $query->have_posts() ):

          // Load posts loop
          while( $query->have_posts() ): $query->the_post();
            get_template_part( 'template-parts/content' );
          endwhile;

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
		<?php if (  $query->max_num_pages > 1 ) : ?>
		<div class="row">
			<div class="col-lg-12 text-center">
				<button data-query="<?php echo json_encode( $query->query_vars ); ?>" data-posts-page="<?php echo $query->query_vars['posts_per_page']; ?>" class="btn btn-outline-primary btn-line m-100 p-loadmore"><span><?php _e( 'Load more', 'thegrapes' ); ?></span></button>
			</div>
		</div>
		<?php endif; ?>
  </div>
</section>
<?php
get_footer();
?>
