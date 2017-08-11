
<section id="intro" class="sagers notrans flight lakestreet">
	
	<div id="copystackers" class="tall hpstacks" style="background: #ddd;">

		<?php

			$pagename = get_option('misfit_primeone');
			$page = get_page_by_title($pagename);
			$featured_id =  $page->ID;

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

				$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
				$banner = wp_get_attachment_url( $bans );

		?>

			<div class="stellar">

				<div class="totality" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);">

					<h1 class="fullstackintense" style=""><?php the_title(); ?></h1>

				</div>

				<a class="dropanchor" style="" href="<?php the_permalink(); ?>"></a>

			</div>

		<?php endwhile; wp_reset_postdata(); endif; ?>

	</div> <!-- end copystackers -->


	<div id="stackers">

		<div class="bigstack">

			<div class="portfoliocontainer">

				<?php

					$pagename = get_option('misfit_secondone');
					$page = get_page_by_title($pagename);
					$featured_id =  $page->ID;
							
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

						$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
						$banner = wp_get_attachment_url( $bans );

				?>

					<div class="portfolio-item">

						<a class="dropanchor" href="<?php the_permalink(); ?>"></a>

						<div class="portimg" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

						<h3><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h3>

					</div>

				<?php endwhile; wp_reset_postdata(); endif; ?>

			</div>

		</div>


		<div class="halfstacks">

			<div class="portfoliocontainer">

				<?php

					$pagename = get_option('misfit_terone');
					$page = get_page_by_title($pagename);
					$featured_id =  $page->ID;
							
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

						$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
						$banner = wp_get_attachment_url( $bans );
				?>

					<div class="portfolio-item">

						<a class="dropanchor" href="<?php the_permalink(); ?>"></a>

						<div class="portimg" style="background-image: url(<?php if($bans) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

						<h3><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h3>

					</div>

				<?php endwhile; wp_reset_postdata(); endif; ?>

				<?php

					$pagename = get_option('misfit_quatone');
					$page = get_page_by_title($pagename);
					$featured_id =  $page->ID;
							
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

						$bans = get_post_meta($post->ID, 'misfit_bannerimage',true);
						$banner = wp_get_attachment_url( $bans );

				?>

					<div class="portfolio-item">

						<a class="dropanchor" href="<?php the_permalink(); ?>"></a>

						<div class="portimg" style="background-image: url(<?php if($banner) { echo $banner; } else { echo esc_url($imgsrc[0]); } ?>);"></div>

						<h3><?php if(get_post_meta($post->ID, 'misfit_shorttitle', true)) { echo get_post_meta($post->ID, 'misfit_shorttitle', true); } else { the_title(); } ?></h3>

					</div>

				<?php endwhile; wp_reset_postdata(); endif; ?>

			</div>

		</div>

	</div>

	<div class="clear"></div>

	<div class="leftwall"></div> 
	<div class="rightwall"></div> 

</section>