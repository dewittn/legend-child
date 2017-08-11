<?php
/**
 * The template for displaying the footer.
 *
**/
?>

<?php if(get_option('misfit_showsignup') == "true") { ?>

	<div class="signupform">

		<h4><?php echo get_option('misfit_signuptitle'); ?></h4>

		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup" class="container">

			<form action="<?php echo get_option('misfit_mailchimpcode'); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

				<div id="mc_embed_signup_scroll">

					<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email">
					<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
					<input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">

					<div class="clear"></div>

					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>

					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true">
						<input type="text" name="b_e3a77e4144455d1946c16db48_2a2a20bddc" tabindex="-1" value="">
					</div>
				</div>

			</form>

			<div class="clear"></div>

		</div>

		<!--End mc_embed_signup-->

	</div>
  
<?php } ?>

<footer>
	
	<div class="footer">

		<?php if (get_option('misfit_instagramtok') && get_option('misfit_instagramid')) { ?>

			<div id="instafeed"></div>

		<?php } ?>    

		<div class="clear"></div>

	</div><!-- end footer -->

</footer>


<div class="sole">
	
	<div class="container">

		<a href="#intro" id="back-to-top" title="Back to top">&uarr;</a>

		<ul>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'container' => false,
						'items_wrap' => '%3$s'
					)
				);
			?>
		</ul>

		<p><?php _e('&copy; Legend - A Handcrafted Misfit Theme','misfitlang'); ?></p>

		<div class="clear"></div>

	</div>

</div>


</div><!-- end stage -->

<h1 class="comptitle"><a href="<?php bloginfo('url'); ?>"><?php echo get_option('misfit_logotext'); ?></a></h1>
<a class="nav-closer" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

<div class="hiddennav">
	
	<div class="navigations">

		<ul>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container' => '',
						'menu_class' => ''
					)
				);
			?>

		</ul>

	</div>

</div><!-- end hiddennav-->

</div><!--end wrapper -->

<div class="bigsearch">

	<a class="search-closer" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

	<div class="search-holster">

		<form action="<?php bloginfo('url'); ?>/" method="get" style="position: relative;">
			<input name="s" id="search" placeholder="Type To Start Your Search">
			<button class="pinutton"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>

	</div>

</div><!-- end big search -->

	<?php if(get_option('misfit_infobox') == "Select a page:" || get_option('misfit_infobox') == "" ) { ?>
	<?php } else { ?>

		<div class="biginfo pagecontent">

			<a class="info-closer" href="#"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

			<div class="info-holster">

				<div class="pagecontent">

					<div class="content-wrapper">

						<?php
							$pagename = get_option('misfit_infobox');
							$page = get_page_by_title($pagename);
							$featured_id = $page->ID;

							$misfit_WP_Args = array(
								'post_type' => 'page',
								'p' => $featured_id,
								'posts_per_page' => 1,
								'no_found_rows' => true,
								'update_post_term_cache' => false,
							);
							$misfit_WP_Query = new WP_Query( $misfit_WP_Args );

							if ( $misfit_WP_Query->have_posts() ) : while ( $misfit_WP_Query->have_posts() ) : $misfit_WP_Query->the_post();
								
								$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");

								$gallery = get_post_gallery();
								$content = misfit_themes_strip_shortcode_gallery( get_the_content() );
								$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 

						?>

							<h1><?php the_title(); ?></h1>
							<?php echo $content; ?>

						<?php endwhile; wp_reset_postdata(); endif; ?>

					</div><!-- end content wrapper -->

				</div><!-- end pagecontent -->

			</div>

		</div>

	<?php } ?>

	<div class="hidden-side">

		<?php include(TEMPLATEPATH . '/library/tabs.php'); ?>

	</div><!--end hidden -->

	<?php include(TEMPLATEPATH . '/library/mobile-nav.php'); ?>

	<script src="<?php bloginfo ('template_url'); ?>/js/preloader.js" type="text/javascript"></script>

	<?php if( (is_home() && get_option('misfit_hometype') == "2") || ( is_page() && is_page_template('hp_slide.php') ) ) { ?>

		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/supersized.3.2.7.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/supersized.shutter.min.js"></script>
		<?php include (TEMPLATEPATH . '/js/images.php');?>

	<?php } ?>

	<?php if(is_home() && get_option('misfit_hometype') == "3" || is_page_template('hp_vid.php') ) { ?>
		<?php include (TEMPLATEPATH . '/js/home-video.php');?>
	<?php } ?>

	<?php if(get_option('misfit_instagramid')) { ?>
		<?php include (get_stylesheet_directory() . '/js/insta.php');?>
	<?php } ?>

	<?php if(get_option('misfit_consumer_key')) { ?>
		<?php include (TEMPLATEPATH . '/js/tweets.php');?>
	<?php } ?>

	<?php if ( is_page_template('page_cs.php') ) { ?>
		<?php include (TEMPLATEPATH . '/library/countdown.php');?>
	<?php } ?>

	<script src = "<?php bloginfo ('template_url'); ?>/js/jquery.iosslider.js"></script>
	<script src="<?php bloginfo ('template_url'); ?>/js/view.js" type="text/javascript"></script>
	<script src="<?php bloginfo ('stylesheet_directory'); ?>/js/lightbox.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo ('stylesheet_directory'); ?>/js/execute.js"></script>
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.touchcarousel-1.2.js"></script> 
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.sticky-kit.js"></script>
	<script src="<?php bloginfo ('template_url'); ?>/js/stick.js"></script>   

	<?php if ( get_option('misfit_tracking_code') <> "" ) { echo stripslashes(get_option('misfit_tracking_code')); } ?>

	<?php wp_footer(); ?>
</body>
</html>