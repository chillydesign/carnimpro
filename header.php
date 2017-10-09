<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link href="//www.google-analytics.com" rel="dns-prefetch">
        <?php $tdu  = get_template_directory_uri(); ?>
        <link href="<?php echo $tdu; ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo $tdu; ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        <!-- <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <?php wp_head(); ?>


    </head>
    <body <?php body_class(); ?>>




            <header  id="header">
                <div class="container">

                <a href="<?php echo home_url(); ?>" class="branding">
                    <img src="<?php echo $tdu; ?>/img/logo.svg" alt="">
                    <span><?php bloginfo('name'); ?></span>
                </a>

                <nav id="navigation_menu" role="navigation">
                    <ul>
                        <li><a href="#accueil">accueil</a></li>
                        <li><a href="#rechercher">rechercher</a></li>
                        <li><a href="#contact">contact</a></li>
                    </ul>
                </nav>
                </div>
            </header>
