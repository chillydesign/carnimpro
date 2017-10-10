<?php get_header(); ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" class="container">
        <?php
        $workshop_id = get_field('workshop_id');
        $others = new WP_Query( array(
            'post_type'  => 'workshop',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby'   => 'meta_value_num',
        	'meta_key'  => 'day',
            'order' => 'asc',
            'meta_query' => array(
                array(
                    'key'     => 'workshop_id',
                    'value'   => $workshop_id,
                    'compare' => '=',
                )
            )

        ));

        ?>


        <h1><?php the_title(); ?></h1>
        <?php the_content(); // Dynamic Content ?>


        <div class="table_container">
            <table>
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Heures</th>
                        <th>Centre</th>
                        <th>Age Range</th>
                        <th>Levels</th>
                        <th>Teachers</th>

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
