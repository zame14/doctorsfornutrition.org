<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/9/2022
 * Time: 1:05 PM
 */
class WPAjax
{
    private $success = 0;
    private $error = 0;
    private $response = 0;

    function __construct($function)
    {
        if (method_exists($this, $function)) {
            // Runt he function
            $this->$function();
        } else {
            $this->error = 1;
            $this->response = 'Function not found for ' . $function;
        }
        echo $this->getResponse();
        session_write_close();
        exit;
    }

    public function getResponse()
    {
        // Prepare response array
        $json = Array(
            'success' => $this->success,
            'error' => $this->error,
            'response' => $this->response
        );
        $output = $json['response'];

        return $output;
    }
    private function filterWebinars()
    {
        $filter = $_REQUEST['filter'];
        $post_id = $_REQUEST['post_id'];
        $this->response = getWebinarEvents($filter, $post_id);
    }
    private function filterEvents()
    {
        $category_id = $_REQUEST['category_id'];
        $this->response = getPastEvents($category_id);
    }
    private function filterCourses()
    {
        $filter = $_REQUEST['filter'];
        $post_id = $_REQUEST['post_id'];
        $this->response = getCourses($filter, $post_id);
    }
    private function showFreeRecipeForm()
    {
        $post_id = $_REQUEST['post_id'];
        $html = '<div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Get Your Free WFPB Recipe Book Today!</h3>
                </div>
                <div class="col-12">
                    ' . get_field('recipe_book_form',$post_id) . '
                </div>
            </div>
        </div>';
        $this->response = $html;
    }
    private function showMealPlanForm()
    {
        $post_id = $_REQUEST['post_id'];
        $page = new Page($post_id);
        $html = '<div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>' . $page->getCustomField('page-form-title') . '</h3>
                </div>
                <div class="col-12">
                    ' . $page->getCustomField('page-form-field') . '
                </div>
            </div>
        </div>';
        $this->response = $html;
    }
    private function showResourceKitForm()
    {
        $post_id = $_REQUEST['post_id'];
        $page = new Page($post_id);
        $html = '<div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>' . get_field('resource_kit_form_title',$post_id) . '</h3>
                </div>
                <div class="col-12">
                    ' . get_field('resource_kit_form',$post_id) . '
                </div>
            </div>
        </div>';
        $this->response = $html;
    }
    private function showResourceGuideForm()
    {
        $post_id = $_REQUEST['post_id'];
        $page = new Page($post_id);
        $html = '<div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>' . $page->getCustomField('page-form-title') . '</h3>
                </div>
                <div class="col-12">
                    ' . $page->getCustomField('page-form-field') . '
                </div>
            </div>
        </div>';
        $this->response = $html;
    }
}