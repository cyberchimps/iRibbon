<?php
/**
* Global actions used by the CyberChimps Response Core Framework
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
* Response global actions
*/

add_action( 'response_loop', 'response_loop_content' );
add_action( 'response_post_byline', 'response_post_byline_content' );
add_action( 'response_edit_link', 'response_edit_link_content' );
add_action( 'response_post_tags', 'response_post_tags_content' );
add_action( 'response_post_bar', 'response_post_bar_content' );

/**
* Check for post format type, apply filter based on post format name for easy modification.
*
* @since 1.0
*/
function response_loop_content($content) { 

	global $options, $ir_themeslug, $post; //call globals
	
	if (is_single()) {
		 $post_formats = $options->get($ir_themeslug.'_single_post_formats');
		 $featured_images = $options->get($ir_themeslug.'_single_show_featured_images');
		 $excerpts = $options->get($ir_themeslug.'_single_show_excerpts');
	}
	elseif (is_archive()) {
		 $post_formats = $options->get($ir_themeslug.'_archive_post_formats');
		 $featured_images = $options->get($ir_themeslug.'_archive_show_featured_images');
		 $excerpts = $options->get($ir_themeslug.'_archive_show_excerpts');
	}
	else {
		 $post_formats = $options->get($ir_themeslug.'_post_formats');
		 $featured_images = $options->get($ir_themeslug.'_show_featured_images');
		 $excerpts = $options->get($ir_themeslug.'_show_excerpts');
	}
	
	if (get_post_format() == '') {
		$format = "default";
	}
	else {
		$format = get_post_format();
	} ?>
		
		<?php ob_start(); ?>
			<div class="ribbon-top">
      <div class="ribbon-more">
      </div>
      <h2 class="posts_title entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <div class="ribbon-shadow"></div><!-- ribbon shadow -->
      </div><!-- ribbon top -->
			<article class="post_container">
			<?php if ($post_formats != '0') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format ;?>.png" alt="formats" />
			</div><!--end format-icon-->
			<?php endif; ?>
				
					<!--Call @response Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $featured_images == '1') {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry entry-content" <?php if ( has_post_thumbnail() && $featured_images == '1' && !is_single()  ) { echo 'style="min-height: 115px;" '; }?>>
					<?php 
						if ($excerpts == '1' && !is_single() ) {
						the_excerpt();
						}
						else {
							the_content();
						}
					 ?>
				</div><!--end entry-->
        <?php if( is_attachment() ): ?>
        	<div class='alignleft'>
						<?php previous_image_link( 'thumbnail', 'Previous Image' ); ?>
          </div>
          <div class='alignright'>
          	<?php next_image_link( 'thumbnail', 'Next Image' ); ?>
          </div>
        
        <?php endif; ?>
        <!-- Start containing styling if any of the links below are selected -->
        <?php if( iRibbon_post_meta() != 0 ): ?>
        <div class="iRibbon-post-meta">
        <?php endif; ?>
        
				<!--Begin @response post tags hook-->
					<?php response_post_bar(); ?>
				<!--End @response post tags hook-->
        
        <!--Begin @response link pages hook-->
					<?php response_link_pages(); ?>
				<!--End @response link pages hook-->
					
							
				<!--Begin @response post tags hook-->
					<?php response_post_tags(); ?>
				<!--End @response post tags hook-->
        
				<!--Begin @response post edit link hook-->
					<?php response_edit_link(); ?>
				<!--End @response post edit link hook-->
        
        <!-- end containing styling for links above -->
         <?php if( iRibbon_post_meta() != 0 ): ?>
			<div class='clear'></div>
        </div>
        <?php endif; ?>
							
			</article><!--end post container-->
		<div class='clear'>&nbsp;</div>
		<?php	
		
		$content = ob_get_clean();
		$content = apply_filters( 'response_post_formats_'.$format.'_content', $content );
	
		echo $content; 
}


/**
* Sets up the HTML for the postbar area.
*
* @since 3.1
*/
function response_post_bar_content() { 
	global $options, $ir_themeslug; 
	
	if (is_single()) {
		$hidden = $options->get($ir_themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($ir_themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($ir_themeslug.'_hide_byline'); 
	}?>
	
	<div id="comments">
	<?php if (($hidden[$ir_themeslug.'_hide_comments']) != '0'):?><?php comments_popup_link( __('No Comments', 'iribbon' ), __('1 Comment', 'iribbon' ), __('% Comments' , 'iribbon' )); //need a filer here ?>.<?php endif;?>
	</div>
	<?php
}

/**
* Sets the post byline information (author, date, category). 
*
* @since 1.0
*/
function response_post_byline_content() {
	global $options, $ir_themeslug; //call globals.  
	if (is_single()) {
		$hidden = $options->get($ir_themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($ir_themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($ir_themeslug.'_hide_byline'); 
	}?>
	
	<div class="meta">
		<?php if (($hidden[$ir_themeslug.'_hide_date']) != '0'):?> <?php _e( 'Published on', 'iribbon' ); ?> <a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?></a>,<?php endif;?>
		<?php if (($hidden[$ir_themeslug.'_hide_author']) != '0'):?><?php _e( 'by', 'iribbon' ); ?> <span class="vcard author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="url fn"><?php the_author_meta( 'display_name' ); ?></a></span> <?php endif;?>
		<?php if (($hidden[$ir_themeslug.'_hide_categories']) != '0'):?><?php _e( 'in', 'iribbon' ); ?> <?php the_category(', ') ?>.<?php endif;?>
		
	</div> <?php
}

/**
* Sets up the WP edit link
*
* @since 1.0
*/
function response_edit_link_content() {
	edit_post_link('Edit', '<p>', '</p>');
}

/**
* Sets up the tag area
*
* @since 1.0
*/
function response_post_tags_content() {
	global $options, $ir_themeslug; 
	if (is_single()) {
		$hidden = $options->get($ir_themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($ir_themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($ir_themeslug.'_hide_byline'); 
	}?>

	<?php if (has_tag() AND ($hidden[$ir_themeslug.'_hide_tags']) != '0'):?>
	<div class="tags">
			<?php the_tags( __('Tags: ', 'iribbon'), ', ', '<br />'); ?>
		
	</div><!--end tags--> 
	<?php endif;
}

/**
* End
*/

?>