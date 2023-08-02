<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Testimony.php');
require_once('modal/class.Team.php');
require_once('modal/class.Blog.php');
require_once('modal/class.Page.php');
require_once('modal/class.Category.php');
require_once('modal/class.Event.php');
require_once('modal/class.Recipe.php');
require_once('modal/class.Course.php');
require_once('modal/class.Slider.php');
require_once('modal/class.Slide.php');
require_once('modal/class.Clinician.php');
require_once('modal/class.Speaker.php');
require_once('modal/class.WPAjax.php');
$wcAdjustStylesheet = 'understrap-theme';
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'icomoon', get_stylesheet_directory_uri() . '/css/icomoon.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/all.min.css');
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.css');
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;
}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
add_action('init', 'dfn_register_menus');
function dfn_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
            'conference-menu' => __('Conference Menu'),
        )
    );
}
add_action('admin_init', 'my_general_section');
function my_general_section()
{
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'abn', // Option ID
        'ABN Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'abn' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'blog-title', // Option ID
        'Single Blog Page Title', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'blog-title' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'team-title', // Option ID
        'Single Team Member Page Title', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'team-title' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'zoom-url', // Option ID
        'Zoom registration url', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'zoom-url' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'conference-page-id', // Option ID
        'Conference Home Page ID', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'conference-page-id' // Should match Option ID
        )
    );
    register_setting('general','abn', 'esc_attr');
    register_setting('general','blog-title', 'esc_attr');
    register_setting('general','team-title', 'esc_attr');
    register_setting('general','zoom-url', 'esc_attr');
    register_setting('general','conference-page-id', 'esc_attr');
}
function my_section_options_callback() { // Section Callback
    echo '';
}
function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
add_image_size( 'profile', 200, 200);
add_image_size( 'blog', 600, 450, true);
add_image_size( 'sixhundred', 600, 600, true);
add_image_size( '320', 320, 320);
add_image_size( 'blog1200x450', 1200, 450, true);
add_image_size( 'blog1200x600', 1200, 600, true);
add_image_size( 'blog450x600', 450, 600, true);
add_image_size( 'blog800x600', 800, 600, true);
add_image_size( 'blog800x400', 800, 400, true);
function footer_widget_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget Right', 'understrap' ),
        'id'            => 'footerwidget',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer_widget_init' );
function footer1_widget_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget Center', 'understrap' ),
        'id'            => 'footerwidget1',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper-text">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer1_widget_init' );
function footer2_widget_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget bottom', 'understrap' ),
        'id'            => 'footerwidget2',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper-text footer-bottom">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer2_widget_init' );

function breadcrumb()
{
    global $post;
    $post_type = get_post_type($post->ID);
    $page = new dfnBase($post->ID);
    $page_title = $page->getTitle();
    $html = '<ul class="plain">
        <li><a href="' . get_page_link(5) . '">Home</a></li>';
    // make sure we are not on the search results page
    if(!is_search())
    {
        // tweak breadcrumb based on page type
        switch($post_type) {
            case "post":
                $html .= '<li><a href="' . get_page_link(19) . '">Articles</a></li>';
                break;
            case "team":
                $parent = new Page(wp_get_post_parent_id(150));
                $html .= '<li><a href="' . get_page_link($parent->id()) . '">' . $parent->getTitle() . '</a></li>';
                $html .= '<li><a href="' . get_page_link(150) . '">Our Team</a></li>';
                break;
            case "event":
                // events are either general public or clinicians & students
                $from_page_id = url_to_postid( $_SERVER['HTTP_REFERER'] );
                if($from_page_id == 393) {
                    // from General public
                    $html .= '<li><a href="' . get_page_link(45) . '">General Public</a></li>';
                } else {
                    $html .= '<li><a href="' . get_page_link(48) . '">Clinicians & Students</a></li>';
                }
                $event = new Event($post->ID);
                if($event->isWebinar()) {
                    if($from_page_id == 393) {
                        $html .= '<li><a href="' . get_page_link(390) . '">Education & Events</a></li>';
                        $html .= '<li><a href="' . get_page_link(393) . '">Food Vitals Webinars</a></li>';
                    } else {
                        $html .= '<li><a href="' . get_page_link(155) . '">Education</a></li>';
                        $html .= '<li><a href="' . get_page_link(161) . '">Food Vitals Webinars</a></li>';
                    }
                } else {
                    $html .= '<li><a href="' . get_page_link(235) . '">All Events</a></li>';
                    if(!$event->isUpcomingEvent()) {
                        $html .= '<li><a href="' . get_page_link(241) . '">Past Events</a></li>';
                    }
                }
                break;
            case "recipe":
                $html .= '<li><a href="' . get_page_link(45) . '">General Public</a></li>';
                $html .= '<li><a href="' . get_page_link(202) . '">Getting Started</a></li>';
                $html .= '<li><a href="' . get_page_link(352) . '">Recipes</a></li>';
                break;
            case "course":
                // courses are either general public or clinicians & students
                $html .= '<li><a href="' . get_page_link(48) . '">Clinicians & Students</a></li>';
                $html .= '<li><a href="' . get_page_link(155) . '">Education</a></li>';
                $html .= '<li><a href="' . get_page_link(409) . '">Online Courses</a></li>';
                break;
            case "clinician":
                $html .= '<li><a href="' . get_page_link(260) . '">Find a Clinician</a></li>';
                break;
            case "speaker":
                // get conference page details
                $conference_page = new Page(get_option('conference-page-id'));
                $html .= '<li><a href="' . $conference_page->link() . '">' . $conference_page->getTitle() . '</a></li>';
                $html .= '<li><a href="' . get_page_link(1577) . '">Speakers</a></li>';
                break;
        }
        //tweak breadcrumb by post id
        switch($post->ID) {
            case 150:
                $page_title = "Our Team";
                break;
        }
        // check if page is a subpage
        if (wp_get_post_parent_id($post->ID)) {
            // this page has a parent
            $parent_id = wp_get_post_parent_id($post->ID);
            $parent = new Page($parent_id);
            // check if the parent page is a sub page of another page
            if(wp_get_post_parent_id($parent_id)) {
                $parent_id_1 = wp_get_post_parent_id($parent_id);
                // check if this page is a subpage
                if(wp_get_post_parent_id($parent_id_1)) {
                    $parent_id_2 = wp_get_post_parent_id($parent_id_1);
                    $parent2 = new Page($parent_id_2);
                    $html .= '<li><a href="' . get_page_link($parent2->id()) . '">' . $parent2->getTitle() . '</a></li>';
                }
                $parent1 = new Page($parent_id_1);
                $html .= '<li><a href="' . get_page_link($parent1->id()) . '">' . $parent1->getTitle() . '</a></li>';
            }
            ($parent_id == 209) ? $parent_link = 'javascript:;' : $parent_link = get_page_link($parent->id());
            $html .= '<li><a href="' . $parent_link . '">' . $parent->getTitle() . '</a></li>';
        }
    } else {
        $page_title = 'Search Results';
    }
    $html .= '
        <li>' . $page_title . '</li>
    </ul>';
    return $html;
}
function getTestimonials()
{
    $testimonials = Array();
    $posts_array = get_posts([
        'post_type' => 'testimony',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'testimony-category',
                'field' => 'term_id',
                'terms' => array(165, 167),
                'operator' => 'NOT IN'
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $testimony = new Testimony($post);
        $testimonials[] = $testimony;
    }
    return $testimonials;
}
function getTestimonialsByCategory($term_id)
{
    $testimonials = Array();
    $posts_array = get_posts([
        'post_type' => 'testimony',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'testimony-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $testimony = new Testimony($post);
        $testimonials[] = $testimony;
    }
    return $testimonials;
}
function getBlogs($limit = -1)
{
    $blogs = Array();
    $posts_array = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'has_password'   => false
    ]);
    foreach ($posts_array as $post) {
        $Blog = new Blog($post);
        $blogs[] = $Blog;
    }
    return $blogs;
}
function getBlogsByCategory($term_id)
{
    $blogs = Array();
    $posts_array = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'has_password'   => false,
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $Blog = new Blog($post);
        $blogs[] = $Blog;
    }
    return $blogs;
}
function getTeam()
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'team',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order'
    ]);
    foreach ($posts_array as $post) {
        $Team = new Team($post);
        $arr[] = $Team;
    }
    return $arr;
}
function getTeamByCategory($term_id)
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'team',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'team-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $Team = new Team($post);
        $arr[] = $Team;
    }
    return $arr;
}
function getSpeakers()
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'speaker',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order'
    ]);
    foreach ($posts_array as $post) {
        $speaker = new Speaker($post);
        $arr[] = $speaker;
    }
    return $arr;
}
function getSpeakersByCategory($term_id)
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'speaker',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'speaker-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $speaker = new Speaker($post);
        $arr[] = $speaker;
    }
    return $arr;
}
function getEvents()
{
    $events = Array();
    $posts_array = get_posts([
        'post_type' => 'event',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order'
    ]);
    foreach ($posts_array as $post) {
        $event = new Event($post);
        $events[] = $event;
    }
    return $events;
}
function getPublicEvents()
{
    $events = Array();
    $posts_array = get_posts([
        'post_type' => 'event',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'meta_query' => [
            [
                'key' => 'wpcf-event-available-to-general-public',
                'value' => 1
            ]
        ],
    ]);
    foreach ($posts_array as $post) {
        $event = new Event($post);
        $events[] = $event;
    }
    return $events;
}
function getEventByCategory($term_id)
{
    $events = Array();
    $posts_array = get_posts([
        'post_type' => 'event',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'event-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $event = new Event($post);
        $events[] = $event;
    }
    return $events;
}
function getPublicEventsByCategory($term_id)
{
    $events = Array();
    $posts_array = get_posts([
        'post_type' => 'event',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'meta_query' => [
            [
                'key' => 'wpcf-event-available-to-general-public',
                'value' => 1
            ]
        ],
        'tax_query' => array(
            array(
                'taxonomy' => 'event-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $event = new Event($post);
        $events[] = $event;
    }
    return $events;
}
function getRecipes()
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $recipe = new Recipe($post);
        $arr[] = $recipe;
    }
    return $arr;
}
function getRecipesByTag($term_id)
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'recipe_tag',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $recipe = new Recipe($post);
        $arr[] = $recipe;
    }
    return $arr;
}
function getCoursesByCategory($term_id)
{
    $courses = Array();
    $posts_array = get_posts([
        'post_type' => 'course',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'course-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $course = new Course($post);
        $courses[] = $course;
    }
    return $courses;
}
function getOtherCoursesForStudents()
{
    $courses = Array();
    $posts_array = get_posts([
        'post_type' => 'course',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'meta_query' => [
            [
                'key' => 'wpcf-course-available-to-clinicians-students',
                'value' => 1
            ]
        ],
        'tax_query' => array(
            array(
                'taxonomy' => 'course-category',
                'field' => 'term_id',
                'terms' => 44
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $course = new Course($post);
        $courses[] = $course;
    }
    return $courses;
}
function getOtherCoursesForGP()
{
    $courses = Array();
    $posts_array = get_posts([
        'post_type' => 'course',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'meta_query' => [
            [
                'key' => 'wpcf-course-available-to-general-public',
                'value' => 1
            ]
        ],
        'tax_query' => array(
            array(
                'taxonomy' => 'course-category',
                'field' => 'term_id',
                'terms' => 44
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $course = new Course($post);
        $courses[] = $course;
    }
    return $courses;
}
function getClinicians($limit)
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'clinician',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $clinician = new Clinician($post);
        $arr[] = $clinician;
    }
    return $arr;
}
function testimonials_shortcode()
{
    global $post;
    // return all testimonials by default
    $testimonials = getTestimonials();
    // check to see if we are not on the home page
    if($post->ID <> 5)
    {
        // check to see if we are on the clinician and student landing page or a clinicians and students sub page
        if($post->ID == 48 || wp_get_post_parent_id($post->ID) == 48)
        {
            // return student testimonials
            $testimonials = getTestimonialsByCategory(15);
        }
        // check if on general public landing page or subpage
        if($post->ID == 45 || wp_get_post_parent_id($post->ID) == 45)
        {
            // return student testimonials
            $testimonials = getTestimonialsByCategory(16);
        }
    }
    shuffle($testimonials);
    $html = '<div class="testimonials-slider">';
    foreach ($testimonials as $testimony)
    {
        $html .= '
        <div>
            <div class="inner-wrapper">
                <div class="image-wrapper no-lazy">
                    ' . $testimony->getImage() . '
                    <div class="author">' . $testimony->getTitle() . ', ' . $testimony->getCustomField('t-position') . ', ' . $testimony->getCustomField('t-location') . '</div>
                    <span class="quote-left"></span>
                </div>
                <div class="content-wrapper">
                    ' . $testimony->getContent() . '
                </div>
                <div class="m-author">' . $testimony->getTitle() . ', ' . $testimony->getCustomField('t-position') . ', ' . $testimony->getCustomField('t-location') . '</div>
            </div>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('testimonials_slider', 'testimonials_shortcode');
function testimonials_noimage_shortcode($atts)
{
    global $post;
    $testimonials = getTestimonialsByCategory($atts['cat_id']);
    shuffle($testimonials);
    $html = '<div class="testimonials-slider no-img">';
    foreach ($testimonials as $testimony)
    {
        $html .= '
        <div>
            <div class="inner-wrapper noimage">
                <span class="quote-left"></span>
                <div class="content-wrapper">
                    ' . $testimony->getContent() . '
                </div>
                <div class="author">' . $testimony->getTitle() . '</div>
            </div>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('testimonials_slider_noimage', 'testimonials_noimage_shortcode');
function homePanel_shortcode($atts)
{
    $title = $atts['title'];
    $meta = strtolower($title);
    $image_meta = $meta . '_image';
    $content_meta = $meta . '_content';
    $link = $meta . '_learn_more_link';
    $logo_meta = $meta . '_logo';
    $html = '<div class="home-panel ' . $meta . '">
        <div class="image-wrapper">
            <h3>' . $title . '</h3>
            <div class="image"><img src="' . get_field($image_meta,5) . '" alt="' . $title . '" /></div>
            <div class="logo"><img src="' . get_field($logo_meta,5) . '" alt="" /></div>
        </div>
        <div class="content-wrapper">
            ' . get_field($content_meta) . '
        </div>
        <div class="btn-wrapper">
            <a href="' . get_field($link,5) . '" class="btn btn-primary">Learn More</a>
        </div>
    </div>';
    return $html;
}
add_shortcode('home_panel', 'homePanel_shortcode');

function factDisease_shortcode()
{
    $html = '<ul class="plain disease-fact">';
    for($i = 1; $i <= 8; $i++) {
        $html .= '<li></li>';
    }
    $html .= '
    </ul>';
    return $html;
}
add_shortcode('fact_two', 'factDisease_shortcode');
function factPoorNutrition_shortcode($atts) {
    $percentage_class = substr($atts['percentage'],0,-1);
    ($percentage_class > 50) ? $over50_class = 'over50' : $over50_class = '';
    $html = '<div class="poor-nutrition-fact">
        <div>
            <span>' . $atts['percentage'] . '</span>
            <div class="centr p' . $percentage_class . '">
                <div class="value-bar"></div>
                <div class="left-half"></div>
            </div>
            <div class="centrV"></div>       
        </div>    
    </div>';
    $html = '<div class="poor-nutrition-fact">
      <div class="progress-circle ' . $over50_class . ' p' . $percentage_class . '">
        <span>' . $atts['percentage'] . '</span>
        <div class="left-half-clipper">
            <div class="first50-bar"></div>
            <div class="value-bar"></div>
        </div>
      </div>
    </div>';
    return $html;
}
add_shortcode('fact_one', 'factPoorNutrition_shortcode');
function factNutritionTraining_shortcode($atts)
{
    $html = '<div class="training-fact">
        <div class="hours">' . $atts['hours'] . '</div>
        <span>Hours</span>
    </div>';
    return $html;
}
add_shortcode('fact_three', 'factNutritionTraining_shortcode');

function blogFeed_shortcode($atts)
{
    global $post;
    $html = '';
    $post_type = get_post_type($post->ID);
    ($post->ID == 5) ? $title = 'Latest articles' : $title = 'Recent articles';
    $blogs = getBlogs($atts['limit']);
    $taxonomies = get_terms( array(
        'taxonomy' => 'category',
        'orderby' => 'ID',
        'hide_empty' => false
    ) );
    $html .= '
    <div class="row">
        <div class="col-12 latest-new-title">
            <div class="inner-wrapper">
                <h3>' . $title . '</h3>
                <a href="' . get_page_link(19) . '" class="btn btn-primary">See all articles</a>
            </div>    
        </div>
    </div>';
    $html .= '<div class="row blog-feed row-eq-height justify-content-center">';
    foreach ($blogs as $blog)
    {
        if($post->ID <> $blog->id()) {
            // Don't display the blog we are viewing
            $html .= $blog->displayBlogTile();
        }
    }
    $html .= '
    </div>
    <div class="row m-blog-read-more">
        <div class="col-12">
            <a href="' . get_page_link(19) . '" class="btn btn-primary">See all articles</a>
        </div>
    </div>';
    return $html;
}
add_shortcode('blog_feed','blogFeed_shortcode');

function blogModule()
{
    global $post;
    $html = '';
    $class = 'current-category';
    $category_id = 0;
    $blogs = getBlogs();
    $html .= '<div class="row blog-feed row-eq-height justify-content-center">';
    if(sizeof($blogs) > 0)
    {
        foreach ($blogs as $blog)
        {
            $html .= $blog->displayBlogTile();
        }
    } else {
        $html .= '<div class="col-12">
            <p>No articles currently available in this category.</p>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
function teamModule_shortcode()
{
    $taxonomies = get_terms( array(
        'taxonomy' => 'team-category',
        'orderby' => 'ID',
        'hide_empty' => false
    ) );
    $html = '<div class="row">
        <div class="col-12">
            <ul class="plain team-category-menu">';
    foreach ($taxonomies as $term) {
        $category = new Category($term->term_id);
        $anchor = str_replace(" ","_",$category->getTitle());
        $anchor = strtolower($anchor);
        $html .= '<li><a href="' . get_page_link(150) . '#' . $anchor . '" class="btn btn-primary">' . $category->getTitle() . '</a></li>';
    }
    $html .= '
            </ul>
        </div>
    </div>
    <div class="row our-team-wrapper">';
    foreach ($taxonomies as $term) {
        $category = new Category($term->term_id);
        $anchor = str_replace(" ","_",$category->getTitle());
        $anchor = strtolower($anchor);
        $team_members = getTeamByCategory($category->id());
        $number_of_team_members = sizeof($team_members);
        ($number_of_team_members == 5) ? $class = 'small_col' : $class = '';
        $html .= '
        <div class="col-12 team-section">
            <a name="' . $anchor . '"></a>
            <h3>' . $category->getTitle() . '</h3>
            <div class="inner-wrapper ' . $class . '">';
        foreach($team_members as $team)
        {
            $html .= '
                    <a href="' . $team->link() . '">
                        <div class="image-wrapper">
                            ' . $team->getImage() . '
                            <div class="content-wrapper">
                                <div class="name">' . $team->getTitle() . '</div>
                                <div class="position">' . $team->getCustomField('team-position') . '</div>
                            </div>
                        </div>
                    </a>';
        }
        $html .= '
            </div>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('team_module', 'teamModule_shortcode');

function speakersModule_shortcode()
{
    $anchor = '';
    $taxonomies = get_terms( array(
        'taxonomy' => 'speaker-category',
        'orderby' => 'ID',
        'hide_empty' => false
    ) );
    $html = '
    <div class="row">
        <div class="col-12">
            <ul class="plain team-category-menu">';
    foreach ($taxonomies as $term) {
        $category = new Category($term->term_id);
        $anchor = str_replace(" ","_",$category->getTitle());
        $anchor = strtolower($anchor);
        $html .= '<li><a href="' . get_page_link(1577) . '#' . $anchor . '" class="btn btn-primary">' . $category->getTitle() . '</a></li>';
    }
    $html .= '
            </ul>
        </div>
        <div class="col-12 read-full">
            To read full speaker bios click on their profile image.
        </div>
    </div>
    <div class="row our-team-wrapper">';
    foreach ($taxonomies as $term) {
        $category = new Category($term->term_id);
        $anchor = str_replace(" ", "_", $category->getTitle());
        $anchor = strtolower($anchor);
        $speakers = getSpeakersByCategory($category->id());
        $html .= '    
        <div class="col-12 team-section speaker">
            <a name="' . $anchor . '"></a>
            <h3>' . $category->getTitle() . '</h3>        
            <div class="inner-wrapper">';
        foreach ($speakers as $team) {
            $html .= '
                <div class="speaker-panel">
                    <a href="' . $team->link() . '">
                        <div class="image-wrapper">
                            ' . $team->getImage() . '
                        </div>
                    </a>    
                    <div class="speaker-content-wrapper">
                        <h4>' . $team->getTitle() . '</h4>
                        <div class="qualifications">' . $team->getCustomField('speaker-qualifications') . '</div>
                        <div class="position">' . $team->getCustomField('team-position') . '</div>
                    </div>
                </div>';
        }
        $html .= '
            </div>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('speakers_module', 'speakersModule_shortcode');

function subPagePanels_shortcode()
{
    global $post;
    $child_args = array(
        'post_parent' => $post->ID, // The parent id.
        'post_type'   => 'page',
        'post_status' => 'publish',
        'order' => 'menu_order'
    );
    $children = get_children( $child_args );
    $class = '';
    $html = '<div class="subpage-panel">';
    foreach ($children as $child) {
        $page = new Page($child->ID);
        $class = 'panel' . $page->id();
        $html .= '
        <div class="inner-wrapper ' . get_field('background_image', $page->id()) . '">
            <div class="title">
                <h4>' . $page->getPageTitle() . '</h4>
            </div>
            <div class="snippet">
                ' . get_field('page_snippet', $page->id()) . '
            </div>
            <a href="' . $page->link() . '" class="btn btn-secondary">Find out more</a>
        </div>';
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('subpage_panels','subPagePanels_shortcode');
function customSearchForm() {
    $html = '
    <form class="search-form" action="' . $_SERVER['SCRIPT_NAME'] . '" method="get" role="search">
        <div class="inner-wrapper">
            <span class="fa fa-search"></span>
            <input class="search-field" type="search" name="s" value="" placeholder="Search...">
        </div>    
    </form>';

    return $html;
}
function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getWebinarEvents($filter, $post_id)
{
    $c0 = '';
    $c1 = '';
    $c2 = '';
    switch($filter) {
        case 0:
            $c0 = 'current';
            break;
        case 1:
            $c1 = 'current';
            break;
        case 2:
            $c2 = 'current';
            break;
    }
    $events = getEventByCategory(17);
    if($post_id == 393) {
        // general public events
        $events = getPublicEventsByCategory(17);
    }
    $html = '<div class="row">
        <div class="col-12">
            <ul class="plain event-filter" data-post="' . $post_id . '">
                <li class="' . $c0 . '"><a href="javascript:;" onclick="filterWebinars(0)">All</a></li>
                <li class="' . $c1 . '"><a href="javascript:;" onclick="filterWebinars(1)">Upcoming</a></li>
                <li class="' . $c2 . '"><a href="javascript:;" onclick="filterWebinars(2)">Past</a></li>
            </ul>
        </div>
    </div>';
    if($filter == 0 || $filter == 1)
    {
        $html .= '
        <div class="row">
            <div class="col-12">
                <h3>Upcoming webinars</h3>
            </div>
        </div>';
        // get all upcoming events
        $i = 0;
        foreach ($events as $event)
        {
            // only return upcoming events
            if($event->isUpcomingEvent())
            {
                $html .= '<div class="row event-panel">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                        ' . $event->eventPanel() . '
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                        ' . $event->getFeatureImage() . '
                    </div>
                </div>';
                $i++;
            }
        }
        if($i == 0) {
            // no upcoming events
            $html .= '<div class="row event-panel">
                <div class="col-12">
                    ' . get_field('no_webinars_message', $post_id) . '
                </div>
            </div>';
        }
    }
    if($filter == 0 || $filter == 2)
    {
        $html .= '
        <div class="row">
            <div class="col-12">
                <h3>Past webinars</h3>
            </div>
        </div>';
        // get all upcoming events
        foreach ($events as $event)
        {
            // only return upcoming events
            if(!$event->isUpcomingEvent())
            {
                $html .= '<div class="row event-panel">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-7">
                        ' . $event->eventPanel() . '
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-5 feature-image-wrapper">
                        ' . $event->getFeatureImage() . '
                    </div>
                </div>';
            }
        }
    }
    return $html;
}
function getCourses($filter, $post_id)
{
    $c0 = '';
    $c1 = '';
    $c2 = '';
    switch($filter) {
        case 0:
            $c0 = 'current';
            break;
        case 1:
            $c1 = 'current';
            break;
        case 2:
            $c2 = 'current';
            break;
    }
    // get DFN courses
    $courses = getCoursesByCategory(43);
    $html = '<div class="row">
        <div class="col-12">
            <ul class="plain event-filter" data-post="' . $post_id . '">
                <li class="' . $c0 . '"><a href="javascript:;" onclick="filterCourses(0)">All</a></li>
                <li class="' . $c1 . '"><a href="javascript:;" onclick="filterCourses(1)">Our Courses</a></li>
                <li class="' . $c2 . '"><a href="javascript:;" onclick="filterCourses(2)">Other Courses</a></li>
            </ul>
        </div>
    </div>';
    if($filter == 0 || $filter == 1) {
        $html .= '
        <div class="row">
            <div class="col-12">
                <h3>Our courses</h3>
            </div>
        </div>';
        $i = 0;
        foreach ($courses as $course) {
            // display upcoming courses first
            if($course->isUpComingCourse()) {
                $html .= '<div class="row event-panel">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                        ' . $course->coursePanel() . '
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                        ' . $course->getFeatureImage() . '
                    </div>
                </div>';
            }
            $i++;
        }
        foreach ($courses as $course) {
            //display on demand courses
            if($course->getDate() == "ON DEMAND") {
                $html .= '<div class="row event-panel">
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                        ' . $course->coursePanel() . '
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                        ' . $course->getFeatureImage() . '
                    </div>
                </div>';
            }
            $i++;
        }
        if($i == 0) {
            // no upcoming events
            $html .= '<div class="row event-panel">
                <div class="col-12">
                    ' . get_field('no_courses_message', $post_id) . '
                </div>
            </div>';
        }
    }
    if($filter == 0 || $filter == 2) {
        $html .= '
            <div class="row">
                <div class="col-12">
                    <h3>Other courses</h3>
                </div>
            </div>';
        $courses = getOtherCoursesForStudents();
        foreach ($courses as $course) {
            $html .= '<div class="row event-panel">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-7">
                        ' . $course->coursePanel() . '
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-5 feature-image-wrapper">
                        ' . $course->getFeatureImage() . '
                    </div>
                </div>';
        }
    }

    return $html;
}
function getOtherCourses()
{
    $courses = getOtherCoursesForGP();
    $html = '';
    /*
    $html .= '<div class="row">
        <div class="col-12">
            <ul class="plain event-filter">
                <li class="current"><a href="javascript:;">All</a></li>
            </ul>
        </div>
    </div>';
    */
    $html .= '
            <div class="row">
                <div class="col-12">
                    <h3>Other Courses</h3>
                </div>
            </div>';
    foreach ($courses as $course) {
        $html .= '<div class="row event-panel">
            <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                ' . $course->coursePanel() . '
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                ' . $course->getFeatureImage() . '
            </div>
        </div>';
    }
    return $html;
}
function getPastEvents($cat_id = 0)
{
    global $post;
    $html = '';
    ($cat_id == 0) ? $filter_class = 'current' : $filter_class = '';
    // get all upcoming events
    $events = array();
    //get events for a specific event type
    $exclude_ids = array(42); // don't include education
    $taxonomies = get_terms( array(
        'taxonomy' => 'event-category',
        'orderby' => 'menu_order',
        'hide_empty' => false,
        'exclude' => $exclude_ids
    ) );
    $html = '<div class="row">
        <div class="col-12">
            <ul class="plain event-filter">
                <li class="' . $filter_class . '"><a href="javascript:;" onclick="filterEvent(0)">All</a></li>';
    foreach($taxonomies as $term)
    {
        $filter_category = new Category($term->term_id);
        ($filter_category->id() == $cat_id) ? $filter_class = 'current' : $filter_class = '';
        $html .= '<li class="' . $filter_class . '"><a href="javascript:;" onclick="filterEvent(' . $filter_category->id() . ')">' . $filter_category->getTitle() . '</a></li>';
    }
    $html .= '
            </ul>
        </div>
    </div>';
    // check if we are looping through each event category or if we have filtered to one category
    if($cat_id == 0) {
        $current_event_category = '';
        // display all categories
        foreach($taxonomies as $term)
        {
            //$category = new Category($term->term_id);
            // get events
            $events = getEventByCategory($term->term_id);
            if($post->ID == 764) {
                // general public events
                $events = getPublicEventsByCategory($term->term_id);
            }
            foreach ($events as $event)
            {
                if(!$event->isUpcomingEvent()) {
                    $html .= '<div class="row event-panel">';
                    if($current_event_category <> $term->name) {
                        $html .= '<div class="col-12">
                            <h3>' . $term->name . '</h3>
                        </div>';
                    }
                    $html .= '    
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                            ' . $event->eventPanel() . '
                        </div>
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                            ' . $event->getFeatureImage('sixhundred') . '
                        </div>
                    </div>';
                    $current_event_category = $term->name;
                }
            }
        }
    } else {
        $current_event_category = '';
        // filtered to single category
        $events = getEventByCategory($cat_id);
        if($post->ID == 764) {
            // general public events
            $events = getPublicEventsByCategory($cat_id);
        }
        $i = 0;
        foreach ($events as $event)
        {
            if(!$event->isUpcomingEvent()) {
                $category = $event->getCategory();
                $html .= '<div class="row event-panel">';
                if($current_event_category <> $term->name) {
                    $html .= '<div class="col-12">
                        <h3>' . $category->getTitle() . '</h3>
                    </div>';
                }
                $html .= '<div class="col-12 col-sm-12 col-md-7 col-lg-7">
                            ' . $event->eventPanel() . '
                        </div>
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                            ' . $event->getFeatureImage('sixhundred') . '
                        </div>
                    </div>';
                $current_event_category = $term->name;
                $i++;
            }
        }
        if($i==0) {
            // no upcoming events
            //$selected_category = new Category($cat_id);
            $html .= '<div class="row event-panel">
                <div class="col-12">
                    Sorry, there are no past events for this category.
                </div>
            </div>';
        }
    }
    return $html;
}
function upcomingEvents_shortcode()
{
    global $post;
    $html = '';
    $events = getEvents();
    if($post->ID == 727) {
        //get public events
        $events = getPublicEvents();
    }
    $i = 0;
    foreach($events as $event)
    {
        if($event->isUpcomingEvent()) {
            $html .= '
            <div class="row event-panel">
                <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                    ' . $event->eventPanel() . '
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 feature-image-wrapper">
                    ' . $event->getFeatureImage('sixhundred') . '
                </div>
            </div>';
            $i++;
        }
    }
    if($i == 0) {
        // no upcoming events
        $html .= '<div class="row event-panel">
                <div class="col-12">
                    ' . get_field('no_events_message') . '
                </div>
            </div>';
    }
    return $html;
}
add_shortcode('upcoming_events', 'upcomingEvents_shortcode');
function eventsMenu_shortcode()
{
    $html = '
    <div class="row">
        <div class="col-12">
            <ul class="plain event-filter">
                <li><a href="#upcoming">Upcoming</a></li>
                <li><a href="#past">Past</a></li>
            </ul>
        </div>
    </div>';
    return $html;
}
add_shortcode('events_menu', 'eventsMenu_shortcode');
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);



    return $result[0]->ID;
}
function imageSlider_shortcode($atts)
{
    $slider = new Slider($atts['slider_id']);
    //$slides = $slider->getSlides1();
    $slides = $slider->getSlides();
    $html = '<div class="image-slider">';
    foreach ($slides as $slide)
    {
        $html .= '<div class="slide">
                <div class="inner-wrapper">
                    <div class="image-wrapper">
                        ' . $slide->getImage() . '
                    </div>
                    <div class="content-wrapper">
                        <h3>' . $slide->getTitle() . '</h3>
                        <div class="description">
                            ' . $slide->getDescription() . '
                        </div>
                    </div>
                </div>
            </div>';
    }
    $html .= '
    </div>
        <div class="slider-nav">';
    foreach($slides as $slide)
    {
        $html .= '<div>' . $slide->getImage() . '</div>';
    }
    $html .= '
        </div>';
    return $html;
}
add_shortcode('image_slider','imageSlider_shortcode');
/**************** Ajax **************************/
add_action('wp_head', function() {
    echo '<script type="text/javascript">
       var ajaxurl = "' . admin_url('admin-ajax.php') . '";
     </script>';
});
add_action('wp_ajax_ajax', function() {
    $WPAjax = new WPAjax($_GET['call']);
});
add_action('wp_ajax_nopriv_ajax', function() {
    $WPAjax = new WPAjax($_GET['call']);
});
add_action( 'wp_print_styles', 'wc_adjustStylesheetOrder', 99);
function wc_adjustStylesheetOrder() {
    global $wp_styles, $wcAdjustStylesheet;

    if(!$wcAdjustStylesheet) return;

    $keys=[];
    $keys[] = $wcAdjustStylesheet;

    foreach($keys as $currentKey) {
        $keyToSplice = array_search($currentKey,$wp_styles->queue);

        if ($keyToSplice!==false && !is_null($keyToSplice)) {
            $elementToMove = array_splice($wp_styles->queue,$keyToSplice,1);
            $wp_styles->queue[] = $elementToMove[0];
        }

    }

    return;
}
function cooktimes_shortcode()
{
    global $post;
    $recipe = new Recipe($post->ID);
    $html = '<span class="icon-recipe_page_prepare"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>' . $recipe->getCustomField('recipe-prep-time') . ' mins';
    if($recipe->cfIsSet('recipe-total-cook-time')) {
        $html .= '<span class="icon-recipe_page_cook"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>' . $recipe->getCustomField('recipe-total-cook-time') . ' mins';
    }
    return $html;
}
add_shortcode('cook_times','cooktimes_shortcode');
function blog_post_slug( $args, $post_type ) {
    if ( $post_type == "post" ) {
        $args['rewrite'] = array(
            'slug' => 'articles'
        );
    }

    return $args;
}
add_filter( 'register_post_type_args', 'blog_post_slug', 20, 2 );
function backButton_shortcode()
{
    $html = '<a href="javascript:history.back(1)">back</a>';
    return $html;
}
add_shortcode('back_button', 'backButton_shortcode');
function postID_shortcode()
{
    global $post;
    return $post->ID;
}
add_shortcode('post_id', 'postID_shortcode');
function conferenceCTA_shortcode()
{
    global $post;
    $arr = get_field('show_conference_cta',$post->ID);
    $arr2 = get_field('show_banner_cta',$post->ID);
    $html = '';
    if($arr[0] == 1)
    {
        // get conference home page
        $page_id = get_option('conference-page-id');
        $html = '<div class="inner-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-7 left-col">
                    <div class="flex-row-wrapper">
                        <div class="logo">
                            <img src="' . get_field('conference_logo', $page_id) . '" alt="Doctors for Nutrition" />
                        </div>
                        <div class="title">
                            ' . get_field('conference_name', $page_id) . '
                        </div> 
                    </div>
                    <div class="location">' . get_field('conference_location', $page_id) . ' - ' . get_field('conference_dates', $page_id) . '</div>       
                </div>
                <div class="col-12 col-sm-6 col-lg-5 right-col">
                    <div class="snippet">
                        ' . get_field('conference_snippet', $page_id) . '
                    </div>
                    <a href="' . get_page_link($page_id) . '" class="btn btn-primary">Register now</a>
                </div>
            </div>    
        </div>    
        </div>';
    } else {
        if($arr2[0] == 1) {
            $colour = get_field('banner_cta_colour',$post->ID);
            $html = '<div class="inner-wrapper other-cta" style="background-color:' . $colour . '">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-7 left-col">
                        ' . get_field('banner_cta_left_column', $post->ID) . '
                    </div>
                    <div class="col-12 col-sm-6 col-lg-5 right-col">
                        ' . get_field('banner_cta_right_column', $post->ID) . '
                    </div>
                </div>
            </div>
            </div>';
        }
    }
    return $html;
}
add_shortcode('conference_cta','conferenceCTA_shortcode');
function conferenceDate_shortcode()
{
    global $post;
    $html = '
    <div class="conference-panel c-date">
        <span class="fas fa-calendar-alt"></span>
        <p>' . get_field('conference_dates', $post->ID) . '</p>
    </div>';
    return $html;
}
add_shortcode('conference_date','conferenceDate_shortcode');
function conferenceLocation_shortcode()
{
    global $post;
    $html = '
    <div class="conference-panel c-location">
        <span class="fas fa-map-marker-alt"></span>
        <p>' . get_field('conference_venue', $post->ID) . '</p>
        <p>' . get_field('conference_location', $post->ID) . '</p>
    </div>';
    return $html;
}
add_shortcode('conference_location','conferenceLocation_shortcode');
function conferenceEnquiries_shortcode()
{
    global $post;
    $html = '
    <div class="conference-panel c-enquiries">
        <span class="fas fa-envelope"></span>
        <p>Enquiries</p>
        <a href="mailto:' . get_field('conference_email_address', $post->ID) . '">' . get_field('conference_email_address', $post->ID) . '</a>';
    if(get_field('conference_phone', $post->ID) <> "") {
        $html .= '<a href=tel:' . formatPhoneNumber(get_field('conference_phone', $post->ID)) . '>' . get_field('conference_phone', $post->ID) . '</a>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('conference_enquiries','conferenceEnquiries_shortcode');

function medicalDisclaimer_shortcode()
{
    $html = '<div class="medical-disclaimer">
        ' . get_field('medical_disclaimer',260) . '
    </div>';
    return $html;
}
add_shortcode('medical_disclaimer','medicalDisclaimer_shortcode');
function featuredClinicians_shortcode()
{
    $clinicians = getClinicians(20);
    shuffle($clinicians);
    $html = '<div class="featured-clinicians-wrapper">';
    foreach($clinicians as $clinician) {
        $html .= '<div>' . $clinician->getPanel() . '</div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('featured_clinicians','featuredClinicians_shortcode');
function reset_shortcode()
{
    $html = '<a class="reset btn btn-secondary" href="' . get_page_link(260) . '">Reset</a>';
    return $html;
}
add_shortcode('reset','reset_shortcode');
function conferenceLink()
{
    $page = new Page(get_option('conference-page-id'));
    $html = '<a href="' . get_page_link($page->id()) . '">' . $page->getTitle() . '</a>';
    return $html;
}
function mobileCTA_shortcode()
{
    $html = '<div class="mobile-cta">
        <ul class="plain">
        <li class="nihc"><a href="' . get_page_link(1571) . '" class="btn btn-primary">NIHC: Conference 2023</a></li>
            <li><a href="' . get_page_link(260) . '" class="btn btn-primary">Find a clinician</a></li>
        </ul>
    </div>';
    return $html;
}
add_shortcode('mobile_cta','mobileCTA_shortcode');
function dfnCouncilMember_shortcode($atts)
{
    // function for the clinicians view
    $clinician = new Clinician($atts['id']);
    $html = '';
    if($clinician->getCustomField('clinician-dfn-advisory-council-member') == 1) {
        $html = '<div class="advisory-council">DFN Advisory Council</div>';
    }
    return $html;
}
add_shortcode('dfn_council_member','dfnCouncilMember_shortcode');
function clinicianLocation_shortcode($atts)
{
    $clinician = new Clinician($atts['id']);
    return $clinician->getLocation();
}
add_shortcode('clinician_location','clinicianLocation_shortcode');
function clinicianProfessions_shortcode($atts)
{
    $clinician = new Clinician($atts['id']);
    $html = '';
    foreach($clinician->getCategories('profession') as $profession)
    {
        if($profession->getTitle() <> "Medical Doctor") {
            if($html <> "") {
                $html .= '<br />';
            }
            $html .= $profession->getTitle();
        }
    }
    return $html;
}
add_shortcode('clinician_professions', 'clinicianProfessions_shortcode');
function cancelLink_shortcode()
{
    $html = '<a href="' . get_page_link(6481) . '" class="cancel-link">cancel</a>';
    return $html;
}
add_shortcode('cancel_link','cancelLink_shortcode');
function clinicianListingApplication_shortcode()
{
    $html = '';
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "occupation") {
        $html = do_shortcode('[contact-form-7 id="6585" title="New Occupation"]');
    } else {
        $html = do_shortcode('[contact-form-7 id="6479" title="Find a Clinician Listing - Application Form"]');
    }
    return $html;
}
add_shortcode('clinician_listing_application','clinicianListingApplication_shortcode');
function hereActionLink_shortcode()
{
    $html = '<a href="' . get_page_link(6481) . '?action=occupation" class="here-link">here</a>';
    return $html;
}
add_shortcode('here_link','hereActionLink_shortcode');
