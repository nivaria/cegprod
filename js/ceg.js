jQuery(document).ready(function($){
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
    if( jQuery("body").hasClass("node-type-idea") || jQuery("body").hasClass("node-type-challenge") ) {
        jQuery("body .submitted a").each( function(){
            if( jQuery(this).parent(".username").length==0  && jQuery(this).find("img").length==0 ){
                jQuery(this).append(
                    jQuery( "<img width='40' height='40' class='imagecache imagecache-users_40_40_ceg' src='/system/files/imagecache/users_cabecera_ceg/default-user.png' />" )
                )
            }
        });
    }
});