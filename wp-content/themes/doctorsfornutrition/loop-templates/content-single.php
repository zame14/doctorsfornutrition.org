<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
$blog = new Blog($post->ID);
$show_author_image = false;
$team = '';
if($blog->getCustomField('post-guest-author') == "") {
    // not a guest author.  Get team member who wrote this article.
    $team = $blog->getAuthor();
    $author_html = '<a href="' . $team->link() . '">' . $team->getTitle() . ', ' . $team->getCustomField('team-position') . '</a>';
    $show_author_image = true;
} else {
    $author_html = '<a href="javascript:;">' . $blog->getCustomField('post-guest-author') . '</a>';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-12 blog-title">
            <h2><?=$blog->getTitle()?></h2>
        </div>
        <div class="col-12 author-wrapper">
            <ul class="plain">
                <?php
                if($show_author_image)
                { ?>
                    <li><?=$team->getImage('thumbnail')?></li>
                <?php
                }
                ?>
                <li><?=$author_html?></li>
                <li><span class="fas fa-calendar-alt"></span><?=$blog->getPostDate()?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 blog-content-wrapper">
            <?php
            the_content();
            ?>
        </div>
    </div>
</article>
