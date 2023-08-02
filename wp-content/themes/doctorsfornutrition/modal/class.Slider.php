<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2022
 * Time: 9:08 PM
 */
class Slider extends dfnBase
{
    function getSlides1()
    {
        $parent_id = $this->id();
        $relationship_slug = 'slider-slide';
        $slides = array();
        $posts_array = toolset_get_related_posts(
            $parent_id,
            $relationship_slug,
            array(
                'query_by_role' => 'parent', // origin post role
                'role_to_return' => 'child', // role of posts to return
                'return' => 'post_id', // return array of IDs (post_id) or post objects (post_object)
                'limit' => 999, // max number of results
                'offset' => 0, // starting from
                'orderby' => null,
                'order' => 'ASC',
                'need_found_rows' => false, // also return count of results
                'args' => null // for adding meta queries etc.
            )
        );
        foreach ($posts_array as $post)
        {
            $slide = new Slide($post);
            $slides[] = $slide;
        }
        return $slides;
    }
    function getSlides()
    {
        $slides = array();
        $query = new WP_Query(
            array(
                'post_type' => 'slide',
                'toolset_relationships' => array(
                    'role' => 'child',
                    'related_to' => $this->id(), // ID of starting post
                    'relationship' =>'slider-slide',
                ),
                'order_by' => 'menu_order'
            )
        );
        foreach($query->posts as $post)
        {
            $slide = new Slide($post->ID);
            $slides[] = $slide;
        }
        return $slides;
    }
}