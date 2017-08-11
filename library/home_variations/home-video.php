<section id="intro" class="home-feature homevideo"
  data-vide-bg="mp4: <?php echo get_option('misfit_mp4'); ?>, ogv: <?php echo get_option('misfit_ogg'); ?>, poster: <?php echo get_option('misfit_vidfallback'); ?>"
  data-vide-options="position: 0% 50%">


		<?php if(get_option('misfit_ambient') == "false") { ?>

	   	<a id="big-video" href="#" class="mute"></a>
	   	
	   <?php } ?>

        <div class="feature-holster">

            <div class="container">

                <div class="feature-reach">

                    <?php if(get_option('misfit_vidlinetwoimage')) { ?>

                        <div class="overlogo"><img src="<?php echo get_option('misfit_vidlinetwoimage'); ?>" alt="<?php echo bloginfo('description'); ?>" /></div>
            
                    <?php } else { ?>

                    <?php if(get_option('misfit_vidlinetwo')) { ?>
    					
    					<?php $good = get_option('misfit_vidlinetwo'); ?>

    					<h4 style="<?php if (get_option('misfit_vidlinetfont')) { ?>font-size: <?php echo get_option('misfit_vidlinetfont'); ?>px;<?php } ?><?php if (get_option('misfit_vidlinetfontcolor')) { ?> color: <?php echo get_option('misfit_vidlinetfontcolor'); ?>;<?php } ?>"><?php echo stripslashes($good); ?></h4>
    			
    				<?php } ?>
                    
                    <?php if(get_option('misfit_vidlineone')) { ?>

                    <h1 style="<?php if (get_option('misfit_vidlinenoonefont')) { ?>font-size: <?php echo get_option('misfit_vidlinenoonefont'); ?>px;<?php } ?><?php if (get_option('misfit_vidlinenoonefontcolor')) { ?> color: <?php echo get_option('misfit_vidlinenoonefontcolor'); ?>;<?php } ?><?php if (get_option('misfit_vidfontfamily')) { ?> font-family: <?php if(get_option('misfit_vidfontfamily') == 1) { ?>'Playfair Display'; text-transform: none<?php } else if (get_option('misfit_vidfontfamily') == 2) { ?>'GothamBold'<?php } else if (get_option('misfit_vidfontfamily') == 3) { ?>'FARRAY'<?php } else { ?>'FARRAY'<?php } ?>;<?php } ?>"><?php echo get_option('misfit_vidlineone'); ?></h1>
                    
                    <?php } ?>

	    			<?php if(get_option('misfit_vidlinethree')) { ?>
	    			
	    				<p style="<?php if (get_option('misfit_vidlinebfont')) { ?>font-size: <?php echo get_option('misfit_vidlinebfont'); ?>px;<?php } ?><?php if (get_option('misfit_vidlinebfontcolor')) { ?> color: <?php echo get_option('misfit_vidlinebfontcolor'); ?>;<?php } ?>"><?php echo get_option('misfit_vidlinethree'); ?></p>
	    			
	    			<?php } ?>

                    <?php } ?>

                    
                    <?php if(get_option('misfit_vidbuttlabel')) { ?>

                     <div class="nakedbutton"<?php if(get_option('misfit_vidlinetwoimage')) { ?> style="top: 0;"<?php } ?>><a href="<?php echo get_option('misfit_vidlabelurl'); ?>"<?php if(get_option('misfit_vidlabelcolor')) { ?> style="border: 1px solid <?php echo get_option('misfit_vidlabelcolor'); ?>; color: <?php echo get_option('misfit_vidlabelcolor'); ?>;"<?php } ?>><?php echo get_option('misfit_vidbuttlabel'); ?></a></div>

                    <?php } ?>


                </div><!-- end feature reach -->

                </div><!-- end container -->

        </div><!-- end feature holster -->
        
        <div class="mobileintro" style="background-image: url(<?php echo get_option('misfit_vidfallback'); ?>);"></div>

	
</section>