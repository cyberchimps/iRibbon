/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	
  $("#section-ir_font").change(function() {
    if($(this).find(":selected").val() == 'custom') {
      $('#section-ir_custom_font').fadeIn();
    } else {
      $('#section-ir_custom_font').hide();
    }
  }).change();
  $("#section-ir_menu_font").change(function() {
    if($(this).find(":selected").val() == 'custom') {
      $('#section-ir_custom_menu_font').fadeIn();
    } else {
      $('#section-ir_custom_menu_font').hide();
    }
  }).change();
  $("#ir_show_excerpts").change(function() {
    var toShow = $("#section-ir_excerpt_link_text, #section-ir_excerpt_length");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
  $("#ir_show_featured_images").change(function() {
    var toShow = $("#section-ir_featured_image_align, #section-ir_featured_image_height, #section-ir_featured_image_width");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    $("#ir_disable_footer").change(function() {
    var toShow = $("#section-ir_footer_text, #section-ir_hide_link");
    if($(this).is(':checked')) {
      toShow.fadeIn();
    } else {
      toShow.fadeOut();
    }
  }).change();
    $("#ir_custom_logo").change(function() {
    var toShow = $("#section-ir_logo");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
    $("#ir_blog_custom_callout_options").change(function() {
    var toShow = $("#section-ir_blog_callout_text_color");
    if($(this).is(':checked')) {
      toShow.fadeIn();
    } else {
      toShow.fadeOut();
    }
  }).change();
  $("#ir_slider_type").change(function(){
    var val = $(this).val(),
      post = $("#section-ir_slider_category"),
      custom = $("#section-ir_customslider_category");
    if(val == 'custom') {
      post.hide(); custom.show();
    } else {
      post.show(); custom.hide();
    }
  }).change();
  
  
  $.each(['twitter', 'facebook', 'gplus', 'flickr', 'linkedin', 'pinterest', 'youtube', 'googlemaps', 'email', 'rsslink'], function(i, val) {
	  $("#section-ir_" + val).each(function(){
		  var $this = $(this), $next = $(this).next();
		  $this.find(".controls").css({float: 'left', clear: 'both'});
		  $next.find(".controls").css({float: 'right', width: 80});
		  $next.hide();
		  $this.find('.option').before($next.find(".option"));
		  $this.find("input[type='checkbox']").change(function() {
			  if($(this).is(":checked")) {
				  $(this).closest('.option').next().show();
			  } else {
				  $(this).closest('.option').next().hide();
			  }
		  }).change();
	  });
  });
});	

jQuery(function($) {
	var initialize = function(id) {
		var el = $("#" + id);
		function update(base) {
			var hidden = base.find("input[type='hidden']");
			var val = [];
			base.find('.right_list .list_items span').each(function() {
				val.push($(this).data('key'));
			});
			hidden.val(val.join(",")).change();
			el.find('.right_list .action').show();
			el.find('.left_list .action').hide();
		}
		el.find(".left_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).val('Add');
			$(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
			$(this).hide();
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").sortable({
			update: function() {
				update($(this).closest(".section_order"));
			},
			connectWith: '#' + id + ' .left_list .list_items'
		});

		el.find(".left_list .list_items").sortable({
			connectWith: '#' + id + ' .right_list .list_items'
		});

		update(el);
	}

	$('.section_order').each(function() {
		initialize($(this).attr('id'));
	});

	$("input[name='iribbon[ir_blog_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			response_blog_slider: "subsection-featureslider",
			response_callout_section: "subsection-calloutoptions",
			response_twitterbar_section: "subsection-twtterbaroptions",
			response_index_carousel_section: "subsection-carouseloptions"
			// , response_box_section: ""
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');
	
	$("input[name='iribbon[header_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			response_logo_contact: "section-ir_header_contact",
			response_custom_header_element: "section-ir_custom_header_element",
			response_banner: "section-ir_banner"
			// , response_box_section: ""
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');

});
