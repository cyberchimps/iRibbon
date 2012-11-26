<?php
/**
* Initializes the CyberChimps Response Core Framework
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

// Set path of core directory.
$core_path =  get_template_directory() . '/core/';

//Define custom core functions
require_once ( $core_path . 'core-functions.php' );

//Define the core hooks
require_once ( $core_path . 'core-hooks.php' );

//Call the action files

require_once ( $core_path . 'actions/sidebar-actions.php' );
require_once ( $core_path . 'actions/404-actions.php' );
require_once ( $core_path . 'actions/archive-actions.php' ); 
require_once ( $core_path . 'actions/comments-actions.php' );
require_once ( $core_path . 'actions/index-actions.php' );
require_once ( $core_path . 'actions/global-actions.php' );
require_once ( $core_path . 'actions/header-actions.php' );
require_once ( $core_path . 'actions/footer-actions.php' );
require_once ( $core_path . 'actions/pagination-actions.php' );
require_once ( $core_path . 'actions/twitterbar-actions.php' );
require_once ( $core_path . 'actions/page-actions.php' );
require_once ( $core_path . 'actions/search-actions.php' );
require_once ( $core_path . 'actions/slider-actions.php' );
require_once ( $core_path . 'actions/callout-actions.php' );


//Call metabox class file
require_once ( $core_path . 'metabox/meta-box-class.php' );

//CyberChimps Themes Page
require_once ( $core_path . 'classy-options/options-themes.php' );

/**
* End
*/

?>