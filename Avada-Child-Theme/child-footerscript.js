jQuery(document).ready(function(){
//     var icone = '<i class="fa fa-home" aria-hidden="true"></i>';
//     jQuery("section.fusion-tb-header .fusion-breadcrumbs span:first-child span").html(icone);
// 	var breadseprator = '<img src="/wp-content/uploads/2022/05/Vector.svg" alt="arrow">';
//     jQuery(".topheader-breadcrumbs .fusion-breadcrumbs span span:after").attr('content','>');
});


jQuery(document).ready(function(){
 jQuery(document).on('click','.dcsLoadMorePostsbtn',function(){
 var ajaxurl = dcs_frontend_ajax_object.ajaxurl;
 var dcsPostType = jQuery('input[name="dcsPostType"]').val();
 var offset = parseInt(jQuery('input[name="offset"]').val() );
 var dcsloadMorePosts = parseInt(jQuery('input[name="dcsloadMorePosts"]').val() );
 var newOffset = offset+dcsloadMorePosts;
 jQuery('.btnLoadmoreWrapper').hide();
 jQuery.ajax({
 type: "POST",
 url: ajaxurl,
 data: ({
 action: "dcsAjaxLoadMorePostsAjaxReq",
 offset: newOffset,
 dcsloadMorePosts: dcsloadMorePosts,
 postType: dcsPostType,
 }),
 success: function(response){
 if (!jQuery.trim(response)){ 
 // blank output
 jQuery('.noMorePostsFound').show();
 }else{
 // append to last div
 jQuery(response).insertAfter(jQuery('.loadMoreRepeat').last());
 jQuery('input[name="offset"]').val(newOffset);
 jQuery('.btnLoadmoreWrapper').show();
 }
 },
 beforeSend: function() {
 jQuery('.dcsLoaderImg').show();
 },
 complete: function(){
 jQuery('.dcsLoaderImg').hide();
 },
 });
 });
});