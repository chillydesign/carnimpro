<?php /* Template Name: Inscription Page Template */ get_header(); ?>
<?php


$workshop_id = isset( $_GET['id']) ?  $_GET['id'] : false;
if ($workshop_id) :
    $workshop = get_post($workshop_id);
    $workshop_title = $workshop->post_title;
    $professeurs = get_professeurs();

    $jour =  get_field('jour', $workshop_id );
    $heures =  get_field('heures', $workshop_id );
    $centre =  get_field('centre', $workshop_id );
    $age_range =  get_field('age_range', $workshop_id );
    $levels =  get_field('levels', $workshop_id );
    $teachers_of_workshop =   nl2br( get_field('teachers', $workshop_id ));

endif;

?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>




    <div class="container">


        <?php if ($workshop_id) : // if have a workshop id ?>


            <h1>Inscription for <a href="<?php echo $workshop->guid; ?>"><?php echo $workshop_title; ?></a></h1>

            <div class="row">

                <div class="col-sm-3">

                    <ul class="box">
                        <li><h4>Jour</h4> <?php echo $jour; ?></li>
                        <li><h4>Horaire</h4> <?php echo $heures; ?></li>
                        <li><h4>Centre</h4> <?php echo $centre; ?></li>
                        <li><h4>Tranche  d’âge</h4> <?php echo $age_range; ?></li>
                        <li><h4>Niveau</h4> <?php echo $levels; ?></li>
                        <li><h4>Professeur(s)</h4> <?php echo $teachers_of_workshop; ?></li>
                    </ul>

                </div>

                <div class="col-sm-9">

                    <?php if ( isset($_GET['problem']) ): ?>
                        <p class="alert">There was a problem submitting your application. Please try again. </p>
                    <?php endif; ?>

                    <form id="inscription_form" action="<?php echo  esc_url( admin_url('admin-post.php') ); ?>" method="post">


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form_input">
                                    <label for="prenom" >Prenom</label>
                                    <input type="text" name="prenom" id="prenom" />
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form_input">
                                    <label for="nom" >Nom</label>
                                    <input type="text" name="nom" id="nom" />
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">


                                <div class="form_input">
                                    <label for="tel">tel</label>
                                    <input type="text" name="tel" id="tel" />
                                </div>

                                <div class="form_input">
                                    <label for="address">address</label>
                                    <textarea  name="address" id="address"></textarea>
                                </div>
                                <div class="form_input">
                                    <label for="postal">postal</label>
                                    <input type="text" name="postal" id="postal" />
                                </div>
                                <div class="form_input">
                                    <label for="commune">commune</label>
                                    <input type="text" name="commune" id="commune" />
                                </div>



                            </div>
                            <div class="col-sm-6">



                                <div class="form_input">
                                    <label for="email">email</label>
                                    <input type="text" name="email" id="email" />
                                </div>
                                <div class="form_input">
                                    <label for="email_confirm">confirm email</label>
                                    <input type="text" name="email_confirm" id="email_confirm" />
                                </div>

                                <div class="form_input">
                                    <label for="professeur">Professeur</label>
                                    <select name="professeur">
                                        <option value="">-</option>
                                        <?php foreach ($professeurs as $professeur) { ?>
                                            <option value="<?php echo $professeur->post_title; ?>"><?php echo $professeur->post_title; ?></option>
                                        <?php  }; ?>

                                    </select>
                                </div>



                                <div class="form_input">
                                    <input type="hidden" name="action" value="inscription_form">
                                    <input type="hidden" name="workshop_id" value="<?php echo $workshop_id; ?>">
                                    <input type="hidden" name="workshop_title" value="<?php echo $workshop_title; ?>">
                                    <button name="submit_inscription_form" type="submit">Envoyer</button>
                                </div>


                            </div>


                        </div>







                    </form>

                </div>


            </div>







        <?php else: ?>
            <p>No workshop. Please try again</p>
        <?php endif; ?>



    </div>





<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article class="container">

        <h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

    </article>
    <!-- /article -->

<?php endif; ?>




<?php get_footer(); ?>
