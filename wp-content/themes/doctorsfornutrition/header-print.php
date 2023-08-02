<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/12/2022
 * Time: 11:04 AM
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$page = new Page($post->ID);
($page->isRecipe()) ? $page_title = 'Our Recipes' : $page_title = $page->getTitle();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <?php wp_head(); ?>
</head>
<body onLoad="javascript:window.print();">
    <section id="print-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="print-page-title">
                        <h1><?=$page_title?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>