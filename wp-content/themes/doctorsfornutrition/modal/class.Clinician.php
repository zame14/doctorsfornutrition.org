<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/24/2022
 * Time: 3:28 PM
 */
class Clinician extends dfnBase
{
    function getPanel()
    {
        $html = '<div class="clinician-panel">
            <a href="' . $this->link() . '" class="image-wrapper slider-image-wrapper">
                ' . $this->getImage('320') . '
            </a>    
            <div class="content-wrapper">
                <h4>' . $this->getTitle() . '</h4>
                <ul class="plain professions">';
                foreach($this->getCategories('profession') as $profession)
                {
                    if($profession->getTitle() <> "Medical Doctor") {
                        $html .= '<li>' . $profession->getTitle() . '</li>';
                    }
                    //break;
                }
                if($this->getCustomField('clinician-dfn-advisory-council-member') == 1) {
                    $html .= '<li>DFN Advisory Council</li>';
                }
                $html .= '
                </ul>';
                $html .= '
                <div class="location">' . $this->getLocation() . '</div>
            </div>
        </div>';
        return $html;
    }
    public function getImage($size = 'full')
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
    public function getCustomField($field)
    {
        return $this->getPostMeta($field);
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
    function getClinician()
    {
        $arr = explode(",",$this->getCustomField('clinician-speciality'));
        $team = $this->getProfile();
        $html = '<div class="row">
            <div class="col-12 col-sm-12 col-md-4 left-col">
                <div class="image-wrapper">
                    ' . $this->getImage() . '
                </div>
                <div class="contact-details-wrapper">
                    ' . $this->getContactDetails() . '
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 right-col">
                <h2>' . $this->getTitle() . '</h2>
                <ul class="plain professions">';
                foreach($this->getCategories('profession') as $profession)
                {
                    if($profession->getTitle() <> "Medical Doctor") {
                        $html .= '<li>' . $profession->getTitle() . '</li>';
                    }
                }
                $html .= '
                </ul>
                <div class="short-description">
                    ' . $this->getContent() . '
                </div>';
                $html .= '
                <div class="qualitifcations-wrapper">
                    <h4>Qualifications/Credentials</h4>
                    ' . wpautop($this->getCustomField('clinician-qualifications')) . '
                </div>
                <div class="education-wrapper">
                    <h4>Plant Based Education/Experience</h4>
                    ' . wpautop($this->getCustomField('clinician-education')) . '
                </div>';
                if($this->getCustomField('clinician-additional-information') <> "") {
                    $html .= '<div class="additional-info-wrapper">
                    <h4>Additional Information</h4>
                    ' . wpautop($this->getCustomField('clinician-additional-information')) . '
                    </div>';
                }
                $html .= '
                <div class="special-interests-wrapper">    
                    <h4>Areas of Special Interest</h4>
                    <ul class="plain">';
                    foreach($arr as $interest)
                    {
                        $html .= '<li><span class="fas fa-check-circle"></span>' . $interest . '</li>';
                    }
                    $html .= '
                    </ul>
                </div> 
                <div class="m-contact-details-wrapper">
                    ' . $this->getContactDetails() . '
                </div>
            </div>
        </div>';
        return $html;
    }
    function getProfile()
    {
        $team_id = toolset_get_related_post( $this->id(), 'clinician-dfn-profile', 'parent');
        return new Team($team_id);
    }
    function getContactDetails()
    {
        $html = '<h4>Contact details</h4>';
        if($this->cfIsSet('clinician-practice-name')) {
            $html .= '<div class="practice-name"><h5>' . $this->getCustomField('clinician-practice-name') . '</h5></div>';
        }
        if($this->cfIsSet('clinician-address')) {
            $html .= '<h5>Address</h5>';
            $html .=  wpautop($this->getCustomField('clinician-address'));
        }
        if($this->cfIsSet('clinician-phone')) {
            $html .= '<h5>Phone</h5>';
            $html .=  '<a href="tel:' . formatPhoneNumber($this->getCustomField('clinician-phone')) . '">' . $this->getCustomField('clinician-phone') . '</a>';
        }
        if($this->cfIsSet('clinician-website')) {
            $html .= '<h5>Website</h5>';
            $html .= '<a href="' . $this->getCustomField('clinician-website') . '" target="_blank">Visit <span class="fas fa-external-link-alt"></span></a>';
        }
        if($this->getCustomField('clinician-telehealth') == 1) {
            $html .= '<div class="telehealth-wrapper"><h5>Telehealth Available</h5>';
            $html .= '<span class="fas fa-check-circle"></span></div>';
        }
        return $html;
    }
    function cfIsSet($meta)
    {
        if($this->getCustomField($meta) <> "") {
            return true;
        } else {
            return false;
        }
    }
    function getLocation()
    {
        $html = '';
        switch($this->getCustomField('clinician-location')) {
            case "ACT":
                $html = 'Australian Capital Territory';
                break;
            case "NSW":
                $html = 'New South Wales';
                break;
            case "NT":
                $html = 'Northern Territory';
                break;
            case "QLD":
                $html = 'Queensland';
                break;
            case "SA":
                $html = 'South Australia';
                break;
            case "TAS":
                $html = 'Tasmania';
                break;
            case "VIC":
                $html = 'Victoria';
                break;
            case "WA":
                $html = 'Western Australia';
                break;
            case "NZ":
                $html = 'New Zealand';
                break;
        }
        return $html;
    }
}