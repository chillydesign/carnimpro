<?php /* Template Name: ProfStats Page Template */ get_header(); ?>




<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article class="container">

        <h1><?php the_title(); ?></h1>
        <?php if ( post_password_required() ) {
          echo get_the_password_form();
        } else { ?>


            <form action="">
                <?php     $professeurs = get_professeurs(); ?>
                <div class="form_input">
                    <label class="noprint" for="professeur">Professeur *</label>
                    <select id="prof_chooser" name="professeur">
                        <option value="">-</option>
                        <?php foreach ($professeurs as $professeur) { ?>
                            <option value="<?php echo $professeur->post_title; ?>"><?php echo ($professeur->post_title); ?></option>
                        <?php  }; ?>

                    </select>
                </div>
            </form>

        <script type="text/javascript">
        	var prof_stats_url = '<?php echo home_url(); ?>/api/v1/?inscriptions';
        </script>
        <script id="prof_statistics_template" type="x-underscore">
        	<?php echo file_get_contents(dirname(__FILE__) . '/templates/profstats.underscore'); ?>
        </script>


        <div class="container" id="prof_statistics_container"></div>
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
