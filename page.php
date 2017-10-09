<?php get_header(); ?>




<!-- section -->
<section >

	<h1 class="container"><?php the_title(); ?></h1>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php include('section-loop.php'); ?>


			<div class="container">
				<?php the_content(); ?>
				<?php // comments_template( '', true ); // Remove if you don't want comments ?>
				<?php edit_post_link(); ?>
			</div>



		</article>
		<!-- /article -->

	<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="container">

		<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

	</article>
	<!-- /article -->

<?php endif; ?>

</section>
<!-- /section -->




<?php get_footer(); ?>
