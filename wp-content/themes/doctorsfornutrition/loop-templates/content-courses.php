<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/5/2022
 * Time: 2:07 PM
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
        <?php
        if($post->ID == 409) {
            // a clinicians page
            echo getCourses(0, $post->ID);
        } else {
            echo getOtherCourses();
        }
        ?>
    </div>
</article>