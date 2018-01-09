<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link href="//www.google-analytics.com" rel="dns-prefetch">
        <?php $tdu  = get_template_directory_uri(); ?>
        <link rel="apple-touch-icon-precomposed" href="<?php echo $tdu; ?>/img/icons/apple-touch-icon.png" >
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tdu; ?>/img/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tdu; ?>/img/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tdu; ?>/img/icons/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $tdu; ?>/img/icons/manifest.json">
        <link rel="mask-icon" href="<?php echo $tdu; ?>/img/icons/safari-pinned-tab.svg" color="#ed0e58">
        <meta name="apple-mobile-web-app-title" content="Carnimpro">
        <meta name="application-name" content="Carnimpro">
        <meta name="theme-color" content="#ffffff">
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <?php wp_head(); ?>


    </head>
    <body <?php body_class(); ?>>


<?php $home_url =  get_home_url(); ?>

            <div class="all_but_footer">

            <header  id="header">
                <div class="container">

                <a href="<?php echo $home_url; ?>" class="branding">
                    <img src="<?php echo $tdu; ?>/img/logo.svg" alt="">
                    <span><?php bloginfo('name'); ?></span>
                </a>

                <nav id="navigation_menu" role="navigation">
                    <ul>
                        <li><a href="<?php echo $home_url; ?>#accueil">accueil</a></li>
                        <li><a href="<?php echo $home_url; ?>#rechercher">rechercher</a></li>
                        <li><a href="<?php echo $home_url; ?>#contact">contact</a></li>
                    </ul>
                </nav>
                </div>
            </header>
