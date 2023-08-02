<?php
defined( 'ABSPATH' ) || exit;
global $post;
$course = new Course($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-12">
            <div class="event-details">
                <ul class="plain">
                    <li><span class="fas fa-calendar-day"></span> <?=$course->getCalendarLabel()?></li>
                </ul>
            </div>
        </div>
        <div class="col-12">
            <h3><?=$course->getTitle()?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?=$course->getContent(true)?>
        </div>
    </div>
    <?php
    if($course->getCustomField('course-accreditation-logos') <> "") { ?>
        <div class="row">
            <div class="col-12">
                <div class="accreditation-logos-wrapper">
                    <?php
                    foreach ($course->getAccreditationLogos() as $logo_src)
                    {
                        $logo_id = getImageID($logo_src);
                        $img = wp_get_attachment_image_src($logo_id, 'full');
                        $html .= '<div><img src="' . $img[0] . '" alt="" /></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</article>