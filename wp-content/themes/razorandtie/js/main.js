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
            
            $('.artists').removeClass('image-display text-display').addClass(activeClass);
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
        var itemsLength = $('.artists .artist:visible').length;
        
        $('.artists .artist:visible').each(function(i) {
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
            $('.artists .artist').fadeIn(200);
        } else {
            $('.artists .artist').each(function() {
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
        
        $(this).off('click', getNewsPage);
        
        var link = $(this).attr('href');
        $('#news').html('Loading...');
        
        $('#news').load(link + ' .news-wrapper', function( response, status, xhr ) {
            bindNewsPagination();
        });
        
    };
    
    // News pagination binding function
    var bindNewsPagination = function () {
        $('#pagination a').on('click', getNewsPage);
    };
    
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
        
        // AJAX page loading
        // *****************
        // Bind news pagination
        // Where #news exists
        if( $('#news').length > 0 ) {
            bindNewsPagination();
        }
        
        // Select Option Navigation
        // ************************
        if( $('#artist-detail-nav').length > 0 ) {
            $('#artist-detail-nav').on('change', selectOptNav );
        }
        
    }); // End doc.ready
}); // End jQuery