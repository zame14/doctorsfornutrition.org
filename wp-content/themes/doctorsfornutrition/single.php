<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
get_header();
$page = new Page($post->ID);
$colour = $page->pageBackgroundColour();
?>
<div class="wrapper" id="single-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="page-title">
                    <h1><?= get_option('blog-title') ?></h1>
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
    <div id="content" class="container-fluid" style="background-color: <?= $colour ?>">
        <div class="row">
            <div class="col-12 no-padding">
                <main class="site-main container" id="main">
                    <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('loop-templates/content', 'single');
                    }
                    ?>
                </main><!-- #main -->
            </div>
        </div>
    </div>
    <div id="recent-articles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?= do_shortcode('[blog_feed limit="3"]') ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- #single-wrapper -->
</div>
<?php
get_footer();