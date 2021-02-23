<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Woos
 */

get_header();

?>

<section id="sec-intro">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-xl-5 col-12 intro-text mb-1">
				<div class="intro-text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
					<h1><?php echo the_archive_title(); ?></h1>
          <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'thegrapes' ); ?></a></li>
							<span class="breadcrumb-divider">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" />
								</svg>
							</span>
							<li class="breadcrumb-item active" aria-current="page"><?php echo the_archive_title(); ?></li>
						</ol>
					</nav>
				</div>
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
