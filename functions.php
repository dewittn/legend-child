<?php


/**  Add Your Functions Below **/

/* Include Super Furu Custom Options Panel*/
if(is_admin()) {
    require_once(get_stylesheet_directory() .  '/options/options_panel.php');
}

function child_remove_parent_function() {
    remove_action('admin_menu', 'misfit_add_admin');
    add_action('admin_menu', 'patched_misfit_add_admin');
    remove_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');
    add_action('wp_ajax_of_ajax_post_action', 'patched_of_ajax_callback');
    wp_dequeue_script('execute');
    wp_enqueue_script('execute', get_stylesheet_directory_uri() . '/js/execute.js',array('jquery','jquery-sticky-kit'));
    wp_dequeue_script('lightbox');  
    wp_enqueue_script('lightbox', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array('jquery'));
/*
    wp_dequeue_script('misfit-media');
    wp_enqueue_style('misfit-media', get_stylesheet_directory_uri() . '/css/media.css');
*/
}
add_action( 'wp_loaded', 'child_remove_parent_function' );



//.................. Nelson's New Functions .................. //

if ( ! function_exists( 'default_value' ) ) :

function default_value($var, $default) {
    if (empty($var)) {
        $var = $default;
    } 
    return $var;
}
endif; // default_value ()

if ( ! function_exists( 'get_home_body' ) ) :
/*

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
function get_portfolio_label () {
    echo default_value(get_option('misfit_showlabel'), "Portfolio");
}
endif; // get_portfolio_label ()

if ( ! function_exists( 'get_home_intro' ) ) :

function get_home_intro () {
    $hometype = get_option('misfit_hometype');
    switch ($hometype) {
        case "1": // Single Image
            get_template_part ('/library/home_variations/home', 'single_image');
            break;
        case "2": // Slider 
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
function custom_preloader () {
    if(get_option('misfit_custom_preloader')) { 
        echo 'style="background-image: url(', esc_url(get_option('misfit_custom_preloader')),')'; 
    }
}
endif; // custom_preloader ()

if ( ! function_exists( 'load_stylesheets' ) ) :
/*
    This function adds the rest of the stylesheets into wp_head(), allowing them to be optimized by wordpress.
*/
function load_stylesheets () {
    
    echo '<!-- fonts style -->';
    wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts.css');
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,900');    
    
    echo '<!-- dependent styles -->';
    wp_enqueue_style('lightbox', get_template_directory_uri() . '/css/lightbox.css');
    wp_enqueue_style('carousel', get_template_directory_uri() . '/css/carousel.css');
    wp_enqueue_style('bigvideo', get_template_directory_uri() . '/css/bigvideo.css');
    wp_enqueue_style('jscrollpane', get_template_directory_uri() . '/css/jquery.jscrollpane.css');
        
    if(is_home() && get_option('misfit_hometype') == "2" || is_page_template('hp_slide.php') ) { 
        echo '<!-- Fullscreen Slider -->';
	    wp_enqueue_style('supersized', get_template_directory_uri() . '/css/supersized.css');
	    wp_enqueue_style('shutter', get_template_directory_uri() . '/css/supersized.shutter.css');
	}
    
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

if ( ! function_exists( 'load_primary_stylesheets' ) ) :
/*
    This functions places style.css and media.css at the top of the page so that the site does not look broken while it loads.
*/
function load_primary_stylesheets () {
    wp_enqueue_style( 'style', get_stylesheet_uri() ); 
    // Changed to use child theme media.css
    wp_enqueue_style('misfit-media', get_stylesheet_directory_uri() . '/css/media.css');
}
endif; // load_primary_stylesheets ()

if ( ! function_exists( 'feedburner_url' ) ) :
/*  */
function feedburner_url () {
    if ( get_option('misfit_feedburner_url') <> "" ) { 
        echo get_option('misfit_feedburner_url'); 
    } else { 
        echo get_bloginfo_rss('rss2_url'); 
    }
}
endif; // feedburner_url ()

if ( ! function_exists( 'footer_setup' ) ) :
/*  */
function footer_setup () {

    get_template_part ('library/mobile-nav');
    wp_enqueue_script ('preloader', get_template_directory_uri() . '/js/preloader.js');
    wp_enqueue_script ('jquery');    
    
    if( (is_home() && get_option('misfit_hometype') == "2") || ( is_page() && is_page_template('hp_slide.php') ) ) { 
        wp_enqueue_script('supersized', get_template_directory_uri() . '/js/supersized.3.2.7.min.js');
        wp_enqueue_script('supersized-shutter', get_template_directory_uri() . '/js/supersized.shutter.min.js');
		get_template_part ('library/images');
    }
    if ( is_home() && get_option('misfit_hometype') == "3" || is_page_template('hp_vid.php') ) { 
        get_template_part('library/home-video');
    }
    if ( get_option('misfit_instagramid') ) { get_template_part ('library/insta'); }
    if ( get_option('misfit_consumer_key') ) { get_template_part ('library/tweets'); }
    if ( is_page_template('page_cs.php') ) { get_template_part ('library/countdown'); } 
    
    wp_enqueue_script('jquery-iosslider', get_template_directory_uri() . '/js/jquery.iosslider.js');
    wp_enqueue_script('view', get_template_directory_uri() . '/js/view.js');
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.min.js');
    wp_enqueue_script('execute', get_template_directory_uri() . '/js/execute.js', array('jquery'));
    wp_enqueue_script('jquery-touchcarousel', get_template_directory_uri() . '/js/jquery.touchcarousel-1.2.js');
    wp_enqueue_script('jquery-sticky-kit', get_template_directory_uri() . '/js/jquery.sticky-kit.js');
    wp_enqueue_script('stick', get_template_directory_uri() . '/js/stick.js');
    
//     if (is_home() && get_option('misfit_hometype') == "1") { wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js'); }
    if ( get_option('misfit_tracking_code') <> "" ) { echo stripslashes(get_option('misfit_tracking_code')); }
}
add_action('wp_footer', 'footer_setup');
endif; // footer_setup ()

?>
