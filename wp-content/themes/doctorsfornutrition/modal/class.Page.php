<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/21/2022
 * Time: 11:13 AM
 */
class Page extends dfnBase
{
    function displaySubscriptionForm()
    {
        if($this->getPostMeta('page-display-subscription-form') == 1) {
            return true;
        } else {
            return false;
        }
    }
    function displayTestimonialsSlider()
    {
        if($this->getPostMeta('page-display-testimonials') == 1 || $this->getPostMeta('page-display-testimonials') == 2) {
            return true;
        } else {
            return false;
        }
    }
    function hasPageIntroduction()
    {
        if($this->getPostMeta('page-introduction-text') <> "") {
            return true;
        } else {
            return false;
        }
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    function pageBackgroundColour()
    {
        if($this->getPostMeta('page-background-colour') <> "") {
            $colour = $this->getPostMeta('page-background-colour');
        } else {
            $colour = '#ffffff';
        }
        return $colour;
    }
    function getPageTitle() {
        if(get_field('alt_title', $this->id()) <> "")
        {
            return get_field('alt_title', $this->id());
        } else {
            return $this->getTitle();
        }
    }
    function displayPageForm()
    {
        if($this->getPostMeta('page-form-field') <> "") {
            return true;
        } else {
            return false;
        }
    }
    function isWebinar()
    {
        $post_type = get_post_type($this->id());
        if($post_type == "event") {
            $event = new Event($this->id());
            if($event->isWebinar()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function showPrintButton()
    {
        if($this->getPostMeta('printer-friendly-page') == 1)
        {
            return true;
        } else {
            return false;
        }
    }
    function isRecipe()
    {
        $post_type = get_post_type($this->id());
        if($post_type == "recipe") {
            return true;
        } else {
            return false;
        }
    }
    function getFormTitle()
    {
        $title = 'Subscribe to our newsletter';
        if($this->getPostMeta('page-form-title') != "") {
            $title = $this->getPostMeta('page-form-title');
        }
        return $title;
    }
    function isBlog()
    {
        $post_type = get_post_type($this->id());
        if($post_type == "post") {
            return true;
        } else {
            return false;
        }
    }
    function isConferencePage()
    {
        // check if we are on the conference home page
        if($this->id() == get_option('conference-page-id')) {
            return true;
        } else {
            // not on conference home page but check if we on a conference sub page
            $children = get_children(get_option('conference-page-id'));
            foreach($children as $child) {
                if ($this->id() == $child->ID) {
                    return true;
                    break;
                }
            }
            return false;
        }
    }
    function isConferenceHomePage()
    {
        if($this->id() == get_option('conference-page-id')) {
            return true;
        } else {
            return false;
        }
    }
}