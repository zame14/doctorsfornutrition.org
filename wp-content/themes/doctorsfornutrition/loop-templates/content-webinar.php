<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/5/2022
 * Time: 2:07 PM
 */
global $post;
$page = new Page($post->ID);
if(isset($_REQUEST['action']) && $_REQUEST['action']=="time") {
    //$event = new Event(5960);

}
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
        <?=getWebinarEvents(0, $post->ID)?>
    </div>
</article>