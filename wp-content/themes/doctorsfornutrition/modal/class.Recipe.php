<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/11/2022
 * Time: 8:18 PM
 */
class Recipe extends dfnBase
{
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    public function getImage($size = 'full')
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    function getTemplate()
    {
        ($this->cfIsSet('recipe-total-cook-time')) ? $cook_class = '' : $cook_class = 'no-cook-time';
        $html = '
        <div class="row top-section">
            <div class="col-12 col-sm-6 left-col">
                <div class="image-wrapper">
                    ' . $this->getImage('blog');
                    if($this->hasElement('recipe-photographer-credit')) {
                        $html .= '<div class="photo-credit">' . $this->getPhotographersCredit() . '</div>';
                    }
                $html .= '</div>
            </div>
            <div class="col-12 col-sm-6 right-col">
                <div class="content-wrapper">
                    <ul class="plain meal-types">';
                    foreach ($this->getCategories("recipe-meal-type") as $meal_type) {
                        $html .= '<li>' . $meal_type->getTitle() . '</li>';
                    }
                    $html .= '</ul>
                    <h2>' . $this->getTitle() . '</h2>
                    <ul class="plain cook-times ' . $cook_class . '">
                        <li><span class="icon-recipe_page_prepare"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>' . $this->getCustomField('recipe-prep-time') . ' mins</li>';
                        if($this->cfIsSet('recipe-total-cook-time')) {
                            $html .= '<li><span class="icon-recipe_page_cook"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>' . $this->getCustomField('recipe-total-cook-time') . ' mins</li>';
                        }
                        $html .= '<li><span class="icon-recipe_page_eat"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>Serves ' . $this->getCustomField('recipe-servings') . '</li>
                    </ul>
                    <ul class="plain special-requirements">';
                    foreach ($this->getCategories("recipe-special-requirement") as $special) {
                        $html .= '<li>' . $special->getTitle() . '</li>';
                    }
                    $html .= '</ul>
                    <div class="description">
                        ' . $this->getContent() . '
                    </div>';
                    if($this->hasElement('recipe-card')) {
                        $html .= '<a href="' . $this->getCustomField('recipe-card') . '" class="recipe-card" target="_blank">Download recipe card <span class="fas fa-arrow-alt-circle-down"></span></a>';
                    }
                $html .= '</div>
            </div>
        </div>
        <div class="row middle-section">
            <div class="col-12 col-sm-6 ingredients-wrapper">
                <h3>Ingredients</h3>
                ' . $this->getIngredients() . '
            </div>
            <div class="col-12 col-sm-6 directions-wrapper">
                <h3>Directions</h3>
                ' . $this->getDirections() . '
            </div>        
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 tips-wrapper">
                <h4>Chef\'s Tips</h4>
                ' . $this->getCustomField('recipe-chefs-tips') . '
            </div>
            <div class="col-12 col-sm-6 contributor-wrapper">';
                if($this->hasElement('contributors-image')) {
                    $html .= '<div class="image-wrapper">
                        <img src="' . $this->getCustomField('contributors-image') . '" alt="' . $this->getCustomField('contributors-name') . '" />
                    </div>';
                }
                $html .= '
                <div class="content-wrapper">
                    <div class="name">' . $this->getCustomField('contributors-name') . '</div>
                    <div class="socials-wrapper">
                        ' . $this->getSocials() . '
                    </div>
                </div>    
            </div>
        </div>';
        return $html;
    }
    function getCategories($taxonomy)
    {
        global $wpdb;
        $categories = array();
        $sql = '
        SELECT tt.term_id
        FROM ' . $wpdb->prefix . 'term_relationships tr
        INNER JOIN ' . $wpdb->prefix . 'term_taxonomy tt
        ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN ' . $wpdb->prefix . 'terms t
        ON tt.term_id = t.term_id
        WHERE object_id = ' . $this->id() . '
        AND tt.taxonomy = "' . $taxonomy . '"
        ORDER BY t.term_order ASC';
        $results = $wpdb->get_results($sql);
        foreach($results as $result)
        {
            $category = new Category($result->term_id);
            $categories[] = $category;
        }
        return $categories;
    }
    function hasElement($meta)
    {
        if($this->getCustomField($meta) <> "") {
            return true;
        } else {
            return false;
        }
    }
    public function getIngredients()
    {
        $content = wpautop($this->getPostMeta('recipe-ingredients'));
        return $content;
    }
    public function getDirections()
    {
        $content = wpautop($this->getPostMeta('recipe-directions'));
        return $content;
    }
    function getSocials()
    {
        $html = '<ul class="plain">';
        if($this->hasElement('contributors-facebook-link')) {
            $html .= '<li><a href="' . $this->getCustomField('contributors-facebook-link') . '" target="_blank"><span class="fab fa-facebook-square"></span></a></li>';
        }
        if($this->hasElement('contributors-instagram-link')) {
            $html .= '<li><a href="' . $this->getCustomField('contributors-instagram-link') . '" target="_blank"><span class="fab fa-instagram"></span></a></li>';
        }
        if($this->hasElement('contributors-linkedin-link')) {
            $html .= '<li><a href="' . $this->getCustomField('contributors-linkedin-link') . '" target="_blank"><span class="fab fa-linkedin"></span></a></li>';
        }
        if($this->hasElement('contributors-twitter-link')) {
            $html .= '<li><a href="' . $this->getCustomField('contributors-twitter-link') . '" target="_blank"><span class="fab fa-twitter-square"></span></a></li>';
        }
        if($this->hasElement('contributors-website')) {
            $html .= '<li><a href="' . $this->getCustomField('contributors-website') . '" target="_blank"><span class="fas fa-globe"></span></a></li>';
        }
        $html .= '</ul>';
        return $html;
    }
    function navigation()
    {
        $prev = $this->previous();
        $next = $this->next();
        $html = '<ul class="plain">
            <li><a href="' . $prev->link() . '" class="btn btn-primary">Previous</a></li>
            <li><a href="' . get_page_link(352) . '" class="btn btn-primary">Recipe Index</a></li>
            <li><a href="' . $next->link() . '" class="btn btn-primary">Next</a></li>
        </ul>';
        return $html;
    }
    function getPhotographersCredit()
    {
        $link = 'javascript:;';
        $link_target = '';
        if($this->hasElement('recipe-photographers-url')) {
            $link = $this->getCustomField('recipe-photographers-url');
            $link_target = 'target="_blank"';
        }
        $html = '<a href="' . $link . '" ' . $link_target . '>' . $this->getCustomField('recipe-photographer-credit') . '</a>';
        return $html;
    }
    function previous()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID < ' . $this->id() . '
        AND post_status="publish" 
        AND post_type="recipe"
        ORDER BY p.ID DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);
        $prev_id = $result[0]->ID;
        if($prev_id == "") {
            $sql = '
            SELECT p.ID
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="recipe"
            ORDER BY p.ID DESC
            LIMIT 1';
            $result = $wpdb->get_results($sql);
            $prev_id = $result[0]->ID;
        }
        return new Recipe($prev_id);
    }
    function next()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID > ' . $this->id() . '
        AND post_status="publish" 
        AND post_type="recipe"
        ORDER BY p.ID ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);
        $next_id = $result[0]->ID;
        if($next_id =="") {
            $sql = '
            SELECT p.ID
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="recipe"
            ORDER BY p.ID ASC
            LIMIT 1';
            $result = $wpdb->get_results($sql);
            $next_id = $result[0]->ID;
        }
        return new Recipe($next_id);
    }
    function cfIsSet($meta)
    {
        if($this->getCustomField($meta) <> "") {
            return true;
        } else {
            return false;
        }
    }
}