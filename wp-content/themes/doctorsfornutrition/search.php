<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="wrapper" id="search-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 no-padding">
                <div class="page-title">
                    <h1>
                        <?php
                        printf(
                        /* translators: %s: query term */
                            esc_html__( 'Search Results for: %s', 'understrap' ),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
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
                    <?php if ( have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            /*
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content', 'search' );
                        endwhile;
                        ?>
                        <?php else : ?>
                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>
                    <?php endif; ?>
                </main>
            </div>
        </div>
    </div>
</div><!-- #search-wrapper -->
</div>
<?php
get_footer();
