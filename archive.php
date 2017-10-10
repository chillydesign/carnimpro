<?php get_header(); ?>


		<!-- section -->
		<section class="container">

			<h1><?php _e( 'Archives', 'webfactor' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->




<?php get_footer(); ?>
