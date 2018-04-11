<?php

if( !function_exists("is_vc_active") ):
	function is_vc_active() {
		return is_plugin_active( "js_composer/js_composer.php" );
	}
endif;

if( is_vc_active() ):

	if( !function_exists("vc_remove_elements") ):
		function vc_remove_elements($arr) {
			$len = sizeof($arr);
			while($len--) {
				vc_remove_element($arr[$len]);
			}
		}
	endif;

	vc_remove_elements([
		// Wordpress Widgets
		"vc_wp_search",
		"vc_wp_meta",
		"vc_wp_recentcomments",
		"vc_wp_calendar",
		"vc_wp_pages",
		"vc_wp_tagcloud",
		"vc_wp_custommenu",
		"vc_wp_text",
		"vc_wp_posts",
		"vc_wp_links",
		"vc_wp_categories",
		"vc_wp_archives",
		"vc_wp_rss",
		//
	]);

endif;