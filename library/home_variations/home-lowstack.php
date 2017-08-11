
<?php 
	
	$pagename = get_option('misfit_primetwo');
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

		$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
		$banner = wp_get_attachment_url( $bans );
		$color = get_post_meta($post->ID, 'misfit_bgcolor',true);
?>

	<section class="home-feature interiorfeature lakestreet" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>); max-height: 700px; <?php if($color) { ?> background-color: <?php echo $color; ?><?php } ?>">

		<a style="" class="dropanchor" href="<?php the_permalink(); ?>"></a>

		<div class="feature-holster">

			<div class="container">

				<div class="feature-reach">

					<h1 class="fullstackintense"><?php the_title(); ?></h1>

				</div><!-- end feature reach -->

			</div><!-- end container -->

		</div><!-- end feature holster -->

	</section>	
	
	<div class="feature-spacer" style="max-height: 700px;"></div>
	
<?php endwhile; wp_reset_postdata(); endif; ?>

<div class="portfolio-container homable">

	<?php

		$pagename = get_option('misfit_secondtwo');
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

			$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
			$banner = wp_get_attachment_url( $bans ); 

	?>

		<div class="portfol">

			<div class="holster">

				<a href="<?php the_permalink(); ?>" class="dropanchor"></a>

				<div class="groove" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

				<div class="hip">

					<h1><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h1>

				</div>

			</div>

		</div>

	<?php endwhile; wp_reset_postdata(); endif; ?>

	
	<?php 

		$pagename = get_option('misfit_tertwo');
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

			$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
			$banner = wp_get_attachment_url( $bans );

	?>

		<div class="portfol">

			<div class="holster">

				<a href="<?php the_permalink(); ?>" class="dropanchor"></a>

				<div class="groove" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

				<div class="hip">

					<h1><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h1>

				</div>

			</div>

		</div>

	<?php endwhile; wp_reset_postdata(); endif; ?>


	<?php

		$pagename = get_option('misfit_quattwo');
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

			$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
			$banner = wp_get_attachment_url( $bans );

	?>

		<div class="portfol">

			<div class="holster">

				<a href="<?php the_permalink(); ?>" class="dropanchor"></a>

				<div class="groove" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

				<div class="hip">

					<h1><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h1>

				</div>

			</div>

		</div>

	<?php endwhile; wp_reset_postdata(); endif; ?>

	<div class="clear"></div>

</div>	
				   
