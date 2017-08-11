
<div class="stage">

<?php if( get_option('misfit_recentpost') == "true" ) { ?>
	
	<?php

		$misfit_WP_Args = array(
			'posts_per_page' => 1,
			'no_found_rows' => true,
			'update_post_term_cache' => false,
		);
		$misfit_WP_Query = new WP_Query( $misfit_WP_Args );

		if ( $misfit_WP_Query->have_posts() ) : while ( $misfit_WP_Query->have_posts() ) : $misfit_WP_Query->the_post();

			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
			$color = get_post_meta($post->ID, 'misfit_bgcolor',true);
	?>

	<?php if ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Banner(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidebanner.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Banner(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidebannerleft.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/topbanner.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Side(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/topsider.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Side(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidel.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Full(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidebanner.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Full(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidelbanner.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Gallery(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/sidegallery.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Gallery(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/sidegalleryleft.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Gallery(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidegallery.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Gallery(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidegalleryleft.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Banner(R)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/sidebanner.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Banner(L)" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/sidebannerleft.php'); ?>


	<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Scrolling Gallery" ) { ?>


		<?php include (TEMPLATEPATH . '/library/home_page_variations/scrollingbanner.php'); ?>


	<?php } else { ?>


		<?php include (get_stylesheet_directory() . '/library/home_page_variations/basefull.php'); ?>


	<?php } ?>

	<?php endwhile; wp_reset_postdata(); endif; ?>

<?php } else { ?>

	<?php
		$pagename = get_option('misfit_showcasepage');
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

			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");

			$banner = get_post_meta($post->ID, 'misfit_bannerimage',true);
			$color = get_post_meta($post->ID, 'misfit_bgcolor',true);

	?>

	<section id="intro" class="<?php if(get_post_meta($post->ID, 'misfit_pagetype', true) == "Default Full" || get_post_meta($post->ID, 'misfit_pagetype', true) == "Scrolling Gallery"  || get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner" ) { ?>pagers<?php } else { ?>sagers notrans<?php } ?>">

		<?php if ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Banner(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidebanner.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Banner(L)" ) { ?>
	
		
			<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidebannerleft.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/topbanner.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Side(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/topsider.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Side(L)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidel.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Full(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidebanner.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Top Banner w/Full(L)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/topsidelbanner.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Gallery(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/sidegallery.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Gallery(L)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/sidegalleryleft.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Gallery(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidegallery.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Intro w/Side Gallery(L)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/intro_sidegalleryleft.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Banner(R)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/sidebanner.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Side Banner(L)" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/sidebannerleft.php'); ?>


		<?php } elseif ( get_post_meta($post->ID, 'misfit_pagetype', true) == "Scrolling Gallery" ) { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/scrollingbanner.php'); ?>


		<?php } else { ?>


			<?php include (TEMPLATEPATH . '/library/home_page_variations/basefull.php'); ?>


		<?php } ?>


	<?php endwhile; wp_reset_postdata(); endif; ?>

<?php } ?>		


</div>