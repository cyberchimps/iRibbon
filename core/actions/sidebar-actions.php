<?php
/**
* Sidebar actions used by the CyberChimps Response Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2011
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response
* @since 1.0
*/

/**
* Response sidebar actions
*/
add_action( 'response_sidebar_init', 'response_sidebar_init_content' );
add_action( 'response_before_content_sidebar', 'response_before_content_sidebar_markup' );
add_action( 'response_after_content_sidebar', 'response_after_content_sidebar_markup' );


/**
* Set sidebar and grid variables.
*
* @since 1.0
*/
function response_sidebar_init_content() {

	global $options, $themeslug, $post, $sidebar, $content_grid;
	
	if (is_single()) {
	$sidebar = $options->get($themeslug.'_single_sidebar');
	}
	elseif (is_archive()) {
	$sidebar = $options->get($themeslug.'_archive_sidebar');
	}
	elseif (is_404()) {
	$sidebar = $options->get($themeslug.'_404_sidebar');
	}
	elseif (is_search()) {
	$sidebar = $options->get($themeslug.'_search_sidebar');
	}
	elseif (is_page()) {
	$sidebar = get_post_meta($post->ID, 'page_sidebar' , true);
	}
	else {
	$sidebar = $options->get($themeslug.'_blog_sidebar');
	}
	
	if ($sidebar == 'none' OR $sidebar == "2") {
		$content_grid = 'span12 sd_left_sidebar';
	}
	elseif ($sidebar == 'left' OR $sidebar == "1") {
		$content_grid = 'span8 sd_left_sidebar';
	}
	elseif ($sidebar == 'right' OR $sidebar == '0' OR $sidebar == '') {
		$content_grid = 'span8 sd_right_sidebar';
	}
	else {
		$content_grid = 'span8';
	}
}

/**
* Before entry sidebar
*
* @since 1.0
*/
function response_before_content_sidebar_markup() { 
	global $options, $themeslug, $post, $sidebar; // call globals ?>
					
	<?php if ($sidebar == 'left' OR $sidebar == "1"): ?>
  <div class="span4">
	<div id="sidebar_left">
		<?php get_sidebar(); ?>
	</div>
  </div>
	<?php endif;
}

/**
* After entry sidebar
*
* @since 1.0
*/
function response_after_content_sidebar_markup() {
	global $options, $themeslug, $post, $sidebar; // call globals ?>
	
	<?php if ($sidebar == 'right' OR $sidebar == '0' OR $sidebar == '' ): ?>
	<div class="span4">
  <div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
  </div>
	<?php endif;	
}

/**
* End
*/

?>