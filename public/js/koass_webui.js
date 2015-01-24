	// FineSchmecker funksjon for � justere inn overlay-menyer
	function applyMargins() {
        var leftToggler = $(".mini-submenu-left");
        var rightToggler = $(".mini-submenu-right");
        if (leftToggler.is(":visible")) {
          $("#mapDiv .ol-zoom")
            .css("margin-left", 0)
            .removeClass("zoom-top-opened-sidebar")
            .addClass("zoom-top-collapsed");
        } else {
          $("#mapDiv .ol-zoom")
            .css("margin-left", $(".sidebar-left").width())
            .removeClass("zoom-top-opened-sidebar")
            .removeClass("zoom-top-collapsed");
        }
        if (rightToggler.is(":visible")) {
          $("#mapDiv .ol-rotate")
            .css("margin-right", 0)
            .removeClass("zoom-top-opened-sidebar")
            .addClass("zoom-top-collapsed");
        } else {
          $("#mapDiv .ol-rotate")
            .css("margin-right", $(".sidebar-right").width())
            .removeClass("zoom-top-opened-sidebar")
            .removeClass("zoom-top-collapsed");
        }
      }
	  
	  // Har vi lite pixler i viewport?
      function isConstrained() {
        return $("div.mid").width() == $(window).width();
      }
	  
	  // Set onLoad tilstand
      function applyInitialUIState() {
        if (isConstrained()) {
          $(".sidebar-left .sidebar-body").fadeOut('slide');
          $(".sidebar-right .sidebar-body").fadeOut('slide');
          $('.mini-submenu-left').fadeIn();
          $('.mini-submenu-right').fadeIn();
        }
      }
	  
	  // Overlay meny - voodo
      $(function(){
        $('.sidebar-left .slide-submenu').on('click',function() {
          var thisEl = $(this);
          thisEl.closest('.sidebar-body').fadeOut('slide',function(){
            $('.mini-submenu-left').fadeIn();
            applyMargins();
          });
        });
        $('.mini-submenu-left').on('click',function() {
          var thisEl = $(this);
          $('.sidebar-left .sidebar-body').toggle('slide');
          thisEl.hide();
          applyMargins();
        });
        $('.sidebar-right .slide-submenu').on('click',function() {
          var thisEl = $(this);
          thisEl.closest('.sidebar-body').fadeOut('slide',function(){
            $('.mini-submenu-right').fadeIn();
            applyMargins();
          });
        });

        $('.mini-submenu-right').on('click',function() {
          var thisEl = $(this);
          $('.sidebar-right .sidebar-body').toggle('slide');
          thisEl.hide();
          applyMargins();
        });

        $(window).on("resize", applyMargins);



		// Gj�r justeringer iht
        applyInitialUIState();
        applyMargins();
	}); // END autoLoad
