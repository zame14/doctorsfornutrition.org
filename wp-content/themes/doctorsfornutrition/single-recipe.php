<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$action = '';
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "print") {
    $action = $_REQUEST['action'];
    //get_header('print');
} else {
    //get_header();
}
get_header();
global $post;
$recipe = new Recipe($post->ID);
?>
    <div class="wrapper" id="single-wrapper">
        <?php
        if($action == "") {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 no-padding">
                    <div class="page-title">
                        <h1>Our Recipes</h1>
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
        <?php } ?>
        <div id="content" class="container-fluid" style="background-color: #ffffff">
            <div class="row">
                <div class="col-12 no-padding">
                    <main class="site-main container" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            get_template_part( 'loop-templates/content', 'recipe' );
                            ?>
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
            </div>
        </div>
        <?php
        if($action == "") { ?>
            <div id="content-recipe-navigation" class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <?= $recipe->navigation() ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div><!-- #single-wrapper -->
    </div>
<?php
if($action == "") {
    get_footer();
}