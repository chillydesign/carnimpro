<?php /* Template Name: Inscription Page Template */ get_header(); ?>
<?php


$workshop_id = isset( $_GET['id']) ?  $_GET['id'] : false;
if ($workshop_id) :
    $workshop = get_post($workshop_id);
    $workshop_title = $workshop->post_title;
    $professeurs = get_professeurs();

    $jour = convert_number_to_french_day( get_field('day', $workshop_id ));
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


            <h1>Inscription - <a href="<?php echo $workshop->guid; ?>"><?php echo $workshop_title; ?></a></h1>

            <div class="row">



                <div class="col-sm-6 col-sm-push-6 col-md-9 col-md-push-3">

                    <?php if ( isset($_GET['problem']) ): ?>
                        <p class="alert">
                        <?php $prob = $_GET['problem']; ?>
                        <?php if ($prob == 'no_space')  { ?>
                            Malheureusement le cours est déjà complet. Veuillez vérifier si d'autres dates sont disponibles ou choisir un autre cours. En cas de questions vous pouvez nous contacter à l'adresse <a href="mailto: administration@conservatoirepopulaire.ch">administration@conservatoirepopulaire.ch</a>
                        <?php } else if ($prob == 'registered_before') { ?>
                            Vous êtes déjà inscrit à ce cours. En cas d'erreur veuillez nous contacter directement à l'adresse <a href="mailto: administration@conservatoirepopulaire.ch">administration@conservatoirepopulaire.ch</a>
                        <?php } else { ?>
                        Une erreur s’est produite lors de votre inscription. Vérifiez que tous les champs obligatoires soient bien remplis et veuillez réessayer.
                        <?php }; ?>

                    </p>
                    <?php endif; ?>

                    <form id="inscription_form" action="<?php echo  esc_url( admin_url('admin-post.php') ); ?>" method="post">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="prenom" >Prénom *</label>
                                    <input type="text" name="prenom" id="prenom" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="nom" >Nom *</label>
                                    <input type="text" name="nom" id="nom" />
                                </div>

                            </div>
                        </div>





                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="mail">Email *</label>
                                    <input type="text" name="mail" id="mail" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="email_confirm">Confirmez l'email *</label>
                                    <input type="text" name="email_confirm" id="email_confirm" />
                                </div>

                            </div>
                        </div>





                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" id="adresse" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="postal">Code postal</label>
                                    <input type="text" name="postal" id="postal" />

                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="commune">Commune</label>
                                    <input type="text" name="commune" id="commune" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="tel">Téléphone</label>
                                    <input type="text" name="tel" id="tel" />
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="professeur">Professeur *</label>
                                    <select id="prof_val" name="professeur">
                                        <option value="">-</option>
                                        <?php foreach ($professeurs as $professeur) { ?>
                                            <option value="<?php echo $professeur->ID; ?>"><?php echo ($professeur->post_title); ?></option>
                                        <?php  }; ?>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form_input">
                                    <label for="instrument">Instrument(s) principal(aux)</label>
                                    <input type="text" name="instrument" id="instrument" maxlength="50" />
                                </div>
                            </div>
                        </div>



                        <div class="form_input">
                            <input type="hidden" name="action" value="inscription_form">
                            <input type="hidden" name="workshop_id" value="<?php echo $workshop_id; ?>">
                            <input type="hidden" name="workshop_title" value="<?php echo $workshop_title; ?>">
                            <label>&nbsp;</label>
                            <button id="inscription_button" name="submit_inscription_form" type="submit">Envoyer</button>
                        </div>








                    </form>

                </div>

                <div class="col-md-3 col-md-pull-9 col-sm-pull-6 col-sm-6">

                    <ul class="box">
                        <li><h4>Jour</h4> <?php echo $jour; ?></li>
                        <li><h4>Horaire</h4> <?php echo $heures; ?></li>
                        <li><h4>Centre</h4> <?php echo $centre; ?></li>
                        <li><h4>Tranche  d’âge</h4> <?php echo $age_range; ?></li>
                        <li><h4>Niveau</h4> <?php echo $levels; ?></li>
                        <li><h4>Professeur(s)</h4> <?php echo $teachers_of_workshop; ?></li>
                    </ul>

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
