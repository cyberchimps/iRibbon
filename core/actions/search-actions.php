<?php
/**
* Search actions used by the CyberChimps Response Core Framework
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
* Response search actions
*/
add_action( 'response_search', 'response_search_content' );

/**
* Search results output
*
* @since 1.0
*/
function response_search_content() { 
	global $options, $themeslug;
	$results = apply_filters( 'response_search_results_message', 'Search Results For: %s' ); 
	$noresults = apply_filters( 'response_no_search_results_message', 'No posts found.' ); ?>

		<h5 class="iribbon-search-term"><?php printf( __( $results ), '<span>' . get_search_query() . '</span>' ); ?></h5>
		<?php if (have_posts()) : ?>
			<div class="post_outer_container">
  
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="ribbon-top">
      <div class="ribbon-more">
      </div>
				<h2 id="post-<?php the_ID(); ?>" class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        </div><!-- ribbon top -->
        <article class="post_container">
      	<div class="ribbon-shadow"></div><!-- ribbon shadow -->
				<?php get_template_part('meta', 'search' ); ?>
				<div class="entry">

					<?php 
						if ($options->get($themeslug.'_search_show_excerpts') == '1') {
							the_excerpt();
						}
						else {
							the_content();
						}
					 ?>

				</div><!-- end entry -->
        
			</article><!--end post container-->
			</div><!-- end post -->
			
		<?php endwhile; ?>

		<?php response_pagination(); ?>
		
  </article><!-- post container -->
  </div><!-- post outer container -->
	<?php else : ?>
	<div class="post_outer_container">
			<div class="ribbon-top">
      <div class="ribbon-more">
      </div>
					<h2 class="posts_title"><?php printf( __( $noresults, 'response' )) ; ?></h2>
      </div><!-- ribbon top -->
			<article class="post_container">
      <div class="ribbon-shadow">
      </div><!-- ribbon shadow -->
      <div class="entry">

					<p>No posts can be found for your search term <?php echo get_search_query(); ?>.</p>
          <p>Please try again using a different term.</p>

				</div><!-- end entry -->
  </article><!-- post container -->
  </div><!-- post outer container -->
	<?php endif; ?>
	<?php
}

/**
* End
*/

?>