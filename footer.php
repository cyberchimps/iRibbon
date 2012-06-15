<?php 
/**
* Footer template used by the CyberChimps Response Core Framework
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

	global $options, $themeslug // call globals

?>
	
<?php if ($options->get($themeslug.'_disable_footer') != "0"):?>	

</div><!--end container wrap-->
<footer class="footer-container">
    <div class="container-fluid">
     		<div class="row-fluid">
	<!-- Begin @response footer hook content-->
		<?php response_footer(); ?>
	<!-- End @response footer hook content-->
	<?php endif;?>
	

			</div><!--row-->
      </div><!-- container -->

<?php if ($options->get($themeslug.'_disable_afterfooter') != "0"):?>

	<div id="afterfooter" class="container-fluid">
		<div class="row-fluid" id="afterfooterwrap">	
		<!-- Begin @response afterfooter hook content-->
			<?php response_secondary_footer(); ?>
		<!-- End @response afterfooter hook content-->
				
		</div> <!--end afterfooter wrap-->	
    </div> <!-- end afterfooter -->
  </footer>
	<?php endif;?>
	
	<?php wp_footer(); ?>	
</body>
</div><!-- closes iribbon-content-margin found in header.php -->
</html>
