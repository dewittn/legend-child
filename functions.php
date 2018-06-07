<?php


/**  Add Your Functions Below **/

/* Include Nelson's Patched Options Panel */
if(is_admin()) {
    require_once(get_stylesheet_directory() .  '/options/options_panel.php');
}

// Unload theme functions and load modified versions
function child_remove_parent_function() {
    remove_action('admin_menu', 'misfit_add_admin');
    add_action('admin_menu', 'patched_misfit_add_admin');
    remove_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');
    add_action('wp_ajax_of_ajax_post_action', 'patched_of_ajax_callback');
    remove_shortcode('video');
    add_shortcode('video', 'modified_scribe_video_sc');
    remove_shortcode('accordion_content');
    add_shortcode('accordion_content', 'modified_accordion_content_sc');
}
add_action( 'wp_loaded', 'child_remove_parent_function' );


// Custom Myme Type to allow .epub files
function custom_myme_types($mime_types){

    //Adding epub extension
    $mime_types['epub'] = 'application/epub+zip'; 

    return $mime_types;
}

add_filter('upload_mimes', 'custom_myme_types', 1, 1);



/* -------------------------------------------------- */
/*	Modified Video Embed
/* -------------------------------------------------- */
// Video embeds now loads using https requests

function modified_scribe_video_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'youtube' => '',
		'vimeo'   => '',
	), $atts ) );
	
	$output = '<div class="videobox"><div class="video-container">';
	
	if( $youtube )
		$output .= '<iframe width="720" height="394" src="https://www.youtube.com/embed/'. esc_attr( $youtube )  .'" allowfullscreen></iframe>';
		
	if($vimeo)	
		$output .= '<iframe src="https://player.vimeo.com/video/'. esc_attr( $vimeo )  .'" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	
	if($content)
		$output .= ''. $content  .'';

	$output .= '</div></div>';

	return $output;

}


/* -------------------------------------------------- */
/*	Modified Accordion Content
/* -------------------------------------------------- */

// Removed extra <div> element form Accordion content, that was causing layout issues
function modified_accordion_content_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title'      => '',
		'title_size' => 'span',
		'icon'       => '',
		'mode'       => ''
	), $atts ) );

  $output = '<ul id="toggle-view"><li><h3>';
    
  if( $icon )
      $output .= '<i class="fa '. esc_attr( $icon )  .'" aria-hidden="true"></i> ';

	$output .=  esc_attr( $title ) . '</h3><div class="panel"><p>' . do_shortcode( $content ) . '<p></div></li></ul>';
	
	return $output;

}


//.................. Nelson's New Functions .................. //

if ( ! function_exists( 'default_value' ) ) :
  /*
    Checks a string passed to it, usually a database settind, to see if it is empty. 
    If the string is empty the '$default' value is returned.    
  */
  function default_value($var, $default) {
      if (empty($var)) {
          $var = $default;
      } 
      return $var;
  }
endif; // default_value ()

if ( ! function_exists( 'get_home_body' ) ) :
  /*
    Replaces the code that generates the Home Body sections
  */
  function get_home_body () {
      
  	$std = default_value(get_option('misfit_sections'), "Blog,Content,Portfolio");
      $saved_sections = explode(',', $std);
      foreach ($saved_sections as $value) {
      	switch ($value) {
      
      		case "Blog":
      			//  home blog
      			get_template_part( 'library/home', 'blog' );
      			echo '<!-- Blog Section -->';
      		break;
      
      		case "Content":
      
      			// home content
      			if( 'true' == get_option('misfit_showpage') ) {
          			get_template_part( 'library/home', 'content' );
      			}
      
      		break;
      
      		case "Portfolio":
      			// home portfolio
      			$ports = get_page_with_template('page_portfolio');
      		        
      			if( 'true' == get_option('misfit_showport') ) {
          			get_template_part( 'library/home', 'portfolio' );
      			}
      			
      		break;
      	}
      }
  }
endif; // get_home_body ()

if ( ! function_exists( 'get_portfolio_label' ) ) :
  // Returns the portfolio_label text
  function get_portfolio_label () {
      echo default_value(get_option('misfit_showlabel'), "Portfolio");
  }
endif; // get_portfolio_label ()

if ( ! function_exists( 'dequeue_scripts' ) ) :
/* Deregisters multiple scripts */
function dequeue_scripts () {
    $scripts = func_get_args();
    foreach($scripts as $script) {
        wp_dequeue_script($script);
    }
}
endif; // dequeue_scripts ()

if ( ! function_exists( 'dequeue_styles' ) ) :
/* Deregisters multiple stylesheets */
function dequeue_styles () {
    $styles = func_get_args();
    foreach($styles as $style) {
        wp_dequeue_style($style);
    }
}
endif; // dequeue_styles ()

if ( ! function_exists( 'load_single_resources' ) ) :
    //Remove unnecessary resources from home page type 'single'
    function load_single_resources () {
        dequeue_scripts('modernizr','stick','lightbox');
        dequeue_styles('lightbox','bigvideo','carousel','jscrollpane');
    }
endif; // load_single_resources ()

if ( ! function_exists( 'load_slider_resources' ) ) :
    //Removes & loads resources for home page type 'single'
    function load_slider_resources(){
        //Remove unnecessary resources
        dequeue_scripts('modernizr','stick','lightbox');
        dequeue_styles('lightbox','bigvideo','carousel','jscrollpane');
        
        // Load supersied JS and CSS
        echo '<!-- Fullscreen Slider -->';
  	    wp_enqueue_style('supersized', get_template_directory_uri() . '/css/supersized.css');
  	    wp_enqueue_style('shutter', get_template_directory_uri() . '/css/supersized.shutter.css');
        wp_enqueue_script('supersized', get_url_for('/js/supersized.3.2.7.min.js'));
        wp_enqueue_script('supersized-shutter', get_url_for('/js/supersized.shutter.min.js'));
        wp_enqueue_script('images', get_url_for('/js/images.js'), array('supersized','supersized-shutter'));
        
        // Set options for Superized slider
        $supersize_option = get_option('misfit_slidertransitions');
        
        switch ($supersize_option) {
            case 'Slide Top':
                $supersize_num = 2;
                break;
            case 'Slide Right':
                $supersize_num = 3;
                break;
            case 'Slide Bottom':
                $supersize_num = 4;
                break;
            case 'Slide Left':
                $supersize_num = 5;
                break;
            case 'Carousel Right':
                $supersize_num = 6;
                break;
            case 'Carousel Left':
                $supersize_num = 7;
                break;
            default:
                $supersize_num = 1;
        }
        
        // Image data for slider gets embeded into the page using CDATA, eliminating the need to make a second php DB call after page has loaded
        $pagename = get_option('misfit_sliderpage');
        $page = get_page_by_title($pagename);
        $featured_id =  $page->ID;
        $image_arry = array();
        
        $misfit_WP_Args = array(
        	'post_type' => 'page',
        	'p' => $featured_id,
        	'posts_per_page' => -1,
        	'no_found_rows' => true,
        	'update_post_term_cache' => false,
        );
        $misfit_WP_Query = new WP_Query( $misfit_WP_Args );
        
        if ( $misfit_WP_Query->have_posts() ) : 
        
            while ( $misfit_WP_Query->have_posts() ) : 
                $misfit_WP_Query->the_post();
        
            	$galleryImages = misfit_themes_get_post_gallery_imagess(); 
            	$imagesCount = count($galleryImages);
            
                if ($imagesCount > 0) {
                	for ($i = 0; $i < $imagesCount; $i++) {
                		if (!empty($galleryImages[$i])) {
                			$img_full = $galleryImages[$i]['full'][0];
                			$posts = get_post($galleryImages[$i]['id']);
                            array_push($image_arry, array('image' => $img_full, 'title' => '<h4>'.$posts->post_content.'</h4><h1>'.$post->post_excerpt.'</h1>', 'thumb' => '', 'url' => '') );
                		}
                	} 
                } 
            endwhile; 
            wp_reset_postdata(); 
        endif;
        
        // Pass options onto JS as CDATA embed into page
        wp_localize_script( 'images', 'js_data', array('supersize_num' => $supersize_num, 'images' => $image_arry ) );
    }
endif; // load_slider_resources ()


if ( ! function_exists( 'get_home_intro' ) ) :
/*
    Loads resources and template part for each home page type 
*/
function get_home_intro () {
    $hometype = get_option('misfit_hometype');
    switch ($hometype) {
        case "1": // Single Image
            add_action('wp_footer', 'load_single_resources');
            get_template_part ('/library/home_variations/home', 'single_image');
            break;
        case "2": // Slider 
//             if( (is_home() && get_option('misfit_hometype') == "2") || ( is_page() && is_page_template('hp_slide.php') ) )
            add_action('wp_footer', 'load_slider_resources');
            get_template_part ('/library/home_variations/home', 'slider');
            break;
        case "3": // Video
            
            get_template_part ('/library/home_variations/home', 'video');
            break;
        case "4": // Single Page
            include_banner ();
            get_template_part ('/library/home_variations/home', 'full');
            echo '<div class="gettit"></div>';
            break;
        case "5": // Intro Grid (side)
            get_template_part ('/library/home_variations/home', 'fullstack');
            echo '<div class="gettit"></div>';
            break;
        case "6": // Intro Grid (bottom)
            get_template_part ('/library/home_variations/home', 'lowstack');
            echo '<div class="gettit"></div>';
            break;
        default: // Defailt Minimal
            get_template_part ('/library/home_variations/home', 'base');
    } 
}
endif; // get_home_intro ()

if ( ! function_exists( 'feature_img_url' ) ) :
  // Returns the feature image URL
  function feature_img_url () {
      if(get_option('misfit_single_image')) { 
          echo esc_url(get_option('misfit_single_image')); 
      } else { 
          get_parent_theme_file_path ('/images/bans/23.jpg');
      }
  }
endif; // feature_img_url ()

if ( ! function_exists( 'include_banner' ) ) :
  function include_banner () {
      global $post;
      $page_type = get_post_meta($post->ID, 'misfit_pagetype', true);
      switch ($page_type) {
          case "Top Banner":
          case "Top Banner w/Side(R)":
          case "Top Banner w/Side(L)":
          case "Top Banner w/Full(R)":
          case "Top Banner w/Full(L)":
              get_template_part ('library/banner');
              break;
      }
  }
endif; // include_banner ()

if ( ! function_exists( 'custom_preloader' ) ) :
  // Returns the custome preloader URL
  function custom_preloader () {
      if(get_option('misfit_custom_preloader')) { 
          echo 'style="background-image: url(', esc_url(get_option('misfit_custom_preloader')),')'; 
      }
  }
endif; // custom_preloader ()

if ( ! function_exists( 'load_primary_stylesheets' ) ) :
  /*
    Places style.css and media.css at the top of the page so that .preloader works poperly. 
    All other styles and scripts can be loaded later.
  */
  function load_primary_stylesheets () {
      wp_enqueue_style( 'style', get_stylesheet_uri() ); 
      // Changed to use child theme media.css
      wp_enqueue_style('misfit-media', get_stylesheet_directory_uri() . '/css/media.css');
  }
endif; // load_primary_stylesheets ()

if ( ! function_exists( 'load_stylesheets' ) ) :
  /*
    Registers all stylesheets and JS files not included in load_primary_stylesheets(), so they can be optimized by wordpress.
  */
  function load_stylesheets () {
      
      echo '<!-- fonts style -->';
      wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts.css');
      wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
      wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,900|Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext');    
      
      echo '<!-- dependent styles -->';
      wp_enqueue_style('lightbox', get_template_directory_uri() . '/css/lightbox.css');
      wp_enqueue_style('carousel', get_template_directory_uri() . '/css/carousel.css');
      wp_enqueue_style('bigvideo', get_template_directory_uri() . '/css/bigvideo.css');
      wp_enqueue_style('jscrollpane', get_template_directory_uri() . '/css/jquery.jscrollpane.css');
          
      echo '<!-- responsive style -->';
      wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js');
      
      /****************** DO NOT REMOVE **********************
      /* We add some JavaScript to pages with the comment form
      * to support sites with threaded comments (when in use).
      */
      if ( is_singular() && get_option( 'thread_comments' ) )
          wp_enqueue_script( 'comment-reply' );
  }
  add_action('wp_head', 'load_stylesheets');
endif; // load_stylesheets ()


if ( ! function_exists( 'feedburner_url' ) ) :
  /* Returns feedburner URL */
  function feedburner_url () {
      if ( get_option('misfit_feedburner_url') <> "" ) { 
          echo get_option('misfit_feedburner_url'); 
      } else { 
          echo get_bloginfo_rss('rss2_url'); 
      }
  }
endif; // feedburner_url ()


if ( ! function_exists( 'get_url_for' ) ) :
/* 
  Checks the child theme folder to see if an updated file is aviable.
  If not, the default file from the Legend theme is returned.
  Allows all stylesheets and JS files to be easily modified.
*/
    function get_url_for($file_to_check) {
        if ( file_exists( get_stylesheet_directory() . $file_to_check ) ) :
            return get_stylesheet_directory_uri() . $file_to_check;
        else :
            return get_template_directory_uri() . $file_to_check;
        endif;
    }
endif;

if ( ! function_exists( 'footer_setup' ) ) :
  /* 
    Setups the footer with all the styles and scripts needed for the Misfit Legend Theme.    
  */
  function footer_setup () {
  
      get_template_part ('library/mobile-nav');
      wp_enqueue_script ('preloader', get_url_for('/js/preloader.js'));
      wp_enqueue_script ('jquery');    
  
      if ( is_home() && get_option('misfit_hometype') == "3" || is_page_template('hp_vid.php') ) { 
          get_template_part('library/home-video');
      }
      if ( get_option('misfit_instagramid') ) { get_template_part ('library/insta'); }
      if ( get_option('misfit_consumer_key') ) { get_template_part ('library/tweets'); }
      if ( is_page_template('page_cs.php') ) { get_template_part ('library/countdown'); } 
      
      wp_enqueue_script('jquery-iosslider', get_url_for('/js/jquery.iosslider.js'));
      wp_enqueue_script('view', get_url_for('/js/view.js'));
      wp_enqueue_script('lightbox', get_url_for('/js/lightbox.min.js'));
      wp_enqueue_script('execute', get_stylesheet_directory_uri() . '/js/execute.js',array('jquery','jquery-sticky-kit'));
      wp_enqueue_script('jquery-touchcarousel', get_url_for('/js/jquery.touchcarousel-1.2.js'));
      wp_enqueue_script('jquery-sticky-kit', get_url_for('/js/jquery.sticky-kit.js'));
      wp_enqueue_script('stick', get_url_for('/js/stick.js'));
      
  //     if (is_home() && get_option('misfit_hometype') == "1") { wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js'); }
      if ( get_option('misfit_tracking_code') <> "" ) { echo stripslashes(get_option('misfit_tracking_code')); }
  }
  add_action('wp_footer', 'footer_setup');
endif; // footer_setup ()

?>
