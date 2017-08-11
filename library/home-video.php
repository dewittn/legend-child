
<?php

	$mp4 = get_option('misfit_mp4');
	$webm = get_option('misfit_webm');
	$ogv = get_option('misfit_ogg');
	$poster = get_option('misfit_vidfallback');

	$ambient = get_option('misfit_ambient');

?>

<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.vide.min.js"></script>

<script>

	$('#intro').vide({

		<?php if ( $mp4 ) { ?>mp4: '<?php echo $mp4; ?>',<?php } ?>
		<?php if ( $webm ) { ?>webm: '<?php echo $webm; ?>',<?php } ?>
		<?php if ( $ogv ) { ?>ogv: '<?php echo $ogv; ?>',<?php } ?>
		<?php if ( $poster ) { ?>poster: '<?php echo $poster; ?>',<?php } ?>

	}, {

		<?php if ( $ambient == "true" ) { ?>muted: false,<?php } else { ?>muted: true,<?php } ?>

	});

	var intro = $('#intro').data('vide').getVideoObject();

	$('.mute-vide-button').on('click', function() {
		intro.muted = !intro.muted;
	});

</script>

