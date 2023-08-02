<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/9/2022
 * Time: 4:20 PM
 */
global $post;
$page = new Page($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
    <div class="events-wrapper">
        <?=getPastEvents()?>
    </div>
</article>
