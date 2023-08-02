<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/22/2022
 * Time: 9:24 AM
 */
class Testimony extends dfnBase
{
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
    }
    public function getImage()
    {
        return get_the_post_thumbnail($this->Post, 'profile');
    }
}