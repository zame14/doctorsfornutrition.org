<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/9/2022
 * Time: 1:26 PM
 */
defined( 'ABSPATH' ) || exit;
global $post;
$event = new Event($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <?php
        if($event->isWebinar()) { ?>
            <div class="col-12">
                <div class="series"><?=$event->getCustomField('webinar-series')?></div>
            </div>
        <?php
        }
        ?>
        <div class="col-12 event-details">
            <ul class="plain">
                <li><span class="fas fa-calendar-day"></span><?=$event->getDate()?></li>
                <?php
                if($event->isUpcomingEvent()) { ?>
                    <li class="event-times-wrapper"><span class="fas fa-clock"></span><?=$event->getEventTimes()?></li>
                <?php
                }
                if($event->getCustomField('event-type') == 1) { ?>
                    <li><span class="fas fa-globe"></span></li>
                <?php
                } else { ?>
                    <li><span class="fas fa-user-friends"></span></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-12">
            <h3><?=$event->getTitle()?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?=$event->getContent(true)?>
        </div>
    </div>
    <?php
    if($event->isWebinar() && $event->isUpcomingEvent()) { ?>
        <div class="row">
            <div class="col-12">
                <div><strong>About the Speaker</strong></div>
                <?=$event->getCustomField('webinar-speaker')?>
            </div>
        </div>
    <?php
    }
    if($event->isWebinar()) { ?>
        <div class="row">
            <div class="col-12 watch-now-btn-wrapper">
                <a href="#watch" class="btn btn-primary">Watch now</a>
            </div>
        </div>
    <?php
    }
    ?>
</article>