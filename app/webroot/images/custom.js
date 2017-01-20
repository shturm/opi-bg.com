﻿$("#inner-header li.level-0").live("mouseover", function() {
    var $drop = $(this).children(".dropdown-menu");
    var isOverflowing = ($(this).offset().left+$drop.width() ) > 1024;
    if(isOverflowing){
    $(this).children(".dropdown-menu").addClass('right-dropdown');
    $(this).children(".dropdown-menu").css('margin-left',-$drop.width()/2+2)
    }
    $(this).children(".dropdown-menu").css("display", "block");

});


$("#inner-header li.level-0").live("mouseout", function() {

    $(this).children(".dropdown-menu").css("display", "none");

});

$(".dropdown-menu li").live("mouseover", function() {
    if($(this).parent().parent().hasClass('right-dropdown'))
     {
      $(this).children(".dropdown-menu").addClass('right-dropdown');
     }
    $(this).children(".dropdown-menu").css("display", "block");

});

$(".dropdown-menu li").live("mouseout", function() {
    $(this).children(".dropdown-menu").css("display", "none");

});

HTMLDivElement.prototype.animating = false;

$(".lower-item").live("mouseover", function() {
	
	if($(this)[0].animating==false)
	{
	 $(".lower-item").animating = false;
	 $(".lower-item").css("margin-top","0px");
	 $(".lower-item").parent().children(".hover-blob").css("display","none");
	 $(this)[0].animating = true;
	 $(this).css("margin-top","-15px");
     $(this).parent().children(".hover-blob").fadeIn("fast",function(){ 
      $(this).parent().children(".lower-item")[0].animating=false;
     });
    }
});

$(".lower-item").live("mouseout", function() {
  	if($(this)[0].animating==false)
	{
	 $(this)[0].animating = true;
	 $(this).css("margin-top","0px");
     $(this).parent().children(".hover-blob").fadeOut("fast",function(){ 
     $(this).parent().children(".lower-item")[0].animating=false;
    });
    }
});

function close_tabs() {
    $("#inner-tabs div.tab-text").each(function(a) {
        if ($(this).parent().attr("open") == "true") {
        $(".close").css("display", "none");
        $(this).parent().attr("open", "false");
        var $prev_top = $(this).parent().offset().top;
        var $prev_left = $(this).parent().offset().left;
        var l = ($prev_left + $(this)[0].prev_left).toString();
        $(this).parent().animate({right:'0'});
        $(this).parent().offset({
            top: $(this)[0].prev_top
        });
        $(this).parent().children(".tab-content").css("display", "none");

        }
    });
}
HTMLDivElement.prototype.prev_top = -1;
HTMLDivElement.prototype.prev_left = -1;
$("#inner-tabs div.tab-text").live("click", function() {



    if ($(this).parent().attr("open") != "true") {
        close_tabs();
        $(this).parent().attr("open", "true");
        var $mod = 200;
        var $prev_left = $(this).parent().offset().left;
        var $prev_top = $(this).parent().offset().top;
        if ($(this)[0].prev_top == -1) $(this)[0].prev_top = $prev_top;
        var adj = $(this).parent().children(".tab-content").width();
        if ($(this)[0].prev_left == -1) $(this)[0].prev_left = adj + 50;
        if ($.browser.msie == true) $mod = 109;
        
        var l = (adj+50).toString();
        $(this).parent().animate({right:l});
        $(this).parent().offset({
            top: $mod
        });
        $(".close").css("display", "block");
        if ($.browser.msie != true)
         $(".close").css("top",$prev_top-98);
        else
          $(".close").css("top",$prev_top);
        $(this).parent().children(".tab-content").css("display", "block");
    } else {
    	$(".close").css("display", "none");
        $(this).parent().attr("open", "false");
        var $prev_top = $(this).parent().offset().top;
        var $prev_left = $(this).parent().offset().left;

        $(this).parent().animate({right:'0'});
        $(this).parent().offset({
            top: $(this)[0].prev_top
        });
        $(this).parent().children(".tab-content").css("display", "none");

    }
});



$("#other-images img").live("click",function(){
var $new_src = $(this).attr("src");
$("#full-image img").attr("src",$new_src);
$("#other-images img").css("border-left","3px solid grey");
$("#other-images img").removeClass("selected");
$(this).addClass("selected");
$(this).css("border-left","3px solid orange");

});
$("#other-images img").live("mouseover",function(){
if(!$(this).hasClass("selected"))
  $(this).css("border-left","3px solid orange");
});

$("#other-images img").live("mouseout",function(){
if(!$(this).hasClass("selected"))
 $(this).css("border-left","3px solid grey");
});



$(".cart-button").live('click',function(){
	
 if($(this).parent().parent().hasClass("closed"))
 {
  $(this).parent().parent().removeClass('closed');
  $(this).parent().parent().addClass('opened');
  $(".cart-button").addClass('pushed');
  $(this).parent().parent().children("#cart-dropdown").fadeIn("fast");
 }else 
 	  {
 	  	$(this).parent().parent().removeClass('opened');
 	  	$(this).parent().parent().addClass('closed');
 	  	$(".cart-button").removeClass('pushed');
        $(this).parent().parent().children("#cart-dropdown").fadeOut("fast");
 	  }
});

$('input[name=\'buy-count\']').live('keypress',function(event){

 if (event.which<48||event.which>57) {
     event.preventDefault();
   }
});
function update_prices()
{
  var $sum = 0;
  $(".cart-final-price").each(function(){
    $sum = $sum+ parseInt($(this).children("span").html());
  })
  $("#cart-price span").html($sum);
}

$('input[name=\'buy-count\']').live('keyup',function(event){

  var $price = $(this).parent().parent("tr").children("td").children('input[name=\"single-value\"]').val();
  console.log($price);
  $(this).parent().parent().children(".cart-final-price").children("span").
  html($(this).val()*$price);
  
  var $sum = 0;
  $(".cart-final-price").each(function(){
    $sum = $sum+ parseInt($(this).children("span").html());
  })
  $("#cart-price span").html($sum);
}); 

$('input[name=\'buy-button\']').live("click",function(){
 //get id
 var $id = $(this).parent().children('input[name=\'buy-id\']').val();
 var $count = $(this).parent().children('input[name=\'buy-count\']').val();
 var $forged = "http://opi.urghh.net/cart/add"+"/"+$id+"/"+$count;
 $.get($forged,function(data){
  console.log(data);
 });
});
$(".remove-item").live("click",function(){
 var $id = $(this).children("input").val();
 var $forged = "http://opi.urghh.net/cart/remove"+"/"+$id;
 $.get($forged,function(data){
  console.log(data);
 });
});