<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/27/2022
 * Time: 8:17 PM
 */
defined( 'ABSPATH' ) || exit;
global $post;
$clinician = new Clinician($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?=$clinician->getClinician()?>
    <div class="row">
        <div class="col-12">
            <?=do_shortcode('[medical_disclaimer]')?>
        </div>
    </div>
</article>