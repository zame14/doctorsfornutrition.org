<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/12/2022
 * Time: 10:33 AM
 */
defined( 'ABSPATH' ) || exit;
global $post;
$recipe = new Recipe($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?=$recipe->getTemplate()?>
</article>
