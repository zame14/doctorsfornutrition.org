<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2022
 * Time: 9:12 PM
 */
class Slide extends dfnBase
{
    function getImage()
    {
        $html = '<img src="' . $this->getPostMeta('slide-image') . '" alt="' . $this->getTitle() . '" />';
        return $html;
    }
    function getDescription()
    {
        return wpautop($this->getPostMeta('slide-content'));
    }
}