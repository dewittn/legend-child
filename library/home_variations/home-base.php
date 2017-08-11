<section class="home-feature" <?php if (get_option('misfit_defbackgroundcolor')) { ?>style="background: <?php echo get_option('misfit_defbackgroundcolor'); ?>;"<?php } ?>>

        <div class="feature-holster">

            <div class="container">

                <div class="feature-reach">
					
					<?php if(get_option('misfit_deflinenotwoimage')) { ?>
                    
                        <div class="overlogo"><img src="<?php echo get_option('misfit_deflinenotwoimage'); ?>" alt="<?php echo bloginfo('description'); ?>" /></div>
            
                    <?php } else { ?>


                    <?php if(get_option('misfit_deflinenotwo')) { ?>
    					
    					<?php $good = get_option('misfit_deflinenotwo'); ?>


    					<h4 style="<?php if (get_option('misfit_deflinetfont')) { ?>font-size: <?php echo get_option('misfit_deflinetfont'); ?>px;<?php } ?><?php if (get_option('misfit_deflinefontcolor')) { ?> color: <?php echo get_option('misfit_deflinefontcolor'); ?><?php } else { ?>#3A3A3A;<?php } ?>"><?php echo stripslashes($good); ?></h4>

                    <?php } ?>
                    
                    <?php if(get_option('misfit_deflinenoone')) { ?>

                    <h1 style="<?php if(get_option('misfit_deflinenoonefont')) { ?>font-size: <?php echo get_option('misfit_deflinenoonefont'); ?>px;<?php } ?><?php if (get_option('misfit_deflinenoonefontcolor')) { ?> color: <?php echo get_option('misfit_deflinenoonefontcolor'); ?>;<?php } else { ?> color: #3A3A3A;<?php } ?><?php if (get_option('misfit_deffontfamily')) { ?> font-family: <?php if(get_option('misfit_deffontfamily') == 1) { ?>'Playfair Display'; text-transform: none<?php } else if (get_option('misfit_deffontfamily') == 2) { ?>'GothamBold'<?php } else if (get_option('misfit_deffontfamily') == 3) { ?>'FARRAY';<?php } ?><?php } ?>"><?php echo get_option('misfit_deflinenoone'); ?></h1>
                    
                    <?php } ?>


                    <?php if(get_option('misfit_deflinenothree')) { ?>
                
                        <p style="<?php if (get_option('misfit_deflinebfont')) { ?>font-size: <?php echo get_option('misfit_deflinebfont'); ?>px;<?php } ?><?php if (get_option('misfit_deflinefontcolor')) { ?> color: <?php echo get_option('misfit_deflinebfontcolor');  ?>;<?php } else { ?>#3A3A3A;<?php } ?>"><?php echo get_option('misfit_deflinenothree'); ?></p>
                
                    <?php } ?>


                    <?php } ?>

                    <?php if(get_option('misfit_deflinebuttlabel')) { ?>

                     <div class="nakedbutton"<?php if(get_option('misfit_deflinenotwoimage')) { ?> style="top: 0;"<?php } ?>><a href="<?php echo get_option('misfit_deflinebuttlabelurl'); ?>"<?php if(get_option('misfit_deflinebuttlabelcolor')) { ?> style="border: 1px solid <?php echo get_option('misfit_deflinebuttlabelcolor'); ?>; color: <?php echo get_option('misfit_deflinebuttlabelcolor'); ?>;"<?php } else { ?> style="color: #333; border: 1px solid #333;"<?php } ?>><?php echo get_option('misfit_deflinebuttlabel'); ?></a></div>

                    <?php } ?>



                </div><!-- end feature reach -->

                </div><!-- end container -->

        </div><!-- end feature holster -->

</section>