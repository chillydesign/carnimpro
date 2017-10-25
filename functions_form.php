<?php


add_action( 'admin_post_nopriv_inscription_form',    'get_email_from_inscription_form'   );
add_action( 'admin_post_inscription_form',  'get_email_from_inscription_form' );




function get_email_from_inscription_form () {

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'inscription_form'   ) :

        // TO DO CHECK IF ALL NECESSARY FIELDS HAVE BEEN FILLED IN

        // $referer = $_SERVER['HTTP_REFERER'];
        // $referer =  explode('?',   $referer)[0];


        // print_r($_SERVER);
        // print_r($referer);
        // print_r($_POST);


        $workshop_id = $_POST['workshop_id'];
        $workshop_title = $_POST['workshop_title'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $address = $_POST['address'];
        $postal = $_POST['postal'];
        $commune = $_POST['commune'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $professeur = $_POST['professeur'];

        $full_name = $prenom . ' ' . $nom;

        if ( $prenom != '' && $nom != '' && $workshop_title != ''  ) {



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


                $email_content = '<h1>Confirmation of inscription to ' . $workshop_title  .'</h1>';
                $email_content .= '<p>Thankyou for signing up. Something snething blah di blah. Thankyou for signing up. Something snething blah di blah. Thankyou for signing up. Something snething blah di blah. Thankyou for signing up. Something snething blah di blah. </p>';
                $email_content .= '<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;margin: 10px 0 30px">
                <tr><td>Nom</td><td>'. $nom .'</td></tr>
                <tr><td>Prenom</td><td>'. $prenom .'</td></tr>
                <tr><td>Address</td><td>'. $address .'</td></tr>
                <tr><td>Postal</td><td>'. $postal .'</td></tr>
                <tr><td>Commune</td><td>'. $commune .'</td></tr>
                <tr><td>Tel</td><td>'. $tel .'</td></tr>
                <tr><td>Email</td><td>'. $email .'</td></tr>
                <tr><td>Workshop title</td><td>'. $workshop_title .'</td></tr>
                <tr><td>Professeur</td><td>'. $professeur .'</td></tr>
                </table>';
                $email_content .= '<p>Thank you <br/> Carnimpro people</p>'





                // EMAIL TO ADMIN
                $recipient = 'harvey.charles@gmail.com';
                $subject = 'Confirmation d\'inscription aux Carnimpro';
                $body = $email_header;
                $body .= $email_content;
                $body .= $email_footer;

                wp_mail( $recipient, $subject, $body, $headers );




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
