jQuery(document).ready(function($){
    if( jQuery("body").hasClass("node-type-challenge") ){
        if( jQuery("body.node-type-challenge .field-field-valid-date").length==0 ){
            jQuery("body.node-type-challenge .full-node").append(
                jQuery("<div class='field-field-valid-date'></div>")
            )
        }
    }
    jQuery(".imagecache-active_users_faces").each( function(){
       jQuery(this).attr("src","http://ceg/sites/default/files/imagecache/profile_pictures/default-user.png"); 
    });
    /* TODO: use nth-child pseudoselectors */
    jQuery("#nav-group ul.menu li").each( function(index){
        if(index==1){
            jQuery(this).addClass("second");
        }
        if(index==2){
            jQuery(this).addClass("third");
        }
    });
    jQuery(".pager-current").addClass("pager-item");
    if( jQuery("#content-tabs-inner .tabs li").length > 0 ){
        jQuery("body").addClass("hastabs");
    }
    if( jQuery("#sidebar-last").length > 0 || jQuery("#sidebar-first").length > 0 ){
        jQuery("body").addClass("has_one_sidebar");
    }
    jQuery("#page ul.pager").each( function(index){
        jQuery(this).children("li.pager-item").each( function(index2){
            if(index2==0){
                jQuery(this).addClass("first");
            }
        });
    });
    jQuery("#block-views-home_slideshow-block_1").bind(
        "mouseenter",function(){
            jQuery(this).find(".views-slideshow-controls-top").show();
        }).bind("mouseleave",function(){
            jQuery(this).find(".views-slideshow-controls-top").hide();
        });
    jQuery("body.node-type-idea .field-field-idea-challenge" ).append(
        jQuery("<div class='challenge-state-wrapper'></div>").append(
            jQuery("body.node-type-idea .challenge-state"),
            jQuery("body.node-type-idea .field-field-valid-date")
        )
    )
    jQuery("body.page-comment .node-type-idea .field-field-idea-challenge" ).append(
        jQuery("<div class='challenge-state-wrapper'></div>").append(
            jQuery("body.page-comment .node-type-idea .challenge-state"),
            jQuery("body.page-comment .node-type-idea .field-field-valid-date")
        )
    )
    if( jQuery("body").hasClass("node-type-idea") || jQuery("body").hasClass("node-type-challenge") || jQuery("body").hasClass("page-comment") ) {
        jQuery("body .submitted a").each( function(){
            if( jQuery(this).parent(".username").length==0  && jQuery(this).find("img").length==0 ){
                jQuery(this).append(
                    jQuery( "<img width='40' height='40' class='imagecache imagecache-users_40_40_ceg' src='/system/files/imagecache/users_cabecera_ceg/default-user.png' />" )
                )
            }
        });
    }
    jQuery("body.node-type-challenge #content-content").after(
        jQuery("<h3 class='view-challenge-ideas-title' >Ideas propuestas</h3>"),
        jQuery(".view-challenge-ideas")
    );
    jQuery("body.node-type-question #content-content").after(        
        jQuery("<h3 class='view-question-answers-title' >"+jQuery("h1").text()+"</h3>"),
        jQuery(".view-question-answers")
    );
    
    var calendar_view = jQuery("attachment-after > calendar-calendar div");
    
    if ( calendar_view.hasClass("year-view") ){
        jQuery(".calendar-year").addClass("active");
    }
    if ( calendar_view.hasClass("month-view") ){
        jQuery(".calendar-month").addClass("active");
    }
    if ( calendar_view.hasClass("week-view") ){
        jQuery(".calendar-week").addClass("active");
    }
    if ( calendar_view.hasClass("day-view") ){
        jQuery(".calendar-day").addClass("active");
    }
});