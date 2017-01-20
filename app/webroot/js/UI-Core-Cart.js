
var CoreCart =
{
 //General Cart
 //XHR urls
 index_url:'http://opi-bg.com/cart/index',
 change_url:"http://opi-bg.com/cart/change",
 add_url:"http://opi-bg.com/cart/add",
 remove_url:"http://opi-bg.com/cart/remove",
 trim_url:"http://opi-bg.com/cart/trim",
 total_price:0,
 step_number:0,
 
 
 init:function()
 {
  this.count_update_event();
  this.buy_button_event();
  this.remove_button_event();
  this.clear_button_event();
  this.top_cart_button_order();
  this.top_cart_button_event();
 },
 
 
 update_prices:function()
 {
   var $sum = 0;
  $(".cart-final-price").each(function(){
    $sum = $sum+ parseFloat($(this).children("span").html());
  })
  $("#cart-price span").html($sum);
 },
 //Events 
 count_update_event:function()
  {
    var self = this;
    $('input[name=\'buy-count\']').keypress(function(event){
     if (event.which<48||event.which>57) {
       event.preventDefault();
    }});
    $('input[name=\'buy-count\']').keyup(function (event) {

        if ($("#cart-view")[0] != undefined) {
            var $id = $(this).parents("tr").children(":first").children("div").children().val();
            var $forged = self.change_url + "/" + $id + "/" + $(this).val()+'?'+(new Date()).toISOString();
            
            $.ajax({
                url: $forged,
                mimeType: 'text/html',
                success: function (data) {
                    self.update_top_cart(data);
                }
            });
            
            var product_type = $(this).parent().
            parent("tr").children("td").
            children('input[name="product-type"]').val();
            
            if(product_type=="product")
            {  
              if($(this).val()<6) price_value="single-value";
              if($(this).val()>=6) price_value="mult-value-6";
              if($(this).val()>=12) price_value="mult-value-12";
            }
            
            if(product_type=="lacquer")
            {
             //get lacquer count
             lcount = 0;
             $('input[name="product-type"]').each(function()
             {
               //alert(
               if($(this).val()=="lacquer") 
                lcount+=parseFloat($(this).parent().parent().children(":eq(3)").children().val());
               //$('input[name=\'buy-count\']')
             });
             
             if(lcount<6) price_value="single-value";
             if(lcount>=6) price_value="mult-value-6";
             if(lcount>=12) price_value="mult-value-12";
             //Update all lacquers single value
             $('input[name="product-type"]').each(function(){
               if($(this).val()=="lacquer"){
                 precision = 2;
                 var power = Math.pow(10, precision || 0);
                 bcount = $(this).parent().parent().children(":eq(3)").children();
                 var $disc = bcount.parent().
                 parent("tr").children("td").
                 children('input[name="product-discount"]').val();
                
                 if($disc!=0)   $disc = ($disc/100); else $disc = 0;
                
                 var $price = parseFloat(bcount.parent().
                 parent("tr").children("td").
                 children('input[name=\"'+price_value+'\"]').val());
                 $disc = bcount.val() * $price *$disc;
                
                 bcount.parent().
                 parent("tr").children("td").children('input[name=\"'+price_value+'\"]').parent("td").children("span").html($price);
                 bcount.parent().parent().children(".cart-final-price").children("span").
                 html(Math.round((bcount.val() * $price-$disc)*power)/power);
                 
                }});
            }
            
            //Rounding
            precision = 2;
            var power = Math.pow(10, precision || 0);
            //Standalone discount
            var $disc = $(this).parent().
            parent("tr").children("td").
            children('input[name="product-discount"]').val();
            
            if($disc!=0)    $disc = ($disc/100); else $disc = 0;
            
            var $price = parseFloat($(this).parent().
            parent("tr").children("td").
            children('input[name=\"'+price_value+'\"]').val());
            $disc_ = $price*$disc;
            $disc = $(this).val() * $price *$disc;
            
            
            $(this).parent().
            parent("tr").children("td").children('input[name=\"'+price_value+'\"]').parent("td").children("span").html//($price);
            (Math.round(($price-$disc_)*power)/power);
            
            
            $(this).parent().parent().children(".cart-final-price").children("span").
            html(Math.round(($(this).val() * $price-$disc)*power)/power);
            
            
            var $sum = 0;
            $(".cart-final-price").each(function () {
                $sum = $sum + parseFloat($(this).children("span").html());
            })
            $sum = Math.round($sum * power) / power;
            $("#cart-price span").html($sum);
            //self.update_discount();
            
        }
    });
  },
 
 /* Buy Button Event
 it('description', function(done) {
   
 });
 */
 buy_button_event:function()
 {
   var self = this;
   $('input[name=\'buy-button\']').live("click",function(){
     //get id
     var $id = $(this).parent().children('input[name=\'buy-id\']').val();
     var $count = $(this).parent().children('input[name=\'buy-count\']').val();
     var $forged = self.add_url+"/"+$id+"/"+$count+'?'+(new Date()).toISOString();
     console.log($forged);
     $.get($forged,function(data){
      self.update_top_cart(data);
     });
    });
 },
 /* Remove Button Event
 
 */
 remove_button_event:function()
 {
  var self = this;
  $(".remove-item").click(function(){
    var $id = $(this).children("input").val();
    var $forged = self.remove_url+"/"+$id+'?'+(new Date()).toISOString();
    var $item = $(this).parent().parent();
    $.get($forged,function(data){
        $item.remove();
        self.update_top_cart(data);
        self.update_prices();
    });
  });
 },
 /* Clear Button Event
 
 */
 clear_button_event:function()
  {
     var self = this;
    $('input[name=\'clear-cart\']').click(function(){
     var $forged = self.trim_url+'?'+(new Date()).toISOString();
     $.get($forged,function(data){
      $("#cart-view tbody>tr:has(input)").remove();
      self.update_top_cart(data);
      self.update_prices();
     });
    });
  },
 
 
 //Top Cart
 
 /*
   Update Cart Dropdown data
   @param data
 */
 update_top_cart:function(data)
 {
  $(".cart-cont").remove();
  $("#outer-header").append(data);
 },
 /*
    Top Cart Button Dropdown trigger
 */
 cdropdown_opened:false,
 top_cart_button_event:function()
 {
  var $self = this;
  $(".cart-button").live("click",function(){
  if($self.cdropdown_opened==false){
    $(".cart-button").css("background-position","0px 15px");
    $(this).parent().parent().children("#cart-dropdown").fadeIn("fast");
    $self.cdropdown_opened = true;
   }else {
    $(".cart-button").css("background-position","0 0");
    $(this).parent().parent().children("#cart-dropdown").fadeOut("fast");
    $self.cdropdown_opened = false;
   }
  });
 },
 /*
   Top Cart Order button event 
 */
 top_cart_button_order:function()
 {
  var self = this;
  $("input[name=\"order-cart-button\"]").live("click",function(){window.location = self.index_url+'?'+(new Date()).toISOString();});
 }
 /*End Of [Object]*/
};