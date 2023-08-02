<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
global $post;
$event = new Event($post->ID);
// check if upcoming or past event
if($event->isUpcomingEvent()) {
    if($event->isWebinar()) {
        $page_title = "Upcoming Food Vitals Webinars";
    } else {
        $page_title = "Upcoming Events";
    }
} else {
    if($event->isWebinar()) {
        $page_title = "Past Food Vitals Webinars";
    } else {
        $page_title = "Past Events";
    }
}
?>
<div class="wrapper" id="single-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="page-title">
                    <h1><?=$page_title?></h1>
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
                        get_template_part( 'loop-templates/content', 'event' );
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