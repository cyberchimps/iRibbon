<?php
/**
* Archive actions used by the CyberChimps Response Core Framework
*
* Author: Tyler Cunningham
* Copyright: © 2012
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
* Response archive actions
*/
add_action( 'response_archive_title', 'response_archive_page_title' );

/**
* Output archive page title based on archive type. 
*
* @since 1.0
*/
function response_archive_page_title() { 
	?>
	
		<?php if( is_category() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for the &#8216;', 'iribbon' ); ?><?php single_cat_title(); ?><?php _e( '&#8217; Category:', 'iribbon' ); ?></h2><br />

		<?php } elseif( is_tag() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Posts Tagged &#8216;', 'iribbon' ); ?><?php single_tag_title(); ?><?php _e( '&#8217;:', 'iribbon' ); ?></h2><br />

		<?php } elseif( is_day() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for', 'iribbon' ); ?> <?php the_time( 'F jS, Y' ); ?>:</h2><br />

		<?php } elseif( is_month() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for', 'iribbon' ); ?> <?php the_time( 'F, Y' ); ?>:</h2><br />

		<?php } elseif( is_year() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Archive for:', 'iribbon' ); ?> <?php the_time( 'Y' ); ?>:</h2><br />

		<?php } elseif( is_author() ) { ?>
			<h2 class="archivetitle"><?php _e( 'Author Archive:', 'iribbon' ); ?></h2><br />

		<?php } elseif( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { ?>
			<h2 class="archivetitle"><?php _e( 'Blog Archives:', 'iribbon' ); ?></h2><br />
	
		<?php } 
}

/**
* Output Archive Description in archibe pages.
*
* @since ?
*/

function response_archive_description(){
	?>
		<?php if ((is_category() || is_tag()) && category_description()): ?>
			<div class="ribbon-top">
      	<div class="ribbon-more"></div>
      	<h1 class="posts_title"><?php single_cat_title(_e( 'Currently browsing: ', 'iribbon' )); ?></h1>
      	<div class="ribbon-shadow"></div><!-- ribbon shadow -->
      </div>
			<div class="post_outer_container">
				<div class="post_container">
					<?php echo category_description(); ?> 
				</div>
			</div>
		<?php endif; ?>
	<?php
}

/**
* End
*/

?>