<?php
/**
* Theme functions used by iRibbon.
*
* Authors: Tyler Cunningham, Hugo Saner.
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package iRibbon
* @since 1.0
*/


/**
* Define global theme functions.
*/ 
	$ir_themename = 'iribbon';
	$ir_themenamefull = 'iRibbon';
	$ir_themeslug = 'ir';
	$ir_pagedocs = 'http://cyberchimps.com/question/using-the-iribbon-page-options/';
	$ir_sliderdocs = 'http://cyberchimps.com/question/using-the-feature-slider-in-iribbon/';
	$ir_root = get_template_directory_uri();
	
	if ( ! isset( $content_width ) ) $content_width = 608; //Set content width

/**
* Establishes 'response' as the textdomain, sets $locale and file path
*
* @since 1.0
*/
function response_text_domain() {
	load_theme_textdomain( 'response', get_template_directory() . '/core/languages' );

	    $locale = get_locale();
	    $locale_file = get_template_directory() . "/core/languages/$locale.php";
	    if ( is_readable( $locale_file ) )
		    require_once( $locale_file );
		
		return;    
}
add_action('after_setup_theme', 'response_text_domain');
	
/**
* Assign new default font.
*/ 
function ribbon_default_font( $font ) {
	$font = 'Georgia';
	return $font;
}
add_filter( 'response_default_font', 'ribbon_default_font' );

	
/**
* Basic theme setup.
*/ 
function iribbon_theme_setup() {
	
/**
* Initialize response Core Framework and Pro Extension.
*/ 
	require_once ( get_template_directory() . '/core/core-init.php' );

/**
* Call additional files required by theme.
*/ 
	require_once ( get_template_directory() . '/includes/classy-options-init.php' ); // Theme options markup.
	require_once ( get_template_directory() . '/includes/options-functions.php' ); // Custom functions based on theme options.
	require_once ( get_template_directory() . '/includes/meta-box.php' ); // Meta options markup.
	
	add_theme_support(
		'post-formats',
		array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support('automatic-feed-links');
	add_editor_style();
	
	if ( function_exists('get_custom_header')) {
				$default_bg = array( 'default-image' => get_template_directory_uri().'/images/backgrounds/texture-background.jpg' );
        add_theme_support( 'custom-background', $default_bg );
	} 
	else {
       	add_custom_background(); //For WP 3.3 and below.	
	}
}
add_action( 'after_setup_theme', 'iribbon_theme_setup' );

/**
* Redirect user to theme options page after activation.
*/ 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
	wp_redirect( 'themes.php?page=iribbon' );
}

/**
* Add link to theme options in Admin bar.
*/ 
function iribbon_admin_link() {
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array( 'id' => 'iRibbon', 'title' => 'iRibbon Options', 'href' => admin_url('themes.php?page=iribbon')  ) ); 
}
add_action( 'admin_bar_menu', 'iribbon_admin_link', 113 );

/**
* Custom markup for gallery posts in main blog index.
*/ 
function iribbon_custom_gallery_post_format( $content ) {
	global $options, $ir_themeslug, $post;
	$ir_root = get_template_directory_uri(); 
	
	ob_start();?>
			<div class="ribbon-top">
      <div class="ribbon-more">
      </div>
				<h2 class="posts_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <div class="ribbon-shadow"></div><!-- ribbon shadow -->
         </div><!-- ribbon top -->
			<article class="post_container">
      <div class="ribbon-shadow"></div><!-- ribbon shadow -->
		<?php if ($options->get($ir_themeslug.'_post_formats') == '1') : ?>
			<div class="postformats"><!--begin format icon-->
				<img src="<?php echo get_template_directory_uri(); ?>/images/formats/gallery.png" />
			</div><!--end format-icon-->
		<?php endif;?>
					<!--Call @Core Meta hook-->
			<?php response_post_byline(); ?>
				<?php
				if ( has_post_thumbnail() && $options->get($ir_themeslug.'_show_featured_images') == '1' && !is_single() ) {
 		 			echo '<div class="featured-image">';
 		 			echo '<a href="' . get_permalink($post->ID) . '" >';
 		 				the_post_thumbnail();
  					echo '</a>';
  					echo '</div>';
				}
			?>	
				<div class="entry" <?php if ( has_post_thumbnail() && $options->get($ir_themeslug.'_show_featured_images') == '1' ) { echo 'style="min-height: 115px;" '; }?>>
				
				<?php if (!is_single()): ?>
				<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
					<br /><br />
					This gallery contains <?php echo $total_images ; ?> images
					<?php endif;?>
				</figure><!-- .gallery-thumb -->
				<?php endif;?>
				
				<?php if (is_single()): ?>
					<?php the_content(); ?>
				<?php endif;?>
				</div><!--end entry-->
				
        </article><!--end post container-->
				<div class="clear">&nbsp;</div>
	<?php	
	$content = ob_get_clean();
	
	return $content;
}
add_filter('iribbon_post_formats_gallery_content', 'iribbon_custom_gallery_post_format' ); 
		
/**
* Set custom post excerpt link text based on theme option.
*/ 
function iribbon_excerpt_link($more) {

	global $ir_themename, $ir_themeslug, $options, $post;
    
    	if ($options->get($ir_themeslug.'_excerpt_link_text') == '') {
    		$linktext = '(Read More...)';
   		}
    	else {
    		$linktext = $options->get($ir_themeslug.'_excerpt_link_text');
   		}

	return '<a href="'. get_permalink($post->ID) . '"> <br /><br /> '.$linktext.'</a>';
}
add_filter('excerpt_more', 'iribbon_excerpt_link');

/**
* Set custom post excerpt length based on theme option.
*/ 
function iribbon_excerpt_length($length) {

	global $ir_themename, $ir_themeslug, $options;
	
		if ($options->get($ir_themeslug.'_excerpt_length') == '') {
    		$length = '55';
    	}
    	else {
    		$length = $options->get($ir_themeslug.'_excerpt_length');
    	}
    	
	return $length;
}
add_filter('excerpt_length', 'iribbon_excerpt_length');

/**
* Custom featured image size based on theme options.
*/ 
function iribbon_featured_image() {	
	if ( function_exists( 'add_theme_support' ) ) {
	
	global $ir_themename, $ir_themeslug, $options;
	
	if ($options->get($ir_themeslug.'_featured_image_height') == '') {
		$featureheight = '100';
	}		
	else {
		$featureheight = $options->get($ir_themeslug.'_featured_image_height'); 
	}
	if ($options->get($ir_themeslug.'_featured_image_width') == "") {
			$featurewidth = '100';
	}		
	else {
		$featurewidth = $options->get($ir_themeslug.'_featured_image_width'); 
	} 
	set_post_thumbnail_size( $featurewidth, $featureheight, true );
	}	
}
add_action( 'init', 'iribbon_featured_image', 11);	

/**
* Attach CSS3PIE behavior to elements
*/   
function iribbon_pie() { ?>
	
	<style type="text/css" media="screen">
		#wrapper input, textarea, #twitterbar, input[type=submit], input[type=reset], #imenu, .searchform, .post_container, .postformats, .postbar, .post-edit-link, .widget-container, .widget-title, .footer-widget-title, .comments_container, ol.commentlist li.even, ol.commentlist li.odd, .slider_nav, ul.metabox-tabs li, .tab-content, .list_item, .section-info, #of_container #header, .menu ul li a, .submit input, #of_container textarea, #of_container input, #of_container select, #of_container .screenshot img, #of_container .of_admin_bar, #of_container .subsection > h3, .subsection, #of_container #content .outersection .section, #carousel_list, #calloutwrap, #calloutbutton, .box1, .box2, .box3, .es-carousel-wrapper, #halfnav ul li a, #halfnav ul li a:hover, #halfnav li.current_page_item a, #halfnav li.current_page_item ul li a, .pagination span, .pagination a, .pagination a:hover, .pagination .current, #nav, .nav-shadow, .sd_left_sidebar div.ribbon-top, .sd_left_sidebar div.ribbon-shadow, .sd_left_sidebar div.ribbon-more, .sd_right_sidebar div.ribbon-top, .sd_right_sidebar div.ribbon-more, .sd_right_sidebar div.ribbon-extra, .sd_right_sidebar div.ribbon-shadow, .ribbon-bottom, .ribbon-bottom-end, .ribbon-bg-blue, .ribbon-bg-blue .ribbon-shadow, .ribbon-left-blue, .ribbon-right-blue, .searchform .iRibbon-search
  		
  	{
  		behavior: url('<?php echo get_template_directory_uri();  ?>/core/library/pie/PIE.htc');
	}
	</style>
<?php
}

add_action('wp_head', 'iribbon_pie', 8);

/**
* Add Google Analytics support based on theme option.
*/ 
function iribbon_google_analytics() {
	global $ir_themename, $ir_themeslug, $options;
	
	echo stripslashes ($options->get($ir_themeslug.'_ga_code'));

}
add_action('wp_head', 'iribbon_google_analytics');

/**
* Add custom header scripts support based on theme option.
*/ 
function iribbon_custom_scripts() {
	global $ir_themename, $ir_themeslug, $options;
	
	echo stripslashes ($options->get($ir_themeslug.'_custom_header_scripts'));

}
add_action('wp_head', 'iribbon_custom_scripts');

	
/**
* Register custom menus for header, footer.
*/ 
function iribbon_register_menus() {
	register_nav_menus(
	array( 'header-menu' => __( 'Header Menu', 'response' ), 'footer-menu' => __( 'Footer Menu', 'response' ), 'sub-menu' => __( 'Sub Menu', 'response' ), 'mobile-menu' => __( 'Mobile Menu', 'response' ) )
	);
}
add_action( 'init', 'iribbon_register_menus' );
	
/**
* Menu fallback if custom menu not used.
*/ 
function iribbon_menu_fallback() {
	global $post; ?>
	<div id="nav">
	<ul id="nav_menu">
		<?php wp_list_pages( 'title_li=&sort_column=menu_order&depth=3'); ?>
	</ul>
	</div><?php
}
/**
* Register widgets.
*/ 
function iribbon_widgets_init() {
    register_sidebar(array(
    	'name' => 'Full Sidebar',
    	'id'   => 'sidebar-widgets',
    	'description'   => 'These are widgets for the full sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));
    register_sidebar(array(
    	'name' => 'Left Half Sidebar',
    	'id'   => 'sidebar-left',
    	'description'   => 'These are widgets for the left half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
    ));    	
    register_sidebar(array(
    	'name' => 'Right Half Sidebar',
    	'id'   => 'sidebar-right',
    	'description'   => 'These are widgets for the right half sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget-container"><div class="ribbon-cut-blue"></div><div class="ribbon-bg-blue"><div class="ribbon-left-blue"></div><div class="ribbon-shadow"></div><div class="ribbon-right-blue"></div></div>',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h2 class="widget-title">',
    	'after_title'   => '</h2>'
   	));
   	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'description' => 'These are the footer widgets',
		'before_widget' => '<div class="span3 footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	));
}
add_action ('widgets_init', 'iribbon_widgets_init');

function iRibbon_post_meta()
{
	global $options, $ir_themeslug; //call globals.  
	if (is_single()) {
		$hidden = $options->get($ir_themeslug.'_single_hide_byline'); 
	}
	elseif (is_archive()) {
		$hidden = $options->get($ir_themeslug.'_archive_hide_byline'); 
	}
	else {
		$hidden = $options->get($ir_themeslug.'_hide_byline'); 
	}
	$link_pages = wp_link_pages( array( 'echo' => 0 ) );
	
	if( $hidden[$ir_themeslug.'_hide_comments'] != '0' ||
			$link_pages != '' ||
			$hidden[$ir_themeslug.'_hide_tags'] != 0 && has_tag()
		)
		{
			return 1;
		}
		else {
			return 0;
		}
}

/**
* End
*/

?>