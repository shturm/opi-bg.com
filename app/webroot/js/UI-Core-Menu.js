

var CoreMenu =
{
 //Top Menu
 init:function()
 {
  this.level0_init();
  this.lower_menu_init();
  this.user_dropdown_init();
 },
 top_overlay:false,
 level0_init:function()
 {
	$(".dropdown-menu").each(function()
		{
		 var $drop = $(this);
    	 var isOverflowing = ($(this).parent().offset().left+$drop.width() ) > 1024;
    	 if(isOverflowing){
    		$(this).addClass('right-dropdown');
    		$(this).css('margin-left',-$drop.width()/2+2)
    	 }
		 $(this).parent().hover(function(){ $('.dropdown-menu:eq(0)', this).show(); },
		                        function(){ $('.dropdown-menu:eq(0)', this).hide(); });
		})
 },

 
 //Lower Menu
 animating:false,
 lower_menu_init:function()
 {
  var $self = this;
  $(".lower-item").hover(function() 
  	  {if($self.animating==false){  $self.animating=true;
  	    $(this).parent().children(".hover-blob").fadeIn(100,
  	    	function(){ $(this).parent().children(".lower-item").css("margin-top","-5px"); setTimeout(function(){$self.animating=false;},30);}); 
  	    		}},
  	    function() { $(".lower-item").css("margin-top","0px"); $(".lower-item").parent().children(".hover-blob").fadeOut("fast")});
 },
 udropdown_opened:false,
 user_dropdown_init:function()
 {
  var $self = this;
  $("#user-button").live("click",function(){
  if($self.udropdown_opened==false){
    $("#user-button").css("background-position","0px 15px");
    $("#user-dropdown").fadeIn("fast");
    $self.udropdown_opened = true;
   }else {
    $("#user-button").css("background-position","0 0");
    $("#user-dropdown").fadeOut("fast");
    $self.udropdown_opened = false;
   }
  });
 }
/*End Of [Object]*/
};