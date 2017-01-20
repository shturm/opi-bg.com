$(function() {
        /*
		//vars
		var conveyor = $(".content-conveyor", $("#similar-images")),
		item = $(".similar-cont", $("#similar-images"));
		
		//set length of conveyor
		conveyor.css("width", item.length * parseInt(item.css("width"))+50);
				
        //
        var sliderOpts = {
		  max: (item.length * parseInt(item.css("width"))) -   parseInt($(".viewer", $("#similar-images")).css("width")),
          slide: function(e, ui) {
            conveyor.css("left", "-" + ui.value + "px");
          }
        };

        //create slider
        $("#slider").slider(sliderOpts);
        */
        //Horizontal Slider
        var conveyor = $(".content-conveyor", $(".selled-products")),
		item = $(".similar-cont", $(".selled-products"));
		var viewer = $(".viewer", $(".selled-products"));
		
		//set length of conveyor
		conveyor.css("width", item.length * parseInt(item.css("width")));
		var $difference = conveyor.width()-viewer.width()-50;
		var $max = item.length-2;
		if($difference<0){ $difference = 0; $max =0; }
        //
        var sliderOpts = {
          orientation:'horizontal',
		  range: "min",
          min: 0,
	      max: $max,
		  value: 0,
          slide: function(e, ui) {
          	
            conveyor.css({right:((ui.value)*$difference/100)});
          }
        };
        
        //create slider
        $("#slider").slider(sliderOpts);

        //Vertical Slider
        var vconveyor = $(".vcontent-conveyor", $(".selled-products-vertical")),
		vitem = $(".similar-cont", $(".selled-products-vertical"));
		var vviewer = $(".vviewer", $(".selled-products-vertical"));
		//set length of conveyor
		vconveyor.css("height", vitem.length * parseInt(item.css("height"))+50);
		var difference = vconveyor.height()-vviewer.height();
        //
        var vsliderOpts = {
          orientation:'vertical',
          range: "min",
          min: 0,
	      max: 100,
		  value: 100,
          slide: function(e, ui) {
            vconveyor.css({top:-((100-ui.value)*difference/100)});
          }
        };

        //create slider
        $("#vslider").slider(vsliderOpts);
        
        //AdminPanelSlider
        var aconveyor = $(".content-sl", $("#image-select"));
		var aitem = $(".item-image", $("#image-select"));
		var aviewer =$(".img-viewer", $("#image-select"));
		//set length of conveyor
		aconveyor.css("width", aitem.length * 80);
		var $adifference = aconveyor.width()-350;
		var $amax = 100;
		if($adifference<0){ $adifference = 0; $amax =0; }
        //
        var AsliderOpts = {
		  orientation:'horizontal',
		  range: "min",
          min: 0,
	      max: $amax,
		  value: 0,
          slide: function(e, ui) {
            aconveyor.css({right:((ui.value)*$adifference/100)});

          }
        };
        
        //create slider
        $("#image-slider").slider(AsliderOpts);
      });