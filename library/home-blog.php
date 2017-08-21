<section class="blogroll home-blog">

	<div class="theslip"><?php echo default_value(get_option('misfit_bloglabel'), "Essays") ?></div>

    <div class="container pagecontent">

        <h1 id="my-work" class="bigheading" >Essays & Articles</h1>

        <div class="highroll">

		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$postcounts = get_option('misfit_postcount');
			
			if( "4" == get_option('misfit_hometype') && "true" == get_option('misfit_recentpost') ) {
                $offset = 1;
            } else {
                $offset = 0;
			}
			$my_query = new WP_Query(
			array(
					'paged' => $paged,
					'offset' => $offset,
					'post_type' => 'post',
					'posts_per_page' => $postcounts 
				));
			if(have_posts()) :
		    $postcount=1;
		    $total = count($posts);
		    while($my_query->have_posts()) : $my_query->the_post();

		        if( ($postcount % 2) == 0 ) $post_class = 'rightpost';
		        else $post_class = 'leftpost';

		        $attachments = get_children(
				    array(
				        'post_type' => 'attachment',
				        'post_mime_type' => 'image',
				        'post_parent' => $post->ID
				    ));

				$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "blog-posts");
        ?>
		        
		        <div class="post <?php echo esc_attr($post_class); ?> <?php if(!$imgsrc){ ?>noimg <?php } ?>">

                    <a href="<?php the_permalink(); ?>" class="dropanchor"></a>

                    <div class="post-snip">

                    	<div class="slip-line">

	                        <h2><?php the_title(); ?></h2>

	                        <p><?php echo esc_html(misfit_themes_excerpt(55)); ?></p>

	                   </div>

						<a href="<?php the_permalink(); ?>" class="std"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
						
                    </div><!--end post snip -->

                    <div class="post-bg" style="background-image: url(<?php echo esc_url($imgsrc[0]); ?>);">

                        <div class="wager">
                                <h4><?php the_title(); ?><span><?php the_author(); ?></span></h4>
                        </div><!-- end wager -->

                    </div><!-- end post-bg -->

                </div><!-- end post -->

				<?php $postcount++;  endwhile; endif; wp_reset_query(); ?>

                <div class="clear"></div>

        	</div><!-- end highroll -->

		<?php $blogger = get_page_with_template('page_blog');
			  $bloggerurl = get_permalink($blogger);
			?>
		
		<?php if($blogger) { ?>	

        <div class="nakedbutton"><a href="<?php echo $bloggerurl; ?>?paged=2"><?php _e('More', 'misfitlang'); ?></a></div>
        
        <?php } ?>

    </div><!-- end container -->

</section><!-- end blogroll -->
