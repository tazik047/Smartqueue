
(function($) {
  /**
   * @todo
   */
  
  
  Drupal.behaviors.helpdeskDropdownMenu = {
    attach: function (context) {
        $('.dropdown').hover(
        function () {
			$(this).addClass('open');
		},
		
        function () {
			$(this).removeClass('open');
		}
		);
    }
  };
  
  
  Drupal.behaviors.helpdeskEqualHeights = {
    attach: function (context) {
      $('body', context).once('views-row-equalheights', function () {
        $(window).resize(function() {
          $($('.view-list-equalheight .view-content').get().reverse()).each(function () {
            var elements = $(this).children('.views-row').css('height', '');
            if($(window).width() > 960) {
              var tallest = 0;
              elements.each(function () {    
                if ($(this).height() > tallest) {
                  tallest = $(this).height();
                }
              }).each(function() {
                if (($(this).height() < tallest) || ($(this).height() == tallest)) {
                  $(this).css('height', tallest);
				  $('.views-row-inner',this).css('height', tallest);
                }
              });
			}
			else {
				elements.each(function () {
				  $(this).css('height', 'auto');
				  $('.views-row-inner',this).css('height', 'auto');
				});
			}
          });
        });
      });
    }
  };
  
  Drupal.behaviors.helpdeskEqualHeightsSidebar = {
    attach: function (context) {
      $('body', context).once('views-row-equalheights-sidebar', function () {
        $(window).resize(function() {
          
            var main_content = $('.main-content-region').css('height', '');
			var sidebar_second = $('.sidebar-second-region').css('height', '');
            if($(window).width() > 960) {
              
                if (main_content.height() > sidebar_second.height()) {
                  sidebar_second.css('height', main_content.height());
                }
				else
				  main_content.css('height', sidebar_second.height());
				
              
			}
			else {
				  main_content.css('height', 'auto');
				  sidebar_second.css('height', 'auto');
			}
          });
        
      });
    }
  };
  
  Drupal.behaviors.helpdeskGalleryPage = {
    attach: function (context) {
      $('.block-featured-business .views-field-field-image, .view-member .views-field-picture, .view-meet-our-team .views-field-field-image').hover(
        function () {
		  $(this).addClass('hover');
        },
        function () {
		  $(this).removeClass('hover');
        }
      );
    }
  };
  Drupal.behaviors.helpdeskThemeColors = {
    attach: function (context) {
      $('body', context).once('block-theme-colors-showhide', function () {													   
        jQuery('.block-theme-colors .close').click(function(e){
		  e.preventDefault();
		  jQuery('.block-theme-colors .block-theme-color-content ').hide();
		  jQuery(this).hide();
		  jQuery('.block-theme-colors .open').show();
		});
		jQuery('.block-theme-colors .open').click(function(e){
          e.preventDefault();
		  jQuery('.block-theme-colors .block-theme-color-content ').show();
		  jQuery(this).hide();
		  jQuery('.block-theme-colors .close').show();
		});  
      });
    }
  };
})(jQuery);

