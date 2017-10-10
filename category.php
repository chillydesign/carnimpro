<?php get_header(); ?>


		<!-- section -->
		<section class="container">

			<h1><?php _e( 'Categories for ', 'webfactor' ); single_cat_title(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->




<?php get_footer(); ?>
