<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>
		<?php 
    		global $page, $paged; 
    		
    		wp_title( '|', true, 'right' ); 
    		// bloginfo( 'name' );
    	
    		// Add the blog description for the home/front page.
    		// $site_description = get_bloginfo( 'description', 'display' );
    		// if ( $site_description && ( is_home() || is_front_page() ) )
    		//	echo " | $site_description";
    	
    		// Add a page number if necessary:
    		if ( $paged >= 2 || $page >= 2 )
    			echo ' | ' . sprintf( __( 'Page %s', 'misfitlang' ), max( $paged, $page ) );
		?>
	</title>
	<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php feedburner_url (); ?>" />
	<?php 
    	load_primary_stylesheets(); 
        add_action('wp_footer', 'optimize_homepage');	
    ?>
	
	<style type="text/css">
	    .is_stuck{
            z-index: 6;
	    }
	</style>
	
 	<style type="text/css">
    	<?php echo stripslashes(get_option('misfit_custom_css'));   ?>
    	<?php if(!get_option('misfit_deflinenothree') || !get_option('misfit_deflinenothree') || !get_option('misfit_deflinenothree')) : ?>
    		.feature-holster {
			   top: 53%;
    		}
    	<?php endif; ?>
    </style>    
        
	<?php wp_head(); ?>
	
	</head> 
	
	<body <?php body_class(); ?>>

        <div id="preloader">
            <div id="status" <?php custom_preloader(); ?>></div>
        </div>

        <div class="wrapper sic" id="icing">			
            <div class="fixed-nav">
                <?php wp_nav_menu( array( 'theme_location' => 'topper' ,  'container' => false, 'items_wrap' => '%3$s' ) ); ?>
                <a href="#" class="searcher"><i class="fa fa-search" aria-hidden="true"></i></a>
                <?php if(get_option('misfit_infobox') != "Select a page:" && get_option('misfit_infobox') != "" ) : ?>
                    <a href="#" class="info"><i class="fa fa-info" aria-hidden="true"></i></a>
                <?php endif; ?>
                <a href="<?php echo esc_url(get_home_url()); ?>" class="home"><i class="fa fa-home" aria-hidden="true"></i></a>
            </div><!-- end fixed nav -->
			
			<?php get_template_part ('library/sidenav'); ?>
				
			<?php if(is_home()) {
    			    get_home_intro(); 
    			} elseif (!is_category() && !is_archive() && !is_author() && !is_tag() && !is_search()) {
                    include_banner ();
                }
            ?>			
			<div class="stage nelson">
 			