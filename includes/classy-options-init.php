<?php
/**
* Initializes the Response Theme Options
*
* Author: Tyler Cunningham
* Copyright: &#169; 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Response 
* @since 1.0.4
*/

require( get_template_directory() . '/core/classy-options/classy-options-framework/classy-options-framework.php');

add_action('init', 'chimps_init_options');

function chimps_init_options() {

global $options, $ir_themeslug, $ir_themename, $ir_themenamefull;
$options = new ClassyOptions($ir_themename, $ir_themenamefull." Options");

$terms2 = get_terms('category', 'hide_empty=0');

	$blogoptions = array();
                                    
	$blogoptions['all'] = "All";

    	foreach($terms2 as $term) {

        	$blogoptions[$term->slug] = $term->name;

        }
$options
	->section("Welcome")
		->info("<h1>iRibbon</h1>
		
<p><strong>An elegant Responsive Wordpress Theme Framework that looks great on big and small screens alike.</strong></p>

<p><a href='http://cyberchimps.com/iribbonpro/' target='_blank'>Upgrade to iRibbon Pro for just $25!</a></p>

<p>iRibbon is based around a Responsive Design (which magically adjusts to mobile devices such as the iPhone and iPad), Responsive Navigation, Responsive Slider, Drag & Drop Header Elements, Page and Blog Elements, simplified Theme Options, and is built with HTML5 and CSS3. Upgrade to iRibbon Pro for even more Drag & Drop Elements.</p>

<p>To get started simply work your way through the options below, add your content, and always remember to hit save after making any changes.</p>

<p>The Main iRibbon Slider options are under the iRibbon Blog Options below, this will set the Slider up for your blog page. However you can also add a Slider to every page you have by changing the options in the relevant page edit screen. This way you can configure each page individually. You will also find the Drag & Drop Page Elements editor within the iRibbon Page Options as well.</p>

<p>We tried to make iRibbon as easy to use as possible, but if you still need help please read the <a href='http://cyberchimps.com/iribbon/docs/' target='_blank'>documentation</a>, and visit our <a href='http://cyberchimps.com/forum/' target='_blank'>support forum</a>.</p>

<p>Thank you for choosing iRibbon and enjoy using it.</p>
")
	->section("Design")
		->open_outersection()
			->select($ir_themeslug."_skin_color", "Select a Skin Color", array( 'options' => array("default" => "Teal and Orange (default)", "orange" => "Blue and Orange", "red" => "Green and Red"), 'default' => 'default'))
		->close_outersection()
		->subsection("Typography")
			->select($ir_themeslug."_font", "Choose a Font", array( 'options' => array("Arial" => "Arial (default)", "Courier New" => "Courier New", "Georgia" => "Georgia", "Helvetica" => "Helvetica", "Lucida Grande" => "Lucida Grande", "Tahoma" => "Tahoma", "Times New Roman" => "Times New Roman", "Verdana" => "Verdana", "Maven+Pro" => "Maven Pro", "Ubuntu" => "Ubuntu")))
		->subsection_end()
		->open_outersection()
				->textarea($ir_themeslug."_css_options", "Custom CSS")
			->close_outersection()
		->section("Header")
		->open_outersection()
			->section_order("header_section_order", "Drag & Drop Header Elements", array('options' => array("response_logo_icons" => "Logo + Icons", "response_banner" => "Banner", "response_custom_header_element" => "Custom", "response_navigation" => "Menu"), 'default' => 'response_logo_icons,response_navigation'))	
			->textarea($ir_themeslug."_custom_header_element", "Custom HTML")
		->close_outersection()
		->subsection("Banner Options")
			->upload($ir_themeslug."_banner", "Banner Image")
			->text($ir_themeslug."_banner_url", "Banner URL", array('default' => home_url()))
		->subsection_end()		
			->subsection("Header Options")
			->checkbox($ir_themeslug."_custom_logo", "Custom Logo" , array('default' => true))
			->upload($ir_themeslug."_logo", "Logo", array('default' => array('url' => TEMPLATE_URL . '/images/responselogo.png')))
			->upload($ir_themeslug."_favicon", "Custom Favicon")
			->upload($ir_themeslug."_apple_touch", "Apple Touch Icon", array('default' => array('url' => TEMPLATE_URL . '/images/apple-icon.png')))
		->subsection_end()
		->subsection("Social")
			->images($ir_themeslug."_icon_style", "Icon set", array( 'options' => array('legacy' => TEMPLATE_URL . '/images/social/thumbs/icons-classic.png', 'default' =>
TEMPLATE_URL . '/images/social/thumbs/icons-default.png' ), 'default' => 'default' ) )
			->text($ir_themeslug."_twitter", "Twitter Icon URL", array('default' => 'http://twitter.com'))
			->checkbox($ir_themeslug."_hide_twitter_icon", "Hide Twitter Icon", array('default' => true))
			->text($ir_themeslug."_facebook", "Facebook Icon URL", array('default' => 'http://facebook.com'))
			->checkbox($ir_themeslug."_hide_facebook_icon", "Hide Facebook Icon" , array('default' => true))
			->text($ir_themeslug."_gplus", "Google + Icon URL", array('default' => 'http://plus.google.com'))
			->checkbox($ir_themeslug."_hide_gplus_icon", "Hide Google + Icon" , array('default' => true))
			->text($ir_themeslug."_flickr", "Flickr Icon URL", array('default' => 'http://flikr.com'))
			->checkbox($ir_themeslug."_hide_flickr", "Hide Flickr Icon")
			->text($ir_themeslug."_linkedin", "LinkedIn Icon URL", array('default' => 'http://linkedin.com'))
			->checkbox($ir_themeslug."_hide_linkedin", "Hide LinkedIn Icon")
			->text($ir_themeslug."_pinterest", "Pinterest Icon URL", array('default' => 'http://pinterest.com'))
			->checkbox($ir_themeslug."_hide_pinterest", "Hide Pinterest Icon")
			->text($ir_themeslug."_youtube", "YouTube Icon URL", array('default' => 'http://youtube.com'))
			->checkbox($ir_themeslug."_hide_youtube", "Hide YouTube Icon")
			->text($ir_themeslug."_googlemaps", "Google Maps Icon URL", array('default' => 'http://maps.google.com'))
			->checkbox($ir_themeslug."_hide_googlemaps", "Hide Google maps Icon")
			->text($ir_themeslug."_email", "Email Address")
			->checkbox($ir_themeslug."_hide_email", "Hide Email Icon")
			->text($ir_themeslug."_rsslink", "RSS Icon URL")
			->checkbox($ir_themeslug."_hide_rss_icon", "Hide RSS Icon" , array('default' => true))
		->subsection_end()
		->subsection("Tracking and Scripts")
			->textarea($ir_themeslug."_ga_code", "Google Analytics Code")
			->textarea($ir_themeslug."_custom_header_scripts", "Custom Header Scripts")
		->subsection_end()
	->section("Blog")
		->open_outersection()
			->section_order($ir_themeslug."_blog_section_order", "Drag & Drop Blog Elements", array('options' => array("response_index" => "Post Page", "response_blog_slider" => "Feature Slider",  "response_callout_section" => "Callout Section"), "default" => 'response_blog_slider,response_index'))
		->close_outersection()
		->subsection("Blog Options")
			->images($ir_themeslug."_blog_sidebar", "Sidebar Options", array( 'options' => array("none" => TEMPLATE_URL . '/images/options/none.png',"left" => TEMPLATE_URL . '/images/options/left.png',  "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ir_themeslug."_post_formats", "Post Format Icons",  array('default' => true))
			->checkbox($ir_themeslug."_show_excerpts", "Post Excerpts")
			->text($ir_themeslug."_excerpt_link_text", "Excerpt Link Text", array('default' => '(More)&#8230;'))
			->text($ir_themeslug."_excerpt_length", "Excerpt Character Length", array('default' => '55'))
			->checkbox($ir_themeslug."_show_featured_images", "Featured Images")
			->select($ir_themeslug."_featured_image_align", "Featured Image Alignment", array( 'options' => array("key1" => "Left", "key2" => "Center", "key3" => "Right")))
			->text($ir_themeslug."_featured_image_height", "Featured Image Height", array('default' => '100'))
			->text($ir_themeslug."_featured_image_width", "Featured Image Width", array('default' => '100'))
			->checkbox($ir_themeslug."_featured_image_crop", "Crop Images", array('default' => true))		
			->multicheck($ir_themeslug."_hide_byline", "Post Byline Elements", array( 'options' => array($ir_themeslug."_hide_author" => "Author" , $ir_themeslug."_hide_categories" => "Categories", $ir_themeslug."_hide_date" => "Date", $ir_themeslug."_hide_comments" => "Comments",  $ir_themeslug."_hide_tags" => "Tags"), 'default' => array( $ir_themeslug."_hide_tags" => true, $ir_themeslug."_hide_author" => true, $ir_themeslug."_hide_date" => true, $ir_themeslug."_hide_comments" => true, $ir_themeslug."_hide_categories" => true ) ) )
		->subsection_end()
		->subsection("Feature Slider")
			->upload($ir_themeslug."_blog_slide_one_image", "Slide One Image", array('default' => array('url' => TEMPLATE_URL . '/images/responseslider.jpg')))
			->text($ir_themeslug."_blog_slide_one_url", "Slide One Link", array('default' => 'http://cyberchimps.com'))
			->upload($ir_themeslug."_blog_slide_two_image", "Slide Two", array('default' => array('url' => TEMPLATE_URL . '/images/responseslider.jpg')))
			->text($ir_themeslug."_blog_slide_two_url", "Slide Two Link", array('default' => 'http://cyberchimps.com'))
			->upload($ir_themeslug."_blog_slide_three_image", "Slide Three", array('default' => array('url' => TEMPLATE_URL . '/images/responseslider.jpg')))
			->text($ir_themeslug."_blog_slide_three_url", "Slide Three Link", array('default' => 'http://cyberchimps.com'))
		->subsection_end()
		->subsection("Callout Options")
			->textarea($ir_themeslug."_blog_callout_text", "Enter your Callout text")
		->subsection_end()
		->section("Templates")
		->subsection("Single Post")
			->images($ir_themeslug."_single_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ir_themeslug."_single_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($ir_themeslug."_single_show_featured_images", "Featured Images")
			->checkbox($ir_themeslug."_single_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($ir_themeslug."_single_hide_byline", "Post Byline Elements", array( 'options' => array($ir_themeslug."_hide_author" => "Author" , $ir_themeslug."_hide_categories" => "Categories", $ir_themeslug."_hide_date" => "Date", $ir_themeslug."_hide_comments" => "Comments",  $ir_themeslug."_hide_tags" => "Tags"), 'default' => array( $ir_themeslug."_hide_tags" => true, $ir_themeslug."_hide_author" => true, $ir_themeslug."_hide_date" => true, $ir_themeslug."_hide_comments" => true, $ir_themeslug."_hide_categories" => true ) ) )
			->checkbox($ir_themeslug."_post_pagination", "Post Pagination Links",  array('default' => true))
		->subsection_end()	
		->subsection("Archive")
			->images($ir_themeslug."_archive_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ir_themeslug."_archive_breadcrumbs", "Breadcrumbs", array('default' => true))
			->checkbox($ir_themeslug."_archive_show_excerpts", "Post Excerpts", array('default' => true))
			->checkbox($ir_themeslug."_archive_show_featured_images", "Featured Images")
			->checkbox($ir_themeslug."_archive_post_formats", "Post Format Icons",  array('default' => true))
			->multicheck($ir_themeslug."_archive_hide_byline", "Post Byline Elements", array( 'options' => array($ir_themeslug."_hide_author" => "Author" , $ir_themeslug."_hide_categories" => "Categories", $ir_themeslug."_hide_date" => "Date", $ir_themeslug."_hide_comments" => "Comments",  $ir_themeslug."_hide_tags" => "Tags"), 'default' => array( $ir_themeslug."_hide_tags" => true, $ir_themeslug."_hide_author" => true, $ir_themeslug."_hide_date" => true, $ir_themeslug."_hide_comments" => true, $ir_themeslug."_hide_categories" => true ) ) )
			->subsection_end()
		->subsection("Search")
			->images($ir_themeslug."_search_sidebar", "Sidebar Options", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->checkbox($ir_themeslug."_search_show_excerpts", "Post Excerpts", array('default' => true))
		->subsection_end()
		->subsection("404")
			->images($ir_themeslug."_404_sidebar", "Select the Sidebar Type", array( 'options' => array("left" => TEMPLATE_URL . '/images/options/left.png', "none" => TEMPLATE_URL . '/images/options/none.png', "right" => TEMPLATE_URL . '/images/options/right.png'), 'default' => 'right'))
			->textarea($ir_themeslug."_custom_404", "Custom 404 Content")
		->subsection_end()
	->section("Footer")
		->open_outersection()
			->text($ir_themeslug."_footer_text", "Footer Copyright Text")
		->close_outersection()	
;
}
