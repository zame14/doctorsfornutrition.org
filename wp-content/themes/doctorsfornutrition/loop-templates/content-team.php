<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/27/2022
 * Time: 8:17 PM
 */
defined( 'ABSPATH' ) || exit;
global $post;
$team_member = new Team($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?=$team_member->getProfile()?>
</article>