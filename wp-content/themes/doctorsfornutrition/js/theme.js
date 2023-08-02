jQuery(function($) {
    if($(".testimonials-slider").length == 1) {
        testimonialSlick = $(".testimonials-slider").slick({
            dots:true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<i class="icon-right-arrow"></i>',
            prevArrow: '<i class="icon-left-arrow"></i>',
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        adaptiveHeight: true
                    }
                }
            ]
        });
    }
    if($(".testimonials-slider.no-img").length == 1) {
        testimonialSlick = $(".testimonials-slider.no-img").slick({
            dots:true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<i class="icon-right-arrow"></i>',
            prevArrow: '<i class="icon-left-arrow"></i>'
        });
    }
    if($(".image-slider").length == 1) {
        imageSlick = $(".image-slider").slick({
            dots:false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<i class="icon-right-arrow"></i>',
            prevArrow: '<i class="icon-left-arrow"></i>',
            asNavFor: '.slider-nav',
            infinite: true,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        adaptiveHeight: true,
                        accessibility: false
                    }
                }
            ]
        });
        imageNavSlick = $(".slider-nav").slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.image-slider',
            dots: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    if($(".featured-clinicians-wrapper").length == 1) {
        cliniciansSlick = $(".featured-clinicians-wrapper").slick({
            dots:false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: true,
            nextArrow: '<i class="icon-right-arrow"></i>',
            prevArrow: '<i class="icon-left-arrow"></i>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        adaptiveHeight: true
                    }
                }
            ]
        });
    }
    $(".top-bar .fa-search").click(function() {
        $("#searchModal.modal").hide().fadeIn();
    });
    $("#searchModal .fa-times").click(function() {
        $("#searchModal.modal").hide();
    });
    if($(".vc_tta-accordion").length) {
        $(".vc_tta-panel").removeClass('vc_active');
        $(".reference .vc_tta-panel").addClass('vc_active');
    }
    $(".free-recipe").click(function() {
        var post_id = $(".free-recipe").data('post');
        $.ajax({
            url: ajaxurl + "?action=ajax&call=showFreeRecipeForm&post_id=" + post_id,
            cache: false,
            success: function (response) {
                $("#page-form").html(response).fadeIn();
            }
        });
    });
    $(".free-meal-plan").click(function() {
        var post_id = $(".free-meal-plan").data('post');
        $.ajax({
            url: ajaxurl + "?action=ajax&call=showMealPlanForm&post_id=" + post_id,
            cache: false,
            success: function (response) {
                $("#page-form").html(response).fadeIn();
            }
        });
    });
    $(".plant-base-kit").click(function() {
        var post_id = $(".plant-base-kit").data('post');
        $.ajax({
            url: ajaxurl + "?action=ajax&call=showResourceKitForm&post_id=" + post_id,
            cache: false,
            success: function (response) {
                $("#page-form").html(response).fadeIn();
            }
        });
    });
    $(".plant-base-guide").click(function() {
        var post_id = $(".plant-base-guide").data('post');
        $.ajax({
            url: ajaxurl + "?action=ajax&call=showResourceGuideForm&post_id=" + post_id,
            cache: false,
            success: function (response) {
                $("#page-form").html(response).fadeIn();
            }
        });
    });
    $(".print-friendly").click(function() {
        $("#page").addClass('print-me');
        window.print();
        $("#page").removeClass('print-me');
    });
    /*
     removing sticky header
     if($(window).width() > 575) {
     if ($(".green").length == 1) {
     var waypoint = new Waypoint({
     element: document.getElementById('content'),
     handler: function () {
     $("#header").toggleClass('fixed');
     //$(".wrapper").addClass('marginTop');
     //$(".home-banner-wrapper").addClass('marginTop');
     },
     offset: -100
     });
     }
     if ($(".green").length == 1) {
     var waypoint = new Waypoint({
     element: document.getElementById('content'),
     handler: function () {
     $(".conference-menu-wrapper").toggleClass('fixed');
     //$(".wrapper").addClass('marginTop');
     //$(".home-banner-wrapper").addClass('marginTop');
     },
     offset: -100
     });
     }
     }
     */
    $(".recipe-filter-wrapper .btn").click(function() {
        setTimeout(function() {
            $(".clinicians-view").fadeIn();
        }, 1000);
    });
    if($(".single-speaker").length == 1) {
        // on individual speaker page. Set speaker menu item as current menu item
        $(".menu-item-1632").addClass('current_page_item');
    }
    $(".search-form .fa-search").click(function() {
        $(".search-form").submit();
    });
    if($(".blog-panel").length) {
        var h = 0;
        $(".blog-panel h4").each(function() {
            if($(this).height() > h) {
                h = $(this).height();
            }
        });
        $(".blog-panel h4").css('min-height', h+'px');
    }
    if($(".page-id-1575 .program-tabs").length) {
        setTimeout(function() {
            // Clear tabs
            $(".program-tabs .vc_tta-tab").each(function(i,a) {
                $(a).removeClass("vc_active");
                if(i == 1) {
                    $(a).addClass("vc_active");
                }
            });
            // Clear panels
            $(".program-tabs .vc_tta-panels").children().each(function(i) {
                $(this).removeClass("vc_active");
                if(i == 1) {
                    $(this).addClass("vc_active");
                }
            });
            //$("#1660805420415-bc3ebf0b-40d9").addClass('vc_active');


        },100);
        if($(".page-id-6065 .program-tabs").length) {
            setTimeout(function () {
                // Clear tabs
                $(".program-tabs .vc_tta-tab").each(function (i, a) {
                    $(a).removeClass("vc_active");
                    if (i == 0) {
                        $(a).addClass("vc_active");
                    }
                });
                // Clear panels
                $(".program-tabs .vc_tta-panels").children().each(function (i) {
                    $(this).removeClass("vc_active");
                    if (i == 0) {
                        $(this).addClass("vc_active");
                    }
                });
                //$("#1660805420415-bc3ebf0b-40d9").addClass('vc_active');


            }, 100);
        }
    }
});
function filterWebinars(filter_in) {
    //alert(e);
    var $ = jQuery;
    var post_id = $(".event-filter").data('post');
    $.ajax({
        url: ajaxurl + "?action=ajax&call=filterWebinars&filter=" + filter_in + "&post_id="+post_id,
        cache: false,
        success: function (response) {
            $(".events-wrapper").html(response).fadeIn();
        }
    });
}
function filterEvent(cat_id) {
    //alert(e);
    var $ = jQuery;
    $.ajax({
        url: ajaxurl + "?action=ajax&call=filterEvents&category_id=" + cat_id,
        cache: false,
        success: function (response) {
            $(".events-wrapper").html(response).fadeIn();
        }
    });
}
function filterCourses(filter_in) {
    //alert(e);
    var $ = jQuery;
    var post_id = $(".event-filter").data('post');
    $.ajax({
        url: ajaxurl + "?action=ajax&call=filterCourses&filter=" + filter_in + "&post_id="+post_id,
        cache: false,
        success: function (response) {
            $(".events-wrapper").html(response).fadeIn();
        }
    });
}