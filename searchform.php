<?php 
/**
* Searchform template used by the CyberChimps Response Core Framework
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

	global $options, $themeslug, $post, $sidebar, $content_grid; // call globals
	response_sidebar_init(); // sidebar init
	get_header(); // call header

?>
<h2 class="widget-title">Search</h2>
<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<div class="search-container">
  <input type="text" name="s" class="iRibbon-search" value="<?php printf( __( 'Search', 'response' )); ?>" id="searchsubmit" onfocus="if (this.value == 'Search') this.value = '';" />
	<button class="search-button" value="Submit search" ></button>
  </div>
</form>