<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/25/2022
 * Time: 10:25 AM
 */
class Blog extends dfnBase
{
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    public function getImage()
    {
        return get_the_post_thumbnail($this->Post, 'blog');
    }
    public function getBlogCategory()
    {
        return get_the_category($this->Post->ID);
    }
    public function getTeaser()
    {
        return substr($this->getPostMeta('post-snippet'),0,70) . '[...]';
    }
    function getAuthor()
    {
        $author_id = toolset_get_related_post( $this->id(), 'post-author', 'parent');
        return new Team($author_id);
    }
    function getSlug() {
        return '/' . $this->Post->post_name . '/';
    }
    function displayBlogTile()
    {
        if ($this->getCustomField('post-guest-author') <> "") {
            $name = $this->getCustomField('post-guest-author');
        } else {
            $author = $this->getAuthor();
            $name = $author->getTitle();
        }
        $cat = $this->getBlogCategory();
        $html = '
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 blog-panel">
            <div class="inner-wrapper">
                <div class="image-wrapper">
                    ' . $this->getImage() . '
                </div>
                <div class="content-wrapper">
                    <h4>' . $this->getTitle() . '</h4>
                    <div class="snippet">
                        ' . $this->getTeaser() . '
                    </div>
                    <ul class="plain blog-author">
                        <li><span class="fas fa-user"></span>' . $name . '</li>
                        <li><span class="fas fa-calendar-alt"></span>' . $this->getPostDate() . '</li>
                    </ul>
                    <ul class="plain btns-wrapper">
                        <li><a href="' . get_permalink($this->id()) . '" class="btn btn-secondary">Read Now</a></li>
                        <li class="time-to-read">' . $this->getCustomField('post-time-to-read') . ' min read</li>
                    </ul>
                </div>
            </div>
        </div>';
        return $html;
    }
}