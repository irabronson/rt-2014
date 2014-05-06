jQuery(function($) {
    
    // Toggle Artist List
    // ******************
    // Between image and text
    var toggleDisplay = function (e) {
        
        $('#toggle-display a').unbind('click', toggleDisplay);
        
        e.preventDefault();
        
        var activeClass = $(this).attr('id');
        
        if( $(this).hasClass('active') === false ) {
            $('#toggle-display a.active').removeClass('active');
            $(this).addClass('active');
            
            $('.artist-list').removeClass('image-display text-display').addClass(activeClass);
        }
        
        $('#toggle-display a').bind('click', toggleDisplay);
    };
    
    // Artist Category Filtering
    // *************************
    // Currently only appears on the homepage
    var filterArtists = function (e) {
        e.preventDefault();
        
        $('ul#filters a').off( 'click', filterArtists );
        
        var filterVal = $(this).attr('data-filter');
        var itemsLength = $('.artist-list .artist:visible').length;
        
        $('.artist-list .artist:visible').each(function(i) {
            $(this).fadeOut(30, function(){
                if(itemsLength == ++i) {
                    showArtists(filterVal);
                }
            });
        });
        
        // Adds/removes 'active' class to selected item
        // Adds the 'active' class to the first anchor
        // $('ul#filters a').first().addClass("active");
        $('ul#filters .active').removeClass('active');
        $(this).addClass('active');
        
        $('ul#filters a').on( 'click', filterArtists );
    };
    
    // Shows results for
    // Artists Category Filter
    var showArtists = function(filterVal) {
        if(filterVal == 'all') {
            $('.artist-list .artist').fadeIn(200);
        } else {
            $('.artist-list .artist').each(function() {
                if($(this).attr('data-filter') === filterVal ) {
                    $(this).fadeIn(200);
                }
            });
        }
    };

    // AJAX page loading
    // *****************
    // For News Posts on homepage
    var getNewsPage = function(e) {

        e.preventDefault();

        var link = $(this).attr('href');

        $('#news .news-content-wrapper').html('<img src="/wp-content/themes/razorandtie/images/loading.gif">');
        
        $('#news .news-content-wrapper').load(link + ' .news-content', function( response, status, xhr ) { });

    };
    
    // News pagination binding function

        $('#news').on('click', '#pagination a', getNewsPage);

    // Select Option Navigation
    // ************************
    // Appears on Artist Detail page as supplementary nav
    var selectOptNav = function () {
        
        if ($(this).val()!='') {
            $('#artist-detail-nav').off('change', selectOptNav );
            window.location.href=$(this).val();
            $('#artist-detail-nav').html('<option>Loading...</option>');
        }
    };
    
    
    // DOM events after doc.ready
    // **************************
    $(document).ready(function () {
        
        // Browser Queries
        //****************
        // Add class to <html> based on browser
        if (navigator.userAgent.indexOf('Mac OS X') != -1) {
            // Mac
            if ($.browser.opera) { $('html').addClass('opera-Mac'); }
            if ($.browser.webkit) { $('html').addClass('webkit-Mac'); }
            if ($.browser.mozilla) { $('html').addClass('mozilla-Mac'); }
            if (/camino/.test(navigator.userAgent.toLowerCase())){ $('html').addClass('camino-Mac'); }
            if (/chrome/.test(navigator.userAgent.toLowerCase())) { $('html').addClass('chrome-Mac'); }
            if (navigator && navigator.platform && navigator.platform.match(/^(iPad|iPod|iPhone)$/)) { $('html').addClass('iOS'); }
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { $('html').addClass('safari-Mac'); }
        } else {
            // Not Mac
            if ($.browser.opera) { $('html').addClass('opera-Win'); }
            if ($.browser.webkit) { $('html').addClass('webkit-Win'); }
            if ($.browser.mozilla) { $('html').addClass('mozilla-Win'); }
            if (document.all && document.addEventListener) { $('html').addClass('ie9-Win'); }
            if (/chrome/.test(navigator.userAgent.toLowerCase())) { $('html').addClass('chrome-Win'); }
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { $('html').addClass('safari-Win'); }
        }
        
        // Toggle Artist List
        // ******************
        if( $('#toggle-display').length > 0 ) {
            $('#toggle-display a').bind('click', toggleDisplay);
        }
        
        // Artist Category Filtering
        // *************************
        if( $('#filters').length > 0 ) {
            $('ul#filters a').on( 'click', filterArtists );
            
            // Preselecting a filter option
            $('#filters a[data-filter="razor-tie"]').trigger('click');
            
            // Sets timeout and fades in content
            // Best for 'FlashOfUnfilteredContent'
            setTimeout(function (){
                $('.primary').fadeTo( 150 , 1 );
            }, 150);
        }
        
        // Toggle Nav height for Artists Submenu
        // *************************************
        $('li.menu-item-has-children').hover(function() {
          $('nav,header.scrolled .section-inner').toggleClass('nav-expanded');
        });

        // Expand/Collapse drawer to fit content
        // *************************************

        var newsHeight = function() {
            // Get maximum height of drawer (all news items visible, pagination visible)
            var maxht = $(".news-wrapper h3").outerHeight(true) + $("#pagination").height() + 45 + 50;
            for (var i = 1; i <= $(".news-post").length; i++) {
                maxht += $(".news-post:nth-child("+i+")").height() + 25;
            }
            
            // Get mim height of drawer (only first news item visible)
            var minht = $(".news-post:nth-child(1)").height() + $(".news-wrapper h3").outerHeight(true) + 45 + 50;

            // Check which height applies 
            if ($('#news').hasClass("news-expanded")) {
                $('#news').css({"height" : maxht + "px"});
            }
            else {
                $('#news').css({"height" : minht + "px"});
            }
        }
        
        // Expand news drawer on page load
        newsHeight();

        // Adjust news drawer on page resize
        $(window).resize(function() {
            newsHeight();
        });
        
        // Toggle Latest News expanding drawer
        // ***********************************
        $('.news-trigger-bg,.news-trigger').click(function() {
            $('#news,.news-trigger,.news-post').toggleClass('news-expanded');
            newsHeight();
        });

        // Toggle Nav/menu for iPad/mobile
        // ***********************************
        $('#nav-trigger,#nav-close').click(function() {
          $('nav,#nav-close').toggleClass('menu-expanded');
        });
        
        // AJAX page loading
        // *****************
        // For News Posts on homepage
        var getNewsPage = function(e) {

            e.preventDefault();

            var link = $(this).attr('href');

            $('#news .news-content-wrapper').html('Loading...');

            $('#news .news-content-wrapper').load(link + ' .news-content', function() { 
                newsHeight();
            });

        };

        // News pagination binding function

        $('#news').on('click', '#pagination a', getNewsPage);
        
        
        // Fire FitVids
        // ************
        $(".video").fitVids();

        // Waypoints
        // Scroll position of viewport
        // ***************************
        $("body").waypoint(function() {
           $("header,nav,.menu-primary-container,#nav-close,.sub-menu").toggleClass('scrolled');
        }, { offset: -60 });
        
        
        // Select Option Navigation
        // ************************
        if( $('#artist-detail-nav').length > 0 ) {
            $('#artist-detail-nav').on('change', selectOptNav );
        }
        
    }); // End doc.ready
}); // End jQuery