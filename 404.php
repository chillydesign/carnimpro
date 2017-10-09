<?php get_header(); ?>


		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404">

				<h1><?php _e( 'Page not found', 'webfactor' ); ?></h1>
				<p>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'webfactor' ); ?></a>
				</p>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>
