<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/20/2022
 * Time: 9:49 AM
 */
global $post;
$page = new Page($post->ID);
if(isset($_REQUEST['action']) && $_REQUEST['action'] <> "") {
    $meta = str_replace("-","_",$_REQUEST['action']);
} else {
    // default message if something goes wrong.
    $meta = 'subscribe_new';
}
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
    <div class="thankyou-message-wrapper">
        <?=get_field($meta, $page->id())?>
    </div>
</article><!-- #post-## -->