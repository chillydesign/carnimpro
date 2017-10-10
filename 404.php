<?php get_header(); ?>


			<!-- article -->
			<article id="post-404" 		class="container">

				<h1><?php _e( 'Page not found', 'webfactor' ); ?></h1>
				<p>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'webfactor' ); ?></a>
				</p>

			</article>
			<!-- /article -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>
