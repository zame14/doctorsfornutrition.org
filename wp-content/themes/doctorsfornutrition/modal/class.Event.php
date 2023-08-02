<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/5/2022
 * Time: 2:52 PM
 */
class Event extends dfnBase
{
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function eventPanel()
    {
        $html = '<div class="inner-wrapper">';
            if($this->isWebinar())
            {
                $html .= '<div class="series">' . $this->getCustomField('webinar-series') . '</div>';
            }
            $html .= '
            <h4>' . $this->getTitle() . '</h4>
            <div class="event-details">
                <ul class="plain">
                    <li><span class="fas fa-calendar-day"></span> ' . $this->getCalendarLabel() . '</li>';
                    if($this->isUpcomingEvent()) {
                        $html .= '<li class="event-times-wrapper"><span class="fas fa-clock"></span> ' . $this->getEventTimes() . '</li>';
                    }
                    if($this->getCustomField('event-type') == 1) {
                        // online event
                        $html .= '<li><span class="fas fa-globe"></span></li>';
                    } else {
                        $html .= '<li><span class="fas fa-user-friends"></span></li>';
                    }
                $html .= '
                </ul>';
                if($this->cfIsSet('event-location')) {
                    $html .= '<div class="location"><span class="fas fa-map-marker-alt"></span> ' . $this->getCustomField('event-location') . '</div>';
                }
                $html .= '
                <div class="hosted-by">Hosted by ' . $this->getCustomField('event-hosted-by') . '</div>
            </div>
            <div class="snippet">
                ' . $this->getSnippet() . '
            </div>';
            if($this->isUpcomingEvent()) {
                if($this->getCustomField('event-cpd') <> "")
                {
                    $html .= '<div class="cpd-wrapper">
                        ' . $this->getCustomField('event-cpd') . '
                    </div>';
                }
                if($this->getCustomField('event-accreditation-logos') <> "")
                {
                    $html .= '<div class="accreditation-logos-wrapper">';
                    foreach ($this->getAccreditationLogos() as $logo_src)
                    {
                        $logo_id = getImageID($logo_src);
                        $img = wp_get_attachment_image_src($logo_id, 'full');
                        $html .= '<div><img src="' . $img[0] . '" alt="" /></div>';
                    }
                    $html .= '
                </div>';
                }
            }
            $html .= '<ul class="plain event-buttons">';
            if($this->isUpcomingEvent())
            {
                if($this->getDate() == 'TBC')
                {
                    // display expressions of interest page
                    ($this->cfIsSet('event-eoi-button-label')) ? $eoi_label = $this->getCustomField('event-eoi-button-label') : $eoi_label = 'Expressions of interest';
                    ($this->cfIsSet('event-eoi-button-url')) ? $eoi_url = $this->getCustomField('event-eoi-button-url') : $eoi_url = 'javascript:;';
                    ($this->getCustomField('event-eoi-new-tab') == 1) ? $target= 'target="_blank"' : $target = '';
                    $html .= '<li><a href="' . $eoi_url . '" class="btn btn-primary" ' . $target . '>' . $eoi_label . '</a></li>';
                    if($this->cfIsSet('event-custom-find-out-more-link')) {
                        // check if we need to open link in a new tab
                        ($this->getCustomField('event-find-out-more-in-new-tab') == 1) ? $target="target='_blank'" : $target = '';
                        $html .= '<li><a href="' . $this->getCustomField('event-custom-find-out-more-link') . '" class="btn btn-primary" ' . $target . '>Find out more</a></li>';
                    }
                } else {
                    // display link to zoom registration page
                    if($this->cfIsSet('event-custom-find-out-more-link')) {
                        // check if we need to open link in a new tab
                        ($this->getCustomField('event-find-out-more-in-new-tab') == 1) ? $target="target='_blank'" : $target = '';
                        $html .= '<li><a href="' . $this->getCustomField('event-custom-find-out-more-link') . '" class="btn btn-primary" ' . $target . '>Find out more</a></li>';
                    } else {
                        $registration_link = get_option('zoom-url') . $this->getCustomField('registration-code');
                        $html .= '<li><a href="' . $registration_link . '" class="btn btn-primary" target="_blank">register for free today</a></li>';
                    }
                }
            } else {
                // past event
                if($this->getContent() <> "") {
                    ($this->getCustomField('event-find-out-more-in-new-tab') == 1) ? $target="target='_blank'" : $target = '';
                    // has a description so display buttons
                    // if webinar display watch now button, otherwise find out more button
                    if($this->isWebinar()) {
                        $url = '#watch';
                        $label = 'Gain CPD';
                        if($this->cfIsSet('custom-find-out-more-label')) {
                            $label = $this->getCustomField('custom-find-out-more-label');
                        }
                        $html .= '<li><a href="' . $url . '" class="btn btn-primary">Watch now</a></li>';
                        $html .= '<li><a href="' . $this->findOutMoreLink() . '" class="btn btn-primary" ' . $target . '>' . $label . '</a></li>';
                    } else {
                        $html .= '<li><a href="' . $this->findOutMoreLink() . '" class="btn btn-primary" ' . $target . '>Find out more</a></li>';
                    }
                }
            }
            $html .= '</ul>';
        $html .= '
        </div>';
        return $html;
    }
    public function getFeatureImage($size = 'full')
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    function getCategory()
    {
        global $wpdb;

        $sql = '
        SELECT t.term_id
        FROM ' . $wpdb->prefix . 'term_relationships tr
        INNER JOIN ' . $wpdb->prefix . 'term_taxonomy t
        ON tr.term_taxonomy_id = t.term_taxonomy_id
        WHERE object_id = ' . $this->id();
        $result = $wpdb->get_results($sql);

        return new Category($result[0]->term_id);
    }
    function getDate()
    {
        $date = '';
        if($this->cfIsSet('event-date')) {
            if($this->cfIsSet('event-end-date')) {
                $date1 = date('j', $this->getPostMeta('event-date'));
                $date2 = date('j F Y', $this->getPostMeta('event-end-date'));
                $date = $date1 . ' - ' . $date2;
            } else {
                $date = date('j F Y', $this->getPostMeta('event-date'));
            }
        } else {
            $date = 'TBC';
        }
        return $date;
    }
    function isUpcomingEvent()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date("Y-m-d");// current date
        $now =  strtotime(date("Y-m-d", strtotime($date)));
        if($this->getDate() == "TBC") {
            // upcoming event, has not set date yet
            return true;
        } else {
            if($this->getPostMeta('event-date') >= $now) {
                return true;
            } else {
                return false;
            }
        }
    }
    function getSnippet()
    {
        $content = wpautop($this->getPostMeta('event-snippet1'));
        return $content;
    }
    function getEventTimes()
    {
        $html = '';
        if($this->getDate() == "TBC") {
            // just display TBC
            $html = 'TBC';
        } else {
            $class = '';
            if($this->cfIsSet('event-time-aest') && $this->cfIsSet('event-time-nzt')) {
                $class = 'alt';
            }
            $html = '<div class="event-times ' . $class . '">';
            if ($this->cfIsSet('event-time-aest')) {
                $html .= '<div>' . $this->getPostMeta('event-time-aest') . '</div>';
            }
            if ($this->cfIsSet('event-time-nzt')) {
                $html .= '<div>' . $this->getPostMeta('event-time-nzt') . '</div>';
            }
            $html .= '
            </div>';
        }
        return $html;
    }
    function getAccreditationLogos()
    {
        $logos = Array();
        $field = get_post_meta($this->id());
        foreach ($field['wpcf-event-accreditation-logos'] as $logo) {
            $logos[] = $logo;
        }
        return $logos;
    }
    function isWebinar()
    {
        $cat = $this->getCategory();
        if($cat->id() == 17) {
            return true;
        } else {
            return false;
        }
    }
    function cfIsSet($meta)
    {
        if($this->getCustomField($meta) <> "") {
            return true;
        } else {
            return false;
        }
    }
    function findOutMoreLink()
    {
        $link = $this->link();
        if($this->cfIsSet('event-custom-find-out-more-link')) {
            $link = $this->getCustomField('event-custom-find-out-more-link');
        }
        return $link;
    }
    function getCalendarLabel()
    {
        if($this->cfIsSet('event-alt-calendar-label')) {
            return $this->getCustomField('event-alt-calendar-label');
        } else {
            return $this->getDate();
        }
    }
}