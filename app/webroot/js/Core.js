
$(document).ready(function() {
  

 
 //Product View
 $("#other-images img").live("click",function(){
   var $new_src = $(this).attr("src");
		$("#full-image img").attr("src",$new_src);
	$("#other-images img").css("border-left","3px solid #808080");
	$("#other-images img").removeClass("selected");
	$(this).addClass("selected");
	$(this).css("border-left","3px solid #FFA500");
  });
 
 $("#other-images img").live("mouseover",function(){
  if(!$(this).hasClass("selected"))
    $(this).css("border-left","3px solid #FFA500");
 });
 
 $("#other-images img").live("mouseout",function(){
	if(!$(this).hasClass("selected"))
	 $(this).css("border-left","3px solid #808080");
 });
 
 $("input[name=\"invoice-check\"]").live("click",function()
 {
   if( $(this).is(':checked'))
   {
   	 $("#invoice-info").fadeIn("fast");
   }else
   	   {
   	     $("#invoice-info").fadeOut("fast");
   	   }
 });
 $(".item-image").live("click",function()
 {
  var $id = $(this).children("img").attr("id");
  var $src = $(this).children("img").attr("src");
  $("#imagefull").attr("src",$src);
  $("#thumb_id").html($id);
 });
 $("#link_picker").live("change",function(){ $("#link").val($("#link_picker option:selected").val()); })
 
 var base_url = 'http://opi-bg.com/';
function toggle_button(act,id,caller)
 {
  $forged = base_url+"admin/products/toggle"+act+"/"+id;
  $.get($forged,{},function(data)
  	 {
  	 	if(data.status=='1')
  	 	{
  	 	 
  	     if(act == "Active")
  	 	 if(caller.hasClass("ui-active")){ caller.removeClass("ui-active"); caller.addClass("ui-inactive")}
         else { caller.removeClass("ui-inactive"); caller.addClass("ui-active")}
         if(act == "Pro")
         if(caller.hasClass("ui-pro")){ caller.removeClass("ui-pro"); caller.addClass("ui-no-pro")}
         else { caller.removeClass("ui-no-pro"); caller.addClass("ui-pro")}
         if(act == "Action")
         if(caller.hasClass("ui-action")){ caller.removeClass("ui-action"); caller.addClass("ui-no-action")}
         else { caller.removeClass("ui-no-action"); caller.addClass("ui-action")}
         if(act == "Featured")
         if(caller.hasClass("ui-featured")){ caller.removeClass("ui-featured"); caller.addClass("ui-no-featured")}
         else { caller.removeClass("ui-no-featured"); caller.addClass("ui-featured")}
  	 	}
  	 });
 };
 $(".ui-active,.ui-inactive").live("click",function()
 {
   var $id = $(this).parents("tr").children(":eq(0)");
   toggle_button("Active",$id.html(),$(this));

 })
 
  $(".ui-pro,.ui-no-pro").live("click",function()
 {
  var $id = $(this).parents("tr").children(":eq(0)");
  toggle_button("Pro",$id.html(),$(this));

 })
 $(".ui-action,.ui-no-action").live("click",function()
 {
  var $id = $(this).parents("tr").children(":eq(0)");
  toggle_button("Action",$id.html(),$(this));
  
 })
  $(".ui-featured,.ui-no-featured").live("click",function()
 {
  var $id = $(this).parents("tr").children(":eq(0)");
  toggle_button("Featured",$id.html(),$(this));
  
 })
 
  CoreCart.init();
  CoreMenu.init();
  CoreTabs.init();
  
});