<?php

/*
Plugin Name: HPS - GA4 Author/Category Tracking
Description: Adds post authors and categories to the GA4 tracking.
Version: 0.1
Author: Hanscom Park Studio
*/


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

add_action('wp_head', function() {
	if (is_single()) {
		global $post;
		$category = get_the_category($post->ID);
		$category_name = $category[0]->name ?? 'Uncategorized';
		$author_name = get_the_author_meta('display_name', $post->post_author);
?>
		<script>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				'event': 'post_view',
				'post_category': '<?php echo esc_js($category_name); ?>',
				'post_author': '<?php echo esc_js($author_name); ?>'
			});
		</script>
<?php
	}
});
