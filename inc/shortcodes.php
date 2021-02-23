<?php
/* -------------------------------------------------- */
/* 1. DISPLAY VINEYARDS
/* -------------------------------------------------- */

// function that runs when shortcode is called
function thegrapes_estates_shortcode() {

  $result = '<div class="row mb-2">';

  $taxonomy = 'product-estates';
  $terms = get_terms([
      'taxonomy' => $taxonomy,
      'hide_empty' => false,
  ]);
  foreach ($terms as $term) {

    $vy_url = get_term_link( $term->slug, $term->taxonomy );
    $vy_name = $term->name;
    $vy_img = get_term_meta($term->term_id, 'term_image', true);
    $vy_title= get_term_meta($term->term_id, 'term_preview_title', true);
    $vy_subtitle= get_term_meta($term->term_id, 'term_preview_subtitle', true);

    $result .= '<div class="col-lg-4 mb-6"><div class="vy-pr d-flex flex-row flex-lg-column justify-content-start align-items-center">';
    if ( $vy_img ) {
      $vy_img_m = wp_get_attachment_image_src( thegrapes_get_attachment_id_by_url($vy_img), 'medium');
      $result .= '<div class="vy-pr-img mr-4 mr-lg-0 mb-0 mb-lg-4">';
      $result .= '<a href="' . $vy_url . '" title="' . $vy_name . '" >';
      $img = $vy_img_m[0] ? $vy_img_m[0] : $vy_img;
      $result .= '<img src="' . $img . '" alt="' . $vy_name . '" />';
      $result .= '</a></div>';
    }
    $result .= '<div class="estate-pr-content d-flex flex-column align-items-start align-items-lg-center">';
    $result .= '<a href="' . $vy_url . '" title="' . $vy_name . '" class="link-decoration-none"><h4 class="d-inline-block mb-1">' . $vy_title . '</h4></a>';
    $result .= '<p class="d-inline-block mb-1">' . $vy_subtitle . '</p>';
    $result .= '<a href="' . $vy_url . '" title="' . $vy_name . '" class="btn btn-simple-primary btn-line"><span>' . __( 'View Estate', 'thegrapes' ) . '</span></a>';
    $result .= '</div></div></div>';
  }
  $result .= '</div>';

// Output needs to be return
return $result;
}
// register shortcode
add_shortcode('estates', 'thegrapes_estates_shortcode');
