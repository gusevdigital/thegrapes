<?php

/* -------------------------------------------------- */
/* 1. Get part of String based on start and end pattern
/* -------------------------------------------------- */

function getStringpart($string,$startStr,$endStr)
{
  $start = strpos( $string, $startStr);

  $end = strrpos( $string, $endStr) + strlen($endStr);
  //we need the length of the substring for the third argument, not its index
  $len = ($end-$start);

  $fstr = substr($string, $start, $len );

return $fstr;
}


/* -------------------------------------------------- */
/* 2. GET ATTACHMENT ID BY URL
/* -------------------------------------------------- */

function thegrapes_get_attachment_id_by_url( $url ) {

    // Split the $url into two parts with the wp-content directory as the separator
    $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

    // Get the host of the current site and the host of the $url, ignoring www
    $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
    $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

    // Return nothing if there aren't any $url parts or if the current host and $url host do not match
    if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
        return;
    }

    // Now we're going to quickly search the DB for any attachment GUID with a partial path match

    // Example: /uploads/2013/05/test-image.jpg
    global $wpdb;
    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

    // Returns null if no attachment is found
    return $attachment[0];
}


/* -------------------------------------------------- */
/* 3. BREADCRUMBS
/* -------------------------------------------------- */

function the_breadcrumb() {
	 global $post;
	 $separator = '<span class="breadcrumb-divider"><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 8.49993L13.4394 5.93933V7.99599H0V9.00394H13.4394V11.0606L16 8.49993Z" fill="#121212" /></svg></span>';
	 echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
	 if (!is_home()) {
			 echo '<li class="breadcrumb-item"><a href="';
			 echo get_option('home');
			 echo '">';
			 echo __( 'Home', 'thegrapes' );
			 echo '</a></li>' . $separator;
			 if ( is_category() ) {
					 echo '<li class="breadcrumb-item active">';
					 the_category(' </li>' . $separator . '<li class="breadcrumb-item"> ');
			 } elseif ( is_single() ) {
         echo '<li class="breadcrumb-item">';
         echo '<a href="' . get_post_type_archive_link( 'post' ) . '">';
         echo get_the_title( get_option('page_for_posts', true) );
         echo '</a>';
         echo '</li>' . $separator  . '<li class="breadcrumb-item active">';
         the_title();
         echo '</li>';
       } elseif ( is_page() ) {
					 if($post->post_parent){
							 $anc = get_post_ancestors( $post->ID );
							 $title = get_the_title();
							 foreach ( $anc as $ancestor ) {
									 $output = '<li class="breadcrumb-item"><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>' . $separator;
							 }
							 echo $output;
							 echo '<li class="breadcrumb-item active">'.$title.'</li>';
					 } else {
							 echo '<li class="breadcrumb-item active">'.get_the_title().'</li>';
					 }
			 }
	 }
	 elseif (is_tag()) {single_tag_title();}
	 elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	 elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	 elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	 elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	 elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	 elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	 echo '</ol></nav>';
}


/* -------------------------------------------------- */
/* 4. LEFT FOR FREE SHIPPING
/* -------------------------------------------------- */

function wc_add_notice_free_shipping() {

  $order_min_amount = get_free_shipping_minimum();

  $cart = WC()->cart->subtotal;
  $remaining = $order_min_amount  - $cart;
  $f_str = "";
  if ( $cart < 1 ) {
    $f_str .= sprintf( __( '<strong>Free delivery</strong> from %s.', 'thegrapes' ), wc_price($order_min_amount));
  } else if ( $order_min_amount > $cart ){
    $f_str .= sprintf( __( 'Spend %s more to get <strong>free delivery</strong>.', 'thegrapes' ), wc_price($remaining));
  } else {
    $f_str .= '<strong>' . __( 'You have free delivery.', 'thegrapes' ) . '</strong>';
  }
  return $f_str;

}

function get_free_shipping_minimum($zone_name = 'Singapore') {
    if ( ! isset( $zone_name ) ) return null;

    $result = null;
    $zone = null;

    $zones = WC_Shipping_Zones::get_zones();
    foreach ( $zones as $z ) {
        if ( $z['zone_name'] == $zone_name ) {
            $zone = $z;
        }
    }

    if ( $zone ) {
        $shipping_methods_nl = $zone['shipping_methods'];
        $free_shipping_method = null;
        foreach ( $shipping_methods_nl as $method ) {
            if ( $method->id == 'free_shipping' ) {
                $free_shipping_method = $method;
                break;
            }
        }

        if ( $free_shipping_method ) {
            $result = $free_shipping_method->min_amount;
        }
    }

    return $result;
}


/* -------------------------------------------------- */
/* 5. GET USER BROWSER
/* -------------------------------------------------- */

function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}


/* -------------------------------------------------- */
/* 5. GET POST SIBLINGS FOR RELATED POSTS
/* -------------------------------------------------- */

function the_similar_posts( $amount = 3 ) {
    global $wpdb, $post;

    if( empty( $date ) )
        $date = $post->post_date;

    //$date = '2009-06-20 12:00:00'; // test data

    $amount = absint( $amount );
    if( !$amount )
        return;
    $p = array();
    $p = $wpdb->get_results( "
        SELECT
            post_title,
            post_date,
            ID
        FROM
            $wpdb->posts
        WHERE
            post_date < '$date' AND
            post_type = 'post' AND
            post_status = 'publish'
        ORDER by
            post_date DESC
        LIMIT
            $amount
    " );

    if( !empty($p) || count($p) < $amount) {
      $amount_new = $amount - count($p);
      $p_new = $wpdb->get_results( "
          SELECT
              post_title,
              post_date,
              ID
          FROM
              $wpdb->posts
          WHERE
              post_date > '$date' AND
              post_type = 'post' AND
              post_status = 'publish'
          ORDER by
              post_date ASC
          LIMIT
              $amount_new
      " );
      $p = array_merge($p, $p_new);
    }
    $amount = count( $p );

    $post_ids = array();

    foreach ($p as $val) {
      array_push( $post_ids, $val->ID );
    }

    $related_posts = new WP_Query( array( 'post_type' => 'post', 'post__in' => $post_ids ) );

    if ( $related_posts->have_posts() ):
      ?>
      <div id="similar-gallery" class="carousel slide carousel-adaptive" data-ride="carousel" data-interval="4000" data-state="mobile">
        <ol class="carousel-indicators">
        <?php for ($i=0; $i < $amount; $i++) : ?>
          <li data-target="#similar-gallery" data-slide-to="<?php echo $i; ?>" class="<?php echo !$i ? 'active' : ''; ?>"></li>
        <?php endfor; ?>
        </ol>
        <div class="carousel-inner row py-5" role="listbox">
          <?php
          $post_i = 0;
          // Load posts loop
          while( $related_posts->have_posts() ): $related_posts->the_post();
            get_template_part( 'template-parts/content-similar', 'name', array('post_i'=>$post_i) );
            $post_i++;
          endwhile;
          ?>
        </div>
      </div>
    <?php else: ?>
      <div class="col-lg-12">
        <h3><?php _e( 'Nothing to display', 'thegrapes' ); ?></h3>
      </div>
    <?php endif;
}
