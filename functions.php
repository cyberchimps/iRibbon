<?php
/**
 * Theme Functions
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Load Core
require_once( get_template_directory() . '/cyberchimps/init.php' );

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
    $content_width = 640; /* pixels */

function cyberchimps_add_site_info() { ?>
    <p>&copy; Company Name</p>
<?php }
add_action('cyberchimps_site_info', 'cyberchimps_add_site_info');

if ( ! function_exists( 'cyberchimps_comment' ) ) :
// Template for comments and pingbacks.
// Used as a callback by wp_list_comments() for displaying the comments.
    function cyberchimps_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php _e( 'Pingback:', 'cyberchimps' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cyberchimps' ), ' ' ); ?></p>
                <?php
                break;
            default :
                ?>
                    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment hreview">
                        <footer>
                            <div class="comment-author reviewer vcard">
                                <?php echo get_avatar( $comment, 40 ); ?>
                                <?php printf( '%1$s <span class="says">%2$s</span>', sprintf( '<cite class="fn">%1$s</cite>',
                                                                                              get_comment_author_link() ),
                                              __( 'says', 'cyberchimps' ) ); ?>
                            </div><!-- .comment-author .vcard -->
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <em><?php _e( 'Your comment is awaiting moderation.', 'cyberchimps' ); ?></em>
                                <br />
                            <?php endif; ?>

                            <div class="comment-meta commentmetadata">
                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="dtreviewed"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                                        <?php
                                        /* translators: 1: date, 2: time */
                                        printf( __( '%1$s at %2$s', 'cyberchimps' ), get_comment_date(), get_comment_time() ); ?>
                                    </time></a>
                                <?php edit_comment_link( __( '(Edit)', 'cyberchimps' ), ' ' );
                                ?>
                            </div><!-- .comment-meta .commentmetadata -->
                        </footer>

                        <div class="comment-content"><?php comment_text(); ?></div>

                        <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                    </article><!-- #comment-## -->

                <?php
                break;
        endswitch;
    }
endif; // ends check for cyberchimps_comment()

// set up next and previous post links for lite themes only
function cyberchimps_next_previous_posts() {
    if( get_next_posts_link() || get_previous_posts_link() ): ?>
        <div class="more-content">
            <div class="row-fluid">
                <div class="span6 previous-post">
                    <?php previous_posts_link(); ?>
                </div>
                <div class="span6 next-post">
                    <?php next_posts_link(); ?>
                </div>
            </div>
        </div>
    <?php
    endif;
}
add_action( 'cyberchimps_after_content', 'cyberchimps_next_previous_posts' );

if ( ! function_exists( 'cyberchimps_theme_check' ) ) :
// core options customization Names and URL's
//Pro or Free has to stay prepended with cyberchimps_
    function cyberchimps_theme_check() {
        $level = 'free';
        return $level;
    }
endif;
//Theme Name
function cyberchimps_options_theme_name(){
    $text = 'iRibbon';
    return $text;
}
//Doc's URL
function cyberchimps_options_documentation_url() {
    $url = 'http://cyberchimps.com/help/';
    return $url;
}
// Support Forum URL
function cyberchimps_options_support_forum() {
    $url = 'http://cyberchimps.com/forum/free/';
    return $url;
}
//Page Options Help URL
function cyberchimps_options_page_options_help() {
    $url = 'http://cyberchimps.com/element-how-tos/';
    return $url;
}
// Slider Options Help URL
function cyberchimps_options_slider_options_help() {
    $url = 'http://cyberchimps.com/faq/how-to-use-the-ifeature-pro-slider/';
    return $url;
}
add_filter( 'cyberchimps_current_theme_name', 'cyberchimps_options_theme_name', 1 );
add_filter( 'cyberchimps_documentation', 'cyberchimps_options_documentation_url' );
add_filter( 'cyberchimps_support_forum', 'cyberchimps_options_support_forum' );
add_filter( 'cyberchimps_page_options_help', 'cyberchimps_options_page_options_help' );
add_filter( 'cyberchimps_slider_options_help', 'cyberchimps_options_slider_options_help' );

//upgrade bar
function cyberchimps_upgrade_title(){
    $title = 'iRibbon Pro 2';
    return $title;
}
function cyberchimps_upgrade_link(){
    $link = 'http://cyberchimps.com/iribbon-pro/';
    return $link;
}
add_filter( 'cyberchimps_upgrade_pro_title', 'cyberchimps_upgrade_title' );
add_filter( 'cyberchimps_upgrade_link', 'cyberchimps_upgrade_link' );

// Help Section
function cyberchimps_options_help_header() {
    $text = 'iRibbon';
    return $text;
}
function cyberchimps_options_help_sub_header(){
    $text = __( 'iRibbon an elegant and responsive WordPress Theme', 'cyberchimps' );
    return $text;
}

add_filter( 'cyberchimps_help_heading', 'cyberchimps_options_help_header' );
add_filter( 'cyberchimps_help_sub_heading', 'cyberchimps_options_help_sub_header' );

// Branding images and defaults

// Banner default
function cyberchimps_banner_default() {
    $url = '/images/branding/banner.jpg';
    return $url;
}
add_filter( 'cyberchimps_banner_img', 'cyberchimps_banner_default' );



//theme specific skin options in array. Must always include option default
function cyberchimps_skin_color_options( $options ) {
    // Get path of image
    $imagepath = get_template_directory_uri(). '/inc/css/skins/images/';

    $options = array(
        'default'	=> $imagepath . 'default.png'
    );
    return $options;
}
add_filter( 'cyberchimps_skin_color', 'cyberchimps_skin_color_options', 1 );

// theme specific background images
function cyberchimps_background_image( $options ) {
    $imagepath =  get_template_directory_uri() . '/cyberchimps/lib/images/';
    $options = array(
        'none' => $imagepath . 'backgrounds/thumbs/none.png',
        'noise' => $imagepath . 'backgrounds/thumbs/noise.png',
        'blue' => $imagepath . 'backgrounds/thumbs/blue.png',
        'dark' => $imagepath . 'backgrounds/thumbs/dark.png',
        'space' => $imagepath . 'backgrounds/thumbs/space.png'
    );
    return $options;
}
add_filter( 'cyberchimps_background_image', 'cyberchimps_background_image' );

// theme specific typography options
function cyberchimps_typography_sizes( $sizes ) {
    $sizes = array( '8','9','10','12','14','16','20' );
    return $sizes;
}
function cyberchimps_typography_faces( $faces ) {
    $faces = array(
        'Arial, Helvetica, sans-serif'						 => 'Arial',
        'Arial Black, Gadget, sans-serif'					 => 'Arial Black',
        'Comic Sans MS, cursive'							 => 'Comic Sans MS',
        'Courier New, monospace'							 => 'Courier New',
        'Georgia, serif'									 => 'Georgia',
        'Impact, Charcoal, sans-serif'						 => 'Impact',
        'Lucida Console, Monaco, monospace'					 => 'Lucida Console',
        'Lucida Sans Unicode, Lucida Grande, sans-serif'	 => 'Lucida Sans Unicode',
        'Palatino Linotype, Book Antiqua, Palatino, serif'	 => 'Palatino Linotype',
        'Tahoma, Geneva, sans-serif'						 => 'Tahoma',
        'Times New Roman, Times, serif'						 => 'Times New Roman',
        'Trebuchet MS, sans-serif'							 => 'Trebuchet MS',
        'Verdana, Geneva, sans-serif'						 => 'Verdana',
        'Symbol'											 => 'Symbol',
        'Webdings'											 => 'Webdings',
        'Wingdings, Zapf Dingbats'							 => 'Wingdings',
        'MS Sans Serif, Geneva, sans-serif'					 => 'MS Sans Serif',
        'MS Serif, New York, serif'							 => 'MS Serif',
    );
    return $faces;
}
function cyberchimps_typography_styles( $styles ) {
    $styles = array( 'normal' => 'Normal','bold' => 'Bold' );
    return $styles;
}
add_filter( 'cyberchimps_typography_sizes', 'cyberchimps_typography_sizes' );
add_filter( 'cyberchimps_typography_faces', 'cyberchimps_typography_faces' );
add_filter( 'cyberchimps_typography_styles', 'cyberchimps_typography_styles' );

/**
 * Adds extra div container to sidebar widget title
 *
 * @param $title
 *
 * @return string
 */
function cyberchimps_sidebar_before_widget_title( $title ) {
    $title = '<div class="cc-widget-title-container">' . $title;

    return $title;
}

add_action( 'cyberchimps_sidebar_before_widget_title', 'cyberchimps_sidebar_before_widget_title', 10, 1 );

/**
 * Finished extra div container to sidebar widget title
 *
 * @param $title
 *
 * @return string
 */
function cyberchimps_sidebar_after_widget_title( $title ) {
    $title = $title . '</div>';

    return $title;
}

add_action( 'cyberchimps_sidebar_after_widget_title', 'cyberchimps_sidebar_after_widget_title', 10, 1 );

// Set separator for post entry meta.
function cyberchimps_entry_meta_sep() {
    return '.';
}

add_filter( 'cyberchimps_entry_meta_sep', 'cyberchimps_entry_meta_sep' );

// Customize widget element before_title markup.
function cyberchimps_before_widget_title( $title ) {

    $before_title = '<div class="cc-widget-title-container">';

    $title = $before_title . $title;

    return $title;
}

add_filter( 'cyberchimps_before_widget_title', 'cyberchimps_before_widget_title', 10, 1 );

// Customize widget element after_title markup.
function cyberchimps_after_widget_title( $title ) {

    $after_title = '</div>';

    $title = $title . $after_title;

    return $after_title;
}

add_filter( 'cyberchimps_after_widget_title', 'cyberchimps_after_widget_title', 10, 1 );

function cyberchimps_after_widget( $after ) {
    $after_widget = '<div class="ribbon-bottom-container"><div class="ribbon-bottom"></div></div>';

    $after = $after_widget . $after;

    return $after;
}

add_action( 'cyberchimps_after_widget', 'cyberchimps_after_widget', 10, 1 );

// Add goggle font Lobster.
function cyberchimps_add_google_font() {

    // Check if SSL is present, if so then use https othereise use http
    $protocol = is_ssl() ? 'https' : 'http';
    ?>
    <link rel='stylesheet' href='<?php echo $protocol; ?>://fonts.googleapis.com/css?family=Lobster' type='text/css'>
<?php
}

add_action( 'wp_head', 'cyberchimps_add_google_font' );
?>