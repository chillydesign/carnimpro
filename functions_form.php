<?php


add_action( 'admin_post_nopriv_inscription_form',    'get_email_from_inscription_form'   );
add_action( 'admin_post_inscription_form',  'get_email_from_inscription_form' );




function get_email_from_inscription_form () {

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'inscription_form'  && $_POST['workshop_id']  ) :


        // STUDENT DETAILS
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $address = $_POST['address'];
        $postal = $_POST['postal'];
        $commune = $_POST['commune'];
        $tel = $_POST['tel'];
        $email = trim($_POST['email']);
        $email_confirm = trim($_POST['email_confirm']);
        $professeur = $_POST['professeur'];
        $full_name = $prenom . ' ' . $nom;

        $workshop_id = $_POST['workshop_id'];


        if ( $prenom != '' && $nom != ''  && ( $email == $email_confirm  )   ) {

            // WORKSHOP DETAILS
            $workshop_title = $_POST['workshop_title'];
            $workshop = get_post($workshop_id);
            $jour =  get_field('jour', $workshop_id );
            $heures =  get_field('heures', $workshop_id );
            $centre =  get_field('centre', $workshop_id );
            $age_range =  get_field('age_range', $workshop_id );
            $levels =  get_field('levels', $workshop_id );
            $teachers_of_workshop =   nl2br( get_field('teachers', $workshop_id ));



            $post = array(
                'post_title'     => $full_name  ,
                'post_status'    => 'publish',
                'post_type'      => 'inscription',
                'post_content'   => '',
                'post_parent'    => $workshop_id
            );
            $new_inscription = wp_insert_post( $post );


            if ($new_inscription == 0) {
                wp_redirect(get_home_url() . '/inscription?id=' . $workshop_id . '&problem' );
            } else {


                $fields = all_inscription_fields();
                foreach ($fields as $field => $value ) {
                    if (isset($_POST[$field])){
                        add_post_meta($new_inscription,  $field,  $_POST[$field] , true);
                    }
                }





                $headers = 'From: CarnImprov<noreply@carnimprov.ch>' . "\r\n";
                $email_header = file_get_contents(dirname(__FILE__) . '/email/email_header.php');
                $email_footer = file_get_contents(dirname(__FILE__) . '/email/email_footer.php');
                add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));




                $email_content = '<h3>Résumé de l\'inscription</h3><table cellspacing="0" cellpadding="0" border="0" align="left" width="100%" style="max-width: 600px;"><tbody>
                <tr><td style="width:25%">Atelier</td><td>'. $workshop_title .'</td></tr>
                <tr><td style="width:25%">Jour</td><td>'. $jour .'</td></tr>
                <tr><td style="width:25%">Horaire</td><td>'. $heures .'</td></tr>
                <tr><td style="width:25%">Lieu</td><td>'. $centre .'</td></tr>
                <tr><td style="width:25%">Tranche d’âge</td><td>'. $age_range .'</td></tr>
                <tr><td style="width:25%">Niveau</td><td>'. $levels .'</td></tr>
                <tr><td style="width:25%">Professeur(s)</td><td>'. $teachers_of_workshop .'</td></tr>
                </tbody></table>';
                $email_content .= '<p>&nbsp;</p>';
                $email_content .= '<h3>Rappel des données</h3><table cellspacing="0" cellpadding="0" border="0" align="left" width="100%" style="max-width: 600px;"><tbody>
                <tr><td style="width:25%">Nom</td><td>'. $nom .'</td></tr>
                <tr><td style="width:25%">Prénom</td><td>'. $prenom .'</td></tr>
                <tr><td style="width:25%">Adresse</td><td>'. $address .'</td></tr>
                <tr><td style="width:25%">Code postal</td><td>'. $postal .'</td></tr>
                <tr><td style="width:25%">Commune</td><td>'. $commune .'</td></tr>
                <tr><td style="width:25%">Téléphone</td><td>'. $tel .'</td></tr>
                <tr><td style="width:25%">Email</td><td>'. $email .'</td></tr>
                <tr><td style="width:25%">Professeur</td><td>'. $professeur .'</td></tr>
                </tbody></table>';
                $email_content .= '<p>&nbsp;</p>';
                $email_content .= '<p >A bientôt pour votre atelier<br/>L\'équipe CPMDT</p>';


                // EMAIL TO STUDENT
                $subject_for_student = 'Confirmation d\'inscription aux Carnimpro';
                $email_start_for_student = '<h1 style="line-height:36px;font-size:26px;">Confirmation d\'inscription Carnimpro </h1>';
                $email_start_for_student .= '<p>Merci pour votre inscription à l\'atelier ' . $workshop_title . ' </p><p>&nbsp;</p>';
                $body_for_student = $email_header . $email_start_for_student . $email_content  . $email_footer;
                wp_mail( $email, $subject_for_student, $body_for_student, $headers );

                // EMAIL TO ADMIN
                $email_start_for_admin =  '<h1 style="line-height:36px;font-size:26px;">Nouvelle inscription à l’atelier <br>' .$workshop_title .  '</h1>';
                $admin_email = 'harvey.charles@gmail.com';
                $subject_for_admin = 'Nouvelle inscription';
                $body_for_admin = $email_header . $email_start_for_admin . $email_content  . $email_footer;

                wp_mail( $admin_email, $subject_for_admin, $body_for_admin, $headers );




                remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );



                $redirect = get_home_url() . '/inscription-reussie/';
                wp_redirect( $redirect );

            }; // if saved as custom post type OK


        } else { // if we dont have first name, last name or workshop title
            wp_redirect(get_home_url() . '/inscription?id=' . $workshop_id . '&problem' );

        }



        exit;



    endif;


}


function all_inscription_fields(){

        return array(
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'adresse' => 'Address',
            'postal' => 'Postal',
            'commune' => 'Commune',
            'tel' => 'Tel',
            'mail' => 'Email',
            'workshop_title' => 'Workshop title',
            'professeur' => 'Professeur'

        );
    }



 ?>
