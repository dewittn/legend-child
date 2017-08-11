
<?php
	
	$supersize_option = get_option('misfit_slidertransitions');
	$supersize_num = '1';

	if ( $supersize_option == 'Fade' ) { $supersize_num = '1'; }
	elseif ( $supersize_option == 'Slide Top' ) { $supersize_num = '2'; }
	elseif ( $supersize_option == 'Slide Right' ) { $supersize_num = '3'; }
	elseif ( $supersize_option == 'Slide Bottom' ) { $supersize_num = '4'; }
	elseif ( $supersize_option == 'Slide Left' ) { $supersize_num = '5'; }
	elseif ( $supersize_option == 'Carousel Right' ) { $supersize_num = '6'; }
	elseif ( $supersize_option == 'Carousel Left' ) { $supersize_num = '7'; }
	else {}

?>


<script type="text/javascript">

	jQuery(function($){

		$.supersized({

			// Functionality
			slideshow               :   1,			// Slideshow on/off
			autoplay				:	1,			// Slideshow starts playing automatically
			start_slide             :   1,			// Start slide (0 is random)
			stop_loop				:	0,			// Pauses slideshow on last slide
			random					: 	0,			// Randomize slide order (Ignores start slide)
			slide_interval          :   12000,		// Length between transitions
			transition              :   <?php echo $supersize_num; ?>,	// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed		:	1000,		// Speed of transition
			new_window				:	1,			// Image links open in new window/tab
			pause_hover             :   0,			// Pause slideshow on hover
			keyboard_nav            :   1,			// Keyboard navigation on/off
			performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
			image_protect			:	1,			// Disables image dragging and right click with Javascript

			// Size & Position
			min_width		        :   0,			// Min width allowed (in pixels)
			min_height		        :   0,			// Min height allowed (in pixels)
			vertical_center         :   1,			// Vertically center background
			horizontal_center       :   1,			// Horizontally center background
			fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
			fit_portrait         	:   1,			// Portrait images will not exceed browser height
			fit_landscape			:   0,			// Landscape images will not exceed browser width

			// Components							
			slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			thumb_links				:	1,			// Individual thumb links for each slide
			thumbnail_navigation    :   0,			// Thumbnail navigation
			slides 					:  	[			// Slideshow Images

				<?php
					$pagename = get_option('misfit_sliderpage');
					$page = get_page_by_title($pagename);
					$featured_id =  $page->ID;

					$misfit_WP_Args = array(
						'post_type' => 'page',
						'p' => $featured_id,
						'posts_per_page' => -1,
						'no_found_rows' => true,
						'update_post_term_cache' => false,
					);
					$misfit_WP_Query = new WP_Query( $misfit_WP_Args );

					if ( $misfit_WP_Query->have_posts() ) : while ( $misfit_WP_Query->have_posts() ) : $misfit_WP_Query->the_post();

						$galleryImages = misfit_themes_get_post_gallery_imagess(); 
						$imagesCount = count($galleryImages);
				?>

					<?php if ($imagesCount > 0) : ?>
						<?php for ($i = 0; $i < $imagesCount; $i++) : ?>
							<?php if (!empty($galleryImages[$i])) :

								$img_full = $galleryImages[$i]['full'][0];
								$posts = get_post($galleryImages[$i]['id']);

							?>

								{
									image : '<?php echo $img_full;?>',
									title : '<h4><?php echo $posts->post_content; ?></h4><h1><?php echo $post->post_excerpt; ?></h1>',
									thumb : '',
									url : ''
								},

							<?php endif; ?>
						<?php endfor; ?>
					<?php endif; ?>

				<?php endwhile; wp_reset_postdata(); endif; ?>

			],

			// Theme Options
			progress_bar			:	0,			// Timer for each slide
			mouse_scrub				:	0
		});
	});
</script>