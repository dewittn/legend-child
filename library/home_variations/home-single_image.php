<section class="home-feature singleimage">
	<img id="feature-img" src="<?php feature_img_url(); ?>">
        <div class="feature-holster">

            <div class="container">

                <div class="feature-reach">


                    <?php if(get_option('misfit_linetwoimage')) { ?>
                    
                        <div class="overlogo"><img src="<?php echo get_option('misfit_linetwoimage'); ?>" alt="<?php echo bloginfo('description'); ?>" /></div>
            
                    <?php } else { ?>

                    <?php if(get_option('misfit_linetwo')) { ?>
    					
    					<?php $good = get_option('misfit_linetwo'); ?>
    					<h4 style="<?php if(get_option('misfit_linetfont')) { ?>font-size: <?php echo get_option('misfit_linetfont'); ?>px;<?php } ?> <?php if (get_option('misfit_linetfontcolor')) { ?>color: <?php echo get_option('misfit_linetfontcolor'); ?>;<?php } ?>"><?php echo stripslashes($good); ?></h4>
    			
    				<?php } ?>
                    
                    <?php if(get_option('misfit_lineone')) { ?>

                    <h1 style="<?php if(get_option('misfit_linenoonefont')) { ?>font-size: <?php echo get_option('misfit_linenoonefont'); ?>px;<?php } ?><?php if(get_option('misfit_linefontcolor')) { ?> color:  <?php echo get_option('misfit_linefontcolor'); ?>;<?php } ?><?php if (get_option('misfit_fontfamily')) { ?> font-family: <?php if(get_option('misfit_fontfamily') == 1) { ?>'Playfair Display'; text-transform: none<?php } elseif (get_option('misfit_fontfamily') == 2) { ?>'GothamBold'<?php } elseif (get_option('misfit_fontfamily') == 3) { ?>'FARRAY'<?php } ?>;<?php } ?>"><?php echo get_option('misfit_lineone'); ?></h1>
                    
                    <?php } ?>

                   <?php if(get_option('misfit_linethree')) { ?>
    			
    					<p style="<?php if(get_option('misfit_linebfont')) { ?>font-size: <?php echo get_option('misfit_linebfont'); ?>px;<?php } ?><?php if (get_option('misfit_linefontcolor')) { ?> color: <?php echo get_option('misfit_linebfontcolor'); ?>;<?php } ?>"><?php echo get_option('misfit_linethree'); ?></p>
    			
    				<?php } ?>

                    <?php } ?>

                    <?php if(get_option('misfit_buttlabel')) { ?>

                     <div class="nakedbutton"<?php if(get_option('misfit_linetwoimage')) { ?> style="top: 0;"<?php } ?>><a href="<?php echo get_option('misfit_buttlabelurl'); ?>"<?php if(get_option('misfit_buttlabelcolor')) { ?> style="border: 1px solid <?php echo get_option('misfit_buttlabelcolor'); ?>; color: <?php echo get_option('misfit_buttlabelcolor'); ?>;"<?php } ?>><?php echo get_option('misfit_buttlabel'); ?></a></div>

                    <?php } ?>


                </div><!-- end feature reach -->

                </div><!-- end container -->

        </div><!-- end feature holster -->

   	<!-- <div class="hero">
		<div class="hero__back hero__back--static" style="background-image: url(<?php if(get_option('misfit_single_image')) { echo get_option('misfit_single_image'); } else { ?><?php bloginfo('template_url'); ?>/images/bans/23.jpg<?php } ?>);"></div>
		
		<div class="hero__front"></div>
	</div> -->

    <div class="hero">
        <div class="hero__back hero__back--static" style="background-image: url(<?php if(get_option('misfit_single_image')) { echo get_option('misfit_single_image'); } else { ?><?php bloginfo('template_url'); ?>/images/bans/23.jpg<?php } ?>);"></div>
        <div class="hero__back hero__back--mover" style="background-image: url(<?php if(get_option('misfit_single_image')) { echo get_option('misfit_single_image'); } else { ?><?php bloginfo('template_url'); ?>/images/bans/23.jpg<?php } ?>);"></div>
        <div class="hero__front"></div>
    </div>
</section>