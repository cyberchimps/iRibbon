<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @usage: please read document at project homepage and meta-box-usage.php file
 * @version: 3.0.1
 */
 

/********************* BEGIN DEFINITION OF META BOXES ***********************/

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global  $themename, $themeslug, $themenamefull, $options; // call globals.
	
	// Call taxonomies for select options
	
	$carouselterms = get_terms('carousel_categories', 'hide_empty=0');
	$carouseloptions = array();

		foreach($carouselterms as $term) {
			$carouseloptions[$term->slug] = $term->name;
		}

	$terms = get_terms('slide_categories', 'hide_empty=0');
	$slideroptions = array();

		foreach($terms as $term) {
			$slideroptions[$term->slug] = $term->name;
		}

	$terms2 = get_terms('category', 'hide_empty=0');
	$blogoptions = array();
	$blogoptions['all'] = "All";

		foreach($terms2 as $term) {
			$blogoptions[$term->slug] = $term->name;
		}
	
	// End taxonomy call
	
	$meta_boxes = array();

	$mb = new Chimps_Metabox('post_slide_options', $themenamefull.' Slider Options', array('pages' => array('post')));
	$mb
		->tab("Slider Options")
			->single_image($themeslug.'_slider_image', 'Slider Image', '')
			->text($themeslug.'_slider_text', 'Slider Text', 'Enter your slider text here')
			->checkbox($themeslug.'_slider_hidetitle', 'Title Bar', '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', 'Custom Thumbnail', 'Use the image uploader to upload a custom navigation thumbnail')
			->sliderhelp('', 'Need Help?', '')
		->end();
		
	$mb = new Chimps_Metabox('Carousel', 'Featured Post Carousel', array('pages' => array($themeslug.'_featured_posts')));
	$mb
		->tab("Featured Post Carousel Options")
			->text($themeslug.'_post_title', 'Featured Post Title', '')
			->single_image($themeslug.'_post_image', 'Featured Post Image', '')
			->text($themeslug.'_post_url', 'Featured Post URL', '')
			->reorder($themeslug.'_reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('slides', 'Custom Feature Slides', array('pages' => array($themeslug.'_custom_slides')));
	$mb
		->tab("Custom Slide Options")
			->text($themeslug.'_slider_caption', 'Custom Slide Caption', '')
			->text($themeslug.'_slider_url', 'Custom Slide Link', '')
			->single_image($themeslug.'_slider_image', 'Custom Slide Image', '')
			->checkbox($themeslug.'_slider_hidetitle', 'Slide Title Bar', '', array('std' => 'on'))
			->single_image($themeslug.'_slider_custom_thumb', 'Custom Thumbnail', '')
			->sliderhelp('', 'Need Help?', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();

	$mb = new Chimps_Metabox('pages', $themenamefull.' Page Options', array('pages' => array('page')));
	$mb
		->tab("Page Options")
			->image_select($themeslug.'_page_sidebar', 'Select Page Layout', '',  array('options' => array(TEMPLATE_URL . '/images/options/right.png' , TEMPLATE_URL . '/images/options/left.png', TEMPLATE_URL . '/images/options/none.png')))
			->checkbox($themeslug.'_hide_page_title', 'Page Title', '', array('std' => 'on'))
			->section_order('page_section_order', 'Page Elements', '', array('options' => array(
					'page_slider' => 'Feature Slider',
					'callout_section' => 'Callout',
					'twitterbar_section' => 'Twitter Bar',
					'page_section' => 'Page',
					'box_section' => 'Boxes',
					'breadcrumbs' => 'Breadcrumbs',
					'carousel_section' => 'Carousel'
					),
					'std' => 'breadcrumbs,page_section'
				))

			->pagehelp('', 'Need Help?', '')
		->tab($themenamefull." Slider Options")
			->select($themeslug.'_page_slider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select($themeslug.'_slider_category', 'Custom Slide Category', '', array('options' => $slideroptions) )
			->select($themeslug.'_slider_blog_category', 'Blog Post Category', '', array('options' => $blogoptions, 'all') )
			->text($themeslug.'_slider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text($themeslug.'_slider_height', 'Slider Height', '', array('std' => '340'))
			->text($themeslug.'_slider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select($themeslug.'_page_slider_animation', 'Slider Animation Type', '', array('options' => array('Horizontal-Push (default)', 'Fade', 'Horizontal-Slide', 'Vertical-Slide')) )
			->select($themeslug.'_page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array('Dots (default)', 'Thumbnails', 'None')) )
			->select($themeslug.'_page_slider_caption_style', 'Slider Caption Style', '', array('options' => array('None (default)', 'Bottom', 'Left', 'Right')) )
			->checkbox($themeslug.'_hide_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox($themeslug.'_enable_wordthumb', 'WordThumb Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Callout Options")
			->textarea($themeslug.'_callout_text', 'Callout Text', '')
			->checkbox($themeslug.'_extra_callout_options', 'Custom Callout Options', '', array('std' => 'off'))
			->color($themeslug.'_custom_callout_text_color', 'Custom Text Color', '')
			->pagehelp('', 'Need help?', '')
		->tab("Carousel Options")
			->select($themeslug.'_carousel_category', 'Carousel Category', '', array('options' => $carouseloptions) )
			->text($themeslug.'_carousel_speed', 'Carousel Animation Speed (ms)', '', array('std' => '750'))
		->tab("Twitter Options")
			->text($themeslug.'_twitter_handle', 'Twitter Handle', '')
			->checkbox($themeslug.'_twitter_reply', 'Show @ Replies', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}
