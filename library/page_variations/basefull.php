	<div class="stage-holster">


	 <?php if(get_post_type() == "page"|| get_post_type() == "page") {  } else { ?>
	 
	 <div class="progress-indicator">
			<svg>
				<g>
					<circle cx="0" cy="0" r="20" stroke="black" class="animated-circle" transform="translate(50,50) rotate(-90)"  />
				</g>
				<g>
					<circle cx="0" cy="0" r="38" transform="translate(50,50) rotate(-90)"  />
				</g>
			</svg>
			<div class="progress-count"></div>
		</div>
		
		<?php } ?>
	 
	 	<div class="pagecontent sidegallery">
	 	
		<?php if(get_post_meta($post->ID, 'misfit_youtube', $single = true) || get_post_meta($post->ID, 'misfit_vimeo', $single = true))  { ?> 
	       		<div class="basefullcontainer">
	       			
	       			<div class="vidholster">
	       			<div class="video-container">
						
						<?php if(get_post_meta($post->ID, 'misfit_youtube', $single = true)) { ?>
									
						<iframe width="720" height="394" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'misfit_youtube', $single = true); ?>" allowfullscreen></iframe>
						
						<?php } elseif(get_post_meta($post->ID, 'misfit_vimeo', $single = true)) { ?>

						<iframe src="https://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'misfit_vimeo', $single = true); ?>" width="720" height="394"></iframe>
		
						<?php } ?>
						
					</div>	
					</div>
				</div>
	       		
	       		<?php } ?>
	


           <div class="content-wrapper <?php if (get_post_gallery()) { ?>gallery-trigger<?php } ?>"<?php if(get_post_meta($post->ID, 'misfit_youtube', $single = true) || get_post_meta($post->ID, 'misfit_vimeo', $single = true))  { ?>  style="padding: 0px 0 100px 0;"<?php } ?>>
       			
           
       		
       		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>     
			   		
			  <?php if(get_post_type() == "page") {  } else { ?>
	       		
	       		<h2 class="subheading">
	       			<?php _e('w', 'misfitlang'); ?>: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a> 
	       			
	       			<?php if(get_post_meta($post->ID, 'misfit_imagecredit', $single = true)) { ?>&nbsp;&bull;
			       			
	       			<?php _e('p', 'misfitlang'); ?>: <?php if(get_post_meta($post->ID, 'misfit_imagecreditlink', $single = true)) { ?>
	       			
	       			<a href="<?php echo get_post_meta($post->ID, 'misfit_imagecreditlink', $single = true); ?>" target="_blank">
	       			
	       			<?php } ?>
	       			
	       			<?php echo get_post_meta($post->ID, 'misfit_imagecredit', $single = true); ?>&nbsp;
	       			
	       			<?php if(get_post_meta($post->ID, 'misfit_imagecreditlink', $single = true)) { ?></a>
	       			
	       			<?php } ?><?php } ?></h2>		       			
			     <?php } ?>  


				<h1 class="bigheading" style="max-width: 90%; margin: 0 auto 40px;"><?php the_title(); ?></h1>	 
	       		
	       		
	       		
	       		
	       		       		
	       		<div class="postcopy">
		       		
	       		
		       		<?php
				        $content = get_the_content();                                        
				        $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
				        echo $content;
			        ?>
		       		
		       								
					<div class="clear"></div>
					
					
                   	<?php if(get_post_type() == "page") {  } else { ?>
					

	       				<?php include(TEMPLATEPATH . '/library/authorsection.php'); ?>
	       		 
	       		 
	       		 	<?php } ?>
						
							
					
					</div>	
						
	       					
	       		</div>
	       		
	       <div class="clear"></div>
	      
	    
	      </div>
	      
	      <?php endwhile; endif; wp_reset_query(); ?>
	      
	      
	</div><!-- end stage holster -->
	
	<?php if(get_post_type() == "page") {  } else { ?>
	
    <div class="commentarea">

		<?php comments_template(); ?>

	</div>
	
	<?php } ?>
	
	<?php 

		if(get_post_type() == "project") {
	
			include(TEMPLATEPATH . '/library/relational_portfolio.php');
		
		} elseif(get_post_type() == "post") {
	
			include(TEMPLATEPATH . '/library/relational_blog.php');
		
		} else {}

	?>