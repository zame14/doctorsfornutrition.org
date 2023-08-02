<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2022
 * Time: 10:22 AM
 */
defined( 'ABSPATH' ) || exit;
get_header();
global $post;
$course = new Course($post->ID);
?>
    <div class="wrapper" id="single-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h1><?=$course->getTitle()?></h1>
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
                <div class="col-12">
                    <main class="site-main container" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            get_template_part( 'loop-templates/content', 'course' );
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
