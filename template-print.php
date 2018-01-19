<?php /* Template Name: Print Page Template */ get_header(); ?>

<style>
header, footer {display: none;}
.inscription_details.visible {position: relative!important;}
.print_header {
    height: 80px;
    border-bottom: 1px solid #c5e2d6;
    margin: 0 0 80px;
    position: relative;
}
.branding {
  position: absolute;
    top: 0;
    left: 0;
    padding: 20px 100px 0 00px;
    background-size: 100px;
    display: inline-block;
    height: 100px;
    border: 0;
    text-decoration: none;
    color: #333;
    width: 100%;
    font-size: 2.5em;
    text-transform: lowercase;
}

.branding img {
    background-color: white;
    height: 80px;
    padding: 0 10px 0 0;
}
.branding span {
    display: inline-block;
    max-width: 280px;
    position: absolute;
    top: 15px;
}

@media print {
    .inscription_details.visible  {page-break-after: always;}
}
</style>


<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article class="container">

        <!-- <h1><?php the_title(); ?></h1> -->
        <?php if ( post_password_required() ) {
          echo get_the_password_form();
        } else { ?>

        <script type="text/javascript">
        	var stats_url = '<?php echo home_url(); ?>/api/v1/?extra_stats';
        </script>
        <script id="statistics_template" type="x-underscore">
        	<?php echo file_get_contents(dirname(__FILE__) . '/templates/print.underscore'); ?>
        </script>


        <div class="container" id="statistics_container"></div>
        <?php } ?> <!-- END OF IF PASSWORD PROTECTED -->

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
