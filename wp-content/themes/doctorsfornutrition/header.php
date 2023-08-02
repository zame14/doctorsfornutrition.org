<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
$class = 'inside-page';
$post_type = get_post_type($post->ID);
if(!is_front_page()) {
    // check if this is a page that uses a page banner image
    if($post_type == "page" && has_post_thumbnail($post->ID)) {
        $class = 'inside-page-banner';
    }
}
$page = new Page($post->ID);
if($page->isConferencePage() || $post_type == "speaker") {
    $class .= ' green';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="google-site-verification" content="sZAPYdNPGo77MDtdSM4U1DhatDYEmQ6pHXpP6lUv0w8" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
	<?php wp_head(); ?>
    <!-- Hotjar Tracking Code for https://www.doctorsfornutrition.org/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3181145,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
</head>

<body <?php body_class(); ?>>
<div class="site <?=$class?>" id="page">
    <div class="top-section-wrapper">
        <section id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 no-padding">
                        <div class="outer-wrapper">
                            <div class="inner-wrapper">
                                <div class="logo-wrapper">
                                    <a href="<?=get_page_link(5)?>">
                                        <img src="<?=get_stylesheet_directory_uri()?>/images/DFN_Logo_White.svg" alt="<?=get_bloginfo('name')?>" />
                                    </a>
                                </div>
                                <div id="dfn-menu-wrapper">
                                    <div class="main-nav wrapper-fluid wrapper-navbar" id="wrapper-navbar">
                                        <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                            <?php
                                            wp_nav_menu(
                                                array(
                                                    'theme_location' => 'primary',
                                                    'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                                    'menu_class' => 'nav navbar-nav',
                                                    'fallback_cb' => '',
                                                    'menu_id' => 'main-menu'
                                                )
                                            );
                                            ?>
                                        </nav>
                                    </div>
                                </div>
                                <div class="cta">
                                    <ul class="plain">
                                        <li><a href="<?=get_page_link(260)?>" class="btn btn-primary">Find a clinician</a></li>
                                        <li><a href="<?=get_page_link(22)?>" class="btn btn-secondary">Donate</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="top-bar">
                                <ul class="plain">
                                    <li><span class="fas fa-search"></span></li>
                                    <li class="contact-link"><a href="<?=get_page_link(11)?>">Contact us</a></li>
                                    <li class="donate-link"><a href="<?=get_page_link(22)?>">Donate</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
