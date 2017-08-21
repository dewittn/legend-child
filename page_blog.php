<?php 

/* Template Name: Blog

*/

get_header(); ?>

<section class="blogroll">
	
	<div class="container">

		<div class="container pagecontent" style="padding: 100px 0 0 0;">

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<div class="content-wrapper">
					<h1 class="bigheading" style="max-width: 90%; margin: 0 auto 40px;"><?php the_title(); ?></h1>
					<?php
                        $content = get_the_content();                                        
                        $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
                        echo $content;
					?>
				</div><!-- end content-wrapper -->

			<?php endwhile; endif; wp_reset_query(); ?>	
            
            <?php if ( 610 == $post->ID || 247 == $post->ID ) : ?>
				<h2 style="text-align: center;">Books</h2>
                <div class="divider"></div>
                <div class="highroll">
                    <div class="post leftpost">
                        <a href="https://www.nelsonroberto.com/portfolio/innocent-dreams/" class="dropanchor"></a>
                        <div class="post-snip">
                            <div class="slip-line">
                                <h2>Waking From Innocent Dreams</h2>
                                <a href="https://www.nelsonroberto.com/portfolio/innocent-dreams/" class="std">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                
                                <p class="blurb-text">The Mausoleum Club stands on the quietest corner of the best residential street in the City. It is a Grecian building of white stone. About it are great elm trees with birds--the most expensive kind of birds--singing in the branches. The street in the softer hours of the morning has an almost reverential quiet. Great...</p>
                            </div><!-- end slip-line -->
                            <a href="https://www.nelsonroberto.com/portfolio/innocent-dreams/" class="std ion-ios-arrow-thin-right"></a>
                        </div><!-- end post-snip -->
                
                        <div class="post-bg" style="background-image: url(https://www.nelsonroberto.com/wp-content/uploads/2017/07/Waking-From-Innocent-Dreams-Cover.png);">
                            <div class="wager">
                                <h4>In Development</h4>
                            </div><!-- end wager -->
                        </div><!-- end post-bg -->
                    </div><!-- end post -->
                
                    <div class="post rightpost">
                        <a href="https://www.nelsonroberto.com/portfolio/ksg/" class="dropanchor"></a>
                
                        <div class="post-snip">
                            <div class="slip-line">
                                <h2>A Kickstarter's Guide to Kickstarter</h2>
                                <a href="https://www.nelsonroberto.com/portfolio/ksg/" class="std">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                
                                <p class="blurb-text">A Kickstarter’s Guide will give you a thorough understanding of the Kickstarter site, its functionality, practical usage, audience, and strategy. If you have never put together a campaign before or are having trouble getting traction, it will provide a framework to help you navigate the vague world of crowd-sourced funding.</p>
                            </div><!-- end slip-line -->
                            <a href="https://www.nelsonroberto.com/portfolio/ksg/" class="std ion-ios-arrow-thin-right"></a>
                        </div><!-- end post-snip -->
                
                        <div class="post-bg" style="background-image: url(https://www.nelsonroberto.com/wp-content/uploads/2017/08/A-Kickstarters-Guide.jpg);">
                            <div class="wager">
                                <h4>2011</h4>
                            </div><!-- end wager -->
                        </div><!-- end post-bg -->
                    </div><!-- end post -->
                
                    <div class="clear"></div>
                </div><!-- end highroll -->
                <h2 style="text-align: center;">Essays &amp; Articles</h2>
            <?php endif; ?>
		</div>

		<div class="divider"></div>

		<div class="highroll">

			<?php 

				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$postcount = 1;

				$misfit_WP_Args = array(
					'post_type' => 'post',
					'posts_per_page' => 10,
					'paged' => $paged,
					'update_post_term_cache' => false,
				);
				$misfit_WP_Query = new WP_Query( $misfit_WP_Args );

				global $wp_query;
				$tmp_query = $wp_query;
				$wp_query = null;
				$wp_query = $misfit_WP_Query;

				if ( $misfit_WP_Query->have_posts() ) : while ( $misfit_WP_Query->have_posts() ) : $misfit_WP_Query->the_post();

					if( ($postcount % 2) == 0 ) $post_class = 'rightpost';
					else $post_class = 'leftpost';

					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "blog-posts");

			?>

				<div class="post <?php echo $post_class; ?> <?php if(!$imgsrc){ ?>noimg <?php } ?>">

					<!-- <p><?php echo esc_html(misfit_themes_excerpt(55)); ?></p> -->

					<a href="<?php the_permalink(); ?>" class="dropanchor"></a>

					<div class="post-snip">

						<div class="slip-line">

							<h2><?php the_title(); ?></h2>

							<a href="<?php the_permalink(); ?>" class="std"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>

							<p><?php echo esc_html(misfit_themes_excerpt(55)); ?></p>

							<!--<h4 class="genetics"><?php $project_terms = wp_get_object_terms($post->ID, 'category'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo ', '; } echo '<a href="'.get_term_link($term->slug, 'category'). '">'.$term->name. '</a>';  $count++; }  } } ?></h4>


							<p class="wcount"><?php echo misfit_themes_word_count(); ?> <?php _e('words', 'misfitlang'); ?></p>-->

						</div>

						<a href="<?php the_permalink(); ?>" class="std ion-ios-arrow-thin-right"></a>

					</div><!--end post snip -->

					<div class="post-bg" style="background-image: url(<?php echo esc_url($imgsrc[0]); ?>);">

						<div class="wager">
								<h4><?php the_title(); ?><span><?php the_author(); ?></span></h4>
						</div><!-- end wager -->

					</div><!-- end post-bg -->

				</div><!-- end post -->

			<?php $postcount++; endwhile; ?>

			<div class="clear"></div>

		</div><!-- end highroll -->

		<div class="catmo moreposts">

			<div class="nakedbutton"><?php next_posts_link('' .   __(' Next' , 'cebolang')) ?><?php previous_posts_link( __(' Previous', 'cebolang') .  '') ?></div>

			<div class="clear"></div>

		</div>

		<?php wp_reset_postdata(); else : ?>

			<div class="nakedbutton"><?php if(!get_previous_posts_link()) { _e('Nothing More Found','misfitlang'); } else { _e('View More Posts','misfitlang'); } ?></div>

		<?php endif; $wp_query = $tmp_query; ?>

	</div><!-- end container -->

</section><!-- end blogroll -->

<?php get_footer(); ?>