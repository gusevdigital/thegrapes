<?php
/*
 * Meta Box Removal
 */
function thegrapes_post_tags_meta_box_remove() {
	$id = 'tagsdiv-product_tag'; // you can find it in a page source code (Ctrl+U)
	$post_type = 'product'; // remove only from post edit screen
	$position = 'side';
	remove_meta_box( $id, $post_type, $position );
}
add_action( 'admin_menu', 'thegrapes_post_tags_meta_box_remove');



/*
 * Add
 */
function thegrapes_add_new_tags_metabox(){
	$id = 'thegrapes-tagsdiv-product_tag'; // it should be unique
	$heading = 'Filters'; // meta box heading
	$callback = 'thegrapes_metabox_content'; // the name of the callback function
	$post_type = 'product';
	$position = 'side';
	$pri = 'default'; // priority, 'default' is good for us
	add_meta_box( $id, $heading, $callback, $post_type, $position, $pri );
}
add_action( 'admin_menu', 'thegrapes_add_new_tags_metabox');

/*
 * Fill
 */
function thegrapes_metabox_content($post) {

	// get all blog post tags as an array of objects
	$all_tags = get_terms( array('taxonomy' => 'product_tag', 'hide_empty' => 0) );

	// get all tags assigned to a post
	$all_tags_of_post = get_the_terms( $post->ID, 'product_tag' );

	// create an array of post tags ids
	$ids = array();
	if ( $all_tags_of_post ) {
		foreach ($all_tags_of_post as $tag ) {
			$ids[] = $tag->term_id;
		}
	}

	// HTML
	echo '<div id="taxonomy-product_tag" class="categorydiv">';
	echo '<input type="hidden" name="tax_input[product_tag][]" value="0" />';
	echo '<ul>';
	foreach( $all_tags as $tag ){
		// unchecked by default
		$checked = "";
		// if an ID of a tag in the loop is in the array of assigned post tags - then check the checkbox
		if ( in_array( $tag->term_id, $ids ) ) {
			$checked = " checked='checked'";
		}
		$id = 'post_tag-' . $tag->term_id;
		echo "<li id='{$id}'>";
		echo "<label><input type='checkbox' name='tax_input[product_tag][]' id='in-$id'". $checked ." value='$tag->slug' /> $tag->name</label><br />";
		echo "</li>";
	}
	echo '</ul></div>'; // end HTML
}
