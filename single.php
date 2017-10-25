<?php get_header(); ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" class="container">
        <?php
        $workshop_id = get_field('workshop_id');
        $others = get_workshops_by_workshop_id($workshop_id);
        ?>


        <h1><?php the_title(); ?></h1>
        <?php the_content(); // Dynamic Content ?>


        <div class="table_container">
            <table>
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Centre</th>
                        <th>Tranche d’âge</th>
                        <th>Niveau</th>
                        <th>Professeur(s)</th>
                        <th>Inscription</th>

                    </tr>
                </thead>
                <tbody>

                    <?php if ($others->have_posts()): while ($others->have_posts()) : $others->the_post(); ?>
                        <?php  $other_id = get_the_ID(); ?>

                        <tr>
                            <td><?php echo get_field('jour' ); ?></td>
                            <td><?php echo get_field('heures' ); ?></td>
                            <td><?php echo get_field('centre' ); ?></td>
                            <td><?php echo get_field('age_range' ); ?></td>
                            <td><?php echo get_field('levels' ); ?></td>
                            <td><?php echo  nl2br( get_field('teachers' )); ?></td>
                            <td>
                                <a href="<?php echo get_home_url(); ?>/inscription?id=<?php echo $other_id; ?>" class="button">Inscription</a>
                            </td>

                        </tr>

                        <?php wp_reset_postdata(); endwhile; endif; ?>
                    </tbody>
                </table>
            </div>

            <img id="large_logo_page"  src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">





            radio button for ecole
            CPMDT or other

            if other
                input for name of ecole
                politesse
                nom
                prenom
                address
                postal
                commune
                tel
                email
                confirm email
            if cpmdt
                student number input (maybe check to see if its a valid student number)
                email address
                confirm email
                teacher - select for custom post type of professeur

                when sending email, get all the student details from the custom post type of eleve, based on the student number


            sends one email to admin, one to teacher and one to student




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
