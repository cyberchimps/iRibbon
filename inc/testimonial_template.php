<?php
/* Testimonial */

// Modifying testimonial fields in page
add_filter('cyberchimps_testimonial_metabox_fields', 'iribbon_testimonial_page_metabox_fields');

function iribbon_testimonial_page_metabox_fields( $fields )
{
	$fields[] = array(
			'name'    => __( 'Testimonial title', 'cyberchimps_core' ),
			'id'      => 'ht_testimonial_title',
			'class'   => '',
			'std'     => '',
			'type'    => 'text'			
		);
	

	return $fields;
}


// Modifying testimonial for each post type- testimonial
add_filter('cyberchimps_testimonial_single_metabox_fields', 'iribbon_testimonial_each_metabox_fields');

function iribbon_testimonial_each_metabox_fields( $fields )
{
	// remove testimonial text as text and add as textarea
	$elements = count($fields);
	for( $i = 0; $i < $elements; $i++ )
	{
		if( array_key_exists('id', $fields[$i]) )
		{
			switch($fields[$i]['id'])
			{
				case 'testimonial_text': unset( $fields[$i] ); break;
			}

	    }
		
	}
	$fields[] = array(
			'name'    => __( 'About the author', 'cyberchimps_core' ),
			'id'      => 'ht_testimonial_abt_author',
			'class'   => '',
			'std'     => '',
			'type'    => 'text'			
		);
	$fields[] = array(
			'name'    => __( 'Testimonial text', 'cyberchimps_core' ),
			'id'      => 'ht_testimonial_text',
			'class'   => '',
			'std'     => '',
			'type'    => 'textarea'			
		);

	return $fields;
}

// frontend display
function iribbon_testimonial_render_display()
{
	global $post;

	if(is_page())
	{
		$ht_testimonial_title = get_post_meta( $post->ID, 'ht_testimonial_title', true );
		$ht_testimonial_desc = get_post_meta( $post->ID, 'ht_testimonial_desc', true );
		$testimonial_background = get_post_meta( $post->ID, 'testimonial_background', true );
		$testimonial_category = get_post_meta( $post->ID, 'testimonial_category', true );			

	}
	else
	{
		$ht_testimonial_title = cyberchimps_get_option('ht_testimonial_title');
		$ht_testimonial_desc = cyberchimps_get_option('ht_testimonial_desc');
		$testimonial_background = cyberchimps_get_option('testimonial_background');
		$testimonial_category = cyberchimps_get_option( 'testimonial_categories');
	} 
        $skin_color = cyberchimps_get_option('cyberchimps_skin_color');
        ?>
	<?php 
        if($testimonial_background)
        {
        ?>
                <style type="text/css" media="all">
                                                                #testimonial_section{ 
                                                                        background : url("<?php echo $testimonial_background; ?>") no-repeat scroll 0 0 / cover;
                                                                        background-position:center;
                                                                }	
                </style>
        <?php
        }
        else
        {
          if($skin_color == 'black-red') 
          {
              
          ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#cd0a00';?>;
                      }
            </style>
           <?php
          }
          if($skin_color == 'blue-orange') 
          {
           ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#135771';?>;
                      }
            </style>
           <?php   
          }
          if($skin_color == 'red-green') 
          {
             ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#859950';?>;
                      }
            </style>
           <?php 
          }
          else
          {
            ?>
            <style>
                      #testimonial_section{
                          background-color: <?php echo '#7fa6a6';?>;
                      }
            </style>
            <?php
              
          }
          
        
        }
        ?>
					
<?php
	$testimonial_args = array(
					'numberposts'         => 3,
					'offset'              => 0,
					'testimonial_categories' => $testimonial_category,
					'orderby'             => 'post_date',
					'order'               => 'ASC',
					'post_type'           => 'testimonial_posts',
					'post_status'         => 'publish',
					'suppress_filters'    => false
				);
		
				$testimonial_posts2 = get_posts( $testimonial_args );

?>
	<div id="ht_testimonial_top">
		<?php if( !empty($ht_testimonial_title) || !empty($ht_testimonial_desc) ) { ?>
			
		
				<?php if(!empty($ht_testimonial_title)) { ?>
				<h2 class="ht_main_title">
					<?php echo $ht_testimonial_title; ?>
				</h2>
				<?php } ?>
		
			
		<?php } ?>
	</div> 


      <section class="ht_slider_text_img">
        <div id="slider2" class="flexslider">
          <ul class="slides">
			<?php	foreach( $testimonial_posts2 as $post3 ) {
                           

					/* Post-specific variables */
					$testimonial_author    = get_post_meta( $post3->ID, 'testimonial_author_name', true );
					$testimonial_text    = get_post_meta( $post3->ID, 'ht_testimonial_text', true );
					$ht_testimonial_abt_author = get_post_meta( $post3->ID, 'ht_testimonial_abt_author', true ); ?>

				<li class="col-md-12">
					<span class="ht_testimonial_text"><?php echo $testimonial_text; ?></span>
					<?php if(!empty($testimonial_text))
							{ ?>
							<hr class="after_testimonial_text"> </hr>
					<?php } ?>
					<div class="ht_testimonial_author">
						<?php echo $testimonial_author; ?>
					</div>
					<div class="ht_testimonial_abt_author">
						<?php echo $ht_testimonial_abt_author; ?>
					</div>
				</li>
			<?php  } ?>
    		
            
          </ul>
        </div>
	<?php $slide_counters = 0; ?>
        <div id="carousel2" class="flexslider">
          <ul class="slides ht_carousel" >
			<?php	foreach( $testimonial_posts2 as $post2 ) {

					/* Post-specific variables */
					$image    = get_post_meta( $post2->ID, 'testimonial_post_image', true );
					?>
					
 					<li class="col-md-4"> 
						<a id="carousel-selector-<?php echo $slide_counters; ?>" class="<?php echo ( $slide_counters == 0 ) ? "selected" : ""; ?>">
                            <img src="<?php echo $image; ?>" class="img-responsive">
							
                        </a>
						
					</li>
			<?php  $slide_counters++; 
					} ?>
  	    		
            
          </ul>
        </div>
      </section> 
  
	<script type="text/javascript" charset="utf-8">
	(function($) {

	// store the slider in a local variable
	  var $window = $(window),
		  flexslider = { vars:{} };
	 
	  // tiny helper function to add breakpoints
	  function getGridSize() {
		return (window.innerWidth < 480) ? 70 :
			   (window.innerWidth < 767) ? 90 :
		       (window.innerWidth < 1200) ? 100 : 130;
	  }
	 
	$(window).load(function() {
		 $('#carousel2').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: false,
			slideshowSpeed: 7000,
			itemWidth: getGridSize(),
			itemMargin: 20,
			asNavFor: '#slider2'
		  });
		 
		  $('#slider2').flexslider({
			animation: "slide",
			controlNav: false,
			directionNav: false,
			animationLoop: true,
			slideshow: false,
			slideshowSpeed: 7000,
			sync: "#carousel2"
		  });
		});
		// check grid size on resize event
	  $window.resize(function() {
		var gridSize = getGridSize();
	 
		flexslider.vars.itemWidth = gridSize;
	  });
						})(jQuery);
			</script> 


<?php
}
