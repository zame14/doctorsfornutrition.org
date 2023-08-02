<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/20/2022
 * Time: 9:49 AM
 */
global $post;
$page = new Page($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- .entry-header -->
    <?php
    if($page->hasPageIntroduction()) { ?>
        <div class="row">
            <div class="col-12 page-intro">
                <?=wpautop($page->getCustomField('page-introduction-text'))?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
