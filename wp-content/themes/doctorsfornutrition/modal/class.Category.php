<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/27/2022
 * Time: 10:51 AM
 */
class Category
{
    public $Term = null;

    function __construct($term)
    {
        // If an ID is passed instead then change for a post array
        if(intval($term)) $term = get_term($term);
        $this->Term = $term;
    }

    public function id() {
        return $this->Term->term_id;
    }

    function getTermMeta($meta, $prefix = true) {
        if($prefix) $meta = 'wpcf-' . $meta;
        return get_term_meta($this->Term->term_id, $meta, true);
    }


    public function getTitle()
    {
        $title = $this->Term->name;
        return $title;
    }
    public function getFeatureImage()
    {
        return $this->getTermMeta('category-feature-image');
    }
    public function slug($page_id)
    {
        if($page_id == 19) {
            $term = get_term( $this->Term->term_id, 'category');
            $slug = $term->slug;
        } else {
            $category = str_replace(" ","-",$this->Term->name);
            $category = strtolower($category);
            $slug = get_page_link(19) . $category;
        }
        return $slug;
    }
}