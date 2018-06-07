<section id="intro" class="home-feature sliding">
 	
 	<a id="prevslide" class="load-item"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
	<a id="nextslide" class="load-item"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    
    <div class="feature-holster">

        <div class="container">

          <div class="feature-reach">        
    	
            <div class="slide-major<?php if(get_option('misfit_slideimage')) { ?> imageinside<?php } ?><?php if(get_option('misfit_removeanimations') == "false") { ?> anima<?php } ?>">
				
              <?php if(get_option('misfit_slideimage')) { ?>
						
					    <div class="overlogo"><img src="<?php echo get_option('misfit_slideimage'); ?>" alt="<?php echo bloginfo('description'); ?>" /></div>
					
              <?php } else { ?>
			
					    <div id="slidecaption"></div>
					
              <?php } ?>
					
				    </div>
				
	        </div><!-- end feature reach -->

	    </div><!-- end container -->
	
	</div><!-- end feature holster -->
    
</section>