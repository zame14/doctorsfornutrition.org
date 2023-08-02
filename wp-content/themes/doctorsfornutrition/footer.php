<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
$page = new Page($post->ID);
if($post->ID <> 5)
{
    // don't display this on home page. Testimonial on home page added via page builder.
    if($page->displayTestimonialsSlider())
    { ?>
        <section id="testimonials-slider">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?=do_shortcode('[testimonials_slider]')?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
if($page->displayPageForm())
{ ?>
<a name="watch"></a>
<section id="page-form">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3><?=$page->getFormTitle()?></h3>
            </div>
            <div class="col-12">
                <?=$page->getCustomField('page-form-field')?>
            </div>
        </div>
    </div>
</section>
<?php
}
if($page->isWebinar())
{
    // this dynamic page needs to display the watch now webinar form. Get the form from the Webinar parent page
    $webinar_page = new Page(161);
    ?>
    <a name="watch"></a>
    <section id="page-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Access Our Webinar Recordings</h3>
                </div>
                <div class="col-12">
                    <?=$webinar_page->getCustomField('page-form-field')?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                if(is_active_sidebar('footerwidget1')){
                    dynamic_sidebar('footerwidget1');
                }
                ?>
            </div>
            <div class="col-12">
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'footer-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => 'plain',
                        'fallback_cb'     => '',
                        'menu_id'         => 'footer-menu',
                    )
                ); ?>
            </div>
            <div class="col-12">
                <?php
                if(is_active_sidebar('footerwidget2')){
                    dynamic_sidebar('footerwidget2');
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-wrapper">
                    <div class="c-col-1">
                        &copy; <?=date('Y')?> <?=get_bloginfo('name')?>
                    </div>
                    <div class="c-col-2">
                        <div class="registered-charity">
                            <div>Registered Charity - <?=get_option('abn')?></div>
                            <div>Donations $2 and over are tax deductible</div>
                        </div>
                        <?php
                        if(is_active_sidebar('footerwidget')){
                            dynamic_sidebar('footerwidget');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="searchModal" class="modal">
    <span class="fas fa-times"></span>
    <div class="modal-content">
        <div class="inner-wrapper">
            <?=customSearchForm()?>
        </div>
    </div>
</div>
<?php
if($page->showPrintButton() || $page->isRecipe() || $page->isBlog())
{ ?>
    <a class="print-friendly" href="javascript:;">
        <span class="fas fa-print"></span>
    </a>
<?php
}
?>
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=get_stylesheet_directory_uri()?>/slick-carousel/slick/slick.js"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/noframework.waypoints.min.js" type="text/javascript"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/theme.js" type="text/javascript"></script>
</body>
</html>