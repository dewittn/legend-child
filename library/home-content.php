
<section class="home-custom">
	
	<div class="container">

		<div class="content-wrapper">

			<?php
				$pagename = get_option('misfit_custom_page');
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

					$gallery = get_post_gallery();
					$content = strip_shortcodes( get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
			?>

				<article>

					<h1><?php the_title(); ?></h1>

					<?php echo $content; ?>

					<div class="clear"></div>

				</article><!-- end article -->

			<?php endwhile; wp_reset_postdata(); endif; ?>

			<aside>

				<div class="sock-lining">

					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Custom Sidebar') ) : ?><?php endif; ?>

				</div><!-- end lining -->

			</aside><!-- end aside -->

			<div class="clear"></div>

		</div><!-- end content wrapper -->

	</div><!-- end container -->

</section><!-- end custom -->

