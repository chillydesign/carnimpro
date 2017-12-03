<?php get_header(); ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" class="container">
        <?php
        $workshop_id = get_field('workshop_id');
        $discipline = get_field('discipline');
        $others = get_workshops_by_workshop_id($workshop_id);

        ?>


        <h1><?php the_title(); ?></h1>
        <p><?php echo get_the_content();  ?>  (<?php echo $discipline; ?>)</p>


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
                        <?php $other_id = get_the_ID(); ?>
                        <?php $inscriptions = get_inscriptions_by_workshop_id($other_id); ?>
                        <?php $inscriptions_count =  sizeof($inscriptions); ?>
                        <?php $no_allowed_students =  intval(  get_field('no_students') ); ?>
                        <?php $ages =  get_field('ages' ); ?>

                        <tr>
                            <td><?php echo convert_number_to_french_day(get_field('day' )); ?></td>
                            <td><?php echo get_field('heures' ); ?></td>
                            <td><?php echo get_field('centre_display' ); ?></td>
                            <td>
                                <?php  if (is_array($ages)) : ?>
                                    <?php echo implode(',', ($ages)); ?>
                                <?php else : ?>
                                        <?php echo $ages; ?>
                                <?php endif; ?>

                            </td>
                            <td><?php echo get_field('levels' ); ?></td>
                            <td><?php echo nl2br( get_field('teachers' )); ?></td>

                            <td>
                                <?php if(  $inscriptions_count <  $no_allowed_students ) : ?>
                                <a href="<?php echo get_home_url(); ?>/inscr?id=<?php echo $other_id; ?>" class="button">Inscription</a>
                                <?php else:  ?>
                                    <a href="" class="button button_inactive" >Complet</a>
                                <?php endif; ?>
                            </td>

                        </tr>

                        <?php wp_reset_postdata(); endwhile; endif; ?>
                    </tbody>
                </table>
            </div>

            <img id="large_logo_page"  src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">







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
