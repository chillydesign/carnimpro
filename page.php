<?php get_header(); ?>
<?php $tdu  = get_template_directory_uri(); ?>
<?php $date = get_field('date'); ?>
<?php $contact = get_field('contact'); ?>


<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section id="accueil">
        <div class="container">

            <div class="row">

                <div class="col-sm-8">
                    <h1><?php the_title(); ?></h1>
                    <?php if ($date) : ?>
                        <p class="date_of_event"><?php echo $date; ?></p>
                    <?php endif; ?>
                    <div class="page_content">
                        <?php the_content(); ?>
                    </div>

                </div>
                <div class="col-sm-4">
                    <!-- <img id="large_logo" src="<?php echo $tdu; ?>/img/logo.svg" alt=""> -->
                </div>
            </div>

                <img id="large_logo_page"  src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">

        </div>
    </section>


    <section id="rechercher">
        <?php  get_template_part('rechercher_form'); ?>
        <?php  get_template_part('rechercher_results'); ?>
    </section>





    <?php if ($contact) : ?>
        <section id="contact">
            <div class="container">
                <?php echo $contact; ?>
            </div>
        </section>
    <?php endif; ?>





<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article class="container">

        <h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

    </article>
    <!-- /article -->

<?php endif; ?>




<?php get_footer(); ?>
