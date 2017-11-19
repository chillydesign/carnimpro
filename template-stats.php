<?php /* Template Name: Stats Page Template */ get_header(); ?>
<?php




?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article class="container">

        <h1><?php the_title(); ?></h1>

        <script type="text/javascript">
        	var stats_url = '<?php echo home_url(); ?>/api/v1/?inscriptions';
        </script>
        <script id="statistics_template" type="x-underscore">
        	<?php echo file_get_contents(dirname(__FILE__) . '/templates/statistics.underscore'); ?>
        </script>


        <div class="container" id="statistics_container"></div>


    </article>
    <!-- /article -->



<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article class="container">

        <h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

    </article>
    <!-- /article -->

<?php endif; ?>




<?php get_footer(); ?>
