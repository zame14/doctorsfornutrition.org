<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/13/2022
 * Time: 10:43 AM
 */
defined( 'ABSPATH' ) || exit;
global $post;
$speaker = new Speaker($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?=$speaker->getProfile()?>
</article>