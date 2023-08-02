<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
global $post;
?>
    <div class="wrapper" id="single-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 no-padding">
                    <div class="page-title">
                        <h1><?=get_option('team-title')?></h1>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <?=breadcrumb()?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="container-fluid" style="background-color: #ffffff">
            <div class="row">
                <div class="col-12 no-padding">
                    <main class="site-main container" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            get_template_part( 'loop-templates/content', 'team' );
                            ?>
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
            </div>
        </div>
    </div><!-- #single-wrapper -->
    </div>
<?php
get_footer();