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
});