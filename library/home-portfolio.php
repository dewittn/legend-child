<section class="portfolio-section">

<div class="theslip"><?php if(get_option('misfit_showlabel')) { ?><?php echo get_option('misfit_showlabel'); ?><?php } else { ?>Portfolio<?php } ?></div>

    <div class="pagecontent container">

		<h1 class="bigheading" >My Work</h1>
		
        <div class="portfolio-roll">

				<?php 
					
					$counter = 1;
					$postcount = 13; //default_value(get_option('misfit_portcount'), 12);
					$args = array(
								'post_type' => 'project',
								'posts_per_page' => $postcount,
								'orderby' => 'date',
								'order'   => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'type',
										'field'    => 'slug',
										'terms'    => 'work',
									),
								),
							);
	         		$my_query = new WP_Query($args); if(have_posts()) : while($my_query->have_posts()) : $my_query->the_post(); 
	         		$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "portfolio"); 
	         		$imgsrc2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "portfolio-large");
	         		if($counter == 4 || $counter == 10){
		         		$port_class = "port wideport";
		         		$port_img = $imgsrc2[0];
	         		} else {
		         		$port_class = "port";
		         		$port_img = $imgsrc[0];
	         		}
	         	?>

					<div class="<?php echo $port_class; ?>">

                        <a href="<?php the_permalink(); ?>" class="dropanchor"></a>
                        <h2><?php the_title(); ?></h2>

                        <div class="port-bg" style="background-image: url(<?php echo esc_url($port_img) ?>);">

                        </div>

                    </div><!-- end port -->


	      		<?php $counter++; endwhile; endif; wp_reset_query(); ?>	
	      		
				<div class="clear"></div>

        </div><!-- end portroll -->

		<h1 class="bigheading">My Art</h1>
        <div class="portfolio-roll">

				<?php 
					
					$counter = 1;
					$postcount = 4; //default_value(get_option('misfit_portcount'), 12); 
					$args = array(
								'post_type' => 'project',
								'posts_per_page' => $$postcount,
								'tax_query' => array(
									array(
										'taxonomy' => 'type',
										'field'    => 'slug',
										'terms'    => 'art',
										),
									),
								);
	         		$my_query = new WP_Query($args); if(have_posts()) : while($my_query->have_posts()) : $my_query->the_post(); 
	         		$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "portfolio"); 
	         		$imgsrc2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "portfolio-large");
			 		$custom_url = get_post_meta($post->ID, 'custom_url', $single = true);
			 		if($counter == 2 || $counter == 3){
		         		$port_class = "port wideport";
		         		$port_img = $imgsrc2[0];
	         		} else {
		         		$port_class = "port";
		         		$port_img = $imgsrc[0];
	         		}
	         	?>

					<div class="<?php echo $port_class; ?>">

						<?php if($custom_url) { ?>
                        	<a href="<?php echo $custom_url; ?>" class="dropanchor"></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>" class="dropanchor"></a>
						<?php } ?>
                        <h2><?php the_title(); ?></h2>

                        <div class="port-bg" style="background-image: url(<?php echo esc_url($port_img) ?>);">

                        </div>

                    </div><!-- end port -->

	      		<?php $counter++; endwhile; endif; wp_reset_query(); ?>	
	      		
				<div class="clear"></div>

        </div><!-- end portroll -->
					
    </div>

</section>