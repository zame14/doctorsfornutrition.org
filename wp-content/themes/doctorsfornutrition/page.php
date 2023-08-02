<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
get_header();
$page = new Page($post->ID);
$colour = $page->pageBackgroundColour();
$conference_class = '';
($page->isConferenceHomePage()) ? $conference_class = 'conference-home' : $conference_class = '';
?>
<div class="wrapper <?=$conference_class ?>" id="page-wrapper">
    <?php
    if (is_front_page()) { ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home-banner">
                        <?= get_field('banner_title') ?>
                        <div class="panels-wrapper">
                            <a class="banner-panel clinicians-panel" href="<?= get_page_link(48) ?>">
                                <?= get_field('clinicians_panel') ?>
                            </a>
                            <a class="banner-panel general-public-panel" href="<?= get_page_link(45) ?>">
                                <?= get_field('general_public_panel') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        if (has_post_thumbnail($post->ID)) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 no-padding">
                        <div class="inside-banner-wrapper">
                            <?= get_the_post_thumbnail($post->ID, 'full') ?>
                            <div class="page-title">
                                <h1><?= get_the_title() ?></h1>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <?= breadcrumb() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            if($post->ID == get_option('conference-page-id')) {
            // conference home page
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 no-padding">
                        <div class="conference-banner">
                            <div class="conference-page-title-wrapper">
                                <div class="logo">
                                    <img src="<?=get_field('conference_logo', $post->ID)?>" alt="Doctors for Nutrition" />
                                </div>
                                <h1><?=get_field('conference_name', $post->ID)?></h1>
                            </div>
                            <div class="location">
                                <?=get_field('conference_location', $post->ID) . ' - ' . get_field('conference_dates', $post->ID)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 no-padding">
                        <div class="breadcrumb-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <?= breadcrumb() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } else {
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 no-padding">
                            <div class="page-title">
                                <h1><?= get_the_title() ?></h1>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <?= breadcrumb() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    // check if a conference page
    if($page->isConferencePage()) {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 no-padding">
                    <div class="conference-menu-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 flex-row-wrapper m-no-padding">
                                    <img src="<?=get_stylesheet_directory_uri()?>/images/NIHC_Horizontal_Logo.svg" alt="NIHC" />
                                    <?php wp_nav_menu(
                                        array(
                                            'theme_location'  => 'conference-menu',
                                            'container_class' => 'inner-wrapper',
                                            'container_id'    => '',
                                            'menu_class'      => 'plain',
                                            'fallback_cb'     => '',
                                            'menu_id'         => 'conference-menu',
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div id="content" class="container-fluid" style="background-color: <?= $colour ?>">
        <div class="row">
            <div class="col-12 no-padding">
                <main class="site-main container" id="main">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        switch ($post->ID) {
                            case 19:
                                get_template_part('loop-templates/content', 'blog');
                                break;
                            case  161:
                                get_template_part('loop-templates/content', 'webinar');
                                break;
                            case  241:
                                get_template_part('loop-templates/content', 'past-events');
                                break;
                            case  764:
                                get_template_part('loop-templates/content', 'past-events');
                                break;
                            case  393:
                                get_template_part('loop-templates/content', 'webinar');
                                break;
                            case  409:
                                get_template_part('loop-templates/content', 'courses');
                                break;
                            case  395:
                                get_template_part('loop-templates/content', 'courses');
                                break;
                            case  1392:
                                get_template_part('loop-templates/content', 'thankyou');
                                break;
                            default:
                                get_template_part('loop-templates/content', 'page');
                        }
                        ?>
                    <?php endwhile; // end of the loop. ?>
                </main><!-- #main -->
            </div>
        </div>
    </div>
</div><!-- #page-wrapper -->
</div><!-- close top section wrapper -->
<?php
get_footer();
