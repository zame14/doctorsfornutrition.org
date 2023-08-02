<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2022
 * Time: 9:10 AM
 */
class Course extends dfnBase
{
    function getDate()
    {
        $date = '';
        if($this->cfIsSet('course-date')) {
            if($this->cfIsSet('course-end-date')) {
                $date1 = date('j', $this->getPostMeta('course-date'));
                $date2 = date('j F Y', $this->getPostMeta('course-end-date'));
                $date = $date1 . ' - ' . $date2;
            } else {
                $date = date('j F Y', $this->getPostMeta('course-date'));
            }
        } else {
            $date = 'ON DEMAND';
        }
        return $date;
    }
    function cfIsSet($meta)
    {
        if($this->getCustomField($meta) <> "") {
            return true;
        } else {
            return false;
        }
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function isUpcomingCourse()
    {
        date_default_timezone_set('Australia/Melbourne');
        $date = date("Y-m-d");// current date
        $now =  strtotime(date("Y-m-d", strtotime($date)));
        if($this->getPostMeta('course-date') >= $now) {
            // upcoming event, has not set date yet
            return true;
        } else {
            return false;
        }
    }
    public function getFeatureImage($size = 'full')
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    function getSnippet()
    {
        $content = wpautop($this->getPostMeta('course-snippet'));
        return $content;
    }
    function getAccreditationLogos()
    {
        $logos = Array();
        $field = get_post_meta($this->id());
        foreach ($field['wpcf-course-accreditation-logos'] as $logo) {
            $logos[] = $logo;
        }
        return $logos;
    }
    function coursePanel()
    {
        $html = '
        <div class="inner-wrapper">
            <h4>' . $this->getTitle() . '</h4>';
            if($this->isDFNCourse()) {
                $html .= '<div class="event-details">
                     <ul class="plain">
                        <li><span class="fas fa-calendar-day"></span> ' . $this->getCalendarLabel() . '</li>
                     </ul>            
                </div>
                <div class="snippet">
                   ' . $this->getSnippet() . '
                </div>';
            } else {
                $html .= '<div class="snippet">
                    ' . $this->getContent(true) . '
                </div>';
            }
            if($this->getCustomField('course-accreditation-logos') <> "")
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
        if($this->isDFNCourse()) {
            $btn_label = 'find out more';
            if($this->getDate() == "ON DEMAND") {
                $btn_link = $this->getCustomField('course-registration-code');
                $target = 'target="_blank"';
            } else {
                $btn_link = $this->getCustomField('course-registration-code');
                $target = 'target="_blank"';
            }
        } else {
            $btn_label = 'Find out more';
            $btn_link = $this->getCustomField('course-custom-find-out-more-link');
            $target = 'target="_blank"';
        }
        $html .= '<ul class="plain event-buttons">
            <li><a href="' . $btn_link . '" class="btn btn-primary" ' . $target . '>' . $btn_label . '</a></li>
        </ul>    
        </div>';

        return $html;
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
    function isDFNCourse()
    {
        $cat = $this->getCategory();
        if($cat->id() == 43) {
            return true;
        } else {
            return false;
        }
    }
    function getCalendarLabel()
    {
        if($this->cfIsSet('course-alt-calendar-label')) {
            return $this->getCustomField('course-alt-calendar-label');
        } else {
            return $this->getDate();
        }
    }
}