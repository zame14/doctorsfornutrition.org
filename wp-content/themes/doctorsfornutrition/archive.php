<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
$colour = '#ffffff';
if(is_category()) {
    $colour = '#F5F1EB';
}
?>
<div class="wrapper" id="archive-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="page-title">
                    <h1><?=the_archive_title( '<h1 class="page-title">', '</h1>' );?></h1>
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
    <div id="content" class="container-fluid" style="background-color: <?=$colour?>">
        <div class="row">
            <div class="col-12">
                <main class="site-main container" id="main">
                    <?php
                    if(is_category()) {
                        get_template_part('loop-templates/content', 'blog');
                    } else {
                        if (have_posts()) {
                            // Start the loop.
                            while (have_posts()) {
                                the_post();

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part('loop-templates/content', get_post_format());
                            }
                        } else {
                            //get_template_part( 'loop-templates/content', 'none' );
                        }
                    }
                    ?>
                </main>
            </div>
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #archive-wrapper -->
</div>
<?php
get_footer();
