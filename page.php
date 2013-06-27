<?php 
/**
* Page template used by the CyberChimps Response Core Framework
*
* Authors: Tyler Cunningham, Trent Lapinski
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

/* Header call. */

	get_header(); 
	
/* End header. */	

/* Define global variables. */
	global $post;
	$page_section_order = get_post_meta($post->ID, 'page_section_order' , true);
	if(!$page_section_order) {
		$page_section_order = 'breadcrumbs,page_section';
	}
/* End define global variables. */

?>	
<div class="container-fluid"> 
	<?php
	// Checking for password protection.
	if( ! post_password_required() ) {
		foreach(explode(",", $page_section_order) as $key) {
			$fn = 'response_' . $key;
			if(function_exists($fn)) {
				call_user_func_array($fn, array());
			}
		}
	}
	else {
	?>
		<!-- Get the form to submit password -->
		<div id="content" class="span8">
			<div class="post_container">
				<?php echo get_the_password_form(); ?>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
	<?php
	} ?>
</div><!--end container-->
	
<?php get_footer(); ?>