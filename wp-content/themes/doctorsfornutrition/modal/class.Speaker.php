<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/13/2022
 * Time: 10:39 AM
 */
class Speaker extends dfnBase
{
    public function getImage($size = 'full')
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function getProfile()
    {
        $previous = $this->previous();
        $next = $this->next();
        $html = '
        <div class="row inner-wrapper">
            <div class="col-12 col-sm-12 col-md-4 col-lg-5 left-col">
                <div class="image-wrapper">
                    ' . $this->getImage() . '
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-7 right-col">
                <div class="content-wrapper">
                    <h3>' . $this->getTitle() . '</h3>
                    <div class="position">' . $this->getCustomField('team-position') . '</div>
                    <div class="description">' . $this->getContent() . '</div>';
        if($this->getCustomField('team-quote') <> "")
        {
            $html .= '
                        <div class="team-quote">
                            <span class="fas fa-quote-left"></span>
                            ' . $this->getCustomField('team-quote') . '
                        </div>';
        }
        $html .= '    
                </div>
            </div>
            <a class="previous-team" href="' . $previous->link() . '"><span class="left-arrow"></span></a>
            <a class="next-team" href="' . $next->link() . '"><span class="right-arrow"></span></a>
        </div>';
        return $html;
    }
    function previous()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.menu_order < ' . $this->getMenuPosition() . '
        AND post_status="publish" 
        AND post_type="speaker"
        ORDER BY p.menu_order DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);
        $prev_id = $result[0]->ID;
        if($prev_id == "") {
            $sql = '
            SELECT p.ID
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="speaker"
            ORDER BY p.menu_order DESC
            LIMIT 1';
            $result = $wpdb->get_results($sql);
            $prev_id = $result[0]->ID;
        }
        return new Speaker($prev_id);
    }
    function next()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.menu_order > ' . $this->getMenuPosition() . '
        AND post_status="publish" 
        AND post_type="speaker"
        ORDER BY p.menu_order ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);
        $next_id = $result[0]->ID;
        if($next_id =="") {
            $sql = '
            SELECT p.ID
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="speaker"
            ORDER BY p.menu_order ASC
            LIMIT 1';
            $result = $wpdb->get_results($sql);
            $next_id = $result[0]->ID;
        }
        return new Speaker($next_id);
    }
}