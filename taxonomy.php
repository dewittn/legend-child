<?php 

/* Tag Template

*/

get_header(); ?>


<section class="blogroll">
    
    <div class="container">
    
       <div class="container" style="text-align: center; padding: 100px 0 0 0;">
        	
	    <div class="narrowlining">
	    	<h1><?php single_tag_title( '', true ); ?></h1>
	         <p><?php echo category_description(); ?></p>
	    </div>
        
        </div>
        	
        <div class="divider"></div>
               
        <div class="highroll">

				<?php 
				
				        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				        if(have_posts()) :
		       			$postcount=1;
		      			while(have_posts()) : the_post();

				$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "blog-posts");

				if( ($postcount % 2) == 0 ) $post_class = 'rightpost';
		        else $post_class = 'leftpost';
		        
				global $wp_query; 
		        ?>

		        
		            <div class="post <?php echo esc_attr($post_class); ?> <?php if(!$imgsrc){ ?>noimg <?php } ?>">

                    <a href="<?php the_permalink(); ?>" class="dropanchor"></a>


                    <div class="post-snip">

                       <div class="slip-line">

                            <h2><?php the_title(); ?></h2>

                            <p><?php echo esc_html(misfit_themes_excerpt(55)); ?></p>

                            <!--<h4 class="genetics"><?php $project_terms = wp_get_object_terms($post->ID, 'category'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo ', '; } echo '<a href="'.get_term_link($term->slug, 'category'). '">'.$term->name. '</a>';  $count++; }  } } ?></h4>


                            <p class="wcount"><?php echo misfit_themes_word_count(); ?> <?php _e('words', 'misfitlang'); ?></p>-->


                       </div>
                        <?php if($custom_url) { ?>
                        	<a href="<?php echo $custom_url; ?>" class="std"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        <?php } else { ?>
                        	<a href="<?php the_permalink(); ?>" class="std"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        <?php } ?>

                    </div><!--end post snip -->

                    <div class="post-bg" style="background-image: url(<?php echo esc_url($imgsrc[0]); ?>);">

                        <div class="wager">
                                <h4><?php the_title(); ?><span><?php the_author(); ?></span></h4>
                        </div><!-- end wager -->

                    </div><!-- end post-bg -->

                </div><!-- end post -->

				<?php $postcount++;  endwhile; ?>

                <div class="clear"></div>


        	</div><!-- end highroll -->


		   	<div class="catmo moreposts">
		   	
		   			<div class="nakedbutton"><?php next_posts_link('' .   __(' Next' , 'misfitlang')) ?><?php previous_posts_link( __(' Previous', 'misfitlang') .  '') ?></a></div>
                        <div class="clear"></div>   
				</div>
				
				<?php else : ?>
				
					<div class="nakedbutton"><?php if(!get_previous_posts_link()) { _e('Nothing More Found','misfitlang'); } else { _e('View More Posts','misfitlang'); } ?></div>
					
				<?php endif; wp_reset_query(); ?>
				
    </div><!-- end container -->


</section><!-- end blogroll -->
<?php get_footer(); ?>
