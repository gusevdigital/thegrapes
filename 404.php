<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package thegrapes
 */

get_header();
?>

    <div class="container">
      <div class="row">
        <div class="col-12 text-center error-404">
          <h1>Page not found</h1>
          <p>
            Unfortunately, the page you tried to reach does not exist on this site!
          </p>
        </div>
      </div>
        <?php
        /*the_widget( 'WP_Widget_Recent_Posts', array(
          'title'     => 'Take a Look at Out Latest Posts',
          'number'    => 3
        ) );*/
        ?>
    </div>

<?php
  get_footer();
?>
