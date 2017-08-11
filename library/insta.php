<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/instafeed.min.js"></script>
<script type="text/javascript">
// create two separate instances of Instafeed
var playTagFeed = new Instafeed({
    target: 'instafeed',
	get: 'user',
    resolution: 'standard_resolution',
    userId: <?php echo get_option('misfit_instagramid'); ?>,
    limit: 4,
    template: '<a class="instable" href="{{link}}" style="background-image:url({{image}});"></a>',
    accessToken: '<?php echo get_option('misfit_instagramtok'); ?>'
    // rest of settings
});
var glassTagFeed = new Instafeed({
	get: 'user',
	target: 'instafoot',
    resolution: 'standard_resolution',
    userId: <?php echo get_option('misfit_instagramid'); ?>,
    limit: 1,
    accessToken: '<?php echo get_option('misfit_instagramtok'); ?>'
    // rest of settings
});

// run both feeds
playTagFeed.run();
glassTagFeed.run();



</script>