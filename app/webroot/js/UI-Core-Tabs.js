

var CoreTabs =
{
 prev_top:-1, //$(this)[0].prev_left
 prev_left:-1,//$(this)[0].prev_top
 init:function()
 {
  this.close_button_events();
  this.tab_open_event();
 },
 close_tabs:function() {
 var $self = this;
    $("#inner-tabs div.tab-text").each(function(a) {
        if ($(this).parent().attr("open") == "true") {
        $(".close").css("display", "none");
        $(this).parent().attr("open", "false");
        var $prev_top = $(this).parent().offset().top;
        var $prev_left = $(this).parent().offset().left;
        var l = ($prev_left + $self.prev_left).toString();
        $(this).parent().animate({right:'0'});
        $(this).parent().offset({
            top: $self.prev_top
        });
        $(this).parent().children(".tab-content").css("display", "none");
        
        }
        
    });
    $self.prev_top=-1;
    $self.prev_left=-1;
  },
 
 tab_open_event:function()
 {
  var self = this;
  $("#inner-tabs div.tab-text").live("click", function() {
    if ($(this).parent().attr("open") != "true") {
        self.close_tabs();
        $(this).parent().attr("open", "true");
        var $mod = 200;
        var $prev_left = $(this).parent().offset().left;
        var $prev_top = $(this).parent().offset().top;
        if (self.prev_top == -1) self.prev_top = $prev_top;
        var adj = $(this).parent().children(".tab-content").width();
        if (self.prev_left == -1) self.prev_left = adj + 50;
        if ($.browser.msie == true) $mod = 109;
        
        var l = (adj+50).toString();
        $(this).parent().animate({right:l});
        $(this).parent().offset({
            top: $mod
        });
        
        $(".close").css("display", "block");
        if ($.browser.msie != true)
         $(".close").css({top:($prev_top-95)});
        else
          $(".close").css({top:$prev_top});
        $(this).parent().children(".tab-content").css("display", "block");
    } else {
    	$(".close").css("display", "none");
        $(this).parent().attr("open", "false");
        var $prev_top = $(this).parent().offset().top;
        var $prev_left = $(this).parent().offset().left;

        $(this).parent().animate({right:'0'});
        $(this).parent().offset({
            top: self.prev_top
        });
        $(this).parent().children(".tab-content").css("display", "none");
       }
    });
 },
  close_button_events:function()
  {
  	var self = this;
    $(".circle-close").click(function(){ self.close_tabs();});
    $(".close").click(function(){ self.close_tabs();});
  }


 /*End Of [Object]*/
};