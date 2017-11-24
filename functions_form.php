<?php


add_action( 'admin_post_nopriv_inscription_form',    'get_email_from_inscription_form'   );
add_action( 'admin_post_inscription_form',  'get_email_from_inscription_form' );




function get_email_from_inscription_form () {

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'inscription_form'  && $_POST['workshop_id']  ) :






        // STUDENT DETAILS
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $postal = $_POST['postal'];
        $commune = $_POST['commune'];
        $tel = $_POST['tel'];
        $mail = trim($_POST['mail']);
        $email_confirm = trim($_POST['email_confirm']);
        $professeur_id = $_POST['professeur'];
        $instrument = $_POST['instrument'];
        $full_name = $prenom . ' ' . $nom;

        $workshop_id = $_POST['workshop_id'];



        if ( $prenom != '' && $nom != ''  && ( $mail == $email_confirm  )    ) {


            // SPAM check
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $referrer = $_SERVER['HTTP_REFERER'];
            $spam_data = array(
                'user_ip' => $user_ip,
                'user_agent' => $user_agent,
                'referrer' => $referrer,
                'comment_author' =>  $full_name,
                'comment_author_email' => $mail
            );

            $is_message_spam = is_message_spam($spam_data);

            if ($is_message_spam == false) {

                $user_has_registered_before = user_has_registered_before( $mail, $workshop_id  );
                if ($user_has_registered_before == false) {

                    $professeur = '';
                    if ($professeur_id && $professeur_id != '') {
                        $professeur_post  = get_post( $professeur_id );
                        $professeur = $professeur_post->post_title;
                    }

                    // WORKSHOP DETAILS
                    $workshop_title = $_POST['workshop_title'];
                    $workshop = get_post($workshop_id);
                    $jour =  get_field('jour', $workshop_id );
                    $heures =  get_field('heures', $workshop_id );
                    $centre =  get_field('centre', $workshop_id );
                    $age_range =  get_field('ages', $workshop_id );
                    $levels =  get_field('levels', $workshop_id );
                    $no_allowed_students =  get_field('no_students', $workshop_id );
                    $teachers_of_workshop =   nl2br( get_field('teachers', $workshop_id ));


                    $inscriptions = get_inscriptions_by_workshop_id($workshop_id);
                    $inscriptions_count =  sizeof($inscriptions);

                    // if there is a free space to allow someone to subcribe
                    if(  $inscriptions_count <  $no_allowed_students ) {


                        $post = array(
                            'post_title'     => $full_name  ,
                            'post_status'    => 'publish',
                            'post_type'      => 'inscription',
                            'post_content'   => '',
                            'post_parent'    => $workshop_id
                        );
                        $new_inscription = wp_insert_post( $post );


                        if ($new_inscription == 0) {
                            wp_redirect(get_home_url() . '/inscription?id=' . $workshop_id . '&problem=didntsave' );
                        } else {


                            $fields = all_inscription_fields();
                            foreach ($fields as $field => $value ) {
                                if (isset($_POST[$field])){
                                    add_post_meta($new_inscription,  $field,  $$field , true);
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
                            <tr><td style="width:25%">Adresse</td><td>'. $adresse .'</td></tr>
                            <tr><td style="width:25%">Code postal</td><td>'. $postal .'</td></tr>
                            <tr><td style="width:25%">Commune</td><td>'. $commune .'</td></tr>
                            <tr><td style="width:25%">Téléphone</td><td>'. $tel .'</td></tr>
                            <tr><td style="width:25%">Email</td><td>'. $mail .'</td></tr>
                            <tr><td style="width:25%">Professeur</td><td>'. $professeur .'</td></tr>
                            <tr><td style="width:25%">Instrument principal(s)</td><td>'. $instrument .'</td></tr>
                            </tbody></table>';
                            $email_content .= '<p>&nbsp;</p>';
                            $email_content .= '<p >A bientôt pour votre atelier<br/>L\'équipe CPMDT</p>';


                            // EMAIL TO STUDENT
                            $subject_for_student = 'Confirmation d\'inscription aux Carnimpro';
                            $email_start_for_student = '<h1 style="line-height:36px;font-size:26px;">Confirmation d\'inscription Carnimpro </h1>';
                            $email_start_for_student .= '<p>Merci pour votre inscription à l\'atelier ' . $workshop_title . ' </p><p>&nbsp;</p>';
                            $body_for_student = $email_header . $email_start_for_student . $email_content  . $email_footer;
                            wp_mail( $mail, $subject_for_student, $body_for_student, $headers );



                            // EMAIL TO ADMIN AND TEACHER
                            $email_start_for_admin =  '<h1 style="line-height:36px;font-size:26px;">Nouvelle inscription à l’atelier <br>' .$workshop_title .  '</h1>';
                            $admin_emails =  array('harvey.charles@gmail.com');

                            // if they have submitted a professeur and he has an email, also send them an email.
                            if ($professeur_post) {
                                $prof_email = get_field('mail', $professeur_id  );
                                if ($prof_email ) {
                                    if (trim($prof_email) != '') {
                                        array_push(    $admin_emails,  $prof_email);
                                    }
                                }
                            }



                            $subject_for_admin = 'Nouvelle inscription';
                            $body_for_admin = $email_header . $email_start_for_admin . $email_content  . $email_footer;

                            wp_mail( $admin_emails, $subject_for_admin, $body_for_admin, $headers );




                            remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );



                            $redirect = get_home_url() . '/inscription-reussie/';
                            wp_redirect( $redirect );

                        }; // if saved as custom post type OK



                    } else {  // end of if tehre is a free spot for enrollment
                        wp_redirect(get_home_url() . '/inscr?id=' . $workshop_id . '&problem=no_space' );
                    } // if no free space for enrollment


                } else { // user  has registeed for this course before
                    wp_redirect(get_home_url() . '/inscr?id=' . $workshop_id . '&problem=registered_before' );
                } // end of user  has registeed for this course before

            } else { // end of message is not spam
                    wp_redirect(get_home_url() . '/inscr?id=' . $workshop_id . '&problem=spam' );
            } // end of message is spam

        } else { // if we dont have first name, last name or workshop title
            wp_redirect(get_home_url() . '/inscr?id=' . $workshop_id . '&problem' );

        }



        exit;



    endif;


}




function user_has_registered_before( $mail, $workshop_id  ) {
    global $wpdb;
    $emails_query = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT meta_value, meta_id, ID, post_parent FROM $wpdb->postmeta
            LEFT JOIN $wpdb->posts ON wp_posts.ID = wp_postmeta.post_id
            WHERE post_type = 'inscription'
            AND post_status = 'publish'
            AND meta_key = 'mail'
            AND post_parent = %d"
            , $workshop_id)
        );

        $emails =  array_map( function($row) { return $row->meta_value; }, $emails_query );
        // if email is already in the database for this course
        return ( in_array( $mail, $emails  )  );


    };





    function is_message_spam( $data ) {

        // return true is SPAM
        // return false its a good person
        $request = 'blog='. urlencode('https://carnimpro.ch/') .
        '&user_ip='. urlencode($data['user_ip']) .
        '&user_agent='. urlencode($data['user_agent']) .
        '&referrer='. urlencode($data['referrer']) .
        '&comment_type=signup' .
        '&comment_author='. urlencode($data['comment_author']) .
        '&comment_author_email='. urlencode($data['comment_author_email']) ;

        $key = '52d37475e420';
        $host = $http_host = $key.'.rest.akismet.com';
        $path = '/1.1/submit-spam';
        $port = 443;
        $akismet_ua = "WordPress/4.4.1 | Akismet/3.1.7";
        $content_length = strlen( $request );
        $http_request  = "POST $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $http_request .= "Content-Length: {$content_length}\r\n";
        $http_request .= "User-Agent: {$akismet_ua}\r\n";
        $http_request .= "\r\n";
        $http_request .= $request;
        $response = '';
        if( false != ( $fs = @fsockopen( 'ssl://' . $http_host, $port, $errno, $errstr, 10 ) ) ) {

            fwrite( $fs, $http_request );

            while ( !feof( $fs ) )
            $response .= fgets( $fs, 1160 ); // One TCP-IP packet
            fclose( $fs );

            $response = explode( "\r\n\r\n", $response, 2 );
        }

        if ( 'Thanks for making the web a better place.' == $response[1] ) {
            return true;
        } else {
            return false;
        }

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
            'professeur' => 'Professeur',
            'instrument' => 'Instrument principal'

        );
    }




    function inscription_meta_box_markup(){

        $download_link = get_home_url() . '/api/v1/?download_inscriptions&workshop_id=' . $_GET['post'] ;
        echo '<div class=" "><a style="display:block;text-align:center" class="action button-primary button" href="'. $download_link .'">Télécharger les inscriptions (csv)</a></div>';

    }

    function add_inscription_meta_box(){
        add_meta_box("inscriptions-meta-box", " Inscriptions", "inscription_meta_box_markup", "workshop", "side", "high", null);
    }

    add_action("add_meta_boxes", "add_inscription_meta_box");


    add_action( 'manage_posts_extra_tablenav', 'add_download_link'  );
    function add_download_link($which){
        if ( is_post_type_archive('inscription') ) {
            if($which == 'bottom'){
                $download_link = get_home_url() . '/api/v1/?download_inscriptions'  ;
                echo '<div class="alignleft actions"><a class="action button-primary button" href="'. $download_link .'">Télécharger CSV</a></div>';
            }
        }

    }


    ?>
