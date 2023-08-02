<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$page = new Page(273);
?>

<div class="wrapper" id="error-404-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="page-title">
                    <h1>404 Error - Page Not Found</h1>
                </div>
                <div class="breadcrumb-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="plain">
                                    <li><a href="<?=get_page_link(5)?>">Home</a></li>
                                    <li>404 Error - Page Not Found</li>
                                </ul>
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
                    <section class="error-404 not-found">
                        <div class="page-content">
                            <?=$page->getContent(true)?>
                        </div>
                    </section>
                </main><!-- #main -->
            </div>
        </div>
    </div>
</div><!-- #error-404-wrapper -->
</div>
<?php
get_footer();
